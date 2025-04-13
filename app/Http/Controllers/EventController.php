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
        // Validate incoming data.
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'required|string',
            'img'             => 'nullable|image|max:2048', // optional image upload (max 2MB)
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after_or_equal:start_date',
            'start_time'      => 'required',
            'end_time'        => 'required',
            'location'        => 'required|string|max:255',
            'category'        => 'required|string|max:100',
            'booth_quantity'  => 'required|integer|min:1',
        ]);

        // Handle image upload if it exists.
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('events', 'public');
            $validated['img'] = $imagePath;
        }

        // Temporarily assign a test organiser ID.
        $validated['user_id'] = 1;

        // Create the event record.
        $event = Event::create($validated);

        // Optionally auto-generate Booth records based on booth_quantity.
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
}
