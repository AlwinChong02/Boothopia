<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booth;
use Illuminate\Support\Facades\Session;

class BoothBookingController extends Controller
{
    // Show event and all booths for booking (available and unavailable)
    public function showBooking($eventId)
    {
        $event = Event::find($eventId);
        if (!$event) {
            abort(404, 'Event not found');
        }
        // Fetch all booths for the event, not just available ones
        $booths = Booth::where('event_id', $eventId)->get();
        return view('events.booking', compact('event', 'booths'));
    }

    // Handle booth selection and redirect to payment
    public function processBooking(Request $request, $eventId)
    {
        $event = Event::find($eventId);
        if (!$event) {
            return redirect()->back()->withErrors('Event not found.');
        }
        $boothIds = $request->input('booths', []);
        if (empty($boothIds)) {
            return redirect()->back()->withErrors('Please select at least one booth.');
        }
        // Validate booth availability
        $availableBooths = Booth::where('event_id', $eventId)
            ->whereNull('user_id')
            ->whereIn('id', $boothIds)
            ->get();
        if (count($availableBooths) !== count($boothIds)) {
            return redirect()->back()->withErrors('One or more selected booths are no longer available.');
        }
        // Store selection in session
        Session::put('booking.event_id', $eventId);
        Session::put('booking.booth_ids', $boothIds);
        return redirect()->route('booking.payment');
    }

    // Show payment page
    public function showPayment()
    {
        $eventId = Session::get('booking.event_id');
        $boothIds = Session::get('booking.booth_ids', []);
        if (!$eventId || empty($boothIds)) {
            return redirect('/')->withErrors('No booking in progress.');
        }
        $event = Event::find($eventId);
        $booths = Booth::whereIn('id', $boothIds)->get();
        return view('payment', compact('event', 'booths'));
    }
}
