@extends('layouts.app')

@section('title', 'Our Rooms')

@section('content')
<div class="min-h-screen bg-black">
<div class="relative z-0 pt-20">
    <!-- Hero Section -->
    <div class="relative py-24">
        <div class="absolute inset-0">
            <img src="{{ asset('images/room-hero.jpg') }}" alt="Luxury Room" class="w-full h-full object-cover" onerror="this.src='/api/placeholder/1920/600'">
            <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        </div>
        
        <div class="relative container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center text-white">
                <h1 class="text-5xl font-light mb-6">Our Luxury Accommodations</h1>
                <p class="text-xl text-gray-300">Experience comfort and elegance in our thoughtfully designed rooms</p>
            </div>
        </div>
    </div>


    <!-- Admin Calendar Section -->
@auth
    @if(auth()->user()->is_admin)
    <div class="container mx-auto px-4 py-8">
        <div class="bg-gray-900 rounded-lg p-6 mb-8">
            <h2 class="text-2xl text-white font-light mb-6">Room Availability Calendar</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Calendar -->
                <div class="bg-gray-800 rounded-lg p-6">
                    <div id="availability-calendar"></div>
                </div>

                <!-- Selected Date Info -->
                <div class="bg-gray-800 rounded-lg p-6">
                    <h3 class="text-xl text-white mb-4" id="selected-date-display">Select a date to manage room availability</h3>
                    <div id="room-availability-list" class="space-y-4 hidden">
                        <!-- Room availability toggles will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endauth



<!-- Selected Dates Display -->
@if(request('check_in') && request('check_out'))
<div class="container mx-auto px-4 py-8">
    <div class="bg-gray-900/80 backdrop-blur-sm rounded-lg p-6 mb-8">
        <div class="flex flex-wrap justify-between items-center">
            <div class="flex flex-wrap items-center gap-8">
                <div>
                    <span class="block text-gray-400 text-sm">Check-in</span>
                    <span class="text-white text-lg">{{ \Carbon\Carbon::parse(request('check_in'))->format('M d, Y') }}</span>
                </div>
                <div>
                    <span class="block text-gray-400 text-sm">Check-out</span>
                    <span class="text-white text-lg">{{ \Carbon\Carbon::parse(request('check_out'))->format('M d, Y') }}</span>
                </div>
                @if(request('adults') || request('children'))
                <div>
                    <span class="block text-gray-400 text-sm">Guests</span>
                    <span class="text-white text-lg">
                        {{ request('adults', 0) }} {{ Str::plural('Adult', request('adults', 0)) }}
                        @if(request('children'))
                            , {{ request('children') }} {{ Str::plural('Child', request('children')) }}
                        @endif
                    </span>
                </div>
                @endif
            </div>
            <button 
                onclick="window.history.back()"
                class="mt-4 md:mt-0 px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors duration-300 inline-flex items-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Modify Search
            </button>
        </div>
    </div>
</div>
@endif





    <!-- Admin Controls -->
    @auth
        @if(auth()->user()->is_admin)
        <div class="container mx-auto px-4 py-8">
            <div class="bg-gray-900 rounded-lg p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl text-white font-light">Room Management</h2>
                    <a 
                        href="{{ route('rooms.create') }}"
                        class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-colors duration-300 flex items-center gap-2"
                    >
                        <i class="fas fa-plus"></i>
                        Add New Room
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-500/20 text-green-400 px-4 py-3 rounded mb-6 success-alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
        @endif
    @endauth

    <!-- Room Categories -->
    <div class="container mx-auto px-4 py-16">
        <!-- A/C Rooms -->
        <div class="mb-20">
            <h2 class="text-3xl text-white mb-8 font-light">A/C Rooms</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($rooms->where('category', 'ac') as $room)
                
                <div class="bg-gray-900 rounded-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
    <div class="relative">
        <img 
            src="{{ $room->image ? asset('storage/' . $room->image) : '/api/placeholder/400/300' }}" 
            alt="{{ $room->type }} {{ $room->room_number }}"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        
        @if(request('check_in') && request('check_out'))
            @if(!$room->is_available_for_dates)
                <div class="absolute top-0 left-0 w-full bg-black/50 text-center py-2">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Unavailable for Selected Dates
                    </span>
                </div>
            @else
                <div class="absolute top-4 right-4">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Available
                    </span>
                </div>
            @endif
        @endif

        <div class="absolute bottom-4 left-4">
            <p class="text-white text-lg">{{ $room->room_number }}</p>
        </div>
    </div>

    <div class="p-6">
        <h3 class="text-xl text-white mb-2">{{ $room->type }}</h3>
        <p class="text-gray-400 mb-4 line-clamp-2">{{ $room->description }}</p>
        <div class="flex justify-between items-center">
            <p class="text-green-400 text-lg">Rs. {{ number_format($room->price, 2) }}/night</p>
            @if(request('check_in') && request('check_out'))
                @if(!$room->is_available_for_dates)
                    <button 
                        class="bg-gray-500 text-white px-4 py-2 rounded cursor-not-allowed"
                        disabled
                    >
                        Not Available
                    </button>
                @else
                    <a 
                        href="{{ route('rooms.show', $room) }}?check_in={{ request('check_in') }}&check_out={{ request('check_out') }}&adults={{ request('adults', 1) }}&children={{ request('children', 0) }}" 
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors"
                    >
                        Book Now
                    </a>
                @endif
            @else
                <a 
                    href="{{ route('rooms.show', $room) }}" 
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors"
                >
                    View Details
                </a>
            @endif
        </div>
    </div>

    @auth
        @if(auth()->user()->is_admin)
            <div class="p-4 bg-gray-800 border-t border-gray-700">
                <!-- Admin controls remain the same -->
            </div>
        @endif
    @endauth
</div>
                
                
                @endforeach
            </div>
        </div>





        <!-- A/C Rooms with Balcony -->
        <div class="mb-20">
            <h2 class="text-3xl text-white mb-8 font-light">A/C Rooms with Balcony</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($rooms->where('category', 'ac-balcony') as $room)
                
                
                <div class="bg-gray-900 rounded-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
    <div class="relative">
        <img 
            src="{{ $room->image ? asset('storage/' . $room->image) : '/api/placeholder/400/300' }}" 
            alt="{{ $room->type }} {{ $room->room_number }}"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        
        @if(request('check_in') && request('check_out'))
            @if(!$room->is_available_for_dates)
                <div class="absolute top-0 left-0 w-full bg-black/50 text-center py-2">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Unavailable for Selected Dates
                    </span>
                </div>
            @else
                <div class="absolute top-4 right-4">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Available
                    </span>
                </div>
            @endif
        @endif

        <div class="absolute bottom-4 left-4">
            <p class="text-white text-lg">{{ $room->room_number }}</p>
        </div>
    </div>

    <div class="p-6">
        <h3 class="text-xl text-white mb-2">{{ $room->type }}</h3>
        <p class="text-gray-400 mb-4 line-clamp-2">{{ $room->description }}</p>
        <div class="flex justify-between items-center">
            <p class="text-green-400 text-lg">Rs. {{ number_format($room->price, 2) }}/night</p>
            @if(request('check_in') && request('check_out'))
                @if(!$room->is_available_for_dates)
                    <button 
                        class="bg-gray-500 text-white px-4 py-2 rounded cursor-not-allowed"
                        disabled
                    >
                        Not Available
                    </button>
                @else
                    <a 
                        href="{{ route('rooms.show', $room) }}?check_in={{ request('check_in') }}&check_out={{ request('check_out') }}&adults={{ request('adults', 1) }}&children={{ request('children', 0) }}" 
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors"
                    >
                        Book Now
                    </a>
                @endif
            @else
                <a 
                    href="{{ route('rooms.show', $room) }}" 
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors"
                >
                    View Details
                </a>
            @endif
        </div>
    </div>

    @auth
        @if(auth()->user()->is_admin)
            <div class="p-4 bg-gray-800 border-t border-gray-700">
                <!-- Admin controls remain the same -->
            </div>
        @endif
    @endauth
</div>
                
                
                @endforeach
            </div>
        </div>

        <!-- Couple Cottages -->
        <div class="mb-20">
            <h2 class="text-3xl text-white mb-8 font-light">Couple Cottages</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($rooms->where('category', 'couple') as $room)
                
                <div class="bg-gray-900 rounded-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
    <div class="relative">
        <img 
            src="{{ $room->image ? asset('storage/' . $room->image) : '/api/placeholder/400/300' }}" 
            alt="{{ $room->type }} {{ $room->room_number }}"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        
        @if(request('check_in') && request('check_out'))
            @if(!$room->is_available_for_dates)
                <div class="absolute top-0 left-0 w-full bg-black/50 text-center py-2">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Unavailable for Selected Dates
                    </span>
                </div>
            @else
                <div class="absolute top-4 right-4">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Available
                    </span>
                </div>
            @endif
        @endif

        <div class="absolute bottom-4 left-4">
            <p class="text-white text-lg">{{ $room->room_number }}</p>
        </div>
    </div>

    <div class="p-6">
        <h3 class="text-xl text-white mb-2">{{ $room->type }}</h3>
        <p class="text-gray-400 mb-4 line-clamp-2">{{ $room->description }}</p>
        <div class="flex justify-between items-center">
            <p class="text-green-400 text-lg">Rs. {{ number_format($room->price, 2) }}/night</p>
            @if(request('check_in') && request('check_out'))
                @if(!$room->is_available_for_dates)
                    <button 
                        class="bg-gray-500 text-white px-4 py-2 rounded cursor-not-allowed"
                        disabled
                    >
                        Not Available
                    </button>
                @else
                    <a 
                        href="{{ route('rooms.show', $room) }}?check_in={{ request('check_in') }}&check_out={{ request('check_out') }}&adults={{ request('adults', 1) }}&children={{ request('children', 0) }}" 
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors"
                    >
                        Book Now
                    </a>
                @endif
            @else
                <a 
                    href="{{ route('rooms.show', $room) }}" 
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors"
                >
                    View Details
                </a>
            @endif
        </div>
    </div>

    @auth
        @if(auth()->user()->is_admin)
            <div class="p-4 bg-gray-800 border-t border-gray-700">
                <!-- Admin controls remain the same -->
            </div>
        @endif
    @endauth
</div>
            
            
            
            @endforeach
            </div>
        </div>

        <!-- Family Cottages -->
        <div class="mb-20">
            <h2 class="text-3xl text-white mb-8 font-light">Family Cottages</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($rooms->where('category', 'family-cottage') as $room)
                
                
                
                <div class="bg-gray-900 rounded-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
    <div class="relative">
        <img 
            src="{{ $room->image ? asset('storage/' . $room->image) : '/api/placeholder/400/300' }}" 
            alt="{{ $room->type }} {{ $room->room_number }}"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        
        @if(request('check_in') && request('check_out'))
            @if(!$room->is_available_for_dates)
                <div class="absolute top-0 left-0 w-full bg-black/50 text-center py-2">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Unavailable for Selected Dates
                    </span>
                </div>
            @else
                <div class="absolute top-4 right-4">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Available
                    </span>
                </div>
            @endif
        @endif

        <div class="absolute bottom-4 left-4">
            <p class="text-white text-lg">{{ $room->room_number }}</p>
        </div>
    </div>

    <div class="p-6">
        <h3 class="text-xl text-white mb-2">{{ $room->type }}</h3>
        <p class="text-gray-400 mb-4 line-clamp-2">{{ $room->description }}</p>
        <div class="flex justify-between items-center">
            <p class="text-green-400 text-lg">Rs. {{ number_format($room->price, 2) }}/night</p>
            @if(request('check_in') && request('check_out'))
                @if(!$room->is_available_for_dates)
                    <button 
                        class="bg-gray-500 text-white px-4 py-2 rounded cursor-not-allowed"
                        disabled
                    >
                        Not Available
                    </button>
                @else
                    <a 
                        href="{{ route('rooms.show', $room) }}?check_in={{ request('check_in') }}&check_out={{ request('check_out') }}&adults={{ request('adults', 1) }}&children={{ request('children', 0) }}" 
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors"
                    >
                        Book Now
                    </a>
                @endif
            @else
                <a 
                    href="{{ route('rooms.show', $room) }}" 
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors"
                >
                    View Details
                </a>
            @endif
        </div>
    </div>

    @auth
        @if(auth()->user()->is_admin)
            <div class="p-4 bg-gray-800 border-t border-gray-700">
                <!-- Admin controls remain the same -->
            </div>
        @endif
    @endauth
</div>
               
               
               
                @endforeach
            </div>
        </div>

        <!-- Family A/C Rooms -->
        <div class="mb-20">
            <h2 class="text-3xl text-white mb-8 font-light">Family A/C Rooms</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($rooms->where('category', 'family-ac') as $room)
                
                
                <div class="bg-gray-900 rounded-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
    <div class="relative">
        <img 
            src="{{ $room->image ? asset('storage/' . $room->image) : '/api/placeholder/400/300' }}" 
            alt="{{ $room->type }} {{ $room->room_number }}"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        
        @if(request('check_in') && request('check_out'))
            @if(!$room->is_available_for_dates)
                <div class="absolute top-0 left-0 w-full bg-black/50 text-center py-2">
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Unavailable for Selected Dates
                    </span>
                </div>
            @else
                <div class="absolute top-4 right-4">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Available
                    </span>
                </div>
            @endif
        @endif

        <div class="absolute bottom-4 left-4">
            <p class="text-white text-lg">{{ $room->room_number }}</p>
        </div>
    </div>

    <div class="p-6">
        <h3 class="text-xl text-white mb-2">{{ $room->type }}</h3>
        <p class="text-gray-400 mb-4 line-clamp-2">{{ $room->description }}</p>
        <div class="flex justify-between items-center">
            <p class="text-green-400 text-lg">Rs. {{ number_format($room->price, 2) }}/night</p>
            @if(request('check_in') && request('check_out'))
                @if(!$room->is_available_for_dates)
                    <button 
                        class="bg-gray-500 text-white px-4 py-2 rounded cursor-not-allowed"
                        disabled
                    >
                        Not Available
                    </button>
                @else
                    <a 
                        href="{{ route('rooms.show', $room) }}?check_in={{ request('check_in') }}&check_out={{ request('check_out') }}&adults={{ request('adults', 1) }}&children={{ request('children', 0) }}" 
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors"
                    >
                        Book Now
                    </a>
                @endif
            @else
                <a 
                    href="{{ route('rooms.show', $room) }}" 
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors"
                >
                    View Details
                </a>
            @endif
        </div>
    </div>

    @auth
        @if(auth()->user()->is_admin)
            <div class="p-4 bg-gray-800 border-t border-gray-700">
                <!-- Admin controls remain the same -->
            </div>
        @endif
    @endauth
</div>
               
               
               
                @endforeach
            </div>
        </div>
    </div>

    <!-- Amenities Section -->
    <div class="bg-gray-900 py-24">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl text-white mb-12 text-center font-light">Room Amenities</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Air Conditioning -->
                <div class="text-center">
                    <i class="fas fa-snowflake text-4xl text-green-400 mb-4"></i>
                    <h3 class="text-white text-lg mb-2">Air Conditioning</h3>
                    <p class="text-gray-400">Climate controlled comfort</p>
                </div>

                <!-- WiFi -->
                <div class="text-center">
                    <i class="fas fa-wifi text-4xl text-green-400 mb-4"></i>
                    <h3 class="text-white text-lg mb-2">Free WiFi</h3>
                    <p class="text-gray-400">High-speed internet access</p>
                </div>

                <!-- TV -->
                <div class="text-center">
                    <i class="fas fa-tv text-4xl text-green-400 mb-4"></i>
                    <h3 class="text-white text-lg mb-2">Flat Screen TV</h3>
                    <p class="text-gray-400">Premium entertainment</p>
                </div>

                <!-- Room Service -->
                <div class="text-center">
                    <i class="fas fa-concierge-bell text-4xl text-green-400 mb-4"></i>
                    <h3 class="text-white text-lg mb-2">Room Service</h3>
                    <p class="text-gray-400">24/7 service available</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide success messages
    const successAlert = document.querySelector('.success-alert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.opacity = '0';
            setTimeout(() => {
                successAlert.remove();
            }, 300);
        }, 3000);
    }

    // Confirmation for delete actions
    const deleteButtons = document.querySelectorAll('[data-confirm]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm(this.dataset.confirm || 'Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });

    // Initialize calendar for admin
    @auth
        @if(auth()->user()->is_admin)
            const calendar = flatpickr("#availability-calendar", {
                inline: true,
                mode: "single",
                minDate: "today",
                dateFormat: "Y-m-d",
                theme: "dark",
                onChange: function(selectedDates, dateStr) {
                    updateRoomAvailability(dateStr);
                }
            });
        @endif
    @endauth
});

// Room availability functions
async function updateRoomAvailability(date) {
    const dateDisplay = document.getElementById('selected-date-display');
    const roomList = document.getElementById('room-availability-list');
    
    dateDisplay.textContent = `Room Availability for ${new Date(date).toLocaleDateString()}`;
    roomList.classList.remove('hidden');
    
    // Generate room availability toggles
    const rooms = @json($rooms);
    let html = '';
    
    rooms.forEach(room => {
        const isUnavailable = room.unavailable_dates && room.unavailable_dates.includes(date);
        html += `
            <div class="flex items-center justify-between bg-gray-700 p-4 rounded" data-room-id="${room.id}">
                <div>
                    <h4 class="text-white">${room.room_number} - ${room.type}</h4>
                    <p class="text-sm text-gray-400">Category: ${room.category}</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm ${isUnavailable ? 'text-red-400' : 'text-green-400'}">
                        ${isUnavailable ? 'Unavailable' : 'Available'}
                    </span>
                    <button 
                        onclick="toggleRoomAvailability(${room.id}, '${date}')"
                        class="px-4 py-2 rounded ${isUnavailable ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600'} text-white transition-colors"
                        ${isUnavailable ? 'data-action="make-available"' : 'data-action="make-unavailable"'}
                    >
                        ${isUnavailable ? 'Make Available' : 'Make Unavailable'}
                    </button>
                </div>
            </div>
        `;
    });
    
    roomList.innerHTML = html;
}

async function toggleRoomAvailability(roomId, date) {
    try {
        const button = event.target; // Get clicked button
        const roomDiv = button.closest('.flex.items-center.justify-between'); // Get parent room div
        const statusSpan = roomDiv.querySelector('.text-sm.text-green-400, .text-sm.text-red-400'); // Get status span

        // Disable button during API call
        button.disabled = true;
        
        const response = await fetch(`/rooms/${roomId}/availability`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                date: date,
                action: 'toggle'
            })
        });

        if (!response.ok) throw new Error('Failed to update availability');
        const data = await response.json();

        // Update UI based on new state
        const isUnavailable = data.room.unavailable_dates.includes(date);
        
        // Update status text and color
        statusSpan.textContent = isUnavailable ? 'Unavailable' : 'Available';
        statusSpan.className = `text-sm ${isUnavailable ? 'text-red-400' : 'text-green-400'}`;
        
        // Update button text and color
        button.textContent = isUnavailable ? 'Make Available' : 'Make Unavailable';
        button.className = `px-4 py-2 rounded ${isUnavailable ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600'} text-white transition-colors`;

        // Re-enable button
        button.disabled = false;

    } catch (error) {
        console.error('Error:', error);
        alert('Failed to update room availability');
        button.disabled = false;
    }
}
</script>
@endpush

@endsection