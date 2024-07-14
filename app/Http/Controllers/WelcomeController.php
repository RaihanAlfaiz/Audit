<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::select(
            'events.id',
            'events.event_name as title',
            'events.Institution_origin as location',
            'events.phone',
            'events.capacity',
            'events.tenant_name',
            DB::raw("CONCAT(events.event_date, ' ', events.start_time) as start"),
            DB::raw("CONCAT(events.event_date, ' ', events.end_time) as end"),
            DB::raw("'Business' as type"),
            'events.rehearsal_date'
        )

            ->join('packages', 'events.package_id', '=', 'packages.id') // Join antara tabel 'event' dan 'package'
            ->get();

        // Mengambil data rehearsals hanya jika rehearsal_date tidak null
        $rehearsals = Event::select(
            'events.id',
            DB::raw("CONCAT('GR ', events.event_name) as title"),
            'events.Institution_origin as location',
            'events.phone',
            'events.capacity',
            'events.tenant_name',
            DB::raw("CONCAT(events.rehearsal_date, ' ', events.start_time) as start"),
            DB::raw("CONCAT(events.rehearsal_date, ' ', events.end_time) as end"),
            DB::raw("'Family' as type"),
            'events.rehearsal_date'
        )
            ->join('packages', 'events.package_id', '=', 'packages.id') // Join antara tabel 'event' dan 'package'
            ->whereNotNull('events.rehearsal_date') // Hanya ambil baris yang rehearsal_date nya tidak null
            ->get();
        $package = Package::all();
        return view('welcome', compact('package', 'events', 'rehearsals'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
