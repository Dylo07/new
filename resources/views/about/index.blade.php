@extends('layouts.app')

@section('title', 'About Us')

@section('meta_description', 'Learn about Soba Lanka Resort - a luxury resort in Melsiripura, Kurunegala offering cottage accommodations, swimming pool, games and exclusive packages for unforgettable experiences in Sri Lanka.')

@section('content')
<!-- Main Content Container with proper z-index -->
<div class="relative z-0 pt-20">
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative" style="background-image: url('{{ asset('images/about-bg.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-24 relative">
            <h1 class="text-center text-5xl mb-4 opacity-0 animate-fade-in-up"><span class="gradient-text">ABOUT US</span></h1>
            <p class="text-center text-white text-xl">
                Welcome to our luxurious hotel, where comfort meets elegance. With years of expertise in hospitality, 
                we strive to provide our guests with unforgettable experiences.
            </p>
            <!-- Mission -->
            <div>
                <h2 class="text-2xl text-white mb-8">Our Mission</h2>
                <div class="bg-[#1a1f2d] p-8 rounded border border-gray-800">
                    <p class="text-white">
                        Our mission is to provide exceptional hospitality services that exceed our 
                        guests' expectations while maintaining the highest standards of comfort and luxury.
                    </p>
                </div>
            </div>

            <!-- Vision -->
            <div>
                <h2 class="text-2xl text-white mb-8">Our Vision</h2>
                <div class="bg-[#1a1f2d] p-8 rounded border border-gray-800">
                    <p class="text-white">
                        To be recognized as the leading luxury hotel destination, known for 
                        outstanding service, comfort, and memorable experiences.
                    </p>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div>
            <h2 class="text-2xl text-white mb-8 text-center">Our Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-[#1a1f2d] p-8 rounded border border-gray-800 text-center">
                    <p class="text-white text-xl">Luxurious<br>Accommodations</p>
                </div>

                <div class="bg-[#1a1f2d] p-8 rounded border border-gray-800 text-center">
                    <p class="text-white text-xl">24/7 Room<br>Service</p>
                </div>

                <div class="bg-[#1a1f2d] p-8 rounded border border-gray-800 text-center">
                    <p class="text-white text-xl">Fine Dining<br>Restaurant</p>
                </div>

                <div class="bg-[#1a1f2d] p-8 rounded border border-gray-800 text-center">
                    <p class="text-white text-xl">Spa and<br>Wellness</p>
                </div>

                <div class="bg-[#1a1f2d] p-8 rounded border border-gray-800 text-center">
                    <p class="text-white text-xl">Conference</p>
                </div>

                <div class="bg-[#1a1f2d] p-8 rounded border border-gray-800 text-center">
                    <p class="text-white text-xl">Swimming Pool</p>
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
        <h2 class="text-4xl mb-4"><span class="gradient-text">TALK TO US</span></h2>
        <p class="text-white text-lg mb-8">
            Questions or feedback? Reach out to us. We're here to assist you promptly and courteously.
        </p>
        <a 
            href="{{ route('contact') }}" 
            class="btn-primary text-white px-8 py-4 rounded-xl font-semibold"
        >
            GET IN TOUCH
        </a>
    </div>
</div>
</section>
</div>

@push('styles')
<style>
    body {
        background-color: #000000;
        color: #e5e7eb;
    }

    /* Ensure content stays below fixed navbar */
    .content {
        padding-top: 80px;
    }
</style>
@endpush
@endsection