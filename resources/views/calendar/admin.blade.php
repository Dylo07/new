@extends('layouts.admin')

@section('title', 'Availability')
@section('page_title', 'Availability & Sync')
@section('page_subtitle', 'Auto-synced from Ops System — view bookings, sync status, and calendar')

@section('content')

{{-- Sync Status & Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    {{-- Sync Status --}}
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg {{ $lastSyncStatus === 'success' ? 'bg-emerald-500/15' : ($lastSyncStatus === 'error' ? 'bg-red-500/15' : 'bg-gray-500/15') }} flex items-center justify-center">
                <i class="fas {{ $lastSyncStatus === 'success' ? 'fa-check-circle text-emerald-400' : ($lastSyncStatus === 'error' ? 'fa-exclamation-circle text-red-400' : 'fa-question-circle text-gray-400') }}"></i>
            </div>
            @if($lastSyncStatus === 'success')
                <span class="bg-emerald-500/20 text-emerald-400 text-xs font-bold px-2 py-0.5 rounded-full">Healthy</span>
            @elseif($lastSyncStatus === 'error')
                <span class="bg-red-500/20 text-red-400 text-xs font-bold px-2 py-0.5 rounded-full">Error</span>
            @else
                <span class="bg-gray-500/20 text-gray-400 text-xs font-bold px-2 py-0.5 rounded-full">Unknown</span>
            @endif
        </div>
        <div class="text-lg font-bold text-white">
            @if($lastSyncTime)
                {{ $lastSyncTime->diffForHumans() }}
            @else
                Never
            @endif
        </div>
        <div class="text-gray-500 text-xs mt-1">Last Sync</div>
        @if($lastSyncTime)
            <div class="text-gray-600 text-xs mt-0.5">{{ $lastSyncTime->format('M d, g:i A') }}</div>
        @endif
    </div>

    {{-- API Status --}}
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg {{ $apiConfigured ? 'bg-blue-500/15' : 'bg-red-500/15' }} flex items-center justify-center">
                <i class="fas {{ $apiConfigured ? 'fa-plug text-blue-400' : 'fa-unlink text-red-400' }}"></i>
            </div>
        </div>
        <div class="text-lg font-bold text-white">{{ $apiConfigured ? 'Connected' : 'Not Set' }}</div>
        <div class="text-gray-500 text-xs mt-1">Ops API</div>
        <div class="text-gray-600 text-xs mt-0.5">Syncs every hour</div>
    </div>

    {{-- Booked Days --}}
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-red-500/15 flex items-center justify-center">
                <i class="fas fa-calendar-times text-red-400"></i>
            </div>
            <span class="text-gray-500 text-xs">Next 90 days</span>
        </div>
        <div class="text-2xl font-bold text-white">{{ $totalBookedDates }}</div>
        <div class="text-gray-500 text-xs mt-1">Booked Days</div>
        <div class="text-gray-600 text-xs mt-0.5">{{ $totalLimitedDates }} limited</div>
    </div>

    {{-- 30-Day Occupancy --}}
    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-purple-500/15 flex items-center justify-center">
                <i class="fas fa-chart-pie text-purple-400"></i>
            </div>
            <span class="text-gray-500 text-xs">{{ $bookedNext30 }}/30 days</span>
        </div>
        <div class="text-2xl font-bold text-white">{{ $occupancyNext30 }}%</div>
        <div class="text-gray-500 text-xs mt-1">30-Day Occupancy</div>
        <div class="w-full bg-gray-800 rounded-full h-1.5 mt-2">
            <div class="bg-purple-500 h-1.5 rounded-full transition-all" style="width: {{ $occupancyNext30 }}%"></div>
        </div>
    </div>
</div>

{{-- 3-Month Calendar --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    @foreach($months as $monthData)
        @php
            $month = $monthData['month'];
            $availability = $monthData['availability'];
            $startDay = $month->copy()->startOfMonth()->dayOfWeek;
            $daysInMonth = $month->daysInMonth;
            $today = \Carbon\Carbon::today()->format('Y-m-d');
        @endphp
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
            <h3 class="text-white font-semibold text-sm text-center mb-4">{{ $month->format('F Y') }}</h3>
            
            {{-- Day headers --}}
            <div class="grid grid-cols-7 gap-1 text-center mb-2">
                <div class="text-red-400 text-xs font-medium">S</div>
                <div class="text-gray-500 text-xs font-medium">M</div>
                <div class="text-gray-500 text-xs font-medium">T</div>
                <div class="text-gray-500 text-xs font-medium">W</div>
                <div class="text-gray-500 text-xs font-medium">T</div>
                <div class="text-gray-500 text-xs font-medium">F</div>
                <div class="text-red-400 text-xs font-medium">S</div>
            </div>

            {{-- Calendar grid --}}
            <div class="grid grid-cols-7 gap-1">
                @for ($i = 0; $i < $startDay; $i++)
                    <div></div>
                @endfor

                @for ($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $date = $month->copy()->startOfMonth()->addDays($day - 1);
                        $dateString = $date->format('Y-m-d');
                        $dayData = $availability[$dateString] ?? ['status' => 'available', 'rooms' => [], 'function_type' => null, 'guest_count' => null];
                        $status = is_array($dayData) ? ($dayData['status'] ?? 'available') : $dayData;
                        $rooms = is_array($dayData) ? ($dayData['rooms'] ?? []) : [];
                        $funcType = is_array($dayData) ? ($dayData['function_type'] ?? null) : null;
                        $guestCount = is_array($dayData) ? ($dayData['guest_count'] ?? null) : null;
                        $isToday = $dateString === $today;
                        $isPast = $date->lt(\Carbon\Carbon::today());

                        $bgClass = 'bg-gray-800/50 text-gray-500'; // available
                        if ($status === 'booked') {
                            $bgClass = 'bg-red-500/20 text-red-400 border border-red-500/30';
                        } elseif ($status === 'limited') {
                            $bgClass = 'bg-amber-500/20 text-amber-400 border border-amber-500/30';
                        }
                        if ($isPast) {
                            $bgClass = 'bg-gray-900/50 text-gray-700';
                        }
                        if ($isToday) {
                            $bgClass .= ' ring-2 ring-emerald-500';
                        }

                        // Build tooltip
                        $tooltip = $date->format('M d, Y') . ' — ' . ucfirst($status);
                        if ($funcType) $tooltip .= "\nType: " . $funcType;
                        if ($guestCount) $tooltip .= "\nGuests: " . $guestCount;
                        if (is_array($rooms) && count($rooms) > 0) $tooltip .= "\nRooms: " . implode(', ', $rooms);
                    @endphp
                    
                    <div class="{{ $bgClass }} rounded-md p-1 text-center text-xs font-medium cursor-default transition-all hover:opacity-80"
                         title="{{ $tooltip }}">
                        {{ $day }}
                        @if($status === 'booked' && !$isPast)
                            <div class="w-1 h-1 bg-red-400 rounded-full mx-auto mt-0.5"></div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>
    @endforeach
</div>

{{-- Legend --}}
<div class="flex flex-wrap items-center gap-6 mb-8 px-1">
    <div class="flex items-center gap-2">
        <div class="w-3 h-3 bg-gray-800/50 rounded-sm border border-gray-700"></div>
        <span class="text-gray-400 text-xs">Available</span>
    </div>
    <div class="flex items-center gap-2">
        <div class="w-3 h-3 bg-red-500/20 rounded-sm border border-red-500/30"></div>
        <span class="text-gray-400 text-xs">Booked</span>
    </div>
    <div class="flex items-center gap-2">
        <div class="w-3 h-3 bg-amber-500/20 rounded-sm border border-amber-500/30"></div>
        <span class="text-gray-400 text-xs">Limited</span>
    </div>
    <div class="flex items-center gap-2">
        <div class="w-3 h-3 bg-gray-900/50 rounded-sm border border-gray-800"></div>
        <span class="text-gray-400 text-xs">Past</span>
    </div>
    <div class="flex items-center gap-2">
        <div class="w-3 h-3 bg-gray-800 rounded-sm ring-2 ring-emerald-500"></div>
        <span class="text-gray-400 text-xs">Today</span>
    </div>
</div>

{{-- Upcoming Bookings + Sync Log --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    {{-- Upcoming Booked Dates --}}
    <div class="lg:col-span-2 bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-800 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-red-500/15 flex items-center justify-center">
                    <i class="fas fa-calendar-check text-red-400 text-sm"></i>
                </div>
                <h3 class="text-white font-semibold text-sm">Upcoming Booked Dates</h3>
            </div>
            <span class="text-gray-500 text-xs">Next 15 dates</span>
        </div>
        @if($upcomingBookings->count() > 0)
        <table class="w-full admin-table">
            <thead class="bg-gray-800/50">
                <tr>
                    <th>Date</th>
                    <th>Function Type</th>
                    <th>Rooms</th>
                    <th class="text-center">Guests</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcomingBookings as $booking)
                <tr>
                    <td>
                        <div class="text-white text-xs font-medium">{{ $booking->date->format('D, M d') }}</div>
                        <div class="text-gray-500 text-xs">{{ $booking->date->diffForHumans() }}</div>
                    </td>
                    <td>
                        @if($booking->function_type)
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-purple-500/20 text-purple-400">
                                {{ $booking->function_type }}
                            </span>
                        @else
                            <span class="text-gray-600 text-xs">—</span>
                        @endif
                    </td>
                    <td>
                        @if(is_array($booking->rooms) && count($booking->rooms) > 0)
                            <div class="flex flex-wrap gap-1">
                                @foreach($booking->rooms as $room)
                                    <span class="px-1.5 py-0.5 rounded text-xs bg-blue-500/20 text-blue-400">{{ $room }}</span>
                                @endforeach
                            </div>
                        @else
                            <span class="text-gray-600 text-xs">—</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($booking->guest_count)
                            <span class="text-white text-xs font-medium">{{ $booking->guest_count }}</span>
                        @else
                            <span class="text-gray-600 text-xs">—</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-8 text-center">
            <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-calendar text-gray-600 text-lg"></i>
            </div>
            <div class="text-gray-500 text-sm">No upcoming booked dates</div>
            <div class="text-gray-600 text-xs mt-1">All dates are currently available</div>
        </div>
        @endif
    </div>

    {{-- Right Column: Function Types + Sync Log --}}
    <div class="space-y-4">
        {{-- Function Type Breakdown --}}
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
            <h4 class="text-white font-semibold text-xs mb-3">Booking Types</h4>
            @if($functionTypes->count() > 0)
                <div class="space-y-2">
                    @foreach($functionTypes as $ft)
                        @php $ftPct = $totalBookedDates > 0 ? round(($ft->total / $totalBookedDates) * 100) : 0; @endphp
                        <div class="flex items-center justify-between">
                            <span class="text-gray-300 text-xs truncate flex-1 mr-2">{{ $ft->function_type }}</span>
                            <div class="flex items-center gap-2">
                                <div class="w-12 bg-gray-800 rounded-full h-1">
                                    <div class="bg-purple-500 h-1 rounded-full" style="width: {{ min($ftPct, 100) }}%"></div>
                                </div>
                                <span class="text-gray-500 text-xs w-8 text-right">{{ $ft->total }}d</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-gray-600 text-xs text-center py-2">No function type data</div>
            @endif
        </div>

        {{-- Sync Log --}}
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-white font-semibold text-xs">Sync Log</h4>
                @if($lastSyncStatus === 'success')
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                @elseif($lastSyncStatus === 'error')
                    <span class="w-2 h-2 rounded-full bg-red-400"></span>
                @else
                    <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                @endif
            </div>
            @if(count($lastSyncLines) > 0)
                <div class="bg-gray-950 rounded-lg p-3 max-h-48 overflow-y-auto font-mono text-[10px] leading-relaxed space-y-0.5">
                    @foreach($lastSyncLines as $line)
                        <div class="text-gray-400 {{ str_contains($line, '✅') ? 'text-emerald-400' : '' }} {{ str_contains($line, '❌') || str_contains($line, 'Error') ? 'text-red-400' : '' }} {{ str_contains($line, '⚠') ? 'text-amber-400' : '' }}">{{ $line }}</div>
                    @endforeach
                </div>
            @else
                <div class="text-gray-600 text-xs text-center py-4">
                    <i class="fas fa-file-alt text-gray-700 text-lg mb-2 block"></i>
                    No sync log available yet
                </div>
            @endif
        </div>

        {{-- Sync Info --}}
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
            <h4 class="text-white font-semibold text-xs mb-3">Sync Configuration</h4>
            <div class="space-y-2 text-xs">
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Source</span>
                    <span class="text-gray-300">Ops System API</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Frequency</span>
                    <span class="text-gray-300">Every hour</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">API Status</span>
                    <span class="{{ $apiConfigured ? 'text-emerald-400' : 'text-red-400' }}">{{ $apiConfigured ? 'Configured' : 'Not configured' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Command</span>
                    <span class="text-gray-400 font-mono">sync:availability</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection