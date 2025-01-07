<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        body {
            background-color: #000000;
            min-height: 100vh;
        }
    </style>
</head>
<body>
 <!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="mainNav">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Soba Lanka Holiday Resort" class="h-24">
            </div>
            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-white hover:text-green-400 transition-colors duration-300">Home</a>
                <a href="{{ route('gallery') }}" class="text-white hover:text-green-400 transition-colors duration-300">Gallery</a>
                <a href="{{ route('rates') }}" class="text-white hover:text-green-400 transition-colors duration-300">Rates & Packages</a>
                <a href="{{ route('about') }}" class="text-white hover:text-green-400 transition-colors duration-300">About</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-green-400 transition-colors duration-300">Contact</a>
                <a href="tel:+94717152555" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                    Call Now
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white" id="menuButton">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden" id="mobileMenu">
            <div class="py-4 space-y-4">
                <a href="{{ route('home') }}" class="block text-white hover:text-green-400 transition-colors duration-300">Home</a>
                <a href="{{ route('gallery') }}" class="block text-white hover:text-green-400 transition-colors duration-300">Gallery</a>
                <a href="{{ route('rates') }}" class="block text-white hover:text-green-400 transition-colors duration-300">Rates & Packages</a>
                <a href="{{ route('about') }}" class="block text-white hover:text-green-400 transition-colors duration-300">About</a>
                <a href="{{ route('contact') }}" class="block text-white hover:text-green-400 transition-colors duration-300">Contact</a>
                <a href="tel:+94717152555" class="block bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300 text-center">Call Now</a>
            </div>
        </div>
    </div>
</nav>

    <!-- Content -->
    @yield('content')

    @stack('scripts')
</body>
</html>