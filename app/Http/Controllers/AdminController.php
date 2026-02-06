<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lead;
use App\Models\User;
use App\Models\Room;
use App\Models\CustomPackage;
use App\Models\MenuCategory;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $totalRooms = Room::count();

        // --- Morning Overview Stats ---
        $todaysArrivals = Booking::whereDate('check_in', $today)
            ->whereIn('status', ['confirmed', 'pending'])
            ->count();

        $todaysDepartures = Booking::whereDate('check_out', $today)
            ->whereIn('status', ['confirmed', 'completed'])
            ->count();

        $pendingLeads = Lead::whereIn('status', ['started', 'browsing', 'reviewed'])
            ->count();

        // Occupancy: rooms booked today (check_in <= today AND check_out > today)
        $occupiedRooms = Booking::where('check_in', '<=', $today)
            ->where('check_out', '>', $today)
            ->where('status', 'confirmed')
            ->count();
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100) : 0;

        // Monthly revenue (confirmed bookings this month)
        $monthlyRevenue = Booking::where('status', 'confirmed')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_price');

        // Pending approvals (bookings with uploaded receipts waiting for approval)
        $pendingApprovals = Booking::where('status', 'pending')
            ->where('payment_status', 'uploaded')
            ->count();

        // --- Recent Activity ---
        $recentBookings = Booking::with(['user', 'customPackage', 'room'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentLeads = Lead::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // --- Summary Counts ---
        $totalBookings = Booking::count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $totalUsers = User::count();
        $totalLeads = Lead::count();
        $convertedLeads = Lead::where('status', 'converted')->count();
        $conversionRate = $totalLeads > 0 ? round(($convertedLeads / $totalLeads) * 100, 1) : 0;
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');

        // --- Weekly Booking Trend (last 7 days) ---
        $weeklyTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $weeklyTrend[] = [
                'day' => $date->format('D'),
                'date' => $date->format('M d'),
                'bookings' => Booking::whereDate('created_at', $date)->count(),
                'leads' => Lead::whereDate('created_at', $date)->count(),
            ];
        }

        return view('admin.dashboard', compact(
            'todaysArrivals', 'todaysDepartures', 'pendingLeads', 'occupancyRate',
            'occupiedRooms', 'totalRooms', 'monthlyRevenue', 'pendingApprovals',
            'recentBookings', 'recentLeads',
            'totalBookings', 'confirmedBookings', 'totalUsers', 'totalLeads',
            'convertedLeads', 'conversionRate', 'totalRevenue', 'weeklyTrend'
        ));
    }
}
