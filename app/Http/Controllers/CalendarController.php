<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Services\OpsApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    public function index()
    {
        // Generate 6 months of calendar data
        $months = [];
        for ($i = 0; $i < 6; $i++) {
            $month = Carbon::now()->addMonths($i);
            $months[] = [
                'month' => $month,
                'availability' => $this->getMonthAvailability($month),
            ];
        }
        
        return view('calendar.index', compact('months'));
    }

    



    public function admin()
    {
        // Generate 3 months of calendar data
        $months = [];
        for ($i = 0; $i < 3; $i++) {
            $month = Carbon::now()->addMonths($i);
            $months[] = [
                'month' => $month,
                'availability' => $this->getMonthAvailability($month),
            ];
        }

        // --- Sync metadata ---
        $syncLogPath = storage_path('logs/availability-sync.log');
        $lastSyncTime = null;
        $lastSyncStatus = 'unknown';
        $lastSyncLines = [];

        if (file_exists($syncLogPath)) {
            $lastSyncTime = Carbon::createFromTimestamp(filemtime($syncLogPath));
            $logContent = file_get_contents($syncLogPath);
            $lines = array_filter(explode("\n", trim($logContent)));
            $lastSyncLines = array_slice($lines, -20); // last 20 lines

            // Determine status from log
            $tail = implode("\n", array_slice($lines, -5));
            if (str_contains($tail, 'SYNC COMPLETE')) {
                $lastSyncStatus = 'success';
            } elseif (str_contains($tail, '❌') || str_contains($tail, 'Error') || str_contains($tail, 'FAILURE')) {
                $lastSyncStatus = 'error';
            } else {
                $lastSyncStatus = 'unknown';
            }
        }

        // --- API config status ---
        $opsApi = app(OpsApiService::class);
        $apiConfigured = $opsApi->isConfigured();

        // --- Availability stats ---
        $today = Carbon::today();
        $threeMonthsLater = Carbon::today()->addMonths(3);

        $totalBookedDates = Availability::where('status', 'booked')
            ->where('date', '>=', $today)
            ->where('date', '<=', $threeMonthsLater)
            ->count();

        $totalAvailableDates = Availability::where('status', 'available')
            ->where('date', '>=', $today)
            ->where('date', '<=', $threeMonthsLater)
            ->count();

        $totalLimitedDates = Availability::where('status', 'limited')
            ->where('date', '>=', $today)
            ->where('date', '<=', $threeMonthsLater)
            ->count();

        // Days in range that have no record = available
        $daysInRange = $today->diffInDays($threeMonthsLater);
        $totalRecords = $totalBookedDates + $totalAvailableDates + $totalLimitedDates;
        $unrecordedDays = max(0, $daysInRange - $totalRecords);
        $totalAvailableDates += $unrecordedDays;

        // Upcoming booked dates with details (next 15)
        $upcomingBookings = Availability::where('status', 'booked')
            ->where('date', '>=', $today)
            ->orderBy('date')
            ->limit(15)
            ->get();

        // Function type breakdown
        $functionTypes = Availability::where('status', 'booked')
            ->where('date', '>=', $today)
            ->whereNotNull('function_type')
            ->select('function_type', DB::raw('COUNT(*) as total'))
            ->groupBy('function_type')
            ->orderByDesc('total')
            ->get();

        // Occupancy rate for next 30 days
        $next30 = Carbon::today()->addDays(30);
        $bookedNext30 = Availability::where('status', 'booked')
            ->whereBetween('date', [$today, $next30])
            ->count();
        $occupancyNext30 = round(($bookedNext30 / 30) * 100);

        return view('calendar.admin', compact(
            'months', 'lastSyncTime', 'lastSyncStatus', 'lastSyncLines',
            'apiConfigured', 'totalBookedDates', 'totalAvailableDates',
            'totalLimitedDates', 'upcomingBookings', 'functionTypes',
            'occupancyNext30', 'bookedNext30'
        ));
    }
    
    public function edit()
    {
        $currentMonth = Carbon::now();
        $nextMonth = Carbon::now()->addMonth();
        
        $currentMonthAvailability = $this->getMonthAvailability($currentMonth);
        $nextMonthAvailability = $this->getMonthAvailability($nextMonth);
        
        return view('calendar.edit', compact('currentMonth', 'nextMonth', 'currentMonthAvailability', 'nextMonthAvailability'));
    }
    
    public function update(Request $request)
    {
        try {
            $data = $request->json()->all();
            
            $validator = Validator::make($data, [
                'date' => 'required|date',
                'status' => 'required|in:available,limited,booked',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            $validated = $validator->validated();
            
            Availability::updateOrCreate(
                ['date' => $validated['date']],
                ['status' => $validated['status']]
            );
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error updating availability: ' . $e->getMessage()
            ], 500);
        }
    }
    
     // Add this method to get availability data (same as in CalendarController)
     /**
     * Get availability data with booking details for a month
     */
    private function getMonthAvailability(Carbon $month)
    {
        $startOfMonth = $month->copy()->startOfMonth();
        $endOfMonth = $month->copy()->endOfMonth();
        
        // Get all availability records for this month with all details
        $availabilityRecords = Availability::whereBetween('date', [
            $startOfMonth->format('Y-m-d'), 
            $endOfMonth->format('Y-m-d')
        ])->get();
        
        // Create a map with date string as key
        $dateDataMap = [];
        foreach ($availabilityRecords as $record) {
            $dateKey = $record->date instanceof \Carbon\Carbon 
                ? $record->date->format('Y-m-d') 
                : date('Y-m-d', strtotime($record->date));
            
            $dateDataMap[$dateKey] = [
                'status' => $record->status,
                'rooms' => $record->rooms ?? [],
                'function_type' => $record->function_type,
                'guest_count' => $record->guest_count,
            ];
        }
        
        // Build availability array
        $availability = [];
        $currentDate = $startOfMonth->copy();
        
        while ($currentDate <= $endOfMonth) {
            $dateString = $currentDate->format('Y-m-d');
            $availability[$dateString] = $dateDataMap[$dateString] ?? [
                'status' => 'available',
                'rooms' => [],
                'function_type' => null,
                'guest_count' => null,
            ];
            $currentDate->addDay();
        }
        
        return $availability;
    }
 public function search(Request $request)
    {
        $validated = $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
        ]);
        
        // Add your search logic here
        return redirect()->route('rooms.index', $validated);
    }

    
}