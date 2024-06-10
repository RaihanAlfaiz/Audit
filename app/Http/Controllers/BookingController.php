<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Service;
use App\Models\Package;
use App\Models\Addition;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBookingRequest;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::query();

        // Filter by date range
        if ($request->has('range') && !empty($request->input('range'))) {
            $dates = explode(' - ', $request->input('range'));
            $start_date = $dates[0];
            $end_date = $dates[1];
            $query->whereHas('event', function ($q) use ($start_date, $end_date) {
                $q->whereBetween('event_date', [$start_date, $end_date]);
            });
        }

        // Filter by package
        if ($request->has('package') && !empty($request->input('package'))) {
            $query->whereHas('event.package', function ($q) use ($request) {
                $q->where('id', $request->input('package'));
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->input('status'))) {
            $query->whereHas('event', function ($q) use ($request) {
                $q->where('status', $request->input('status'));
            });
        }

        // Order by event date
        $query->orderBy(Event::select('event_date')->whereColumn('events.id', 'bookings.event_id'));

        $booking = $query->get();
        $events = Event::all();
        $services = Service::all();
        $packages = Package::all(); // Mendapatkan data paket

        return view('booking.index', compact('booking', 'events', 'services', 'packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);
        $events = Event::all();
        $services = Service::all();

        return view('booking.create', compact('event', 'events', 'services', 'eventId'));
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

    public function print($id)
    {
        $booking = Booking::find($id);
        $event = Event::find($booking->event_id);
        $package = Package::find($event->package_id);
        $additions = Addition::where('booking_id', $booking->id)->get();



        return view('booking.booking_print', compact('booking', 'event', 'package', 'additions'));
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
