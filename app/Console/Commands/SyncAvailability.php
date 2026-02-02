<?php

namespace App\Console\Commands;

use App\Models\Availability;
use App\Services\OpsApiService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SyncAvailability extends Command
{
    protected $signature = 'sync:availability 
                            {--dry-run : Show what would be synced without making changes}
                            {--force : Force sync even if API health check fails}';

    protected $description = 'Sync room availability from the Ops System API';

    protected OpsApiService $opsApi;

    public function __construct(OpsApiService $opsApi)
    {
        parent::__construct();
        $this->opsApi = $opsApi;
    }

    public function handle(): int
    {
        $this->info('Starting availability sync from Ops System...');
        $this->newLine();

        // Check if API is configured
        if (!$this->opsApi->isConfigured()) {
            $this->error('❌ API not configured. Please set OPS_API_URL and OPS_API_KEY in .env');
            return Command::FAILURE;
        }

        // Health check
        if (!$this->option('force')) {
            $this->info('Checking API health...');
            if (!$this->opsApi->healthCheck()) {
                $this->error('❌ API health check failed. Use --force to skip this check.');
                return Command::FAILURE;
            }
            $this->info('✅ API is healthy');
            $this->newLine();
        }

        // Fetch availability data
        $this->info('Fetching availability data...');
        $data = $this->opsApi->getAvailability();

        if (!$data) {
            $this->error('❌ Failed to fetch availability data from API');
            return Command::FAILURE;
        }

        $this->info("✅ Received data for {$data['summary']['total_bookings']} bookings");
        $this->info("   Date range: {$data['date_range']['start']} to {$data['date_range']['end']}");
        $this->newLine();

        // Build a map of date => booking details from bookings array
        // This correctly expands date ranges (e.g., July 30-31 becomes two separate dates)
        $bookings = $data['bookings'] ?? [];
        $dateBookingMap = $this->buildDateBookingMap($bookings);
        
        // Use the calculated dates instead of API's booked_dates (which may miss end dates)
        $bookedDates = array_keys($dateBookingMap);
        sort($bookedDates);
        
        $this->info("📅 Found " . count($bookedDates) . " booked dates to sync");

        if ($this->option('dry-run')) {
            $this->warn('DRY RUN - No changes will be made');
            $this->newLine();
            
            if (count($bookedDates) > 0) {
                $this->info('Dates that would be marked as BOOKED:');
                foreach (array_slice($bookedDates, 0, 20) as $date) {
                    $this->line("  - {$date}");
                }
                if (count($bookedDates) > 20) {
                    $this->line("  ... and " . (count($bookedDates) - 20) . " more");
                }
            }
            
            return Command::SUCCESS;
        }

        // Sync the data with booking details
        $this->info('Syncing availability with booking details...');
        $bar = $this->output->createProgressBar(count($bookedDates));
        $bar->start();

        $synced = 0;
        $errors = 0;

        foreach ($bookedDates as $date) {
            try {
                $bookingInfo = $dateBookingMap[$date] ?? null;
                
                Availability::updateOrCreate(
                    ['date' => $date],
                    [
                        'status' => 'booked',
                        'rooms' => $bookingInfo['rooms'] ?? null,
                        'function_type' => $bookingInfo['function_type'] ?? null,
                        'guest_count' => $bookingInfo['guest_count'] ?? null,
                        'booking_id' => $bookingInfo['id'] ?? null,
                    ]
                );
                $synced++;
            } catch (\Exception $e) {
                $errors++;
                $this->newLine();
                $this->error("Error syncing date {$date}: " . $e->getMessage());
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Reset dates that are no longer booked (within the date range)
        $startDate = Carbon::parse($data['date_range']['start']);
        $endDate = Carbon::parse($data['date_range']['end']);
        
        $this->info('Resetting non-booked dates to available...');
        
        $resetCount = Availability::whereBetween('date', [$startDate, $endDate])
            ->where('status', 'booked')
            ->whereNotIn('date', $bookedDates)
            ->update(['status' => 'available']);
        
        $this->info("✅ Reset {$resetCount} dates back to available");
        $this->newLine();

        // Summary
        $this->info('═══════════════════════════════════════');
        $this->info('           SYNC COMPLETE');
        $this->info('═══════════════════════════════════════');
        $this->info("✅ Synced: {$synced} dates");
        if ($errors > 0) {
            $this->warn("⚠️  Errors: {$errors}");
        }
        $this->info("🔄 Reset: {$resetCount} dates");
        $this->info('═══════════════════════════════════════');

        return $errors > 0 ? Command::FAILURE : Command::SUCCESS;
    }

    /**
     * Build a map of date => booking details
     * For dates that span multiple days, each day gets the booking info
     */
    private function buildDateBookingMap(array $bookings): array
    {
        $map = [];
        
        foreach ($bookings as $booking) {
            $startDate = Carbon::parse($booking['start_date']);
            $endDate = Carbon::parse($booking['end_date']);
            
            $current = $startDate->copy();
            while ($current->lte($endDate)) {
                $dateStr = $current->format('Y-m-d');
                
                // If date already has a booking, merge rooms
                if (isset($map[$dateStr])) {
                    $existingRooms = $map[$dateStr]['rooms'] ?? [];
                    $newRooms = $booking['rooms'] ?? [];
                    $map[$dateStr]['rooms'] = array_unique(array_merge($existingRooms, $newRooms));
                    
                    // Append function types if different
                    $existingType = $map[$dateStr]['function_type'] ?? '';
                    $newType = $booking['function_type'] ?? '';
                    if ($existingType && $newType && $existingType !== $newType) {
                        $map[$dateStr]['function_type'] = $existingType . ', ' . $newType;
                    }
                    
                    // Sum guest counts
                    $map[$dateStr]['guest_count'] = ($map[$dateStr]['guest_count'] ?? 0) + (int)($booking['guest_count'] ?? 0);
                } else {
                    $map[$dateStr] = [
                        'id' => $booking['id'],
                        'rooms' => $booking['rooms'] ?? [],
                        'function_type' => $booking['function_type'] ?? null,
                        'guest_count' => (int)($booking['guest_count'] ?? 0),
                    ];
                }
                
                $current->addDay();
            }
        }
        
        return $map;
    }
}
