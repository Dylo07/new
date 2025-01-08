@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Main Content Container with proper z-index -->
<div class="relative z-0 pt-20"> <!-- Added pt-20 to account for fixed navbar height -->
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative"  style="background-image: url('{{ asset('images/contact-bg.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-24 relative">
            <h1 class="text-center text-green-500 text-5xl mb-4">CONTACT US</h1>
            <p class="text-center text-white text-xl">Let us know about questions & comments with us</p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 gap-16">
            <!-- Get In Touch Form -->
            <div>
                <h2 class="text-2xl text-white mb-8">Get In Touch</h2>
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Name" 
                        class="w-full bg-[#1a1f2d] text-white p-3 rounded border border-gray-700 focus:border-green-500"
                        required
                    >
                    
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        class="w-full bg-[#1a1f2d] text-white p-3 rounded border border-gray-700 focus:border-green-500"
                        required
                    >
                    
                    <input 
                        type="text" 
                        name="subject" 
                        placeholder="Subject" 
                        class="w-full bg-[#1a1f2d] text-white p-3 rounded border border-gray-700 focus:border-green-500"
                        required
                    >
                    
                    <textarea 
                        name="message" 
                        placeholder="Message" 
                        rows="5" 
                        class="w-full bg-[#1a1f2d] text-white p-3 rounded border border-gray-700 focus:border-green-500"
                        required
                    ></textarea>

                    <button type="submit" class="w-full bg-green-500 text-white py-3 rounded hover:bg-green-600 transition duration-300">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Talk To Us -->
            <div>
                <h2 class="text-2xl text-white mb-8">Talk To Us</h2>
                
                <!-- Email -->
                <div class="mb-8">
                    <a href="mailto:sobalankahotel@gmail.com" class="text-white hover:text-green-500">
                        sobalankahotel@gmail.com
                    </a>
                </div>

                <!-- Phone -->
                <div class="mb-8">
                    <p class="text-white">PHONE NUMBER:</p>
                    <p class="text-white">037 22 50 308 / 071 71 52 955</p>
                </div>

                <!-- Address -->
                <div class="mb-8">
                    <p class="text-white">ADDRESS:</p>
                    <div class="text-white">
                        <p>Soba Lanka Holiday Resort (pvt) Ltd,</p>
                        <p>Balawattala Road,</p>
                        <p>Melsiripura, Kurunegala</p>
                    </div>
                </div>

                <!-- Social Media Links -->
                <!-- Social Media Links -->
                <div>
    <p class="text-white mb-4">Follow Us:</p>
    <div class="flex space-x-4">
        <a href="https://www.facebook.com/Soba.Lanka.Resort/" class="text-white hover:text-green-500 transition-colors" target="_blank">
            <i class="fab fa-facebook"></i> Facebook
        </a>
        <a href="https://www.instagram.com/soba.lanka/" class="text-white hover:text-green-500 transition-colors" target="_blank">
            <i class="fab fa-instagram"></i> Instagram
        </a>
        <a href="https://www.tiktok.com/@sobalanka" class="text-white hover:text-green-500 transition-colors" target="_blank">
            <i class="fab fa-tiktok"></i> TikTok
        </a>
    </div>
</div>


            </div>
        </div>

        <!-- Map Section -->
        <div class="mt-16">
            <iframe 
                src="https://maps.google.com/maps?q=7.625504,80.506160&z=15&output=embed"
                class="w-full h-[450px]" 
                frameborder="0" 
                style="border:0" 
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
    </div>
    
</div>

@push('styles')
<style>
    body {
        background-color: #000000;
    }

    /* Ensure content stays below fixed navbar */
    .content {
        padding-top: 80px; /* Adjust based on your navbar height */
    }

    input::placeholder,
    textarea::placeholder {
        color: #6B7280;
    }
</style>
@endpush
@endsection