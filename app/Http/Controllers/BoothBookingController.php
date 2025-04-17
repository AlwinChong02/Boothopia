<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booth;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function showPayment(Request $request)
    {
        $eventId = session('booking.event_id');
        $boothIds = session('booking.booth_ids', []);
        if (!$eventId || empty($boothIds)) {
            return redirect('/')->withErrors('No booking in progress.');
        }
        $event = Event::find($eventId);
        $booths = Booth::whereIn('id', $boothIds)->get();
        $total = $booths->sum('price');
        return view('payment', compact('event', 'booths', 'total'));
    }

    // Process payment and save booking
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:online_banking,card',
            'card_number' => 'required_if:payment_method,card',
            'card_expiry' => 'required_if:payment_method,card',
            'card_cvc' => 'required_if:payment_method,card',
            'bank_name' => 'required_if:payment_method,online_banking',
            'bank_account' => 'required_if:payment_method,online_banking',
        ]);
        $eventId = session('booking.event_id');
        $boothIds = session('booking.booth_ids', []);
        
        $user = Auth::user();
        if (!$eventId || empty($boothIds) || !$user) {
            return redirect('/')->withErrors('Invalid booking session.');
        }
        $booths = Booth::whereIn('id', $boothIds)->whereNull('user_id')->lockForUpdate()->get();
        if (count($booths) !== count($boothIds)) {
            return redirect('/')->withErrors('One or more booths are no longer available.');
        }
        DB::beginTransaction();
        try {
            // Mark booths as booked
            foreach ($booths as $booth) {
                $booth->user_id = $user->id;
                $booth->save();
            }
            // Save payment
            $details = $request->payment_method === 'card'
                ? json_encode([
                    'card_number' => $request->card_number,
                    'card_expiry' => $request->card_expiry,
                    'card_cvc' => $request->card_cvc
                ])
                : json_encode([
                    'bank_name' => $request->bank_name,
                    'bank_account' => $request->bank_account
                ]);
            $payment = Payment::create([
                'user_id' => $user->id,
                'event_id' => $eventId,
                'booth_ids' => implode(',', $boothIds),
                'method' => $request->payment_method,
                'details' => $details,
                'amount' => $booths->sum('price'),
                'status' => 'success',
            ]);
            DB::commit();
            session()->forget(['booking.event_id', 'booking.booth_ids']);
            return redirect('/home')->with('success', 'Payment successful! Booth(s) booked.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/')->withErrors('Payment failed: ' . $e->getMessage());
        }
    }
}
