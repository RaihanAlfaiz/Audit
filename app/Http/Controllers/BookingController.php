<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Service;
use App\Models\Addition;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booking = Booking::all();
        $events = Event::all();
        $services = Service::all();

        return view('booking.index', compact('booking', 'events', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);
        $events = Event::all();
        $services = Service::all();

        return view('booking.create', compact('event', 'events', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|integer',
            'total_payment' => 'required|string',
            'ktp' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'receipt_full' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'service_id.*' => 'nullable|integer',
            'quantity.*' => 'nullable|integer',
            'price_per_unit.*' => 'nullable|string',
        ]);

        // Handle file uploads
        $ktpPath = $request->file('ktp')->store('ktp_images', 'public');
        $receiptFullPath = $request->file('receipt_full')->store('receipt_full_images', 'public');

        // Save booking
        $booking = new Booking();
        $booking->event_id = $request->event_id;
        $booking->total_payment = $request->total_payment;

        // Handle file uploads
        if ($request->hasFile('ktp')) {
            $booking->ktp = $request->file('ktp')->store('ktp_images', 'public');
        }

        if ($request->hasFile('receipt_full')) {
            $booking->receipt_full = $request->file('receipt_full')->store('receipt_full_images', 'public');
        }

        $booking->save();

        // Find the related event
        $event = Event::find($request->event_id);

        // Update event status based on receipt_full
        if ($booking->receipt_full) {
            // If receipt_full is uploaded, set status to 'Success'
            $event->status = 'Success';
        } else {
            // If receipt_full is not uploaded, set status to 'Process'
            $event->status = 'Process';
        }

        $event->save();

        // Save additions
        if ($request->add_tools == 'yes') {
            foreach ($request->service_id as $key => $serviceId) {
                if ($serviceId) {
                    $addition = new Addition();
                    $addition->service_id = $serviceId;
                    $addition->booking_id = $booking->id;
                    $addition->quantity = $request->quantity[$key];
                    $addition->price_per_unit = $request->price_per_unit[$key];
                    $addition->save();
                }
            }
        }

        return redirect()->route('event', $request->event_id)->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
