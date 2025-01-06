@extends('layouts.app')

@section('title', 'Rates & Packages')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-4">Our Rates & Packages</h1>
        <p class="text-xl text-gray-600">Choose the perfect accommodation for your stay</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($packages as $package)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <div class="relative">
                <img 
                    src="{{ asset($package['image']) }}" 
                    alt="{{ $package['name'] }}" 
                    class="w-full h-48 object-cover"
                >
                <div class="absolute top-0 right-0 bg-green-500 text-white px-4 py-2 rounded-bl-lg">
                    ${{ $package['price'] }}/night
                </div>
            </div>
            
            <div class="p-6">
                <h3 class="text-2xl font-bold mb-2">{{ $package['name'] }}</h3>
                <p class="text-gray-600 mb-4">{{ $package['description'] }}</p>
                
                <div class="mb-6">
                    <h4 class="font-semibold mb-2">Features:</h4>
                    <ul class="space-y-2">
                        @foreach($package['features'] as $feature)
                        <li class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <button onclick="window.location.href='{{ route('home') }}#booking'" 
                        class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors duration-300">
                    Book Now
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-12 bg-gray-100 rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-4">Special Offers</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-2">Early Bird Discount</h3>
                <p class="text-gray-600">Book 30 days in advance and get 15% off</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-2">Extended Stay</h3>
                <p class="text-gray-600">Stay 7 nights or more and get 20% off</p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .room-card {
        transition: transform 0.3s ease;
    }
    .room-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
@endsection