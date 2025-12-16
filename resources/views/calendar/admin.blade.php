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
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Current Month Calendar -->
            <div>
                <h2 class="text-2xl text-white text-center mb-4">{{ $currentMonth->format('F Y') }}</h2>
                <div class="grid grid-cols-7 gap-1 text-center mb-2">
                    <div class="text-red-500">S</div>
                    <div class="text-white">M</div>
                    <div class="text-white">T</div>
                    <div class="text-white">W</div>
                    <div class="text-white">T</div>
                    <div class="text-white">F</div>
                    <div class="text-red-500">S</div>
                </div>

                <div class="grid grid-cols-7 gap-1">
                    @php
                        $startDay = $currentMonth->copy()->startOfMonth()->dayOfWeek;
                        $daysInMonth = $currentMonth->daysInMonth;
                    @endphp

                    @for ($i = 0; $i < $startDay; $i++)
                        <div></div>
                    @endfor

                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $date = $currentMonth->copy()->startOfMonth()->addDays($day - 1);
                            $dateString = $date->format('Y-m-d');
                            $status = $currentMonthAvailability[$dateString] ?? 'available';
                            
                            $bgClass = 'bg-emerald-500'; // Available
                            if ($status === 'limited') {
                                $bgClass = 'bg-yellow-500';
                            } elseif ($status === 'booked') {
                                $bgClass = 'bg-red-500';
                            }
                        @endphp
                        
                        <div class="{{ $bgClass }} rounded-lg p-2 text-center text-white">
                            {{ $day }}
                        </div>
                    @endfor
                </div>
            </div>
            
            <!-- Next Month Calendar -->
            <div>
                <h2 class="text-2xl text-white text-center mb-4">{{ $nextMonth->format('F Y') }}</h2>
                <div class="grid grid-cols-7 gap-1 text-center mb-2">
                    <div class="text-red-500">S</div>
                    <div class="text-white">M</div>
                    <div class="text-white">T</div>
                    <div class="text-white">W</div>
                    <div class="text-white">T</div>
                    <div class="text-white">F</div>
                    <div class="text-red-500">S</div>
                </div>

                <div class="grid grid-cols-7 gap-1">
                    @php
                        $startDay = $nextMonth->copy()->startOfMonth()->dayOfWeek;
                        $daysInMonth = $nextMonth->daysInMonth;
                    @endphp

                    @for ($i = 0; $i < $startDay; $i++)
                        <div></div>
                    @endfor

                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $date = $nextMonth->copy()->startOfMonth()->addDays($day - 1);
                            $dateString = $date->format('Y-m-d');
                            $status = $nextMonthAvailability[$dateString] ?? 'available';
                            
                            $bgClass = 'bg-emerald-500'; // Available
                            if ($status === 'limited') {
                                $bgClass = 'bg-yellow-500';
                            } elseif ($status === 'booked') {
                                $bgClass = 'bg-red-500';
                            }
                        @endphp
                        
                        <div class="{{ $bgClass }} rounded-lg p-2 text-center text-white">
                            {{ $day }}
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        
        <div class="flex justify-center mt-8 gap-8">
            <div class="flex items-center">
                <div class="w-4 h-4 bg-emerald-500 rounded-full mr-2"></div>
                <span class="text-white">Available</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-yellow-500 rounded-full mr-2"></div>
                <span class="text-white">Limited Availability</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-red-500 rounded-full mr-2"></div>
                <span class="text-white">Fully Booked</span>
            </div>
        </div>
    </div>
</div>
@endsection