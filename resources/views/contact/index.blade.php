@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Main Content Container with proper z-index -->
<div class="relative z-0 pt-20"> <!-- Added pt-20 to account for fixed navbar height -->
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative"  style="background-image: url('{{ asset('images/contact-bg.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-32 relative">
            <h1 class="text-center text-5xl md:text-6xl mb-4 opacity-0 animate-fade-in-up"><span class="gradient-text">Contact Us</span></h1>
            <p class="text-center text-white/80 text-xl opacity-0 animate-fade-in-up stagger-2">Let us know about questions & comments with us</p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 gap-16">
            <!-- Get In Touch Form -->
            <div class="glass-card rounded-2xl p-8">
                <h2 class="text-2xl text-white mb-8 font-light">Get In Touch</h2>
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Your Name" 
                        class="w-full bg-gray-800 text-white p-4 rounded-xl border border-gray-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all placeholder-gray-400"
                        required
                    >
                    
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Your Email" 
                        class="w-full bg-gray-800 text-white p-4 rounded-xl border border-gray-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all placeholder-gray-400"
                        required
                    >
                    
                    <input 
                        type="text" 
                        name="subject" 
                        placeholder="Subject" 
                        class="w-full bg-gray-800 text-white p-4 rounded-xl border border-gray-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all placeholder-gray-400"
                        required
                    >
                    
                    <textarea 
                        name="message" 
                        placeholder="Your Message" 
                        rows="5" 
                        class="w-full bg-gray-800 text-white p-4 rounded-xl border border-gray-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none placeholder-gray-400"
                        required
                    ></textarea>

                    <button type="submit" class="w-full btn-primary text-white py-4 rounded-xl font-semibold text-lg">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Talk To Us -->
            <div class="glass-card rounded-2xl p-8">
                <h2 class="text-2xl text-white mb-8 font-light">Talk To Us</h2>
                
                <!-- Email -->
                <div class="mb-8 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-envelope text-emerald-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Email Us</p>
                        <a href="mailto:sobalankahotel@gmail.com" class="text-white hover:text-emerald-400 transition-colors text-lg">
                            sobalankahotel@gmail.com
                        </a>
                    </div>
                </div>

                <!-- Phone -->
                <div class="mb-8 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-phone text-emerald-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Call Us</p>
                        <p class="text-white text-lg">037 22 50 308</p>
                        <p class="text-white text-lg">071 71 52 955</p>
                    </div>
                </div>

                <!-- Address -->
                <div class="mb-8 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-map-marker-alt text-emerald-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Visit Us</p>
                        <div class="text-white">
                            <p>Soba Lanka Holiday Resort (pvt) Ltd,</p>
                            <p>Balawattala Road,</p>
                            <p>Melsiripura, Kurunegala</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media Links -->
                <div>
                    <p class="text-gray-400 text-sm mb-4">Follow Us</p>
                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/Soba.Lanka.Resort/" class="w-12 h-12 rounded-xl bg-blue-600/20 flex items-center justify-center text-blue-400 hover:bg-blue-600 hover:text-white transition-all duration-300" target="_blank">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="https://www.instagram.com/soba.lanka/" class="w-12 h-12 rounded-xl bg-pink-600/20 flex items-center justify-center text-pink-400 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-500 hover:text-white transition-all duration-300" target="_blank">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="https://www.tiktok.com/@sobalanka" class="w-12 h-12 rounded-xl bg-gray-700/50 flex items-center justify-center text-white hover:bg-black transition-all duration-300" target="_blank">
                            <i class="fab fa-tiktok text-xl"></i>
                        </a>
                    </div>
                </div>


            </div>
        </div>

        <!-- Map Section -->
        <div class="mt-16 rounded-2xl overflow-hidden shadow-2xl">
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
    .content {
        padding-top: 80px;
    }
    input::placeholder,
    textarea::placeholder {
        color: #6B7280;
    }
</style>
@endpush
@endsection