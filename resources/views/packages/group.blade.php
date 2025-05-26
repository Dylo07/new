{{-- resources/views/packages/group.blade.php --}}
@extends('layouts.app')

@section('title', 'Group Packages')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Main Content Container -->
<div class="relative z-0 pt-20">
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative" style="background-image: url('{{ asset('images/group-bg.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-24 relative">
            <h1 class="text-center text-green-500 text-5xl mb-4">GROUP PACKAGES</h1>
            <p class="text-center text-white text-xl max-w-3xl mx-auto">
                Experience our group packages with cozy cottage accommodations, delicious meals, 
                swimming pool access, and a variety of games, perfect for offices, large families, 
                and groups of more than 10 guests.
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
                                    <div class="w-full h-64 bg-gradient-to-r from-green-500 to-teal-600 flex items-center justify-center">
                                        <i class="fas fa-user-friends text-white text-6xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
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
                                                <i class="fas fa-check text-green-500 mr-2"></i>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <p class="text-gray-400">Starting from</p>
                                        <p class="text-green-500 text-2xl font-bold">Rs.{{ number_format($package->price, 0) }}</p>
                                        @if($package->min_guests)
                                            <p class="text-gray-400 text-sm">Minimum {{ $package->min_guests }} guests</p>
                                        @endif
                                    </div>
                                    <a href="{{ $package->whatsapp_url }}" 
                                       target="_blank"
                                       class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-colors duration-300 flex items-center gap-2">
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
                    <i class="fas fa-user-friends text-green-500 text-6xl mb-4"></i>
                    <h3 class="text-white text-2xl mb-4">No Group Packages Available</h3>
                    <p class="text-gray-400">We're working on creating amazing group packages for you. Please check back soon!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Special Features Section -->
    <div class="bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-white text-3xl mb-12">Perfect for Large Groups</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-green-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Group Accommodation</h3>
                    <p class="text-gray-300">Multiple rooms and cottages for large groups</p>
                </div>
                <div class="text-center">
                    <div class="bg-green-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-fire text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">BBQ & Music</h3>
                    <p class="text-gray-300">Evening BBQ sessions with music entertainment</p>
                </div>
                <div class="text-center">
                    <div class="bg-green-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users-cog text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Team Activities</h3>
                    <p class="text-gray-300">Perfect for corporate events and team building</p>
                </div>
                <div class="text-center">
                    <div class="bg-green-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Group Dining</h3>
                    <p class="text-gray-300">Large dining spaces for group meals</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Group Benefits Section -->
    <div class="bg-black py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-green-400 text-3xl mb-8">Why Choose Us for Group Events?</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="bg-gray-900 p-6 rounded-lg">
                        <h3 class="text-white text-xl mb-3 flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Corporate Events
                        </h3>
                        <p class="text-gray-300">Perfect venue for company outings, team building activities, and corporate retreats with professional event coordination.</p>
                    </div>
                    <div class="bg-gray-900 p-6 rounded-lg">
                        <h3 class="text-white text-xl mb-3 flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Large Family Gatherings
                        </h3>
                        <p class="text-gray-300">Spacious accommodation and dining facilities ideal for extended family reunions and celebrations.</p>
                    </div>
                    <div class="bg-gray-900 p-6 rounded-lg">
                        <h3 class="text-white text-xl mb-3 flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            School Groups
                        </h3>
                        <p class="text-gray-300">Safe and supervised environment for educational trips and school excursions with recreational activities.</p>
                    </div>
                    <div class="bg-gray-900 p-6 rounded-lg">
                        <h3 class="text-white text-xl mb-3 flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Social Clubs
                        </h3>
                        <p class="text-gray-300">Ideal for club outings, society gatherings, and group celebrations with flexible arrangements.</p>
                    </div>
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
                <h2 class="text-green-400 text-4xl mb-4">PLAN YOUR GROUP EVENT</h2>
                <p class="text-white text-lg mb-8">
                    Questions about our group packages? We're here to help you plan the perfect group getaway or corporate event.
                </p>
                <div class="flex justify-center gap-4">
                    <a 
                        href="{{ route('contact') }}" 
                        class="inline-block bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-600 transition-colors duration-300"
                    >
                        GET IN TOUCH
                    </a>
                    <a 
                        href="https://wa.me/94717152955" 
                        target="_blank"
                        class="inline-block bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-600 transition-colors duration-300 flex items-center gap-2"
                    >
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
    body {
        background-color: #000000;
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