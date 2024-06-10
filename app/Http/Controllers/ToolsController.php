<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use App\Models\ItemList;
use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['event.package'])
            ->join('events', 'bookings.event_id', '=', 'events.id')
            ->orderBy('events.event_date', 'asc')
            ->select('bookings.*')  // Ensure to select columns from bookings
            ->get();
        return view('tools.index', ['bookings' => $bookings]);
    }
    public function showChecklist($eventId)
    {
        $event = Event::with(['package', 'booking.additions.service', 'booking.itemList'])->findOrFail($eventId);

        // Ambil semua item yang perlu dicentang
        $items = collect();

        // Ambil item dari paket
        if ($event->package) {
            $packageItems = explode(',', $event->package->item);
            foreach ($packageItems as $item) {
                $items->push((object)['description' => $item, 'quantity' => 1, 'status' => false]);
            }
        }

        // Ambil item dari tambahan
        if ($event->booking) {
            foreach ($event->booking->additions as $addition) {
                $items->push((object)[
                    'description' => $addition->service->item,
                    'quantity' => $addition->quantity,
                    'status' => false,
                ]);
            }
        }

        // Periksa status item yang sudah ada dalam database dan tandai yang sudah dicentang
        $itemList = $event->booking->itemList;
        foreach ($items as $item) {
            foreach ($itemList as $dbItem) {
                if ($item->description === $dbItem->description) {
                    $item->status = $dbItem->status;
                    break;
                }
            }
        }

        return view('tools.tools', ['event' => $event, 'items' => $items]);
    }

    public function submitChecklist(Request $request, $eventId)
    {
        $event = Event::with('booking.itemList')->findOrFail($eventId);
        $itemList = $event->booking->itemList;

        foreach ($itemList as $item) {
            $item->status = $request->has('item_' . $item->id);
            $item->save();
        }

        // Set the event status to "ready" since all items should be checked before submission
        $event->status = 'ready';
        $event->save();

        return redirect()->back()->with('status', 'Checklist submitted successfully!');
    }
}
