<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\CustomPackage;

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
    public function reviewPackage()
    {
        // Get the data we saved in the session earlier
        $bookingData = session('pending_booking');

        // If there is no data (maybe they waited too long), send them back to builder
        if (!$bookingData) {
            return redirect()->route('package-builder')
                ->with('error', 'Session expired. Please build your package again.');
        }

        // Get the full package details from DB to show names/images
        $package = CustomPackage::findOrFail($bookingData['package_id']);

        return view('bookings.package-review', compact('bookingData', 'package'));
    }

    /**
     * Step 2: Save to Database
     */
    public function storePackage(Request $request)
    {
        // Get data from session again
        $data = session('pending_booking');

        if (!$data) {
            return redirect()->route('package-builder');
        }

        // Create the Booking in Database
        $booking = \App\Models\Booking::create([
            'user_id'           => auth()->id(),
            'custom_package_id' => $data['package_id'],
            'check_in'          => $data['check_in'],
            'check_out'         => $data['check_out'],
            'guests'            => $data['adults'], // Total guests or just adults
            'total_price'       => $data['total_price'],
            'status'            => 'pending', // Default status
            'package_details'   => [
                'adults'   => $data['adults'],
                'children' => $data['children'] ?? 0
            ]
        ]);

        // Clear the session so they don't book it twice by mistake
        session()->forget('pending_booking');

        // Redirect to their dashboard or a success page
        return redirect()->route('profile')
            ->with('success', 'Booking request placed successfully! Order #' . $booking->id . '. We will contact you shortly.');
    }

    // --- Admin: View All Bookings ---
    public function index()
    {
        // Fetch all bookings with their related User and Package data
        // Ordered by newest first
        $bookings = Booking::with(['user', 'customPackage', 'room'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }

    // --- Admin: Update Booking Status (Confirm/Cancel) ---
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $booking->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }
    
    // --- Admin: Delete Booking ---
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }
}