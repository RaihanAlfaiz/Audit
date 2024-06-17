<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Service;
use App\Models\Package;
use App\Models\Addition;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Support\Facades\Crypt;
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Mail;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::query();

     

        if ($request->has('range') && !empty($request->input('range'))) {
            $dates = explode(' to ', $request->input('range'));
            if (count($dates) == 2) {
                $start_date = $dates[0];
                $end_date = $dates[1];
                $query->whereHas('event', function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('event_date', [$start_date, $end_date]);
                });
            }
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
            // Send email notification
            // Generate QR code URL
            $encryptedId = Crypt::encryptString($booking->id);
            $qrCodeUrl = 'https://s.jgu.ac.id/qrcode?data=' . route('booking.print', $encryptedId) . '&label=';
            $recipientEmail = $event->email;

            $emailData = [
                'tenant_name' => $event->tenant_name,
                'event_date' => $event->event_date,
                'event_name' => $event->event_name,
                'institution_origin' => $event->Institution_origin,
                'phone' => $event->phone,
                'package_name' => $event->package->Name, // Assuming 'name' is the field you want
                'total_payment' => $booking->total_payment,
                'qr_code_url' => $qrCodeUrl, // Include the QR code URL
                'encryptedId' => $encryptedId, // Include encrypted ID for printing
                'encryptedId' => $encryptedId, // Include encrypted ID for printing
            ];
            Mail::to($recipientEmail)->send(new sendEmail($emailData)); // Replace 'recipient@example.com' with the actual recipient email
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

    public function print($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $booking = Booking::find($id);
        $event = Event::find($booking->event_id);
        $package = Package::find($event->package_id);
        $additions = Addition::where('booking_id', $id)->get();

        return view('booking.booking_print', compact('booking', 'event', 'package', 'additions', 'encryptedId'));
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
