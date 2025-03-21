<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    
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
                
                <!-- Authentication Links -->
                @auth
                    <div class="flex items-center gap-4">
                        <span class="text-white">{{ auth()->user()->name }}</span>
                        @if(auth()->user()->is_admin)
                            <span class="bg-green-500 px-2 py-1 rounded text-sm text-white">Admin</span>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-white hover:text-green-400 transition-colors duration-300">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-white hover:text-green-400 transition-colors duration-300">Login</a>
                        <a href="{{ route('register') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors duration-300">Register</a>
                    </div>
                @endauth

                <!-- Call Now Button -->
                <a href="tel:+94717152955" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300 flex items-center gap-2">
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
                
                <!-- Mobile Authentication Links -->
                @auth
                    <div class="border-t border-gray-700 pt-4 mt-4">
                        <span class="block text-white mb-2">{{ auth()->user()->name }}</span>
                        @if(auth()->user()->is_admin)
                            <span class="inline-block bg-green-500 px-2 py-1 rounded text-sm text-white mb-2">Admin</span>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-white hover:text-green-400 transition-colors duration-300 text-left">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-gray-700 pt-4 mt-4 space-y-2">
                        <a href="{{ route('login') }}" class="block text-white hover:text-green-400 transition-colors duration-300">Login</a>
                        <a href="{{ route('register') }}" class="block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors duration-300 text-center">Register</a>
                    </div>
                @endauth

                <a href="tel:+94717152555" class="block bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300 text-center">Call Now</a>
            </div>
        </div>
    </div>
</nav>


<!-- This goes in your navigation/dropdown menu for the Gallery section -->
<div class="relative">
    <!-- Gallery Dropdown Button -->
    <button class="flex items-center text-white hover:text-green-500 transition-colors duration-300 group">
        Gallery
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transition-transform duration-300 group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
    
    <!-- Dropdown Menu -->
    <div class="absolute hidden group-hover:block hover:block left-0 mt-2 w-48 bg-black/90 backdrop-blur-sm border border-gray-800 rounded-lg shadow-xl z-50">
        <a href="{{ route('gallery') }}" class="block px-4 py-2 text-sm text-white hover:bg-green-700/30 rounded-t-lg">
            All Photos
        </a>
        <a href="{{ route('gallery.rooms') }}" class="block px-4 py-2 text-sm text-white hover:bg-green-700/30">
            Room Gallery
        </a>
        <a href="{{ route('gallery.outdoor') }}" class="block px-4 py-2 text-sm text-white hover:bg-green-700/30">
            Outdoor Gallery
        </a>
        <a href="{{ route('gallery.weddings') }}" class="block px-4 py-2 text-sm text-white hover:bg-green-700/30 rounded-b-lg">
            Weddings Gallery
        </a>
    </div>
</div>

<!-- For Admin Navigation - Add this to your admin dashboard sidebar -->
@if(Auth::check() && Auth::user()->is_admin)
<div class="py-2">
    <h3 class="text-xs uppercase text-gray-500 font-medium px-4 mb-2">Content Management</h3>
    
    <!-- Gallery Management -->
    <a href="{{ route('admin.gallery.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Manage Galleries
    </a>
    
    <!-- If you want direct links to each gallery section -->
    <div class="pl-12">
        <a href="{{ route('admin.gallery.rooms') }}" class="flex items-center px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">
            Room Gallery
        </a>
        <a href="{{ route('admin.gallery.outdoor') }}" class="flex items-center px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">
            Outdoor Gallery
        </a>
        <a href="{{ route('admin.gallery.weddings') }}" class="flex items-center px-4 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">
            Weddings Gallery
        </a>
    </div>
</div>
@endif


    <!-- Content -->
    @yield('content')

    @stack('scripts')
<script>
    // Navigation scroll effect
    const nav = document.getElementById('mainNav');
    const menuButton = document.getElementById('menuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            nav.classList.add('bg-black', 'backdrop-blur-md');
        } else {
            nav.classList.remove('bg-black', 'backdrop-blur-md');
        }
    });

    // Mobile menu toggle
    menuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
    });
</script>
</body>
</html>