<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * List all events for admin management page.
     */
    public function index()
    {
        $events = Event::with('creator')
            ->orderBy('start_date')
            ->get();

        return view('admin.diary_create', compact('events'));
    }

    /**
     * Store a newly created event.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'type'        => 'required|in:meeting,lunch,exercise,outbound,movie_day',
            'start_date'  => 'required|date',
            'location'    => 'nullable|string|max:2048',
        ]);

        Event::create([
            'title'       => $request->title,
            'description' => $request->description,
            'type'        => $request->type,
            'start_date'  => $request->start_date,
            'location'    => $request->location,
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.calendar')
            ->with('success', 'Event "' . $request->title . '" berhasil ditambahkan!');
    }

    /**
     * Delete an event.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.calendar')
            ->with('success', 'Event berhasil dihapus.');
    }
}
