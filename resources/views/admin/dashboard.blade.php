@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Good ' . (now()->hour < 12 ? 'Morning' : (now()->hour < 17 ? 'Afternoon' : 'Evening')) . ', ' . Auth::user()->name)
@section('page_subtitle', now()->format('l, F j, Y') . ' — Hotel Mission Control')

@section('content')

{{-- Morning Overview Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    {{-- Today's Arrivals --}}
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-blue-500/15 flex items-center justify-center">
                <i class="fas fa-plane-arrival text-blue-400"></i>
            </div>
            @if($todaysArrivals > 0)
                <span class="bg-blue-500/20 text-blue-400 text-xs font-bold px-2 py-0.5 rounded-full">Today</span>
            @endif
        </div>
        <div class="text-2xl font-bold text-white">{{ $todaysArrivals }}</div>
        <div class="text-gray-500 text-xs mt-1">Today's Arrivals</div>
        <div class="text-gray-600 text-xs mt-0.5">{{ $todaysDepartures }} departures</div>
    </div>

    {{-- Pending Leads --}}
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-amber-500/15 flex items-center justify-center">
                <i class="fas fa-phone-volume text-amber-400"></i>
            </div>
            @if($pendingLeads > 0)
                <span class="bg-amber-500/20 text-amber-400 text-xs font-bold px-2 py-0.5 rounded-full animate-pulse">Action</span>
            @endif
        </div>
        <div class="text-2xl font-bold text-white">{{ $pendingLeads }}</div>
        <div class="text-gray-500 text-xs mt-1">Pending Leads</div>
        <div class="text-gray-600 text-xs mt-0.5">Waiting for follow-up</div>
    </div>

    {{-- Occupancy Rate --}}
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-emerald-500/15 flex items-center justify-center">
                <i class="fas fa-bed text-emerald-400"></i>
            </div>
            <span class="text-gray-500 text-xs">{{ $occupiedRooms }}/{{ $totalRooms }}</span>
        </div>
        <div class="text-2xl font-bold text-white">{{ $occupancyRate }}%</div>
        <div class="text-gray-500 text-xs mt-1">Occupancy Rate</div>
        <div class="w-full bg-gray-800 rounded-full h-1.5 mt-2">
            <div class="bg-emerald-500 h-1.5 rounded-full transition-all" style="width: {{ $occupancyRate }}%"></div>
        </div>
    </div>

    {{-- Monthly Revenue --}}
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-purple-500/15 flex items-center justify-center">
                <i class="fas fa-chart-line text-purple-400"></i>
            </div>
            <span class="text-gray-500 text-xs">{{ now()->format('M Y') }}</span>
        </div>
        <div class="text-2xl font-bold text-white">Rs {{ number_format($monthlyRevenue, 0) }}</div>
        <div class="text-gray-500 text-xs mt-1">Monthly Revenue</div>
        <div class="text-gray-600 text-xs mt-0.5">Rs {{ number_format($totalRevenue, 0) }} lifetime</div>
    </div>
</div>

{{-- Alert Banner (if pending approvals) --}}
@if($pendingApprovals > 0)
<div class="bg-amber-500/10 border border-amber-500/30 rounded-xl p-4 mb-8 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-amber-500/20 flex items-center justify-center animate-pulse">
            <i class="fas fa-exclamation-triangle text-amber-400"></i>
        </div>
        <div>
            <div class="text-amber-300 font-semibold text-sm">{{ $pendingApprovals }} booking{{ $pendingApprovals > 1 ? 's' : '' }} waiting for approval</div>
            <div class="text-amber-500/70 text-xs">Payment receipts uploaded — review and approve now</div>
        </div>
    </div>
    <a href="{{ route('admin.bookings.index') }}" class="bg-amber-500 hover:bg-amber-600 text-black font-bold px-4 py-2 rounded-lg text-sm transition">
        Review Now
    </a>
</div>
@endif

{{-- Quick Actions --}}
<div class="mb-8">
    <h2 class="text-white font-semibold text-sm mb-3">Quick Actions</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <a href="{{ route('admin.bookings.index') }}" class="bg-gray-900 border border-gray-800 hover:border-emerald-500/50 rounded-xl p-4 text-center transition group">
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center mx-auto mb-2 group-hover:bg-emerald-500/20 transition">
                <i class="fas fa-calendar-plus text-emerald-400 text-lg"></i>
            </div>
            <div class="text-white text-sm font-medium">Manage Bookings</div>
            <div class="text-gray-500 text-xs mt-0.5">{{ $totalBookings }} total</div>
        </a>
        <a href="{{ route('admin.leads.index') }}" class="bg-gray-900 border border-gray-800 hover:border-blue-500/50 rounded-xl p-4 text-center transition group">
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center mx-auto mb-2 group-hover:bg-blue-500/20 transition">
                <i class="fas fa-user-plus text-blue-400 text-lg"></i>
            </div>
            <div class="text-white text-sm font-medium">Add Lead</div>
            <div class="text-gray-500 text-xs mt-0.5">{{ $totalLeads }} tracked</div>
        </a>
        <a href="{{ route('admin.calendar.edit') }}" class="bg-gray-900 border border-gray-800 hover:border-purple-500/50 rounded-xl p-4 text-center transition group">
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center mx-auto mb-2 group-hover:bg-purple-500/20 transition">
                <i class="fas fa-ban text-purple-400 text-lg"></i>
            </div>
            <div class="text-white text-sm font-medium">Block Dates</div>
            <div class="text-gray-500 text-xs mt-0.5">Manage availability</div>
        </a>
        <a href="{{ route('admin.custom-packages.create') }}" class="bg-gray-900 border border-gray-800 hover:border-amber-500/50 rounded-xl p-4 text-center transition group">
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center mx-auto mb-2 group-hover:bg-amber-500/20 transition">
                <i class="fas fa-box-open text-amber-400 text-lg"></i>
            </div>
            <div class="text-white text-sm font-medium">New Package</div>
            <div class="text-gray-500 text-xs mt-0.5">Create custom package</div>
        </a>
    </div>
</div>

{{-- Weekly Trend + Summary --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    {{-- Weekly Trend Chart --}}
    <div class="lg:col-span-2 bg-gray-900 border border-gray-800 rounded-xl p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-white font-semibold text-sm">7-Day Activity</h3>
            <div class="flex items-center gap-4 text-xs">
                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-emerald-400"></span> Bookings</span>
                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-blue-400"></span> Leads</span>
            </div>
        </div>
        <div class="flex items-end gap-2 h-32">
            @foreach($weeklyTrend as $day)
                @php
                    $maxVal = max(1, max(array_column($weeklyTrend, 'bookings') + array_column($weeklyTrend, 'leads')));
                    $bookingHeight = $maxVal > 0 ? max(4, ($day['bookings'] / $maxVal) * 100) : 4;
                    $leadHeight = $maxVal > 0 ? max(4, ($day['leads'] / $maxVal) * 100) : 4;
                @endphp
                <div class="flex-1 flex flex-col items-center gap-1">
                    <div class="w-full flex gap-0.5 items-end justify-center" style="height: 100px;">
                        <div class="w-3 bg-emerald-500/60 rounded-t transition-all hover:bg-emerald-400" style="height: {{ $bookingHeight }}%" title="{{ $day['bookings'] }} bookings"></div>
                        <div class="w-3 bg-blue-500/60 rounded-t transition-all hover:bg-blue-400" style="height: {{ $leadHeight }}%" title="{{ $day['leads'] }} leads"></div>
                    </div>
                    <div class="text-gray-500 text-xs">{{ $day['day'] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="space-y-3">
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-emerald-500/15 flex items-center justify-center">
                <i class="fas fa-check-circle text-emerald-400"></i>
            </div>
            <div class="flex-1">
                <div class="text-white font-bold">{{ $confirmedBookings }}</div>
                <div class="text-gray-500 text-xs">Confirmed Bookings</div>
            </div>
        </div>
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-blue-500/15 flex items-center justify-center">
                <i class="fas fa-users text-blue-400"></i>
            </div>
            <div class="flex-1">
                <div class="text-white font-bold">{{ $totalUsers }}</div>
                <div class="text-gray-500 text-xs">Registered Users</div>
            </div>
        </div>
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-purple-500/15 flex items-center justify-center">
                <i class="fas fa-exchange-alt text-purple-400"></i>
            </div>
            <div class="flex-1">
                <div class="text-white font-bold">{{ $conversionRate }}%</div>
                <div class="text-gray-500 text-xs">Lead Conversion Rate</div>
            </div>
        </div>
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-amber-500/15 flex items-center justify-center">
                <i class="fas fa-funnel-dollar text-amber-400"></i>
            </div>
            <div class="flex-1">
                <div class="text-white font-bold">{{ $convertedLeads }}/{{ $totalLeads }}</div>
                <div class="text-gray-500 text-xs">Leads Converted</div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Activity Tables --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Recent Bookings --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-800 flex items-center justify-between">
            <h3 class="text-white font-semibold text-sm">Recent Bookings</h3>
            <a href="{{ route('admin.bookings.index') }}" class="text-emerald-400 hover:text-emerald-300 text-xs font-medium">View All →</a>
        </div>
        <table class="w-full admin-table">
            <thead class="bg-gray-800/50">
                <tr>
                    <th>Guest</th>
                    <th>Package</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBookings as $booking)
                <tr>
                    <td>
                        <div class="text-white font-medium text-xs">{{ $booking->user->name ?? 'N/A' }}</div>
                        <div class="text-gray-500 text-xs">{{ $booking->created_at->diffForHumans() }}</div>
                    </td>
                    <td>
                        @if($booking->customPackage)
                            <span class="text-emerald-400 text-xs">{{ Str::limit($booking->customPackage->name, 20) }}</span>
                        @elseif($booking->room)
                            <span class="text-blue-400 text-xs">{{ $booking->room->room_number }}</span>
                        @else
                            <span class="text-gray-500 text-xs">—</span>
                        @endif
                    </td>
                    <td class="text-white font-medium text-xs">Rs {{ number_format($booking->total_price, 0) }}</td>
                    <td>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold
                            {{ $booking->status === 'confirmed' ? 'bg-emerald-500/20 text-emerald-400' : '' }}
                            {{ $booking->status === 'pending' ? 'bg-amber-500/20 text-amber-400' : '' }}
                            {{ $booking->status === 'cancelled' ? 'bg-red-500/20 text-red-400' : '' }}
                            {{ $booking->status === 'completed' ? 'bg-blue-500/20 text-blue-400' : '' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-8">No bookings yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Recent Leads --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-800 flex items-center justify-between">
            <h3 class="text-white font-semibold text-sm">Newest Leads</h3>
            <a href="{{ route('admin.leads.index') }}" class="text-emerald-400 hover:text-emerald-300 text-xs font-medium">View All →</a>
        </div>
        <table class="w-full admin-table">
            <thead class="bg-gray-800/50">
                <tr>
                    <th>Lead</th>
                    <th>Source</th>
                    <th>Interest</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLeads as $lead)
                <tr>
                    <td>
                        <div class="text-white font-medium text-xs">{{ $lead->guest_name ?: 'Anonymous' }}</div>
                        <div class="text-gray-500 text-xs">{{ $lead->created_at->diffForHumans() }}</div>
                    </td>
                    <td>
                        <span class="px-2 py-0.5 rounded text-xs font-medium
                            {{ $lead->source === 'package_builder' ? 'bg-blue-500/20 text-blue-400' : '' }}
                            {{ $lead->source === 'whatsapp' ? 'bg-green-500/20 text-green-400' : '' }}
                            {{ $lead->source === 'manual' ? 'bg-gray-500/20 text-gray-400' : '' }}
                            {{ $lead->source === 'phone' ? 'bg-purple-500/20 text-purple-400' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $lead->source)) }}
                        </span>
                    </td>
                    <td class="text-gray-300 text-xs">{{ $lead->category ?: '—' }}</td>
                    <td>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold
                            {{ $lead->status === 'converted' ? 'bg-emerald-500/20 text-emerald-400' : '' }}
                            {{ $lead->status === 'abandoned' ? 'bg-red-500/20 text-red-400' : '' }}
                            {{ in_array($lead->status, ['started','browsing','reviewed']) ? 'bg-amber-500/20 text-amber-400' : '' }}
                            {{ $lead->status === 'paid' ? 'bg-blue-500/20 text-blue-400' : '' }}">
                            {{ ucfirst($lead->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-8">No leads tracked yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
