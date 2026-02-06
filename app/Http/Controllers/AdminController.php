<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lead;
use App\Models\User;
use App\Models\Room;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'total_users' => User::count(),
            'total_rooms' => Room::count(),
            'total_leads' => Lead::count(),
            'active_leads' => Lead::active()->count(),
            'abandoned_leads' => Lead::abandoned()->count(),
            'needs_followup' => Lead::needsFollowUp()->count(),
            'revenue' => Booking::where('status', 'confirmed')->sum('total_price'),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
