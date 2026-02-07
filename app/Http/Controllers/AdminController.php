<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lead;
use App\Models\User;
use App\Models\Room;
use App\Models\CustomPackage;
use App\Models\MenuCategory;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        // --- Daily Visitors Summary ---
        $todayVisitors = Visitor::whereDate('created_at', $today)->count();
        $todayUniqueVisitors = Visitor::whereDate('created_at', $today)->distinct('ip_address')->count('ip_address');

        // Visitors by country (today)
        $visitorsByCountry = Visitor::whereDate('created_at', $today)
            ->select('country', 'country_code', DB::raw('COUNT(*) as visits'), DB::raw('COUNT(DISTINCT ip_address) as unique_visitors'))
            ->whereNotNull('country')
            ->groupBy('country', 'country_code')
            ->orderByDesc('visits')
            ->limit(15)
            ->get();

        // Top pages today
        $topPages = Visitor::whereDate('created_at', $today)
            ->select('page_name', DB::raw('COUNT(*) as views'))
            ->whereNotNull('page_name')
            ->groupBy('page_name')
            ->orderByDesc('views')
            ->limit(8)
            ->get();

        // Device breakdown today
        $deviceBreakdown = Visitor::whereDate('created_at', $today)
            ->select('device_type', DB::raw('COUNT(*) as total'))
            ->whereNotNull('device_type')
            ->groupBy('device_type')
            ->orderByDesc('total')
            ->get();

        // Visitor trend (last 7 days)
        $visitorTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $visitorTrend[] = [
                'day' => $date->format('D'),
                'date' => $date->format('M d'),
                'total' => Visitor::whereDate('created_at', $date)->count(),
                'unique' => Visitor::whereDate('created_at', $date)->distinct('ip_address')->count('ip_address'),
            ];
        }

        return view('admin.dashboard', compact(
            'todaysArrivals', 'todaysDepartures', 'pendingLeads', 'occupancyRate',
            'occupiedRooms', 'totalRooms', 'monthlyRevenue', 'pendingApprovals',
            'recentBookings', 'recentLeads',
            'totalBookings', 'confirmedBookings', 'totalUsers', 'totalLeads',
            'convertedLeads', 'conversionRate', 'totalRevenue', 'weeklyTrend',
            'todayVisitors', 'todayUniqueVisitors', 'visitorsByCountry',
            'topPages', 'deviceBreakdown', 'visitorTrend'
        ));
    }
}
