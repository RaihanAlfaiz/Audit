<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Package;
use App\Models\UserRole;
use App\Mail\sendEmail;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Filter by date range
        if ($request->has('range') && !empty($request->input('range'))) {
            $dates = explode(' to ', $request->input('range'));
            if (count($dates) == 2) {
                $start_date = $dates[0];
                $end_date = $dates[1];
                $query->whereBetween('event_date', [$start_date, $end_date]);
            }
        }

        // Filter by package
        if ($request->has('package') && !empty($request->input('package'))) {
            $query->where('package_id', $request->input('package'));
        }

        // Filter by status
        if ($request->has('status') && !empty($request->input('status'))) {
            $query->where('status', $request->input('status'));
        }

        $event = $query->get();
        $packages = Package::all();

        return view('event.index', [
            'event' => $event,
            'packages' => $packages,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = auth()->id();

        // Mengambil roles user
        $userRoles = UserRole::where('user_id', $userId)
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->pluck('roles.id');

        // Mengambil packages sesuai dengan role user dan pack = 'audit'
        $packages = Package::whereIn('type', $userRoles)
            ->where('pack', 'audit')
            ->get();

        // Mengambil events yang memiliki package dengan pack = 'audit'
        $events = Event::whereHas('package', function ($query) {
            $query->where('pack', 'audit');
        })->get();

        // Buat array untuk menyimpan tanggal-tanggal yang dinonaktifkan
        $disabledDates = $events->map(function ($event) {
            $eventDate = Carbon::parse($event->event_date);
            return [
                'from' => $eventDate->format('Y-m-d'),
                'to' => $eventDate->format('Y-m-d')
            ];
        });

        return view('event.create', [
            'packages' => $packages,
            'events' => $events,
            'disabledDates' => $disabledDates
        ]);
    }

    public function createlecture()
    {
        $userId = auth()->id(); // Mengambil ID user yang sedang login

        // Mengambil roles user
        $userRoles = UserRole::where('user_id', $userId)
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->pluck('roles.id'); // Mengambil semua role titles sebagai array

        // Mengambil packages sesuai dengan role user
        $packages = Package::whereIn('type', $userRoles)
            ->where('pack', 'lt')
            ->get();

        $events = Event::whereHas('package', function ($query) {
            $query->where('pack', 'lt');
        })->get();

        // Buat array untuk menyimpan tanggal-tanggal yang dinonaktifkan
        $disabledDates = $events->map(function ($event) {
            $eventDate = Carbon::parse($event->event_date);
            return [
                'from' => $eventDate->format('Y-m-d'),
                'to' => $eventDate->format('Y-m-d') // Asumsi rentang tanggal event hanya satu hari
            ];
        });

        return view('event.createlecture', [
            'packages' => $packages,
            'events' => $events,
            'disabledDates' => $disabledDates // Pass the formatted dates to the view
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tenant_name' => 'required',
            'event_name' => 'required',
            'email' => 'email',
            'institution_origin' => 'required',
            'phone' => 'required',
            'package_id' => 'required|exists:packages,id',
            'event_date' => 'required',
            'rehearsal_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'capacity' => 'required|integer',
            'payment_amount' => 'required|numeric',
            'remaining_payment' => 'nullable|numeric',
        ]);

        // Check if receipt_dp is uploaded
        if ($request->hasFile('receipt_dp')) {
            $validatedData['receipt_dp'] = $request->file('receipt_dp')->store('receipt-dp');
            // Set status to 'DP' since receipt_dp exists
            $validatedData['status'] = 'DP';
        } else {
            // If receipt_dp is not uploaded, set status to 'Pending'
            $validatedData['status'] = 'Pending';
        }

        // Check if the event date is already taken
        $existingEvent = Event::where('event_date', $validatedData['event_date'])->first();
        if ($existingEvent) {
            return redirect()->back()->withInput()->withErrors(['event_date' => 'The event date is already taken.']);
        }

        // Create the event
        Event::create($validatedData);

        return redirect()->route('event')->with('success', 'Event added successfully.');
    }

    public function storelecture(Request $request)
    {
        $validatedData = $request->validate([
            'tenant_name' => 'required',
            'event_name' => 'required',
            'email' => 'email',
            'institution_origin' => 'required',
            'phone' => 'required',
            'package_id' => 'required|exists:packages,id',
            'event_date' => 'required',
            'rehearsal_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'capacity' => 'required|integer',
            'payment_amount' => 'required|numeric',
            'remaining_payment' => 'nullable|numeric',
        ]);

        // Check if receipt_dp is uploaded
        if ($request->hasFile('receipt_dp')) {
            $validatedData['receipt_dp'] = $request->file('receipt_dp')->store('receipt-dp');
            // Set status to 'DP' since receipt_dp exists
            $validatedData['status'] = 'DP';
        } else {
            // If receipt_dp is not uploaded, set status to 'Pending'
            $validatedData['status'] = 'Pending';
        }

        // Check if the event date is already taken
        $existingEvent = Event::where('event_date', $validatedData['event_date'])->first();
        if ($existingEvent) {
            return redirect()->back()->withInput()->withErrors(['event_date' => 'The event date is already taken.']);
        }

        // Create the event
        Event::create($validatedData);

        return redirect()->route('event')->with('success', 'Event added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        $booking = Booking::find($id); // Mengganti findOrFail dengan find
        $package = Package::findOrFail($event->package_id);
        return view('event.show', compact('event', 'package', 'booking'));
    }

    public function print(string $id)
    {
        $event = Event::findOrFail($id);
        $booking = Booking::find($id); // Mengganti findOrFail dengan find
        $package = Package::findOrFail($event->package_id);
        return view('event.print', compact('event', 'package', 'booking'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $userId = auth()->id(); // Mengambil ID user yang sedang login

        // Mengambil roles user
        $userRoles = UserRole::where('user_id', $userId)
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->pluck('roles.id'); // Mengambil semua role titles sebagai array

        // Mengambil packages sesuai dengan role user
        $packages = Package::whereIn('type', $userRoles)
            ->where('pack', 'audit')
            ->get();
        return view('event.edit', compact('event', 'packages'));
    }

    public function editlecture(string $id)
    {
        $event = Event::findOrFail($id);
        $userId = auth()->id(); // Mengambil ID user yang sedang login

        // Mengambil roles user
        $userRoles = UserRole::where('user_id', $userId)
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->pluck('roles.id'); // Mengambil semua role titles sebagai array

        // Mengambil packages sesuai dengan role user
        $packages = Package::whereIn('type', $userRoles)
            ->where('pack', 'lt')
            ->get();
        return view('event.editlecture', compact('event', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'tenant_name' => 'required',
            'event_name' => 'required',
            'email' => 'email',
            'institution_origin' => 'required',
            'phone' => 'required',
            'package_id' => 'required|exists:packages,id',
            'event_date' => 'required',
            'rehearsal_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'capacity' => 'required|integer',
            'payment_amount' => 'required|numeric',
            'remaining_payment' => 'nullable|numeric',
        ]);

        // Check if receipt_dp is uploaded
        if ($request->hasFile('receipt_dp')) {
            // Delete old image if exists
            if ($event->receipt_dp) {
                Storage::delete($event->receipt_dp);
            }

            $validatedData['receipt_dp'] = $request->file('receipt_dp')->store('gallery-images');
            // Set status to 'DP' since receipt_dp exists
            $validatedData['status'] = 'DP';
        } else {
            // If receipt_dp is not uploaded, keep the previous status
            $validatedData['status'] = $event->status;
        }

        // Update the event model with validated data
        $event->fill($validatedData);
        $event->save();

        return redirect()->route('event')->with('success', 'Event updated successfully.');
    }

    public function updatelecture(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'tenant_name' => 'required',
            'event_name' => 'required',
            'email' => 'email',
            'institution_origin' => 'required',
            'phone' => 'required',
            'package_id' => 'required|exists:packages,id',
            'event_date' => 'required',
            'rehearsal_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'capacity' => 'required|integer',
            'payment_amount' => 'required|numeric',
            'remaining_payment' => 'nullable|numeric',
        ]);

        // Check if receipt_dp is uploaded
        if ($request->hasFile('receipt_dp')) {
            // Delete old image if exists
            if ($event->receipt_dp) {
                Storage::delete($event->receipt_dp);
            }

            $validatedData['receipt_dp'] = $request->file('receipt_dp')->store('gallery-images');
            // Set status to 'DP' since receipt_dp exists
            $validatedData['status'] = 'DP';
        } else {
            // If receipt_dp is not uploaded, keep the previous status
            $validatedData['status'] = $event->status;
        }

        // Update the event model with validated data
        $event->fill($validatedData);
        $event->save();

        return redirect()->route('event')->with('success', 'Event updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('event')->with('success', 'event was successfully deleted.');
    }

    public function getPackagePrice($packageId)
    {
        $package = Package::findOrFail($packageId);
        return response()->json(['price' => $package->price]);
    }

    public function email($id)
    {
        // Find the event by ID
        $event = Event::findOrFail($id);

        // Define the email data
        $emailData = [
            'tenant_name' => $event->tenant_name,
            'event_date' => $event->event_date,
            'event_name' => $event->event_name
        ];

        // Send the email
        Mail::send('mail.reminder', $emailData, function ($message) use ($event) {
            $message->to($event->email)
                ->subject('Event Reminder');
        });

        // Redirect back with a success message
        return redirect()->route('event.index')->with('success', 'Reminder email sent successfully!');
    }

    public function whatsappReminder($id)
    {
        // Find the event by ID
        $event = Event::findOrFail($id);

        // Create the message
        $message = urlencode('Hello, ' . $event->tenant_name . '. This is a reminder for your event on ' . date('d F Y', strtotime($event->event_date)) . '.');

        // Redirect to WhatsApp URL
        return redirect()->away('https://wa.me/+62' . $event->phone . '?text=' . $message);
    }

    public function audit(Request $request)
    {
        $query = Event::query();

        // Filter by date range
        if ($request->has('range') && !empty($request->input('range'))) {
            $dates = explode(' to ', $request->input('range'));
            if (count($dates) == 2) {
                $start_date = $dates[0];
                $end_date = $dates[1];
                $query->whereBetween('event_date', [$start_date, $end_date]);
            }
        }

        // Filter by package (select only events with packages having 'audit' pack)
        $query->whereHas('package', function ($query) {
            $query->where('pack', 'audit');
        });

        // Filter by status
        if ($request->has('status') && !empty($request->input('status'))) {
            $query->where('status', $request->input('status'));
        }

        $event = $query->get();
        $packages = Package::where('pack', 'audit')->get(); // Select only packages with 'audit' pack

        return view('event.audit', [
            'event' => $event,
            'packages' => $packages,
        ]);
    }

    public function lecture(Request $request)
    {
        $query = Event::query();

        // Filter by date range
        if ($request->has('range') && !empty($request->input('range'))) {
            $dates = explode(' to ', $request->input('range'));
            if (count($dates) == 2) {
                $start_date = $dates[0];
                $end_date = $dates[1];
                $query->whereBetween('event_date', [$start_date, $end_date]);
            }
        }

        // Filter by package (select only events with packages having 'lt' pack)
        $query->whereHas('package', function ($query) {
            $query->where('pack', 'lt');
        });

        // Filter by status
        if ($request->has('status') && !empty($request->input('status'))) {
            $query->where('status', $request->input('status'));
        }

        $event = $query->get();
        $packages = Package::where('pack', 'lt')->get(); // Select only packages with 'lt' pack

        return view('event.lecture', [
            'event' => $event,
            'packages' => $packages,
        ]);
    }
}
