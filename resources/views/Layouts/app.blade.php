<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $defaultTitle = 'Soba Lanka Resort - Luxury Cottages in Kurunegala, Sri Lanka';
        $defaultDescription = 'Soba Lanka Resort - Luxury cottage accommodations, swimming pool, games, and exclusive packages for couples, families, and groups in Melsiripura, Kurunegala, Sri Lanka.';
        $defaultImage = 'https://sobalanka.com/images/pool-bg-min.jpg';
        $siteUrl = config('app.url', 'https://sobalanka.com');
        
        $pageTitle = View::hasSection('title') ? View::yieldContent('title') : $defaultTitle;
        $pageDescription = View::hasSection('meta_description') ? View::yieldContent('meta_description') : $defaultDescription;
        $pageImage = View::hasSection('og_image') ? View::yieldContent('og_image') : $defaultImage;
    @endphp
    
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    
    <!-- Canonical URL for SEO -->
    <link rel="canonical" href="{{ url()->current() }}" />
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta property="og:site_name" content="Soba Lanka Resort">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $pageImage }}">
    
    <!-- WhatsApp specific -->
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    
    <!-- Schema.org Structured Data for Rich Snippets -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Hotel",
        "name": "Soba Lanka Holiday Resort",
        "description": "Luxury cottage accommodations, swimming pool, games, and exclusive packages for couples, families, and groups in Melsiripura, Kurunegala, Sri Lanka.",
        "image": [
            "https://sobalanka.com/images/pool-bg-min.jpg",
            "https://sobalanka.com/images/pool-night.jpg",
            "https://sobalanka.com/images/deluxe-suite-min.jpg"
        ],
        "url": "https://sobalanka.com",
        "telephone": "+94717152955",
        "email": "sobalankahotel@gmail.com",
        "priceRange": "Rs.2,490 - Rs.995,000",
        "currenciesAccepted": "LKR",
        "paymentAccepted": "Cash, Bank Transfer",
        "checkinTime": "15:00",
        "checkoutTime": "10:00",
        "numberOfRooms": "30",
        "starRating": {
            "@type": "Rating",
            "ratingValue": "4"
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Balawattala Road",
            "addressLocality": "Melsiripura",
            "addressRegion": "Kurunegala",
            "postalCode": "60540",
            "addressCountry": "LK"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "7.625504",
            "longitude": "80.506160"
        },
        "hasMap": "https://maps.app.goo.gl/99iFNphobJ9DFyq99",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.2",
            "bestRating": "5",
            "worstRating": "1",
            "reviewCount": "365"
        },
        "amenityFeature": [
            {"@type": "LocationFeatureSpecification", "name": "Swimming Pool", "value": true},
            {"@type": "LocationFeatureSpecification", "name": "Restaurant", "value": true},
            {"@type": "LocationFeatureSpecification", "name": "Free Parking", "value": true},
            {"@type": "LocationFeatureSpecification", "name": "Games Room", "value": true},
            {"@type": "LocationFeatureSpecification", "name": "Banquet Hall", "value": true},
            {"@type": "LocationFeatureSpecification", "name": "Conference Room", "value": true},
            {"@type": "LocationFeatureSpecification", "name": "BBQ Area", "value": true},
            {"@type": "LocationFeatureSpecification", "name": "Wedding Venue", "value": true}
        ],
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            "opens": "08:00",
            "closes": "22:00"
        },
        "sameAs": [
            "https://www.facebook.com/Soba.Lanka.Resort/",
            "https://www.instagram.com/soba.lanka/",
            "https://www.tiktok.com/@sobalanka"
        ]
    }
    </script>

    <!-- FAQPage Schema for Rich Snippets -->
    @hasSection('faq_schema')
        @yield('faq_schema')
    @endif
    
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
            color: #e5e7eb;
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
        
        /* Tailwind 3.x opacity classes (not in CDN 2.2.19) */
        .bg-gray-800\/50 { background-color: rgba(31, 41, 55, 0.5); }
        .bg-gray-900\/50 { background-color: rgba(17, 24, 39, 0.5); }
        .bg-gray-900\/80 { background-color: rgba(17, 24, 39, 0.8); }
        .bg-black\/40 { background-color: rgba(0, 0, 0, 0.4); }
        .bg-black\/50 { background-color: rgba(0, 0, 0, 0.5); }
        .bg-black\/60 { background-color: rgba(0, 0, 0, 0.6); }
        .bg-white\/5 { background-color: rgba(255, 255, 255, 0.05); }
        .bg-white\/10 { background-color: rgba(255, 255, 255, 0.1); }
        .bg-emerald-500\/10 { background-color: rgba(16, 185, 129, 0.1); }
        .bg-emerald-500\/20 { background-color: rgba(16, 185, 129, 0.2); }
        .bg-emerald-900\/20 { background-color: rgba(6, 78, 59, 0.2); }
        .bg-yellow-500\/20 { background-color: rgba(234, 179, 8, 0.2); }
        .bg-yellow-900\/20 { background-color: rgba(113, 63, 18, 0.2); }
        .bg-red-500\/10 { background-color: rgba(239, 68, 68, 0.1); }
        .bg-red-900\/20 { background-color: rgba(127, 29, 29, 0.2); }
        .text-white\/60 { color: rgba(255, 255, 255, 0.6); }
        .text-white\/70 { color: rgba(255, 255, 255, 0.7); }
        .text-white\/80 { color: rgba(255, 255, 255, 0.8); }
        .text-yellow-400\/50 { color: rgba(250, 204, 21, 0.5); }
        .border-emerald-500\/30 { border-color: rgba(16, 185, 129, 0.3); }
        .border-gray-700\/50 { border-color: rgba(55, 65, 81, 0.5); }
        
        /* Emerald colors (not in Tailwind 2.2.19 CDN - uses green instead) */
        .bg-emerald-400 { background-color: #34d399; }
        .bg-emerald-500 { background-color: #10b981; }
        .bg-emerald-600 { background-color: #059669; }
        .bg-emerald-700 { background-color: #047857; }
        .bg-emerald-800 { background-color: #065f46; }
        .bg-emerald-900 { background-color: #064e3b; }
        .text-emerald-400 { color: #34d399; }
        .text-emerald-500 { color: #10b981; }
        .text-emerald-600 { color: #059669; }
        .text-emerald-700 { color: #047857; }
        .border-emerald-400 { border-color: #34d399; }
        .border-emerald-500 { border-color: #10b981; }
        .border-emerald-600 { border-color: #059669; }
        .hover\:bg-emerald-500:hover { background-color: #10b981; }
        .hover\:bg-emerald-600:hover { background-color: #059669; }
        .hover\:bg-emerald-700:hover { background-color: #047857; }
        .hover\:text-emerald-400:hover { color: #34d399; }
        .hover\:text-emerald-500:hover { color: #10b981; }
        .hover\:border-emerald-500:hover { border-color: #10b981; }
        .focus\:border-emerald-500:focus { border-color: #10b981; }
        .focus\:ring-emerald-500:focus { --tw-ring-color: #10b981; }
        
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
        <div class="container mx-auto px-4 relative">
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
                    <a href="{{ route('location') }}" class="nav-link text-white hover:text-emerald-500 transition-colors duration-300">Location</a>
                    
                    @auth
                        <div class="flex items-center gap-4">
                            <span class="text-white">{{ auth()->user()->name }}</span>
                            
                            <a href="{{ route('profile') }}" class="text-white hover:text-emerald-500 transition-colors duration-300 font-medium">My Profile</a>
                            
                            @if(auth()->user()->is_admin)
                                <span class="bg-emerald-500 px-2 py-1 rounded text-sm text-white">Admin</span>
                                <a href="{{ route('admin.bookings.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300 font-bold">Manage Bookings</a>
                                <a href="{{ route('admin.leads.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300 font-bold">Leads CRM</a>
                                
                                <a href="{{ route('admin.users.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300">Manage Users</a>
                                <a href="{{ route('admin.packages.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300">Manage Packages</a>
                                <a href="{{ route('admin.gallery.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300">Manage Galleries</a>
                                <a href="{{ route('admin.custom-packages.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300">Custom Packages</a>
                                <a href="{{ route('admin.menu-categories.index') }}" class="text-white hover:text-emerald-500 transition-colors duration-300">Edit Menu</a>
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

                    <a href="{{ route('package-builder') }}" class="btn-primary text-white px-6 py-2.5 rounded-full flex items-center gap-2 font-medium animate-pulse-glow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        Book Now
                    </a>
                    <a href="tel:+94717152955" class="btn-secondary text-white px-5 py-2.5 rounded-full flex items-center gap-2 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        Call Now
                    </a>
                </div>

                <button class="md:hidden text-white p-2" id="menuButton">
                    <svg id="menuIconOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="menuIconClose" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="md:hidden hidden" id="mobileMenu" style="position: fixed; top: 80px; left: 0; right: 0; background: rgba(0,0,0,0.98); border-top: 1px solid #374151; z-index: 9999;">
                <div class="py-4 px-4 space-y-4 max-h-screen overflow-y-auto">
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
                    <a href="{{ route('location') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300">Location</a>
                    
                    @auth
                        <div class="border-t border-gray-700 pt-4 mt-4">
                            <span class="block text-white mb-2">{{ auth()->user()->name }}</span>
                            
                            <a href="{{ route('profile') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-2 font-medium">My Profile</a>

                            @if(auth()->user()->is_admin)
                                <span class="bg-emerald-500 px-2 py-1 rounded text-sm text-white inline-block mb-2">Admin</span>
                                <a href="{{ route('admin.bookings.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1 font-bold">Manage Bookings</a>
                                <a href="{{ route('admin.leads.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1 font-bold">Leads CRM</a>

                                <a href="{{ route('admin.users.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1">Manage Users</a>
                                <a href="{{ route('admin.packages.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1">Manage Packages</a>
                                <a href="{{ route('admin.gallery.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1">Manage Galleries</a>
                                <a href="{{ route('admin.custom-packages.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1">Custom Packages</a>
                                <a href="{{ route('admin.menu-categories.index') }}" class="block text-white hover:text-emerald-500 transition-colors duration-300 mb-1">Edit Menu</a>
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

                    <a href="{{ route('package-builder') }}" class="block bg-emerald-500 text-white px-4 py-3 rounded-lg hover:bg-emerald-600 transition-colors duration-300 text-center font-bold text-lg animate-pulse-glow">
                        Book Now
                    </a>
                    <a href="tel:+94717152955" class="block bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300 text-center">Call Now</a>
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
            const menuIconOpen = document.getElementById('menuIconOpen');
            const menuIconClose = document.getElementById('menuIconClose');
            
            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    // Toggle icons
                    if (menuIconOpen && menuIconClose) {
                        menuIconOpen.classList.toggle('hidden');
                        menuIconClose.classList.toggle('hidden');
                    }
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

    <!-- Site Footer -->
    <footer class="relative z-10 bg-gray-900 border-t border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Brand Column -->
                <div>
                    <img src="{{ asset('images/logo.png') }}" alt="Soba Lanka Holiday Resort" class="h-20 mb-4">
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Luxury cottage accommodations nestled in 10 acres of beautiful nature in Melsiripura, Kurunegala, Sri Lanka.
                    </p>
                    <div class="flex items-center gap-1 mt-4">
                        <div class="flex text-yellow-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <span class="text-white text-sm font-semibold ml-1">4.2</span>
                        <a href="https://maps.app.goo.gl/3UzGke3yVHaBMU7WA" target="_blank" class="text-gray-400 text-sm hover:text-emerald-400 transition-colors">(365 Google Reviews)</a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-lg">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">About Us</a></li>
                        <li><a href="{{ route('rates') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Rates & Packages</a></li>
                        <li><a href="{{ route('gallery') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Gallery</a></li>
                        <li><a href="{{ route('calendar.index') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Availability Calendar</a></li>
                        <li><a href="{{ route('menu.index') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Restaurant Menu</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Packages -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-lg">Our Packages</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('packages.couple') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Couple Packages</a></li>
                        <li><a href="{{ route('packages.family') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Family Packages</a></li>
                        <li><a href="{{ route('packages.group') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Group Packages</a></li>
                        <li><a href="{{ route('packages.wedding') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Wedding Packages</a></li>
                        <li><a href="{{ route('packages.honeymoon') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Honeymoon Packages</a></li>
                        <li><a href="{{ route('packages.birthday') }}" class="text-gray-400 hover:text-emerald-400 transition-colors text-sm">Birthday Packages</a></li>
                        <li><a href="{{ route('package-builder') }}" class="text-emerald-400 hover:text-emerald-300 transition-colors text-sm font-semibold">Build Custom Package</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-lg">Contact Us</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-400 text-sm">Balawattala Road, Melsiripura, Kurunegala 60540, Sri Lanka</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            <div class="text-gray-400 text-sm">
                                <a href="tel:+94372250308" class="hover:text-emerald-400 transition-colors">037 22 50 308</a> /
                                <a href="tel:+94717152955" class="hover:text-emerald-400 transition-colors">071 71 52 955</a>
                            </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            <a href="mailto:sobalankahotel@gmail.com" class="text-gray-400 text-sm hover:text-emerald-400 transition-colors">sobalankahotel@gmail.com</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-400 text-sm">Open Daily: 8:00 AM - 10:00 PM</span>
                        </li>
                    </ul>
                    <div class="flex gap-3 mt-4">
                        <a href="https://www.facebook.com/Soba.Lanka.Resort/" target="_blank" class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://www.instagram.com/soba.lanka/" target="_blank" class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-500 hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="https://www.tiktok.com/@sobalanka" target="_blank" class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-black hover:text-white transition-all duration-300 border border-gray-700 hover:border-gray-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1v-3.5a6.37 6.37 0 00-.79-.05A6.34 6.34 0 003.15 15.2a6.34 6.34 0 0010.86 4.46V13a8.28 8.28 0 005.58 2.16v-3.44a4.85 4.85 0 01-3.59-1.44V6.69h3.59z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="section-divider my-8"></div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Soba Lanka Holiday Resort (Pvt) Ltd. All rights reserved.</p>
                <div class="flex items-center gap-4 text-gray-500 text-sm">
                    <span>Melsiripura, Kurunegala, Sri Lanka</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Chat Button -->
    <a href="https://wa.me/94717152955?text=I+want+to+book+a+room" 
       target="_blank" 
       class="whatsapp-float">
        <svg viewBox="0 0 32 32" width="32" height="32" fill="white">
            <path d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z"/>
        </svg>
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 24px;
            right: 20px;
            z-index: 9999;
            background-color: #25D366;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            animation: whatsapp-pulse 2s infinite;
        }
        
        .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.6);
        }
        
        @keyframes whatsapp-pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
    </style>
</body>
</html>