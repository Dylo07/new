@extends('layouts.app')

@section('title', $room->type . ' - Room ' . $room->room_number)

@section('content')
<div class="min-h-screen bg-black text-white">
    <!-- Room Header -->
    <div class="relative h-[60vh]">
        <img 
            src="{{ $room->image ? asset('storage/' . $room->image) : '/api/placeholder/1920/800' }}" 
            alt="{{ $room->type }} {{ $room->room_number }}"
            class="w-full h-full object-cover"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="container mx-auto">
                <h1 class="text-4xl font-light mb-2">{{ $room->type }}</h1>
                <p class="text-xl text-gray-300">Room {{ $room->room_number }}</p>
            </div>
        </div>
    </div>

    <!-- Room Details -->
    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column - Room Info -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description -->
                <div>
                    <h2 class="text-2xl font-light mb-4">Room Description</h2>
                    <p class="text-gray-300">{{ $room->description }}</p>
                </div>

                <!-- Amenities -->
                <div>
                    <h2 class="text-2xl font-light mb-4">Room Amenities</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-snowflake text-emerald-400"></i>
                            <span>Air Conditioning</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-wifi text-emerald-400"></i>
                            <span>Free WiFi</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-tv text-emerald-400"></i>
                            <span>Flat Screen TV</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-bed text-emerald-400"></i>
                            <span>King Size Bed</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-shower text-emerald-400"></i>
                            <span>Hot Water</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-concierge-bell text-emerald-400"></i>
                            <span>Room Service</span>
                        </div>
                    </div>
                </div>

                <!-- Policies -->
                <div>
                    <h2 class="text-2xl font-light mb-4">Room Policies</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-300">
                        <div>
                            <h3 class="text-white font-semibold mb-2">Check-in</h3>
                            <p>From 2:00 PM</p>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold mb-2">Check-out</h3>
                            <p>Until 12:00 PM</p>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold mb-2">Cancellation</h3>
                            <p>Free cancellation up to 24 hours before check-in</p>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold mb-2">Additional Guests</h3>
                            <p>Charges may apply for extra guests</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Booking Form -->
            <div>
                <div class="bg-gray-900 p-6 rounded-lg sticky top-8">
                    <h2 class="text-2xl font-light mb-6">Book This Room</h2>
                    
                    <!-- Price Display -->
                    <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-800">
                        <span class="text-gray-300">Price per night</span>
                        <span class="text-3xl text-emerald-400">Rs. {{ number_format($room->price, 2) }}</span>
                    </div>

                    <!-- Booking Form -->
                    @if($room->is_available)
                        <form action="{{ route('bookings.create', $room) }}" method="GET" class="space-y-4">
                            <div>
                                <label class="block text-gray-300 mb-2">Check-in Date</label>
                                <input 
                                    type="date" 
                                    name="check_in"
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full p-3 bg-black rounded text-white border border-gray-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
                                    required
                                >
                            </div>

                            <div>
                                <label class="block text-gray-300 mb-2">Check-out Date</label>
                                <input 
                                    type="date" 
                                    name="check_out"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    class="w-full p-3 bg-black rounded text-white border border-gray-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
                                    required
                                >
                            </div>

                            <div>
                                <label class="block text-gray-300 mb-2">Guests</label>
                                <select 
                                    name="guests" 
                                    class="w-full p-3 bg-black rounded text-white border border-gray-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
                                    required
                                >
                                    @for($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}">{{ $i }} {{ Str::plural('Guest', $i) }}</option>
                    @endfor
                    </select>
                </div>

                <button 
                    type="submit"
                    class="w-full bg-emerald-500 text-white py-3 px-4 rounded hover:bg-emerald-600 transition-colors duration-300"
                >
                    Book Now
                </button>
            </form>
        @else
            <div class="bg-red-500/20 text-red-400 p-4 rounded text-center">
                This room is currently unavailable
            </div>
        @endif

        <!-- Contact Support -->
        <div class="mt-6 pt-6 border-t border-gray-800">
            <p class="text-gray-400 text-sm text-center mb-4">Need help with your booking?</p>
            <a 
                href="https://wa.me/94717152555"
                class="flex items-center justify-center gap-2 text-white bg-gray-800 py-3 px-4 rounded hover:bg-gray-700 transition-colors duration-300"
            >
                <i class="fab fa-whatsapp"></i>
                Contact Support
            </a>
        </div>
    </div>
</div>
        </div>
    </div>

    <!-- Similar Rooms -->
    <div class="bg-gray-900">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-2xl font-light mb-8">Similar Rooms</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($rooms->where('category', $room->category)->where('id', '!=', $room->id)->take(3) as $similarRoom)
                    <div class="bg-black rounded-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
                        <div class="relative">
                            <img 
                                src="{{ $similarRoom->image ? asset('storage/' . $similarRoom->image) : '/api/placeholder/400/300' }}" 
                                alt="{{ $similarRoom->type }} {{ $similarRoom->room_number }}"
                                class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4">
                                <p class="text-white text-lg">Room {{ $similarRoom->room_number }}</p>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl text-white mb-2">{{ $similarRoom->type }}</h3>
                            <div class="flex justify-between items-center">
                                <p class="text-emerald-400 text-lg">Rs. {{ number_format($similarRoom->price, 2) }}/night</p>
                                <a 
                                    href="{{ route('rooms.show', $similarRoom) }}" 
                                    class="bg-emerald-500 text-white px-4 py-2 rounded hover:bg-emerald-600 transition-colors"
                                >
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the check-in and check-out date inputs
    const checkInInput = document.querySelector('input[name="check_in"]');
    const checkOutInput = document.querySelector('input[name="check_out"]');

    // Add event listener to check-in date
    if (checkInInput && checkOutInput) {
        checkInInput.addEventListener('change', function() {
            // Get the selected check-in date
            const checkInDate = new Date(this.value);
            
            // Set minimum check-out date to be the day after check-in
            const minCheckOutDate = new Date(checkInDate);
            minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
            
            // Format the date to YYYY-MM-DD
            const formattedDate = minCheckOutDate.toISOString().split('T')[0];
            
            // Set the min attribute and clear the check-out date if it's before the new minimum
            checkOutInput.min = formattedDate;
            if (checkOutInput.value && checkOutInput.value <= this.value) {
                checkOutInput.value = formattedDate;
            }
        });
    }
});
</script>
@endpush

@endsection