@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Main Content Container -->
<div class="relative z-0 pt-20">
    <!-- Hero Section with Video -->
    <div class="relative w-full h-96">
        <!-- Video Background -->
        <div class="video-container absolute inset-0 w-full h-full">
            <iframe 
                src="https://www.youtube.com/embed/KKjaD5vsRtY?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&rel=0&playlist=KKjaD5vsRtY" 
                class="absolute inset-0 w-full h-full"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
            ></iframe>
        </div>
        
        <!-- Overlay and Text -->
        <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col justify-center items-center">
            <h1 class="text-green-500 text-5xl mb-4 text-center">GALLERY</h1>
            <p class="text-white text-xl text-center">
                Enjoy and join the handful of guests who already sent their best photographic memories of their stay.
            </p>
        </div>
    </div>
</div>





    <!-- Gallery Section -->
    <div class="bg-black py-24">
        <div class="container mx-auto px-4">
          <!-- Social Media Links -->
<div class="flex justify-center items-center gap-6 mb-16">
    <!-- Facebook -->
    <a href="https://www.facebook.com/Soba.Lanka.Resort/" 
       class="text-white hover:text-[#00bf63] transition-colors duration-300 flex items-center gap-2" 
       target="_blank">
        <i class="fab fa-facebook"></i> Facebook
    </a>
    <!-- Instagram -->
    <a href="https://www.instagram.com/soba.lanka/" 
       class="text-white hover:text-[#00bf63] transition-colors duration-300 flex items-center gap-2" 
       target="_blank">
        <i class="fab fa-instagram"></i> Instagram
    </a>
    <!-- TikTok -->
    <a href="https://www.tiktok.com/@sobalanka" 
       class="text-white hover:text-[#00bf63] transition-colors duration-300 flex items-center gap-2" 
       target="_blank">
        <i class="fab fa-tiktok"></i> TikTok
    </a>
</div>



            <!-- Photo Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                 <!-- Row 1 -->
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-1-min.jpg') }}" 
                alt="Hotel Interior" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-2-min.jpg') }}" 
                alt="Hotel Feature" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-3-min.jpg') }}" 
                alt="Room Detail" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-4-min.jpg') }}" 
                alt="Hotel View" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>

        <!-- Row 2 -->
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-5-min.jpg') }}" 
                alt="Hotel Area" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-6-min.jpg') }}" 
                alt="Hotel Feature" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-7-min.jpg') }}" 
                alt="Night View" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-8-min.jpg') }}" 
                alt="Pool View" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>

         <!-- Row 3 -->
         <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-9-min.jpg') }}" 
                alt="Hotel Area" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-10-min.jpg') }}" 
                alt="Hotel Feature" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-11-min.jpg') }}" 
                alt="Night View" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-12.jpg') }}" 
                alt="Pool View" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
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
        <h2 class="text-green-400 text-4xl mb-4">TALK TO US</h2>
        <p class="text-white text-lg mb-8">
            Questions or feedback? Reach out to us. We're here to assist you promptly and courteously.
        </p>
        <a 
            href="{{ route('contact') }}" 
            class="inline-block bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-600 transition-colors duration-300"
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
    }

    .transition-all {
        transition: all 0.3s ease-in-out;
    }

    /* Smooth hover effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
</style>
@endpush
@endsection