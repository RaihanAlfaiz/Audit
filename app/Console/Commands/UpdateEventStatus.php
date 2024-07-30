<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class UpdateEventStatus extends Command
{
    protected $signature = 'event:update-status';

    protected $description = 'Update event status to Complete if event has ended';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get events that have ended and are Ready, and update status to Complete
        $endedEvents = Event::where('status', 'Ready')
            ->where('event_date', '<', now())
            ->get();

        foreach ($endedEvents as $event) {
            $event->update(['status' => 'Complete']);
        }

        // Get events that are pending and have been pending for more than 1 minute
        // Get events that are pending and have been pending for more than 1 week
        $pendingEvents = Event::where('status', 'Pending')
            ->where('event_date', '<', now()->subWeek())
            ->get();
        foreach ($pendingEvents as $event) {
            $event->update(['status' => 'Cancel']);
        }


        $this->info('Event statuses updated successfully.');
    }
}
