<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function create()
    {
        return view('organiser.create-event');
    }

    // Process form submission and store the event.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'required|string',
            'img'             => 'nullable|image|max:2048', //image upload (max 2MB)
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after_or_equal:start_date',
            'start_time'      => 'required',
            'end_time'        => 'required',
            'location'        => 'required|string|max:255',
            'category'        => 'required|string|max:100',
            'booth_quantity'  => 'required|integer|min:1',
        ]);

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('events', 'public');
            $validated['img'] = $imagePath;
        }

        // Temporarily assign a test organiser ID.
        $validated['user_id'] = 1;

        // Create the event record.
        $event = Event::create($validated);

        for ($i = 1; $i <= $validated['booth_quantity']; $i++) {
            $event->booths()->create([
                'name'  => "Booth {$i}",
                // Default price; you can modify or extend this logic as needed.
                'price' => 0.00
            ]);
        }

        return redirect()->route('organiser.event.create')
            ->with('success', 'Event created successfully!');
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

    public function show($id)
    {
        $event = Event::with('booths')->findOrFail($id);

        return view('organiser.event-profile', compact('event'));
    }
}
