{{-- resources/views/packages/engagement.blade.php --}}
@extends('layouts.app')

@section('title', 'Engagement Packages')

@section('meta_description', 'Romantic engagement packages at Soba Lanka Resort. Celebrate your love story with intimate settings, beautiful decorations and memorable experiences in Kurunegala, Sri Lanka.')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Main Content Container -->
<div class="relative z-0 pt-20">
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative" style="background-image: url('{{ asset('images/engagement-bg.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-24 relative">
            <h1 class="text-center text-5xl mb-4 opacity-0 animate-fade-in-up"><span class="gradient-text">ENGAGEMENT PACKAGES</span></h1>
            <p class="text-center text-white text-xl max-w-3xl mx-auto">
                Celebrate Your Love Story. Mark the beginning of your journey together with our romantic 
                engagement packages featuring intimate settings, beautiful decorations, photography opportunities, 
                and memorable experiences perfect for your special moment.
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
                                    <div class="w-full h-64 bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center">
                                        <i class="fas fa-ring text-white text-6xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="bg-pink-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
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
                                                <i class="fas fa-check text-pink-400 mr-2"></i>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <p class="text-gray-400">Starting from</p>
                                        <p class="text-pink-400 text-2xl font-bold">Rs.{{ number_format($package->price, 0) }}</p>
                                        @if($package->min_guests && $package->max_guests)
                                            <p class="text-gray-400 text-sm">{{ $package->min_guests }}-{{ $package->max_guests }} guests</p>
                                        @endif
                                    </div>
                                    <a href="{{ $package->whatsapp_url }}" 
                                       target="_blank"
                                       class="bg-pink-500 text-white px-6 py-3 rounded-lg hover:bg-pink-600 transition-colors duration-300 flex items-center gap-2">
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
                                            <p class="text-pink-400 text-sm">
                                                <i class="fas fa-info-circle mr-1"></i>
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
                    <i class="fas fa-ring text-pink-400 text-6xl mb-4"></i>
                    <h3 class="text-white text-2xl mb-4">No Engagement Packages Available</h3>
                    <p class="text-gray-400">We're working on creating amazing engagement packages for you. Please check back soon!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Special Features Section -->
    <div class="bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-white text-3xl mb-12">Perfect Engagement Celebration</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-pink-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-camera text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Photography Session</h3>
                    <p class="text-gray-300">Professional photography to capture your special moments and create lasting memories</p>
                </div>
                <div class="text-center">
                    <div class="bg-pink-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Romantic Setup</h3>
                    <p class="text-gray-300">Beautiful decorations, intimate romantic settings, and perfect ambiance for your proposal</p>
                </div>
                <div class="text-center">
                    <div class="bg-pink-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Special Dining</h3>
                    <p class="text-gray-300">Romantic dinner arrangements and champagne celebration for your engagement</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Engagement Benefits Section -->
    <div class="bg-black py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-pink-400 text-3xl mb-8">Why Choose Us for Your Engagement?</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="bg-gray-900 p-6 rounded-lg">
                        <h3 class="text-white text-xl mb-3 flex items-center">
                            <i class="fas fa-check-circle text-pink-400 mr-3"></i>
                            Intimate Settings
                        </h3>
                        <p class="text-gray-300">Private and romantic locations perfect for your proposal moment with beautiful backdrops and serene environments.</p>
                    </div>
                    <div class="bg-gray-900 p-6 rounded-lg">
                        <h3 class="text-white text-xl mb-3 flex items-center">
                            <i class="fas fa-check-circle text-pink-400 mr-3"></i>
                            Custom Decorations
                        </h3>
                        <p class="text-gray-300">Personalized decorations tailored to your love story with flowers, candles, and romantic elements.</p>
                    </div>
                    <div class="bg-gray-900 p-6 rounded-lg">
                        <h3 class="text-white text-xl mb-3 flex items-center">
                            <i class="fas fa-check-circle text-pink-400 mr-3"></i>
                            Professional Support
                        </h3>
                        <p class="text-gray-300">Dedicated event coordinators to ensure everything goes perfectly according to your vision and timeline.</p>
                    </div>
                    <div class="bg-gray-900 p-6 rounded-lg">
                        <h3 class="text-white text-xl mb-3 flex items-center">
                            <i class="fas fa-check-circle text-pink-400 mr-3"></i>
                            Memory Preservation
                        </h3>
                        <p class="text-gray-300">Professional photography and videography services to capture every precious moment of your engagement.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-white text-3xl mb-12">What Our Couples Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-black p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex text-pink-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">"The most magical engagement experience! Everything was perfect, from the romantic setup to the delicious dinner. Highly recommended!"</p>
                    <p class="text-pink-400 font-semibold">- Sarah & Michael</p>
                </div>
                <div class="bg-black p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex text-pink-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">"Professional service and beautiful location. The photography captured our special moment perfectly. Thank you for making our engagement unforgettable!"</p>
                    <p class="text-pink-400 font-semibold">- Jessica & David</p>
                </div>
                <div class="bg-black p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex text-pink-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">"Exceeded all our expectations! The romantic ambiance and attention to detail made our engagement proposal absolutely perfect."</p>
                    <p class="text-pink-400 font-semibold">- Amanda & James</p>
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
                <h2 class="text-pink-400 text-4xl mb-4">PLAN YOUR ENGAGEMENT</h2>
                <p class="text-white text-lg mb-8">
                    Questions about our engagement packages? We're here to help you plan the perfect celebration 
                    and create memories that will last a lifetime.
                </p>
                <div class="flex justify-center gap-4">
                    <a 
                        href="{{ route('contact') }}" 
                        class="inline-block bg-pink-500 text-white px-8 py-3 rounded-lg hover:bg-pink-600 transition-colors duration-300"
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
<div class="fixed bottom-0 left-0 right-0 bg-gradient-to-r from-red-600 to-red-500 py-3 px-4 z-50 shadow-lg" id="sticky-cta">
    <div class="container mx-auto flex items-center justify-between">
        <div class="text-white">
            <span class="font-semibold text-lg hidden sm:inline">Ready to plan your engagement celebration?</span>
            <span class="font-semibold text-lg sm:hidden">Book now!</span>
        </div>
        <a href="{{ route('package-builder') }}" 
           class="bg-white text-red-600 px-6 py-2 rounded-lg font-bold hover:bg-gray-100 transition-colors duration-300 flex items-center gap-2 shadow-md">
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