<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = Event::all();
        return view('event.index', [
            'event' => $event
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');
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
            'capacity' => 'required',
            'event_date' => 'required',
            'rehearsal_date' => 'required',
            'venue' => 'required',
            'description' => 'required',
            'about' => 'required',

        ]);

        // Buat pengguna baru
        $event = Event::create($validatedData);



        return redirect()->route('event')->with('success', 'Event added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id); // Contoh: Menggunakan Eloquent untuk mengambil data event berdasarkan ID
        return view('event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('event.edit', compact('event')); // Kirim data peran ke tampilan
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
            'capacity' => 'required',
            'event_date' => 'required',
            'rehearsal_date' => 'required',
            'venue' => 'required',
            'description' => 'required',
            'about' => 'required',
        ]);

        // Memperbarui model dengan data yang divalidasi
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
}
