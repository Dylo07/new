<?php

namespace App\Console\Commands;

use App\Models\Lead;
use Illuminate\Console\Command;

class MarkStaleLeads extends Command
{
    protected $signature = 'leads:mark-stale {--hours=2 : Hours of inactivity before marking as abandoned}';

    protected $description = 'Mark leads that have been inactive for a specified period as abandoned';

    public function handle()
    {
        $hours = (int) $this->option('hours');
        $threshold = now()->subHours($hours);

        $count = Lead::whereIn('status', ['started', 'browsing'])
            ->where(function ($query) use ($threshold) {
                $query->where('last_activity_at', '<', $threshold)
                      ->orWhere(function ($q) use ($threshold) {
                          $q->whereNull('last_activity_at')
                            ->where('created_at', '<', $threshold);
                      });
            })
            ->update([
                'status' => 'abandoned',
                'last_activity_at' => now(),
            ]);

        $this->info("Marked {$count} stale leads as abandoned (inactive for {$hours}+ hours).");

        return Command::SUCCESS;
    }
}
