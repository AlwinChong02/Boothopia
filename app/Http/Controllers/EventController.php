<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Approval;
use Carbon\Carbon;

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
            'name'            => 'required|string|max:255',
            'description'     => 'required|string',
            'img'             => 'nullable|image|max:10000',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after_or_equal:start_date',
            'start_time'      => 'required',
            'end_time'        => 'required',
            'location'        => 'required|string|max:255',
            'category'        => 'required|string|max:100',
            'booth_quantity'  => 'required|integer|min:1',
        ]);

        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('event-images', 'public');
            $validatedData['img'] = $path;
        }

        $event = Event::create($validatedData);

        // Create booths for this event
        for ($i = 1; $i <= $event->booth_quantity; $i++) {
            $event->booths()->create([
                'name' => "Booth $i",
                'description' => null,
                'price' => 20.00, // Set default price(assumption: 20.00 per booth)
            ]);
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    public function dashboard()
    {
        $organiserId = Auth::id();

        $approvals = Approval::with(['event', 'requester'])
            ->where('status', 'pending')
            ->whereHas('event', function ($q) use ($organiserId) {
                $q->where('user_id', $organiserId);
            })
            ->get();

        return view('organiser.dashboard', compact('approvals'));
    }

    public function cancel($id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $today = Carbon::today();
        $start = Carbon::parse($event->start_date);

        if ($today->diffInDays($start) < 7) {
            return redirect()
                ->route('events.booking', ['event' => $event->id])
                ->with('error', 'You can only cancel at least 7 days before the event start date.');
        }
        $event->status = 'canceled';
        $event->save();

        return redirect()
            ->route('events.booking', ['event' => $event->id])
            ->with('success', 'Event has been canceled.');
    }
}
