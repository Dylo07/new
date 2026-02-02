{{-- resources/views/packages/family.blade.php --}}
@extends('layouts.app')

@section('title', 'Family Packages')

@section('meta_description', 'Family packages at Soba Lanka Resort for 2-10 guests. Spacious cottages, swimming pool, games and activities for unforgettable family time in Kurunegala, Sri Lanka.')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Main Content Container -->
<div class="relative z-0 pt-20">
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative" style="background-image: url('{{ asset('images/family-bg.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-24 relative">
            <h1 class="text-center text-5xl mb-4 opacity-0 animate-fade-in-up"><span class="gradient-text">FAMILY PACKAGES</span></h1>
            <p class="text-center text-white text-xl max-w-3xl mx-auto">
                Enjoy our family packages with cozy cottage accommodations, delicious meals, 
                swimming pool access, and a variety of games, perfect for groups of 2 to 10 guests.
            </p>
        </div>
    </div>

    <!-- Packages Section -->
    <div class="bg-black py-24">
        <div class="container mx-auto px-4">
            @if($packages->count() > 0)
                <!-- Package Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($packages as $package)
                        <div class="bg-gray-900 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all duration-300">
                            <div class="relative">
                                @if($package->image_path)
                                    <img src="{{ asset('storage/' . $package->image_path) }}" 
                                         alt="{{ $package->name }}" 
                                         class="w-full h-64 object-cover">
                                @else
                                    <div class="w-full h-64 bg-gradient-to-r from-purple-500 to-blue-600 flex items-center justify-center">
                                        <i class="fas fa-users text-white text-6xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $package->formatted_price }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <h4 class="text-2xl text-white mb-4 font-semibold">{{ $package->name }}</h4>
                                
                                @if($package->description)
                                    <p class="text-gray-300 mb-4">{{ $package->description }}</p>
                                @endif

                                @if($package->features)
                                    <ul class="text-gray-300 mb-6 space-y-2">
                                        @foreach($package->features as $feature)
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-purple-500 mr-2"></i>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <p class="text-gray-400">Starting from</p>
                                        <p class="text-purple-500 text-2xl font-bold">Rs.{{ number_format($package->price, 0) }}</p>
                                        @if($package->min_guests && $package->max_guests)
                                            <p class="text-gray-400 text-sm">{{ $package->min_guests }}-{{ $package->max_guests }} guests</p>
                                        @endif
                                    </div>
                                    <a href="{{ $package->whatsapp_url }}" 
                                       target="_blank"
                                       class="bg-purple-500 text-white px-6 py-3 rounded-lg hover:bg-purple-600 transition-colors duration-300 flex items-center gap-2">
                                        <i class="fab fa-whatsapp"></i>
                                        BOOK NOW
                                    </a>
                                </div>

                                @if($package->location)
                                    <p class="text-gray-400 text-sm">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        Location: {{ $package->location }}
                                    </p>
                                @endif
                                
                                @if($package->duration)
                                    <p class="text-gray-400 text-sm">
                                        <i class="fas fa-clock mr-1"></i>
                                        Duration: {{ $package->duration }}
                                    </p>
                                @endif

                                @if($package->additional_info)
                                    <div class="mt-4 pt-4 border-t border-gray-700">
                                        @foreach($package->additional_info as $key => $value)
                                            <p class="text-gray-400 text-sm">
                                                <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Packages Available -->
                <div class="text-center py-16">
                    <i class="fas fa-users text-purple-500 text-6xl mb-4"></i>
                    <h3 class="text-white text-2xl mb-4">No Family Packages Available</h3>
                    <p class="text-gray-400">We're working on creating amazing family packages for you. Please check back soon!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Special Features Section -->
    <div class="bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-white text-3xl mb-12">Perfect for Family Bonding</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-purple-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bed text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Family Cottages</h3>
                    <p class="text-gray-300">Spacious A/C cottages perfect for families</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-gamepad text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Games & Activities</h3>
                    <p class="text-gray-300">Indoor and outdoor games for all ages</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-swimming-pool text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Swimming Pool</h3>
                    <p class="text-gray-300">Safe and clean swimming pool for the family</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Family Meals</h3>
                    <p class="text-gray-300">Delicious meals suitable for all family members</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact CTA Section -->
    <section class="relative z-10 bg-black">
        <div class="relative bg-black">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img 
                    src="{{ asset('images/pool-bg-min.jpg') }}" 
                    alt="Swimming Pool" 
                    class="w-full h-full object-cover"
                >
                <div class="absolute inset-0 bg-black bg-opacity-60"></div>
            </div>

            <!-- Content -->
            <div class="relative container mx-auto px-4 py-24 text-center">
                <h2 class="text-purple-400 text-4xl mb-4">PLAN YOUR FAMILY VACATION</h2>
                <p class="text-white text-lg mb-8">
                    Questions about our family packages? We're here to help you plan the perfect family getaway.
                </p>
                <div class="flex justify-center gap-4">
                    <a 
                        href="{{ route('contact') }}" 
                        class="inline-block bg-purple-500 text-white px-8 py-3 rounded-lg hover:bg-purple-600 transition-colors duration-300"
                    >
                        GET IN TOUCH
                    </a>
                    <a 
                        href="https://wa.me/94717152955" 
                        target="_blank"
                        class="inline-block bg-emerald-500 text-white px-8 py-3 rounded-lg hover:bg-emerald-600 transition-colors duration-300 flex items-center gap-2"
                    >
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Sticky Book Online CTA -->
<div class="fixed bottom-0 left-0 right-0 bg-gradient-to-r from-purple-600 to-purple-500 py-3 px-4 z-50 shadow-lg" id="sticky-cta">
    <div class="container mx-auto flex items-center justify-between">
        <div class="text-white">
            <span class="font-semibold text-lg hidden sm:inline">Ready to book your family vacation?</span>
            <span class="font-semibold text-lg sm:hidden">Book now!</span>
        </div>
        <a href="{{ route('package-builder') }}" 
           class="bg-white text-purple-600 px-6 py-2 rounded-lg font-bold hover:bg-gray-100 transition-colors duration-300 flex items-center gap-2 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
            BOOK ONLINE
        </a>
    </div>
</div>

@push('styles')
<style>
    body {
        background-color: #000000;
        color: #e5e7eb;
        padding-bottom: 70px;
    }
    
    .hover\:transform:hover {
        transform: translateY(-5px);
    }
    
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
</style>
@endpush
@endsection