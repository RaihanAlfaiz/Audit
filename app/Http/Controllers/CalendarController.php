<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
        // Mengambil data dari database dan menggabungkan tanggal dengan waktu
        $events = Event::select(
            'events.id',
            'events.tenant_name as title',
            'events.Institution_origin as location',
            'events.phone',
            'events.capacity',
            DB::raw("CONCAT(events.rehearsal_date, ' ', events.start_time) as start"),
            DB::raw("CONCAT(events.event_date, ' ', events.end_time) as end"),
            DB::raw("CASE 
                        WHEN packages.type = 'EE' THEN 'Business' 
                        WHEN packages.type = 'ME' THEN 'Holiday' 
                        WHEN packages.type = 'BW' THEN 'Family' 
                        ELSE 'Unknown' 
                    END as type") // Ubah nilai packages.type sesuai kebutuhan Anda
        )
            ->join('packages', 'events.package_id', '=', 'packages.id') // Join antara tabel 'event' dan 'package'
            ->get();

        return view('calendar.index', compact('events'));
    }


    public function getEvents()
    {
        // Mengambil data events dari database
        $events = Event::select(
            'tenant_name as title',
            DB::raw("CONCAT(event_date, ' ', start_time) as start")
        )->get();

        // Mengembalikan data events dalam format JSON
        return response()->json($events);
    }
}
