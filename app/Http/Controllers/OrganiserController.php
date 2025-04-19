<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class OrganiserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:organiser']);
    }

    public function index()
    {
        $user = Auth::user();
        return view('organiser.dashboard', compact('user'));
    }

    public function create()
    {
        return view('organiser.create-event');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('events', 'public');
            $validated['img'] = $imagePath;
        }

        $validated['user_id'] = 1;

        $event = Event::create($validated);

        for ($i = 1; $i <= $validated['booth_quantity']; $i++) {
            $event->booths()->create([
                'name'  => "Booth {$i}",
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

    public function dashboard()
    {
        $organiserId = Auth::id();

        $totalEvents     = Event::where('user_id', $organiserId)->count();
        $upcomingEvents = Event::where('user_id', $organiserId)
            ->where('status', 'upcoming')
            ->count();
        $ongoingEvents = Event::where('user_id', $organiserId)
            ->where('status', 'ongoing')
            ->count();
        $canceledEvents  = Event::where('user_id', $organiserId)->where('status', 'canceled')->count();
        $unlistedEvents  = Event::where('user_id', $organiserId)->where('status', 'unlisted')->count();

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

    public function ongoing()
    {
        $organiserId = Auth::id();
        $today       = Carbon::today()->toDateString();

        $events = Event::where('user_id', $organiserId)
            ->where('status', 'ongoing')
            ->get();

        return view('organiser.ongoing', compact('events'));
    }

    public function upcoming()
    {
        $organiserId = Auth::id();
        $today       = Carbon::today()->toDateString();
        $events = Event::where('user_id', $organiserId)
            ->where('status', 'upcoming')
            ->orderBy('start_date', 'desc')
            ->get();

        return view('organiser.upcoming', compact('events'));
    }

    public function canceled()
    {
        $organiserId = Auth::id();
        $events = Event::where('user_id', $organiserId)
            ->where('status', 'canceled')
            ->orderBy('start_date', 'desc')
            ->get();

        return view('organiser.canceled', compact('events'));
    }

    public function all()
    {
        $organiserId = Auth::id();

        $events = Event::where('user_id', $organiserId)
            ->orderBy('start_date', 'desc')
            ->get();

        return view('organiser.all', compact('events'));
    }
}
