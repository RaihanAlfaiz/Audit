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
    // public function handle()
    // {
    //     $events = Event::where('status', 'DP')
    //         ->get();

    //     foreach ($events as $event) {
    //         $booking = Booking::where('event_id', $event->id)->first();

    //         if ($booking && empty($booking->receipt_full)) {
    //             $daysSinceCreated = Carbon::parse($event->created_at)->diffInDays(Carbon::now());

    //             // Send reminder email on the 10th day
    //             if ($daysSinceCreated == 10) {
    //                 Mail::to($event->email)->send(new ReminderEmail($event));
    //             }

    //             // Cancel event on the 14th day
    //             if ($daysSinceCreated >= 14) {
    //                 $event->status = 'Cancel';
    //                 $event->save();
    //                 $event->delete();
    //             }
    //         }
    //     }

    //     $this->info('Event statuses checked and updated successfully.');
    // }

    // public function handle()
    // {
    //     $events = Event::where('status', 'DP')
    //         ->whereNull('receipt_full')
    //         ->get();

    //     foreach ($events as $event) {
    //         $eventDate = Carbon::parse($event->event_date);
    //         $daysSinceEvent = Carbon::now()->diffInDays($eventDate, false);

    //         if ($daysSinceEvent <= -10 && $daysSinceEvent > -12) {
    //             // Send email reminder
    //             Mail::to($event->email)->send(new ReminderEmail($event));
    //             // Update status to 'Cancel'
    //             $event->status = 'Cancel';
    //             $event->save();
    //         } elseif ($daysSinceEvent <= -12) {
    //             // Delete the event
    //             $event->delete();
    //         }
    //     }

    //     return Command::SUCCESS;
    // }

    public function handle()
    {
        // Log to indicate the command has started

        // Fetch events with status 'DP' and without 'receipt_full'
        $events = Event::where('status', 'DP')
            ->join('bookings', 'events.id', '=', 'bookings.event_id')
            ->whereNull('bookings.receipt_full')
            ->select('events.*', 'bookings.id as booking_id', 'bookings.created_at as booking_created_at')
            ->get();

        foreach ($events as $event) {
            // Calculate the difference in minutes from event creation time
            $minutesSinceCreated = Carbon::now()->diffInMinutes(Carbon::parse($event->created_at));

            if ($minutesSinceCreated >= 1 && $minutesSinceCreated < 12) {
                // Send email reminder
                Mail::to($event->email)->send(new ReminderEmail($event));
                // Update status to 'Cancel'
                $event->status = 'Cancel';
                $event->save();
            } elseif ($minutesSinceCreated >= 12) {
                // Delete the event
                $event->delete();
            }
        }


        return Command::SUCCESS;
    }
}
