<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = Event::all(); // Mengambil semua event dari database
        $packages = Package::all(); // Mengambil semua paket dari database
        return view('event.index', [
            'event' => $event,
            'packages' => $packages, // Mengirim data paket ke tampilan dengan nama variabel $packages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::all(); // Mengambil semua paket dari database
        return view('event.create', [
            'packages' => $packages, // Mengirim data paket ke tampilan dengan nama variabel $packages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tenant_name' => 'required',
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
        $package = Package::findOrFail($event->package_id); // Ambil paket berdasarkan package_id dari event
        return view('event.show', compact('event', 'package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $packages = Package::all(); // Mengambil semua paket dari database
        return view('event.edit', compact('event', 'packages')); // Kirim data peran ke tampilan
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'tenant_name' => 'required',
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
}
