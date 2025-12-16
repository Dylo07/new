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
    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Archivo+Black&family=Outfit:wght@100;200;300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    
    @stack('styles')
    <style>
        /* Base Styles */
        body {
            background-color: #000000;
            min-height: 100vh;
        }
        
        /* Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #111;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #22c55e, #16a34a);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #16a34a, #15803d);
        }
        
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Glassmorphism Classes */
        .glass {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-light {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-card {
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        /* Modern Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }
        
        /* Modern Card Styles */
        .card-modern {
            background: linear-gradient(145deg, rgba(17, 24, 39, 0.9), rgba(31, 41, 55, 0.9));
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-modern:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.3);
        }
        
        /* Modern Input Styles */
        .input-modern {
            background: rgba(31, 41, 55, 0.8);
            border: 2px solid rgba(75, 85, 99, 0.5);
            color: white;
            transition: all 0.3s ease;
        }
        .input-modern:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        .input-modern::placeholder {
            color: rgba(156, 163, 175, 0.8);
        }
        
        /* Gradient Text - Luxury Gold/Emerald Mix */
        .gradient-text {
            background: linear-gradient(135deg, #34d399 0%, #10b981 50%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Glow Effects */
        .glow-emerald {
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
        }
        .glow-emerald-hover:hover {
            box-shadow: 0 0 30px rgba(16, 185, 129, 0.5);
        }
        
        /* Modern Font Classes */
        .font-heavy {
            font-family: 'League Spartan', sans-serif;
        }
        .font-display {
            font-family: 'Outfit', sans-serif;
        }
        .font-elegant {
            font-family: 'Cormorant Garamond', serif;
        }
        .font-modern {
            font-family: 'Montserrat', sans-serif;
        }
        
        /* Animation Classes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.3); }
            50% { box-shadow: 0 0 40px rgba(34, 197, 94, 0.5); }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        
        /* Stagger animations */
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        .stagger-5 { animation-delay: 0.5s; }
        
        /* Navigation Styles */
        .nav-link {
            position: relative;
            padding: 0.5rem 0;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #10b981, #34d399);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Dropdown Animation */
        .dropdown-menu-animated {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            pointer-events: none;
        }
        .dropdown-menu-animated.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
        
        /* Image Hover Effects */
        .img-hover-zoom {
            overflow: hidden;
        }
        .img-hover-zoom img {
            transition: transform 0.5s ease;
        }
        .img-hover-zoom:hover img {
            transform: scale(1.1);
        }
        
        /* Section Divider */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(34, 197, 94, 0.5), transparent);
        }
    </style>
</head>
<body>
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="mainNav">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Soba Lanka Holiday Resort" class="h-24">
                </div>
                
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link text-white hover:text-emerald-400 transition-colors duration-300">Home</a>
                    
                   <div class="relative gallery-dropdown-container">
                        <button class="gallery-dropdown flex items-center text-white hover:text-emerald-500 transition-colors duration-300">
                            Gallery
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div class="gallery-dropdown-menu absolute hidden left-0 mt-0 pt-2 w-48 z-50">
                            <div class="h-2"></div>
                            <div class="bg-black border border-gray-700 rounded-lg shadow-xl overflow-hidden">
                                <a href="{{ route('gallery') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">All Photos</a>
                                <a href="{{ route('gallery.rooms') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">Room Gallery</a>
                                <a href="{{ route('gallery.outdoor') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">Outdoor Gallery</a>
                                <a href="{{ route('gallery.weddings') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">Weddings Gallery</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative packages-dropdown-container">
                        <button class="packages-dropdown flex items-center text-white hover:text-emerald-500 transition-colors duration-300">
                            Packages
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div class="packages-dropdown-menu absolute hidden left-0 mt-0 pt-2 w-48 z-50">
                            <div class="h-2"></div>
                            <div class="bg-black border border-gray-700 rounded-lg shadow-xl overflow-hidden">
                                <a href="{{ route('rates') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">All Packages</a>
                                <a href="{{ route('package-builder') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200"><i class="fas fa-magic mr-2"></i>Create Custom Package</a>
                                <div class="border-t border-gray-700"></div>
                                <a href="{{ route('packages.couple') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">Couple Packages</a>
                                <a href="{{ route('packages.family') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">Family Packages</a>
                                <a href="{{ route('packages.group') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">Group Packages</a>
                                <a href="{{ route('packages.wedding') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">Wedding Packages</a>
                                <a href="{{ route('packages.engagement') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">Engagement Packages</a>
                                <a href="{{ route('packages.birthday') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">Birthday Packages</a>
                                <a href="{{ route('packages.honeymoon') }}" class="block px-4 py-2 text-sm text-white hover:bg-emerald-600 transition-colors duration-200">Honeymoon Packages</a>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('about') }}" class="nav-link text-white hover:text-emerald-500 transition-colors duration-300">About</a>
                    <a href="{{ route('contact') }}" class="nav-link text-white hover:text-emerald-500 transition-colors duration-300">Contact</a>
                    
                    @auth
                        <div class="flex items-center gap-4">
                            <span class="text-white">{{ auth()->user()->name }}</span>
                            
                            <a href="{{ route('profile') }}" class="text-white hover:text-emerald-500 transition-colors duration-300 font-medium">My Profile</a>
                            
                            @if(auth()->user()->is_admin)
                                <span class="bg-emerald-500 px-2 py-1 rounded text-sm text-white">Admin</span>
                                <a href="{{ route('admin.bookings.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300 font-bold">Manage Bookings</a>
                                
                                <a href="{{ route('admin.users.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300">Manage Users</a>
                                <a href="{{ route('admin.packages.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300">Manage Packages</a>
                                <a href="{{ route('admin.gallery.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300">Manage Galleries</a>
                                <a href="{{ route('admin.custom-packages.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300">Custom Packages</a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-white hover:text-emerald-500 transition-colors duration-300">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="text-white hover:text-emerald-500 transition-colors duration-300">Login</a>
                            <a href="{{ route('register') }}" class="btn-primary text-white px-5 py-2 rounded-full font-medium">Register</a>
                        </div>
                    @endauth

                    <a href="tel:+94717152955" class="btn-primary text-white px-6 py-2.5 rounded-full flex items-center gap-2 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        Call Now
                    </a>
                </div>

                <button class="md:hidden text-white" id="menuButton">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <div class="md:hidden hidden" id="mobileMenu">
                <div class="py-4 space-y-4">
                    <a href="{{ route('home') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300">Home</a>
                    
                    <div class="relative">
                        <button id="mobileGalleryDropdown" class="flex items-center justify-between w-full text-white hover:text-emerald-500 transition-colors duration-300">
                            Gallery
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="mobileGalleryLinks" class="hidden pl-4 mt-2 space-y-2 border-l border-gray-700">
                            <a href="{{ route('gallery') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300">All Photos</a>
                            <a href="{{ route('gallery.rooms') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300">Room Gallery</a>
                            <a href="{{ route('gallery.outdoor') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300">Outdoor Gallery</a>
                            <a href="{{ route('gallery.weddings') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300">Weddings Gallery</a>
                        </div>
                    </div>

                    <div class="relative">
                        <button id="mobilePackagesDropdown" class="flex items-center justify-between w-full text-white hover:text-emerald-500 transition-colors duration-300">
                            Packages
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="mobilePackagesLinks" class="hidden pl-4 mt-2 space-y-2 border-l border-gray-700">
                            <a href="{{ route('rates') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300">All Packages</a>
                            <a href="{{ route('package-builder') }}" class="block text-white hover:bg-emerald-600 transition-colors duration-300"><i class="fas fa-magic mr-2"></i>Create Custom Package</a>
                            <div class="border-t border-gray-700 my-2"></div>
                            <a href="{{ route('packages.couple') }}" class="block text-white hover:bg-emerald-600 transition-colors duration-300">Couple Packages</a>
                            <a href="{{ route('packages.family') }}" class="block text-white hover:bg-emerald-600 transition-colors duration-300">Family Packages</a>
                            <a href="{{ route('packages.group') }}" class="block text-white hover:bg-emerald-600 transition-colors duration-300">Group Packages</a>
                            <a href="{{ route('packages.wedding') }}" class="block text-white hover:bg-emerald-600 transition-colors duration-300">Wedding Packages</a>
                            <a href="{{ route('packages.engagement') }}" class="block text-white hover:bg-emerald-600 transition-colors duration-300">Engagement Packages</a>
                            <a href="{{ route('packages.birthday') }}" class="block text-white hover:bg-emerald-600 transition-colors duration-300">Birthday Packages</a>
                            <a href="{{ route('packages.honeymoon') }}" class="block text-white hover:bg-emerald-600 transition-colors duration-300">Honeymoon Packages</a>
                        </div>
                    </div>
                    
                    <a href="{{ route('about') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300">About</a>
                    <a href="{{ route('contact') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300">Contact</a>
                    
                    @auth
                        <div class="border-t border-gray-700 pt-4 mt-4">
                            <span class="block text-white mb-2">{{ auth()->user()->name }}</span>
                            
                            <a href="{{ route('profile') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-2 font-medium">My Profile</a>

                            @if(auth()->user()->is_admin)
                                <span class="bg-emerald-500 px-2 py-1 rounded text-sm text-white inline-block mb-2">Admin</span>
                                <a href="{{ route('admin.bookings.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1 font-bold">Manage Bookings</a>

                                <a href="{{ route('admin.users.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1">Manage Users</a>
                                <a href="{{ route('admin.packages.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1">Manage Packages</a>
                                <a href="{{ route('admin.gallery.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1">Manage Galleries</a>
                                <a href="{{ route('admin.custom-packages.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1">Custom Packages</a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-white hover:text-emerald-500 transition-colors duration-300 text-left mt-2">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="border-t border-gray-700 pt-4 mt-4 space-y-2">
                            <a href="{{ route('login') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300">Login</a>
                            <a href="{{ route('register') }}" class="block bg-emerald-500 text-white px-4 py-2 rounded hover:bg-emerald-600 transition-colors duration-300 text-center">Register</a>
                        </div>
                    @endauth

                    <a href="tel:+94717152955" class="block bg-emerald-500 text-white px-4 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300 text-center">Call Now</a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navigation scroll effect
            const nav = document.getElementById('mainNav');
            const menuButton = document.getElementById('menuButton');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileGalleryDropdown = document.getElementById('mobileGalleryDropdown');
            const mobileGalleryLinks = document.getElementById('mobileGalleryLinks');
            const mobilePackagesDropdown = document.getElementById('mobilePackagesDropdown');
            const mobilePackagesLinks = document.getElementById('mobilePackagesLinks');

            // Scroll effect for navigation
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    nav.classList.add('bg-black', 'backdrop-blur-md');
                } else {
                    nav.classList.remove('bg-black', 'backdrop-blur-md');
                }
            });

            // Mobile menu toggle
            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Mobile gallery dropdown toggle
            if (mobileGalleryDropdown && mobileGalleryLinks) {
                mobileGalleryDropdown.addEventListener('click', function() {
                    mobileGalleryLinks.classList.toggle('hidden');
                    // Rotate arrow
                    const arrow = mobileGalleryDropdown.querySelector('svg');
                    if (arrow) {
                        arrow.classList.toggle('rotate-180');
                    }
                });
            }

            // Mobile packages dropdown toggle
            if (mobilePackagesDropdown && mobilePackagesLinks) {
                mobilePackagesDropdown.addEventListener('click', function() {
                    mobilePackagesLinks.classList.toggle('hidden');
                    // Rotate arrow
                    const arrow = mobilePackagesDropdown.querySelector('svg');
                    if (arrow) {
                        arrow.classList.toggle('rotate-180');
                    }
                });
            }
            
            // Desktop Gallery dropdown elements
            const galleryContainer = document.querySelector('.gallery-dropdown-container');
            const galleryButton = document.querySelector('.gallery-dropdown');
            const galleryMenu = document.querySelector('.gallery-dropdown-menu');
            
            if (galleryContainer && galleryButton && galleryMenu) {
                galleryContainer.addEventListener('mouseenter', function() {
                    galleryMenu.classList.remove('hidden');
                });
                galleryContainer.addEventListener('mouseleave', function() {
                    galleryMenu.classList.add('hidden');
                });
                galleryButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    galleryMenu.classList.toggle('hidden');
                });
            }

            // Desktop Packages dropdown elements
            const packagesContainer = document.querySelector('.packages-dropdown-container');
            const packagesButton = document.querySelector('.packages-dropdown');
            const packagesMenu = document.querySelector('.packages-dropdown-menu');
            
            if (packagesContainer && packagesButton && packagesMenu) {
                packagesContainer.addEventListener('mouseenter', function() {
                    packagesMenu.classList.remove('hidden');
                });
                packagesContainer.addEventListener('mouseleave', function() {
                    packagesMenu.classList.add('hidden');
                });
                packagesButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    packagesMenu.classList.toggle('hidden');
                });
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                if (galleryContainer && !galleryContainer.contains(event.target)) {
                    if (galleryMenu) {
                        galleryMenu.classList.add('hidden');
                    }
                }
                if (packagesContainer && !packagesContainer.contains(event.target)) {
                    if (packagesMenu) {
                        packagesMenu.classList.add('hidden');
                    }
                }
            });
        });
    </script>
</body>
</html>