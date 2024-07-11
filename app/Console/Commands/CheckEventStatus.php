<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderEmail;
use Carbon\Carbon;

class CheckEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:check-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check events with status DP and update status to Cancel if receipt_full is not filled within two weeks. Send reminder email on the 10th day.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::where('status', 'DP')
            ->where('created_at', '<', Carbon::now()->subDays(10))
            ->get();

        foreach ($events as $event) {
            $booking = Booking::where('event_id', $event->id)->first();

            if ($booking && empty($booking->receipt_full)) {
                $daysSinceCreated = Carbon::parse($event->created_at)->diffInDays(Carbon::now());

                // Send reminder email on the 10th day
                if ($daysSinceCreated == 10) {
                    Mail::to($event->email)->send(new ReminderEmail($event));
                }

                // Cancel event on the 14th day
                if ($daysSinceCreated >= 14) {
                    $event->status = 'Cancel';
                    $event->save();
                    $event->delete();
                }
            }
        }

        $this->info('Event statuses checked and updated successfully.');
    }
}
