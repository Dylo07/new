{{-- resources/views/packages/wedding.blade.php --}}
@extends('layouts.app')

@section('title', 'Wedding Packages')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Main Content Container -->
<div class="relative z-0 pt-20">
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative" style="background-image: url('{{ asset('images/wedding-bg.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-24 relative">
            <h1 class="text-center text-purple-500 text-5xl mb-4">WEDDING PACKAGES</h1>
            <p class="text-center text-white text-xl max-w-3xl mx-auto">
                Experience Unmatched Elegance with Our Luxury Wedding Packages. 
                Celebrate your special day in unparalleled style and sophistication with our 
                exclusive luxury wedding packages.
            </p>
        </div>
    </div>

    <!-- Packages Section -->
    <div class="bg-black py-24">
        <div class="container mx-auto px-4">
            @if($packages->count() > 0)
                @foreach($packages as $package)
                    <div class="bg-gray-900 rounded-xl overflow-hidden shadow-2xl mb-12 hover:transform hover:scale-102 transition-all duration-300">
                        <div class="grid md:grid-cols-2 gap-0">
                            <!-- Image Section -->
                            <div class="relative">
                                @if($package->image_path)
                                    <img src="{{ asset('storage/' . $package->image_path) }}" 
                                         alt="{{ $package->name }}" 
                                         class="w-full h-full object-cover min-h-96">
                                @else
                                    <div class="w-full h-full bg-gradient-to-r from-purple-600 to-pink-600 flex items-center justify-center min-h-96">
                                        <i class="fas fa-rings-wedding text-white text-8xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="bg-purple-500 text-white px-4 py-2 rounded-full text-lg font-bold">
                                        Premium Package
                                    </span>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-8">
                                <div class="border-b border-gray-700 pb-4 mb-6">
                                    <h2 class="text-white text-4xl font-light mb-2">{{ $package->name }}</h2>
                                    @if($package->description)
                                        <p class="text-gray-400">{{ $package->description }}</p>
                                    @endif
                                </div>

                                @if($package->features)
                                    <div class="mb-8">
                                        <h3 class="text-white text-xl mb-4">Package Includes:</h3>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            @foreach($package->features as $feature)
                                                <div class="flex items-center">
                                                    <i class="fas fa-check text-purple-400 mr-3"></i>
                                                    <span class="text-gray-300">{{ $feature }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Pricing Section -->
                                @if($package->pricing_tiers && count($package->pricing_tiers) > 0)
                                    <div class="bg-black/40 p-6 rounded-xl border border-gray-800 mb-6">
                                        <h3 class="text-white text-xl mb-4">Pricing Tiers</h3>
                                        <div class="space-y-3">
                                            @foreach($package->pricing_tiers as $tier)
                                                <div class="flex justify-between items-center border-b border-gray-700 pb-2">
                                                    <span class="text-gray-300">{{ $tier['guests'] }} Guests</span>
                                                    <span class="text-purple-400 font-bold text-lg">Rs.{{ number_format($tier['price'], 0) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-black/40 p-6 rounded-xl border border-gray-800 mb-6">
                                        <div class="text-center">
                                            <p class="text-gray-400 mb-2">Starting from</p>
                                            <p class="text-purple-400 text-3xl font-bold">Rs.{{ number_format($package->price, 0) }}</p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Additional Info -->
                                @if($package->additional_info)
                                    <div class="mb-6">
                                        @foreach($package->additional_info as $key => $value)
                                            <p class="text-gray-400 text-sm mb-1">
                                                <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Contact Buttons -->
                                <div class="flex gap-4">
                                    <a href="{{ $package->whatsapp_url }}" 
                                       target="_blank"
                                       class="flex-1 bg-purple-500 text-white px-6 py-3 rounded-lg hover:bg-purple-600 transition-all duration-300 text-center flex items-center justify-center gap-2">
                                        <i class="fab fa-whatsapp"></i>
                                        Book Now
                                    </a>
                                    <a href="{{ route('contact') }}" 
                                       class="flex-1 border-2 border-purple-500 text-purple-500 px-6 py-3 rounded-lg hover:bg-purple-500 hover:text-white transition-all duration-300 text-center">
                                        Get Quote
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- No Packages Available -->
                <div class="text-center py-16">
                    <i class="fas fa-rings-wedding text-purple-500 text-6xl mb-4"></i>
                    <h3 class="text-white text-2xl mb-4">No Wedding Packages Available</h3>
                    <p class="text-gray-400">We're working on creating amazing wedding packages for you. Please check back soon!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Wedding Features Section -->
    <div class="bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-white text-3xl mb-12">Your Perfect Wedding Venue</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-purple-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Luxury Banquet Hall</h3>
                    <p class="text-gray-300">Elegant banquet hall with modern amenities and beautiful decorations</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-camera text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Photography Locations</h3>
                    <p class="text-gray-300">Beautiful outdoor and indoor locations perfect for wedding photography</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-music text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Entertainment</h3>
                    <p class="text-gray-300">Traditional dancing groups, DJ music, and cultural performances</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Wedding Services Section -->
    <div class="bg-black py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-center text-purple-400 text-3xl mb-12">Complete Wedding Solutions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gray-900 p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-dancing text-purple-500 text-2xl mr-3"></i>
                            <h3 class="text-white text-xl">Cultural Programs</h3>
                        </div>
                        <p class="text-gray-300">Traditional Sri Lankan cultural performances, Jaya Mangala Gatha, and Ashtaka ceremonies.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Special Offer Section -->
    <div class="bg-purple-900/20 py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl p-8">
                    <h2 class="text-white text-3xl mb-4">Special Wedding Discount</h2>
                    <div class="text-white text-6xl font-bold mb-4">25% OFF</div>
                    <p class="text-white text-xl mb-6">Valid till May 2025</p>
                    <p class="text-purple-100 mb-8">Book your dream wedding now and save big on our premium wedding packages!</p>
                    <div class="flex justify-center gap-4">
                        <a href="https://wa.me/94717152955" 
                           target="_blank"
                           class="bg-white text-purple-600 px-8 py-3 rounded-lg hover:bg-gray-100 transition-colors duration-300 font-semibold flex items-center gap-2">
                            <i class="fab fa-whatsapp"></i>
                            Book Now & Save
                        </a>
                        <a href="{{ route('contact') }}" 
                           class="border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white hover:text-purple-600 transition-all duration-300">
                            Get Details
                        </a>
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
                <h2 class="text-purple-400 text-4xl mb-4">PLAN YOUR DREAM WEDDING</h2>
                <p class="text-white text-lg mb-8">
                    Questions about our wedding packages? We're here to help you plan the perfect wedding celebration.
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
    
    .hover\:scale-102:hover {
        transform: scale(1.02);
    }
    
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
</style>
@endpush
@endsection
                        