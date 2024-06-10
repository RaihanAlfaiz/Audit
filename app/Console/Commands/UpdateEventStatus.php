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
        // Get events that have ended
        $events = Event::where('event_date', '<', now())->get();

        foreach ($events as $event) {
            // Update status to Complete
            $event->update(['status' => 'Complete']);
        }

        $this->info('Event statuses updated successfully.');
    }
}
