<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Event::select('id', 'tenant_name as title', 'rehearsal_date as start', 'event_date as end')->get();
        // dd($events);
        return view('calendar.index', compact('events'));
    }
    public function getEvents()
    {
        // Mengambil data events dari database
        $events = Event::select('tenant_name as title', 'event_date as start')->get();

        // Mengembalikan data events dalam format JSON
        return response()->json($events);
    }
}
