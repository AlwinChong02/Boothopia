<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function show($id)
    {
        try {
            $event = Event::with('booths')->findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('events.index')->with('error', 'Event not found.');
        }
        return view('events.show', compact('event'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        Event::create($validatedData);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function approvalPage()
    {
        $events = Event::where('user_id', 1)
                       ->where('status', 'unlisted')
                       ->get();

        return view('organiser.approval', compact('events'));
    }

    public function approve($id)
    {
        $event = Event::findOrFail($id);
        $event->status = 'upcoming';
        $event->save();

        return redirect()->route('organiser.event.approval')
                         ->with('success', 'Event approved successfully!');
    }

    public function reject($id)
    {
        $event = Event::findOrFail($id);
        $event->status = 'canceled';
        $event->save();

        return redirect()->route('organiser.event.approval')
                         ->with('success', 'Event rejected successfully!');
    }


    public function dashboard()
    {
        $organiserId = 1; // Fixed organiser ID for testing

        // Aggregate event counts by status for this organiser
        $totalEvents     = Event::where('user_id', $organiserId)->count();
        $upcomingEvents  = Event::where('user_id', $organiserId)->where('status', 'upcoming')->count();
        $ongoingEvents   = Event::where('user_id', $organiserId)->where('status', 'ongoing')->count();
        $canceledEvents  = Event::where('user_id', $organiserId)->where('status', 'canceled')->count();
        $unlistedEvents  = Event::where('user_id', $organiserId)->where('status', 'unlisted')->count();

        // Fetch the latest 5 events for a quick overview
        $latestEvents = Event::where('user_id', $organiserId)
                             ->orderBy('created_at', 'desc')
                             ->take(5)
                             ->get();

        return view('organiser.dashboard', compact(
            'totalEvents', 
            'upcomingEvents', 
            'ongoingEvents', 
            'canceledEvents', 
            'unlistedEvents',
            'latestEvents'
        ));
    }
}
