<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Room $room)
    {
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'guest_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $nights = \Carbon\Carbon::parse($validated['check_in'])
            ->diffInDays($validated['check_out']);
        
        $booking = new Booking($validated);
        $booking->room_id = $room->id;
        $booking->total_price = $room->price_per_night * $nights;
        $booking->status = 'pending';
        $booking->save();

        return redirect()->route('bookings.confirmation', $booking)
            ->with('success', 'Booking created successfully.');
    }

    public function confirmation(Booking $booking)
    {
        return view('bookings.confirmation', compact('booking'));
    }
}