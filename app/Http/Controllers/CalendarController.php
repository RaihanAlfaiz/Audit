<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
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
            DB::raw("'Personal' as type"),
            'events.rehearsal_date'
        )
            ->join('packages', 'events.package_id', '=', 'packages.id') // Join antara tabel 'event' dan 'package'
            ->where('events.status', '!=', 'cancel') // Tambahkan kondisi untuk mengecualikan event yang statusnya 'cancel'
            ->where('packages.pack', '=', 'audit') // Tambahkan kondisi untuk hanya mengambil paket dengan tipe 'audit'
            ->get();

            $eventslt = Event::select(
                'events.id',
                'events.event_name as title',
                'events.Institution_origin as location',
                'events.phone',
                'events.capacity',
                'events.tenant_name',
                DB::raw("CONCAT(events.event_date, ' ', events.start_time) as start"),
                DB::raw("CONCAT(events.event_date, ' ', events.end_time) as end"),
                DB::raw("'ETC' as type"),
                'events.rehearsal_date'
            )
                ->join('packages', 'events.package_id', '=', 'packages.id') // Join antara tabel 'event' dan 'package'
                ->where('events.status', '!=', 'cancel') // Tambahkan kondisi untuk mengecualikan event yang statusnya 'cancel'
                ->where('packages.pack', '=', 'lt') // Tambahkan kondisi untuk hanya mengambil paket dengan tipe 'audit'
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
            ->where('events.status', '!=', 'cancel') // Tambahkan kondisi untuk mengecualikan rehearsal yang statusnya 'cancel'
            ->get();

        return view('calendar.index', compact('events', 'rehearsals','eventslt'));
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
