@extends('layouts.app')

@section('title', 'Room Availability - Soba Lanka')

@section('content')
<div class="min-h-screen bg-black py-16">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl text-white font-light">Room Availability</h1>
            
            @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('admin.calendar.edit') }}" class="bg-emerald-500 text-white px-6 py-3 rounded-lg hover:bg-emerald-600 transition-all duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit Availability
                </a>
            @endif
        </div>

        <!-- 6 Month Calendar Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($months as $monthData)
                @php
                    $month = $monthData['month'];
                    $availability = $monthData['availability'];
                    $startDay = $month->copy()->startOfMonth()->dayOfWeek;
                    $daysInMonth = $month->daysInMonth;
                @endphp
                
                <div class="bg-gray-900/50 rounded-xl p-4">
                    <h2 class="text-xl text-white text-center mb-4 font-semibold">{{ $month->format('F Y') }}</h2>
                    
                    <!-- Day Headers -->
                    <div class="grid grid-cols-7 gap-1 text-center mb-2 text-sm">
                        <div class="text-red-400">S</div>
                        <div class="text-gray-400">M</div>
                        <div class="text-gray-400">T</div>
                        <div class="text-gray-400">W</div>
                        <div class="text-gray-400">T</div>
                        <div class="text-gray-400">F</div>
                        <div class="text-red-400">S</div>
                    </div>

                    <!-- Calendar Days -->
                    <div class="grid grid-cols-7 gap-1">
                        @for ($i = 0; $i < $startDay; $i++)
                            <div></div>
                        @endfor

                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $date = $month->copy()->startOfMonth()->addDays($day - 1);
                                $dateString = $date->format('Y-m-d');
                                $dayData = $availability[$dateString] ?? ['status' => 'available'];
                                $status = $dayData['status'] ?? 'available';
                                $rooms = $dayData['rooms'] ?? [];
                                // Handle both array and object formats
                                if (is_array($rooms)) {
                                    $rooms = array_values($rooms); // Re-index to ensure proper array
                                }
                                $functionType = $dayData['function_type'] ?? null;
                                $guestCount = $dayData['guest_count'] ?? null;
                                $roomCount = is_array($rooms) ? count($rooms) : 0;
                                
                                // Color based on occupancy level (with inline style fallback)
                                if ($status === 'available') {
                                    $bgClass = 'calendar-available'; // Green
                                    $bgStyle = 'background-color: #10b981;';
                                    $occupancyLabel = 'Available';
                                } elseif ($status === 'booked') {
                                    if ($roomCount === 0) {
                                        $bgClass = 'calendar-full'; // Red
                                        $bgStyle = 'background-color: #ef4444;';
                                        $occupancyLabel = 'Booked';
                                    } elseif ($roomCount <= 5) {
                                        $bgClass = 'calendar-low'; // Yellow
                                        $bgStyle = 'background-color: #eab308;';
                                        $occupancyLabel = 'Low';
                                    } elseif ($roomCount <= 10) {
                                        $bgClass = 'calendar-medium'; // Orange
                                        $bgStyle = 'background-color: #f97316;';
                                        $occupancyLabel = 'Medium';
                                    } else {
                                        $bgClass = 'calendar-full'; // Red
                                        $bgStyle = 'background-color: #ef4444;';
                                        $occupancyLabel = 'High';
                                    }
                                } else {
                                    $bgClass = 'calendar-low'; // Yellow
                                    $bgStyle = 'background-color: #eab308;';
                                    $occupancyLabel = 'Limited';
                                }
                            @endphp
                            
                            <div 
                                class="{{ $bgClass }} rounded-lg p-2 text-center text-white text-sm cursor-default transition-all duration-200"
                                style="{{ $bgStyle }}"
                            >
                                {{ $day }}
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Legend -->
        <div class="flex flex-wrap justify-center mt-8 gap-4 md:gap-6">
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full mr-2" style="background-color: #10b981;"></div>
                <span class="text-white text-sm">Available</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full mr-2" style="background-color: #eab308;"></div>
                <span class="text-white text-sm">Partially Booked</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full mr-2" style="background-color: #f97316;"></div>
                <span class="text-white text-sm">Busy</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-full mr-2" style="background-color: #ef4444;"></div>
                <span class="text-white text-sm">Fully Booked</span>
            </div>
        </div>
    </div>
</div>
@endsection