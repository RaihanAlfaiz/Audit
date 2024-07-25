<?php

namespace App\Exports;

use App\Models\Event;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EventsExport implements FromView, ShouldAutoSize
{
    protected $events;

    public function __construct($events)
    {
        $this->events = $events;
    }

    public function view(): View
    {
        return view('exports.events', [
            'events' => $this->events
        ]);
    }
}
