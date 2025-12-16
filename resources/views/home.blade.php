@extends('layouts.app')

@section('title', 'Soba Lanka')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- Hero Section -->
<section class="relative min-h-screen flex flex-col justify-center items-center">
    <!-- Video Background -->
    <div class="video-container fixed top-0 left-0 w-full h-full -z-10">
        <iframe 
            src="https://www.youtube.com/embed/KKjaD5vsRtY?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&rel=0&playlist=KKjaD5vsRtY" 
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 min-w-full min-h-full w-auto h-auto"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
        ></iframe>
        <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
    </div>

    <!-- Main Content -->
    <main class="w-full max-w-7xl mx-auto px-4 pt-20 pb-32">
        <div class="relative">
            <!-- Hero Content -->
            <div class="text-center mb-12 opacity-0 animate-fade-in-up">
                <h1 class="text-4xl md:text-6xl font-heavy text-white mb-6 tracking-tight">
                    <span class="text-emerald-500 uppercase font-extrabold tracking-tight">Soba Lanka</span><br/>
                    <span class="text-2xl md:text-4xl text-white font-modern font-thin tracking-widest uppercase mt-2 block">Holiday Resort</span>
                </h1>
                <h2 class="text-xl md:text-2xl text-white mb-4 font-modern font-light tracking-wider">
                    Opulence Beyond Imagination
                </h2>
                <p class="text-lg md:text-xl text-gray-300 font-modern">
                    Enjoy your most glorious moments with us
                </p>
            </div>




            <!-- Booking Form -->
            <div class="max-w-5xl mx-auto glass p-6 md:p-10 rounded-2xl shadow-2xl opacity-0 animate-fade-in-up stagger-2">
                <div class="text-white text-lg mb-8 text-center font-medium tracking-widest uppercase">Night Stay & Day Out Packages</div>
                
                <form action="{{ route('package-builder') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    
                    <!-- Check-in Date -->
                    <div>
                        <label class="block text-white text-sm mb-2">Check-in *</label>
                        <input 
                            type="date" 
                            name="check_in" 
                            id="check_in"
                            class="w-full p-3.5 rounded-xl input-modern text-white font-medium"
                            required
                            min="{{ date('Y-m-d') }}" 
                            value="{{ old('check_in') }}"
                        >
                    </div>

                    <!-- Check-out Date -->
                    <div>
                        <label class="block text-white text-sm mb-2">Check-out *</label>
                        <input 
                            type="date" 
                            name="check_out" 
                            id="check_out" 
                            class="w-full p-3.5 rounded-xl input-modern text-white font-medium"
                            required
                            min="{{ date('Y-m-d') }}"
                            value="{{ old('check_out') }}"
                        >
                    </div>

                    <!-- Adults Input -->
                    <div>
                        <label class="block text-white text-sm mb-2">Adults *</label>
                        <input 
                            type="number" 
                            name="adults" 
                            min="1"
                            value="{{ old('adults', 2) }}"
                            class="w-full p-3.5 rounded-xl input-modern text-white font-medium"
                            required
                            placeholder="Enter adults"
                        >
                    </div>

                    <!-- Children Input -->
                    <div>
                        <label class="block text-white text-sm mb-2">Children</label>
                        <input 
                            type="number" 
                            name="children" 
                            min="0"
                            value="{{ old('children', 0) }}"
                            class="w-full p-3.5 rounded-xl input-modern text-white font-medium"
                            placeholder="Enter children"
                        >
                    </div>

                    <!-- Search Button -->
                    <div>
                        <label class="block text-white text-sm mb-2 opacity-0 hidden lg:block">Search</label>
                        <button type="submit" 
                                class="w-full btn-primary text-white p-3.5 rounded-xl flex items-center justify-center gap-2 font-semibold text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            Search
                        </button>
                    </div>
                </form>

                <!-- Guest Info Helper Text -->
                <div class="mt-4 text-center text-white/60 text-sm">
                    <span class="inline-flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Children ages 3-12. Under 3 stay free.
                    </span>
                </div>
            </div>


        </div>
    </main>






    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
</section>

<!-- Promotional Section -->
<section class="relative z-10 bg-black animate-on-scroll">
    <div class="container mx-auto px-4 py-24 relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <!-- Left side - Image with overlay -->
            <div class="w-full md:w-1/2 relative overflow-hidden rounded-2xl group">
                <img 
                    src="{{ asset('images/pool-night.jpg') }}" 
                    alt="Luxury Pool at Night" 
                    class="rounded-2xl shadow-2xl w-full h-[600px] object-cover transition-transform duration-700 group-hover:scale-110"
                    loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent rounded-2xl"></div>
            </div>
            
            <!-- Right side - Text -->
            <div class="w-full md:w-1/2 text-white space-y-8">
                <h2 class="text-5xl font-light leading-tight">
                    Discover a hotel that defines
                    <span class="text-emerald-400">a new dimension</span> 
                    of luxury
                </h2>
                <p class="text-3xl text-white/80">Emotional luxury.</p>
                <div class="space-y-4 text-lg text-white/70">
                    <p>Experience unparalleled comfort and elegance in our meticulously designed spaces.</p>
                    <p>Every detail has been carefully curated to ensure your stay exceeds expectations.</p>
                </div>
                <a href="{{ route('about') }}" 
                    class="inline-block border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white hover:text-black transition-all duration-300 group">
                    <span class="inline-flex items-center gap-2">
                        View More
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Room Availability Preview -->
<section class="relative z-10 bg-black">
    <div class="bg-black py-24">
        <div class="container mx-auto px-4">
            <h2 class="text-white text-4xl font-light text-center mb-4">Room Availability</h2>
            <p class="text-gray-300 text-center mb-8">Check our room availability before booking your stay</p>
            
            <!-- Calendar Preview -->
            <div class="max-w-lg mx-auto">
                <h3 class="text-2xl text-white text-center mb-4">{{ $currentMonth->format('F Y') }}</h3>
                
                <div class="grid grid-cols-7 gap-1 text-center mb-2">
                    <div class="text-red-500">S</div>
                    <div class="text-white">M</div>
                    <div class="text-white">T</div>
                    <div class="text-white">W</div>
                    <div class="text-white">T</div>
                    <div class="text-white">F</div>
                    <div class="text-red-500">S</div>
                </div>
                
                <div class="grid grid-cols-7 gap-1">
                    @php
                        $startDay = $currentMonth->copy()->startOfMonth()->dayOfWeek;
                        $daysInMonth = $currentMonth->daysInMonth;
                    @endphp
                    
                    @for ($i = 0; $i < $startDay; $i++)
                        <div></div>
                    @endfor
                    
                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $date = $currentMonth->copy()->startOfMonth()->addDays($day - 1);
                            $dateString = $date->format('Y-m-d');
                            $status = $currentMonthAvailability[$dateString] ?? 'available';
                            
                            $bgClass = 'bg-emerald-500'; // Available
                            if ($status === 'limited') {
                                $bgClass = 'bg-yellow-500';
                            } elseif ($status === 'booked') {
                                $bgClass = 'bg-red-500';
                            }
                        @endphp
                        
                        <div class="{{ $bgClass }} rounded-lg p-2 text-center text-white">
                            {{ $day }}
                        </div>
                    @endfor
                </div>
                
                <!-- Today's Date -->
                <div class="text-center mt-4 text-gray-400 text-sm">
                    Updated: {{ now()->format('F d, Y') }}
                </div>
                
                <div class="flex justify-center mt-8 gap-8">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-emerald-500 rounded-full mr-2"></div>
                        <span class="text-white">Available</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-yellow-500 rounded-full mr-2"></div>
                        <span class="text-white">Limited</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-red-500 rounded-full mr-2"></div>
                        <span class="text-white">Fully Booked</span>
                    </div>
                </div>
                
                <div class="text-center mt-8">
                    <a href="{{ route('calendar.index') }}" class="bg-emerald-500 text-white px-6 py-3 rounded-lg hover:bg-emerald-600 transition-all duration-300">
                        View Full Availability
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Suite Cards Grid -->
<section class="relative z-10 bg-black">
<div class="grid md:grid-cols-3 gap-8">
        <!-- Deluxe Suite -->
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/deluxe-suite-min.jpg') }}" 
                alt="Deluxe Suite" 
                class="w-full h-96 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:bg-opacity-30"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-3xl font-semibold">Deluxe Suite</h3>
        </div>

        <!-- Signature Suite -->
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/signature-suite-min.jpg') }}" 
                alt="Signature Suite" 
                class="w-full h-96 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:bg-opacity-30"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-3xl font-semibold">Signature Suite</h3>
        </div>

        <!-- Luxury Suite -->
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/luxury-suite-min.jpg') }}" 
                alt="Luxury Suite" 
                class="w-full h-96 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:bg-opacity-30"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-3xl font-semibold">Luxury Suite</h3>
        </div>
    </div>
</div>


<!-- Restaurant Section -->
<section class="relative z-10 bg-black">
<div class="container mx-auto px-4 py-24">
    <div class="flex flex-col md:flex-row items-center justify-between gap-12">
        <!-- Left Side - Text Content -->
        <div class="w-full md:w-1/2 space-y-6">
            <p class="text-gray-400 text-lg">Restaurants</p>
            
            <h2 class="text-white text-5xl font-light leading-tight">
                The art of meeting your highest expectations. Life's better at the Garden
            </h2>
            
            <a href="" 
               class="inline-block text-white hover:text-gray-300 transition-colors duration-300 mt-6 border-b-2 border-transparent hover:border-white pb-1">
                View our restaurants
            </a>
        </div>

        <!-- Right Side - Image -->
        <div class="w-full md:w-1/2">
            <img 
                src="{{ asset('images/restaurant-dish-min.jpg') }}" 
                alt="Gourmet Dish" 
                class="rounded-full w-[600px] h-[600px] object-cover shadow-2xl"
            >
        </div>
    </div>



<!-- Facilities Section -->
<section class="relative z-10 bg-black">
<div class="container mx-auto px-4 py-24">
    <!-- Introduction Text -->
    <div class="text-center mb-16 max-w-3xl mx-auto">
        <p class="text-white text-lg leading-relaxed">
            Everything you need to live an unforgettable eco-luxury experience of health and well-being. The art of meeting your highest expectations.
        </p>
    </div>

    <!-- Facilities Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        <!-- Restaurant -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/restaurant-min.jpg') }}" 
                alt="Restaurant" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Restaurant</h3>
        </div>

        <!-- Banquet Hall -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/banquet-hall-min.jpg') }}" 
                alt="Banquet Hall" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Banquet Hall</h3>
        </div>

        <!-- Swimming Pool -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/swimming-pool-min.jpg') }}" 
                alt="Swimming Pool" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Swimming Pool</h3>
        </div>

        <!-- Pub & Bar -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/pub-bar-min.jpg') }}" 
                alt="Pub & Bar" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Pub & Bar</h3>
        </div>

        <!-- Indoor Games -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/indoor-games-min.jpg') }}" 
                alt="Indoor Games" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Indoor Games</h3>
        </div>

        <!-- Outdoor Games -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/outdoor-games-min.jpg') }}" 
                alt="Outdoor Games" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Outdoor Games</h3>
        </div>

        <!-- Environment -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/environment.jpg') }}" 
                alt="Environment" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Environment</h3>
        </div>

        <!-- Rooms & Cottages -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/rooms-cottages-min.jpg') }}" 
                alt="Rooms & Cottages" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Rooms & Cottages</h3>
        </div>
    </div>
</div>
<!-- Optimized Dynamic Photo Gallery Section -->
<section class="relative z-10 bg-black">
<div class="container mx-auto px-4 py-24">
    <!-- Header -->
    <div class="text-center mb-16">
        <span class="text-yellow-400 mb-4 block">Hotel Gallery</span>
        <h2 class="text-white text-4xl font-light mb-12 max-w-3xl mx-auto leading-relaxed">
            Enjoy and join the handful of guests who already sent their best photographic memories of their stay.
        </h2>
        
        <!-- Social Media Links -->
        <div class="flex justify-center items-center gap-6 mb-8">
            <!-- Facebook -->
            <a href="https://www.facebook.com/Soba.Lanka.Resort/" 
               class="text-white hover:text-[#00bf63] transition-colors duration-300 flex items-center gap-2" 
               target="_blank" rel="noopener">
                <i class="fab fa-facebook"></i> Facebook
            </a>
            <!-- Instagram -->
            <a href="https://www.instagram.com/soba.lanka/" 
               class="text-white hover:text-[#00bf63] transition-colors duration-300 flex items-center gap-2" 
               target="_blank" rel="noopener">
                <i class="fab fa-instagram"></i> Instagram
            </a>
            <!-- TikTok -->
            <a href="https://www.tiktok.com/@sobalanka" 
               class="text-white hover:text-[#00bf63] transition-colors duration-300 flex items-center gap-2" 
               target="_blank" rel="noopener">
                <i class="fab fa-tiktok"></i> TikTok
            </a>
        </div>

        <!-- Gallery Category Navigation - Updated with All 12 Categories -->
<div class="flex justify-center items-center gap-4 mb-12 flex-wrap">
    <a href="{{ route('gallery') }}" class="bg-emerald-500 text-white px-6 py-3 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
        View All Gallery
    </a>
    <a href="{{ route('gallery.rooms') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Rooms
    </a>
    <a href="{{ route('gallery.family_cottages') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Family Cottages
    </a>
    <a href="{{ route('gallery.couple_cottages') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Couple Cottages
    </a>
    <a href="{{ route('gallery.family_rooms') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Family Rooms
    </a>
    <a href="{{ route('gallery.outdoor') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Outdoor
    </a>
    <a href="{{ route('gallery.weddings') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Weddings
    </a>
    <a href="{{ route('gallery.conference_hall') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Conference Hall
    </a>
    <a href="{{ route('gallery.events') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Events
    </a>
    <a href="{{ route('gallery.indoor_games') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Indoor Games
    </a>
    <a href="{{ route('gallery.outdoor_games') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Outdoor Games
    </a>
    <a href="{{ route('gallery.swimming_pool') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Swimming Pool
    </a>
    <a href="{{ route('gallery.dining_area') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
        Dining Area
    </a>
</div>

   <!-- Dynamic Photo Sections with Lazy Loading - UPDATED with All 12 Categories -->
@php
    $hasAnyImages = ($roomImages ?? collect())->count() > 0 || 
                   ($familyCottageImages ?? collect())->count() > 0 || 
                   ($coupleCottageImages ?? collect())->count() > 0 || 
                   ($familyRoomImages ?? collect())->count() > 0 || 
                   ($outdoorImages ?? collect())->count() > 0 || 
                   ($weddingImages ?? collect())->count() > 0 ||
                   ($conferenceHallImages ?? collect())->count() > 0 ||
                   ($eventImages ?? collect())->count() > 0 ||
                   ($indoorGameImages ?? collect())->count() > 0 ||
                   ($outdoorGameImages ?? collect())->count() > 0 ||
                   ($swimmingPoolImages ?? collect())->count() > 0 ||
                   ($diningAreaImages ?? collect())->count() > 0;
@endphp

@if($hasAnyImages)
    <!-- Family Cottages Preview -->
    @if(isset($familyCottageImages) && $familyCottageImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Family Cottages</h3>
                <a href="{{ route('gallery.family_cottages') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($familyCottageImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}"
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Couple Cottages Preview -->
    @if(isset($coupleCottageImages) && $coupleCottageImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Couple Cottages</h3>
                <a href="{{ route('gallery.couple_cottages') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($coupleCottageImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Family Rooms Preview -->
    @if(isset($familyRoomImages) && $familyRoomImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Family Rooms</h3>
                <a href="{{ route('gallery.family_rooms') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($familyRoomImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- General Rooms Preview -->
    @if(isset($roomImages) && $roomImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Hotel Rooms</h3>
                <a href="{{ route('gallery.rooms') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($roomImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Outdoor Gallery Preview -->
    @if(isset($outdoorImages) && $outdoorImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Outdoor Spaces</h3>
                <a href="{{ route('gallery.outdoor') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($outdoorImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Wedding Gallery Preview -->
    @if(isset($weddingImages) && $weddingImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Weddings & Events</h3>
                <a href="{{ route('gallery.weddings') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($weddingImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Conference Hall Preview - NEW -->
    @if(isset($conferenceHallImages) && $conferenceHallImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Conference Hall</h3>
                <a href="{{ route('gallery.conference_hall') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($conferenceHallImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Events Preview - NEW -->
    @if(isset($eventImages) && $eventImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Events & Celebrations</h3>
                <a href="{{ route('gallery.events') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($eventImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Indoor Games Preview - NEW -->
    @if(isset($indoorGameImages) && $indoorGameImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Indoor Game Area</h3>
                <a href="{{ route('gallery.indoor_games') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($indoorGameImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Outdoor Games Preview - NEW -->
    @if(isset($outdoorGameImages) && $outdoorGameImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Outdoor Game Area</h3>
                <a href="{{ route('gallery.outdoor_games') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($outdoorGameImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Swimming Pool Preview - NEW -->
    @if(isset($swimmingPoolImages) && $swimmingPoolImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Swimming Pool</h3>
                <a href="{{ route('gallery.swimming_pool') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($swimmingPoolImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Dining Area Preview - NEW -->
    @if(isset($diningAreaImages) && $diningAreaImages->count() > 0)
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-white text-2xl font-bold">Dining Area</h3>
                <a href="{{ route('gallery.dining_area') }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($diningAreaImages->take(8) as $index => $image)
                    <div class="relative group overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            width="300" height="300"
                        >
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@else
    <!-- Fallback when no images are uploaded yet -->
    <div class="text-center py-16">
        <div class="bg-gray-900 rounded-lg p-12 mx-auto max-w-2xl">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-images text-6xl"></i>
            </div>
            <h3 class="text-white text-2xl mb-4">Gallery Coming Soon</h3>
            <p class="text-gray-300 mb-6">
                We're preparing an amazing collection of photos showcasing our beautiful accommodations and facilities. 
                Check back soon to see our stunning gallery!
            </p>
            <a href="{{ route('contact') }}" class="bg-emerald-500 text-white px-6 py-3 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                Contact Us for More Info
            </a>
        </div>
    </div>
@endif
</div>
</section>


<!-- Packages Section -->
<section class="relative z-10 bg-black">
<div class="bg-black py-24">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-16">
            <p class="text-gray-400 mb-4">Exclusive Packages For Our Valued Clients</p>
            <h2 class="text-white text-4xl font-light">Explore Our New Packages for the Perfect Holiday!</h2>
        </div>

        <!-- Couples Section -->
        <div class="mb-16">
            <div class="mb-8">
                <p class="text-gray-400">For Couples</p>
                <h3 class="text-white text-3xl mb-4">Couple Packages</h3>
                <p class="text-gray-300">Indulge in our exclusive couple packages featuring cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games for a perfect getaway</p>
                <a href="#" class="inline-block text-white hover:text-emerald-400 transition-colors duration-300 mt-4">View Details</a>
            </div>

            <!-- Package Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Package Card 1 -->
                <div class="bg-gray-900 rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/packages/17.jpg') }}" alt="Special Couple Package" class="w-full h-55 object-cover">
                        
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl text-white mb-4">SPECIAL COUPLE PACKAGE(HB)</h4>
                        <ul class="text-gray-300 mb-6 space-y-2">
                            <li>• LUXURY COTTAGE</li>
                            <li>• SWIMMING POOL</li>
                            <li>• EVENING SNACK</li>
                            <li>• DINNER</li>
                            <li>• BED TEA</li>
                            <li>• BREAKFAST</li>
                            
                        </ul>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400">ONLY FOR</p>
                                <p class="text-white text-xl font-semibold">Rs.10,000</p>
                            </div>
                            <a href="https://wa.me/94717152955" class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                                BOOK NOW
                            </a>
                        </div>
                        <p class="text-gray-400 text-sm mt-4">Location: Melsiripura, Kurunegala</p>
                        <p class="text-gray-400 text-sm">Check In/out: 3:00 PM to 10:00 Am</p>
                    </div>
                </div>

                <!-- Package Card 2 -->
                <div class="bg-gray-900 rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/packages/16.jpg') }}" alt="Day Out Package" class="w-full h-55 object-cover">
                        
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl text-white mb-4">DAY-OUT COUPLE PACKAGE</h4>
                        <ul class="text-gray-300 mb-6 space-y-2">
                            <li>• LUXURY COTTAGE</li>
                            <li>• SWIMMING POOL</li>
                            <li>• WELCOME DRINK</li>
                            <li>• LUNCH</li>
                            <li>• EVENING SNACK</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400">ONLY FOR</p>
                                <p class="text-white text-xl font-semibold">Rs.7,000</p>
                            </div>
                            <a href="https://wa.me/94717152955" class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                                BOOK NOW
                            </a>
                        </div>
                        <p class="text-gray-400 text-sm mt-4">Location: Melsiripura, Kurunegala</p>
                        <p class="text-gray-400 text-sm">Check In/out: 9:00 AM to 5:00 pm</p>
                    </div>
                </div>

                <!-- Package Card 3 -->
                <div class="bg-gray-900 rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/packages/18.jpg') }}" alt="Special Couple FB Package" class="w-full h-55 object-cover">
                        
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl text-white mb-4">SPECIAL COUPLE PACKAGE(FB)</h4>
                        <ul class="text-gray-300 mb-6 space-y-2">
                            <li>• LUXURY COTTAGE</li>
                            <li>• SWIMMING POOL</li>
                            <li>• WELCOME DRINK</li>
                            <li>• EVENING SNACK</li>
                            <li>• DINNER</li>
                            <li>• BED TEA</li>
                            <li>• BREAKFAST</li>
                            <li>• MORNING SNACK</li>
                            <li>• LUNCH</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400">ONLY FOR</p>
                                <p class="text-white text-xl font-semibold">Rs.12,000</p>
                            </div>
                            <a href="https://wa.me/94717152955" class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                                BOOK NOW
                            </a>
                        </div>
                        <p class="text-gray-400 text-sm mt-4">Location: Melsiripura, Kurunegala</p>
                        <p class="text-gray-400 text-sm">Check In/out: 3:00 PM to 3:00 pm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Family Packages Section -->
<section class="relative z-10 bg-black">
<div class="mb-16">
    <div class="mb-8">
        <p class="text-gray-400">For Families (2 to 10 Guests)</p>
        <h3 class="text-white text-3xl mb-4">Family Packages</h3>
        <p class="text-gray-300">Enjoy our family packages with cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games, perfect for groups of 2 to 10 guests.</p>
        <a href="#" class="inline-block text-white hover:text-emerald-400 transition-colors duration-300 mt-4">View Details</a>
    </div>

    <!-- Package Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Night Stay Package -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="relative">
                <img src="{{ asset('images/packages/family-night.jpg') }}" alt="Family Night Stay Package" class="w-full h-55 object-cover">
                
            </div>
            <div class="p-6">
                <h4 class="text-2xl text-white mb-4">FAMILY NIGHT-STAY(HB)</h4>
                <ul class="text-gray-300 mb-6 space-y-2">
                    <li>• FAMILY COTTAGES (A/C)</li>
                    <li>• SWIMMING POOL ACCESS</li>
                    <li>• WELCOME DRINK</li>
                    <li>• EVENING SNACK</li>
                    <li>• DINNER</li>
                    <li>• BED TEA</li>
                    <li>• BREAKFAST</li>                    
                    <li>• INDOOR GAMES ACCESS (ALL)</li>
                    <li>• OUTDOOR GAMES ACCESS (ALL)</li>
                </ul>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400">ONLY FOR</p>
                        <p class="text-white text-xl font-semibold">Rs.4,500/-</p>
                    </div>
                    <a href="https://wa.me/94717152955" class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                        BOOK NOW
                    </a>
                </div>
                <p class="text-gray-400 text-sm mt-4">Location: Melsiripura, Kurunegala</p>
                <p class="text-gray-400 text-sm">Check In/out: 3:00 PM to 3:00 PM</p>
            </div>
        </div>

        <!-- Day Out Package -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="relative">
                <img src="{{ asset('images/packages/family-day.jpg') }}" alt="Family Day Out Package" class="w-full h-55 object-cover">
                
            </div>
            <div class="p-6">
                <h4 class="text-2xl text-white mb-4">FAMILY DAY-OUT</h4>
                <ul class="text-gray-300 mb-6 space-y-2">
                    <li>• CHANGING ROOM (A/C)</li>
                    <li>• SWIMMING POOL ACCESS</li>
                    <li>• WELCOME DRINK</li>
                    <li>• LUNCH</li>
                    <li>• EVENING SNACK</li>
                    <li>• INDOOR GAMES ACCESS (ALL)</li>
                    <li>• OUTDOOR GAMES ACCESS (ALL)</li>
                </ul>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400">ONLY FOR</p>
                        <p class="text-white text-xl font-semibold">Rs.3,000/-</p>
                    </div>
                    <a href="https://wa.me/94717152955" class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                        BOOK NOW
                    </a>
                </div>
                <p class="text-gray-400 text-sm mt-4">Location: Melsiripura, Kurunegala</p>
                <p class="text-gray-400 text-sm">Check In/out: 9:00 AM to 5:00 PM</p>
            </div>
        </div>

        <!-- Night Stay Package 2 -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="relative">
                <img src="{{ asset('images/packages/family-night-2.jpg') }}" alt="Family Night Stay Package 2" class="w-full h-55 object-cover">
                
            </div>
            <div class="p-6">
                <h4 class="text-2xl text-white mb-4">FAMILY NIGHT-STAY(FB)</h4>
                <ul class="text-gray-300 mb-6 space-y-2">
                    <li>• FAMILY COTTAGES (A/C)</li>
                    <li>• SWIMMING POOL ACCESS</li>
                    <li>• WELCOME DRINK</li>
                    <li>• EVENING SNACK</li>
                    <li>• DINNER</li>
                    <li>• BED TEA</li>
                    <li>• BREAKFAST</li>
                    <li>• LUNCH</li>
                    <li>• INDOOR GAMES ACCESS (ALL)</li>
                    <li>• OUTDOOR GAMES ACCESS (ALL)</li>
                </ul>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400">ONLY FOR</p>
                        <p class="text-white text-xl font-semibold">Rs.5,500/-</p>
                    </div>
                    <a href="https://wa.me/94717152955" class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                        BOOK NOW
                    </a>
                </div>
                <p class="text-gray-400 text-sm mt-4">Location: Melsiripura, Kurunegala</p>
                <p class="text-gray-400 text-sm">Check In/out: 3:00 PM to 10:00 AM</p>
            </div>
        </div>
    </div>
</div>

<!-- Group Packages Section -->
<section class="relative z-10 bg-black">
<div class="mb-16">
    <div class="mb-8">
        <p class="text-gray-400">Suitable for Offices, Large Families, and Groups (10+ Guests)</p>
        <h3 class="text-white text-3xl mb-4">Group Packages</h3>
        <p class="text-gray-300">Experience our group packages with cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games, perfect for groups of more than 10 guests.</p>
        <a href="#" class="inline-block text-white hover:text-emerald-400 transition-colors duration-300 mt-4">View Details</a>
    </div>

    <!-- Package Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Night Stay Package -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="relative">
                <img src="{{ asset('images/packages/group-night.jpg') }}" alt="Group Night Stay Package" class="w-full h-55 object-cover">
                
            </div>
            <div class="p-6">
                <h4 class="text-2xl text-white mb-4">NIGHT-STAY(HB)</h4>
                <ul class="text-gray-300 mb-6 space-y-2">
                    <li>• ACCOMMODATION</li>
                    <li>• WELCOME DRINK</li>
                    <li>• EVENING SNACK</li>
                    <li>• DINNER</li>
                    <li>• BED TEA</li>
                    <li>• BREAKFAST</li>
                    <li>• SWIMMING POOL</li>
                    <li>• INDOOR GAMES</li>
                    <li>• OUTDOOR GAMES</li>
                    <li>• BBQ & MUSIC</li>
                </ul>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400">ONLY FOR</p>
                        <p class="text-white text-xl font-semibold">Rs.3,990</p>
                    </div>
                    <a href="https://wa.me/94717152955" class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                        BOOK NOW
                    </a>
                </div>
            </div>
        </div>

        <!-- Night Stay FB Package -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="relative">
                <img src="{{ asset('images/packages/group-night-fb.jpg') }}" alt="Group Night Stay FB Package" class="w-full h-55 object-cover">
                
            </div>
            <div class="p-6">
                <h4 class="text-2xl text-white mb-4">NIGHT-STAY(FB)</h4>
                <ul class="text-gray-300 mb-6 space-y-2">
                    <li>• ACCOMMODATION</li>
                    <li>• WELCOME DRINK</li>
                    <li>• EVENING SNACK</li>
                    <li>• DINNER</li>
                    <li>• BED TEA</li>
                    <li>• BREAKFAST</li>
                    <li>• LUNCH</li>
                    <li>• SWIMMING POOL</li>
                    <li>• INDOOR GAMES</li>
                    <li>• OUTDOOR GAMES</li>
                    <li>• BBQ & MUSIC</li>
                </ul>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400">ONLY FOR</p>
                        <p class="text-white text-xl font-semibold">Rs.4,790</p>
                    </div>
                    <a href="https://wa.me/94717152955" class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                        BOOK NOW
                    </a>
                </div>
            </div>
        </div>

        <!-- Day Out Package -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="relative">
                <img src="{{ asset('images/packages/Groupday.jpg') }}" alt="Group Day Out Package" class="w-full h-55 object-cover">
                
            </div>
            <div class="p-6">
                <h4 class="text-2xl text-white mb-4">DAY-OUT</h4>
                <ul class="text-gray-300 mb-6 space-y-2">
                    <li>• WELCOME DRINK</li>
                    <li>• LUNCH</li>
                    <li>• EVENING SNACK</li>
                    <li>• SWIMMING POOL</li>
                    <li>• INDOOR GAMES</li>
                    <li>• OUTDOOR GAMES</li>
                    <li>• BBQ & MUSIC</li>
                </ul>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400">ONLY FOR</p>
                        <p class="text-white text-xl font-semibold">Rs.2,490</p>
                    </div>
                    <a href="https://wa.me/94717152955" class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                        BOOK NOW
                    </a>
                </div>
                <p class="text-gray-400 text-sm mt-4">* Minimum of 10 guests required</p>
                <p class="text-gray-400 text-sm">Location: Melsiripura, Kurunegala</p>
            </div>
        </div>
    </div>
</div>

<!-- Wedding Package Section -->
<section class="relative z-10 bg-black py-16">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="mb-16">
            <h3 class="text-white text-3xl mb-4">Wedding Packages</h3>
            <h4 class="text-white text-xl mb-4">Experience Unmatched Elegance with Our Luxury Wedding Packages</h4>
            <p class="text-gray-300 mb-6">Celebrate your special day in unparalleled style and sophistication with our exclusive luxury wedding packages. Our meticulously curated offerings include opulent accommodations, gourmet dining experiences, and access to our stunning swimming pool and other premium amenities.</p>
        </div>

        <!-- Wedding Package Images Grid -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="relative group overflow-hidden rounded-lg">
                <img src="{{ asset('images/packages/wedding1.jpg') }}" alt="Wedding Venue" 
                     class="w-[148px] h-[105px] object-cover transition-transform duration-300 group-hover:scale-110">
            </div>
            <div class="relative group overflow-hidden rounded-lg">
                <img src="{{ asset('images/packages/wedding2.jpg') }}" alt="Wedding Reception" 
                     class="w-[148px] h-[105px] object-cover transition-transform duration-300 group-hover:scale-110">
            </div>
        </div>

        <!-- Wedding Package Card -->
        <div class="bg-gray-900 rounded-xl overflow-hidden shadow-2xl">
            <div class="p-8">
                <div class="grid md:grid-cols-2 gap-12">
                    <!-- Left Column - Package Details -->
                    <div class="space-y-6">
                        <div class="border-b border-emerald-500 pb-4">
                            <h4 class="text-white text-3xl font-light">WEDDING PACKAGE</h4>
                            <p class="text-gray-400 mt-2">All-inclusive luxury wedding experience</p>
                        </div>
                        
                        <ul class="text-gray-300 space-y-3">
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>WEDDING MENU (32 ITEMS)</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>LUXURY BANQUET HALL</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>LED DANCE FLOOR </span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>JAYA MANGALA GATHA</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>TRADITIONAL DANCING GROUP</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>ASHTAKA</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>DJ MUSIC</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>ENTRANCE DECORATIONS</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>OIL LAMP, TABLES & CHAIR DECORATIONS</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>SETTEE AND PORUWA</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>LUXURY HONEYMOON COTTAGE (HB)</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>VIP BAR SERVICE</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>PHOTOGRAPHY LOCATIONS</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-white text-xl">•</span>
                                <span>EVENT COORDINATION</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Right Column - Pricing -->
                    <div class="space-y-8">
                        <!-- Pricing Card -->
                        <div class="bg-black/40 p-8 rounded-xl border border-emerald-500">
                            <h5 class="text-white text-2xl mb-6 font-light">PRICING</h5>
                            <ul class="text-gray-300 space-y-4">
                                <li class="flex justify-between items-center border-b border-emerald-500 pb-3">
                                    <span>50 Pax</span>
                                    <span class="text-white font-semibold">350,000 /-</span>
                                </li>
                                <li class="flex justify-between items-center border-b border-emerald-500 pb-3">
                                    <span>100 Pax</span>
                                    <span class="text-white font-semibold">560,000 /-</span>
                                </li>
                                <li class="flex justify-between items-center border-b border-emerald-500 pb-3">
                                    <span>150 Pax</span>
                                    <span class="text-white font-semibold">480,000 /-</span>
                                </li>
                                <li class="flex justify-between items-center border-b border-emerald-500 pb-3">
                                    <span>200 Pax</span>
                                    <span class="text-white font-semibold">550,000 /-</span>
                                </li>
                                <li class="flex justify-between items-center border-b border-emerald-500 pb-3">
                                    <span>300 Pax</span>
                                    <span class="text-white font-semibold">795,000 /-</span>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span>400 Pax</span>
                                    <span class="text-white font-semibold">995,000 /-</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Special Discount -->
                        <div class="bg-emerald-900/20 p-8 rounded-xl text-center border border-emerald-500/30">
                            <p class="text-emerald-400 mb-2 text-lg">Special Discount</p>
                            <p class="text-white text-6xl font-bold mb-2">25%</p>
                            <p class="text-gray-400">Valid till May 2025</p>
                        </div>

                        <!-- Contact Button -->
                        <div class="text-center">
                            <a href="https://wa.me/94717152955" 
                               class="bg-emerald-500 text-white px-8 py-3 rounded-lg hover:bg-emerald-600 inline-block transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/20">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FAQ Section -->
<section class="relative z-10 bg-black">
<div class="bg-black py-24">
    <div class="container mx-auto px-4">
        <h2 class="text-brown-400 text-3xl mb-12 text-center">Frequently Asked Questions</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- FAQ List -->
            <div class="space-y-4">
                <!-- Question 1 -->
                <div x-data="{ open: true }" class="border-b border-emerald-500">
                    <button 
                        @click="open = !open" 
                        class="flex justify-between items-center w-full py-4 text-left text-white hover:text-brown-400 transition-colors duration-300"
                    >
                        <span>How many people can be accommodated in our hotel ?</span>
                        <span x-show="!open" class="text-2xl">+</span>
                        <span x-show="open" class="text-2xl">-</span>
                    </button>
                    
                    <div x-show="open" class="pb-4 text-gray-300">
                        <p>Our hotel offers accommodation for a maximum of 100 guests.</p>
                        <p>Nestled within a 10-acre area surrounded by beautiful nature, we have a variety of cottages and rooms, totaling over 30 available.</p>
                    </div>
                </div>

                <!-- Question 2 -->
                <div x-data="{ open: false }" class="border-b border-emerald-500">
                    <button 
                        @click="open = !open" 
                        class="flex justify-between items-center w-full py-4 text-left text-white hover:text-brown-400 transition-colors duration-300"
                    >
                        <span>Why should you choose our hotel ?</span>
                        <span x-show="!open" class="text-2xl">+</span>
                        <span x-show="open" class="text-2xl">-</span>
                    </button>
                    
                    <div x-show="open" class="pb-4 text-gray-300">
                        <!-- Add answer content here -->
                        <p>Enjoy a relaxing stay at our hotel, with spacious rooms, modern amenities, and friendly staff. Book now and get the best rates and offers.</p>
                    </div>
                </div>

                <!-- Question 3 -->
                <div x-data="{ open: false }" class="border-b border-emerald-500">
                    <button 
                        @click="open = !open" 
                        class="flex justify-between items-center w-full py-4 text-left text-white hover:text-brown-400 transition-colors duration-300"
                    >
                        <span>What are the amenities accessible in your hotel ?</span>
                        <span x-show="!open" class="text-2xl">+</span>
                        <span x-show="open" class="text-2xl">-</span>
                    </button>
                    
                    <div x-show="open" class="pb-4 text-gray-300">
                        <!-- Add answer content here -->
                        <p>Our hotel offers a variety of facilities to make your stay comfortable and enjoyable. Some of the facilities that are available in our hotel are,

A swimming pool where you can relax and enjoy the sun or swim some laps.
A restaurant and bar where you can savor delicious food and drinks.
A conference room and banquet hall where you can host meetings, events, and parties.
Room service where you can order food and drinks to your room anytime.
A parking garage where you can park your car safely and conveniently.</p>
                    </div>
                </div>

                <!-- Question 4 -->
                <div x-data="{ open: false }" class="border-b border-emerald-500">
                    <button 
                        @click="open = !open" 
                        class="flex justify-between items-center w-full py-4 text-left text-white hover:text-brown-400 transition-colors duration-300"
                    >
                        <span>What packages do we have, exactly?</span>
                        <span x-show="!open" class="text-2xl">+</span>
                        <span x-show="open" class="text-2xl">-</span>
                    </button>
                    
                    <div x-show="open" class="pb-4 text-gray-300">
                        <!-- Add answer content here -->
                        <p>We offer day-out packages, night-out packages, as well as wedding and homecoming packages. To learn more, click here</p>
                    </div>
                </div>

                <!-- Question 5 -->
                <div x-data="{ open: false }" class="border-b border-emerald-500">
                    <button 
                        @click="open = !open" 
                        class="flex justify-between items-center w-full py-4 text-left text-white hover:text-brown-400 transition-colors duration-300"
                    >
                        <span>How to reserve our hotel ?</span>
                        <span x-show="!open" class="text-2xl">+</span>
                        <span x-show="open" class="text-2xl">-</span>
                    </button>
                    
                    <div x-show="open" class="pb-4 text-gray-300">
                        <!-- Add answer content here -->
                        <p>To reserve our hotel, you can either book online through our website or call us directly at +94 37 225 0308. You will need to provide some basic information such as your name, contact details, check-in and check-out dates, number of guests, and preferred room type. You can also choose from various payment options such as credit card, debit card, or cash. You will receive a confirmation email or SMS once your reservation is complete. If you have any questions or special requests, please feel free to contact us anytime. We look forward to welcoming you at our hotel</p>
                    </div>
                </div>
            </div>

            <!-- Image Section -->
            <div class="relative">
                <img 
                    src="{{ asset('images/chef-cooking-min.jpg') }}" 
                    alt="Chef cooking with fire" 
                    class="rounded-lg w-full h-full object-cover"
                >
            </div>
        </div>
    </div>
</div>



<!-- Location Section -->
<section class="relative z-10 bg-black py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Map Section -->
            <div class="w-full h-[400px] rounded-lg overflow-hidden">
            <iframe 
    src="https://maps.google.com/maps?q=7.625504,80.506160&z=15&output=embed"
    width="100%" 
    height="100%" 
    style="border:0;" 
    allowfullscreen=""
    loading="lazy">
</iframe>
            </div>

            <!-- Contact Details -->
            <div class="space-y-8">
                <h2 class="text-3xl text-white">Location</h2>

                <div class="space-y-6">
                    <!-- Address -->
                    <div>
                        <h3 class="text-white text-xl mb-2">Address</h3>
                        <p class="text-white">
                            Soba Lanka Holiday Resort PVT (LTD), Balawattala Road, Melsiripura 60540
                        </p>
                    </div>

                    <!-- Hours -->
                    <div>
                        <h3 class="text-white text-xl mb-2">Hours</h3>
                        <div class="text-white">
                            <p>Open / Close - 8AM to 10PM</p>
                            <p>Open Every Day</p>
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <h3 class="text-white text-xl mb-2">Contact Number</h3>
                        <div class="text-white">
                            <p>037 22 50 308 / 071 71 52 955</p>
                        </div>
                    </div>

                    <!-- Review Section -->
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <span class="text-white text-xl mr-2">4.2</span>
                            <div class="flex text-yellow-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400/50" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                        </div>
                        <a href="https://maps.app.goo.gl/3UzGke3yVHaBMU7WA" target="_blank" class="text-blue-400 hover:text-blue-300">(365)</a>
                    </div>

                    <!-- Directions Button -->
                    <a 
                        href="https://maps.app.goo.gl/99iFNphobJ9DFyq99"
                        target="_blank"
                        class="w-full btn-primary text-white p-3 rounded-lg hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Get Directions
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

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
        <h2 class="text-white text-4xl mb-4">TALK TO US</h2>
        <p class="text-white text-lg mb-8">
            Questions or feedback? Reach out to us. We're here to assist you promptly and courteously.
        </p>
        <a 
            href="{{ route('contact') }}" 
            class="inline-block bg-emerald-500 text-white px-8 py-3 rounded-lg hover:bg-emerald-600 transition-colors duration-300"
        >
            GET IN TOUCH
        </a>
    </div>
</div>
</section>
</main>

@push('styles')
<style>

    
    body {
        background-color: #000000;
        min-height: 100vh;
    }
    

    .group:hover img {
        transform: scale(1.05);
    }

    .font-light {
        font-weight: 300;
    }
    .group:hover img {
        transform: scale(1.1);
    }

    .aspect-square {
        aspect-ratio: 1 / 1;
    }
    
    .font-light {
        font-weight: 300;
    }

    .video-container {
        height: 100vh;
        overflow: hidden;
        pointer-events: none;
        z-index: 0;
    }
    
    .video-container iframe {
        opacity: 0.7;
    }

    /* Improve date input appearance */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        opacity: 0.7;}
        input[type="date"], select {
        background-image: none;
    }

    /* Custom select styling */
    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    /* Mobile optimizations */
    @media (max-width: 768px) {
        input[type="date"], select, button {
            font-size: 16px; /* Prevent zoom on mobile */
            padding: 0.75rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>

    // Navigation scroll effect
    document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.getElementById('menuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    if (menuButton && mobileMenu) {
        menuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });
    }
});


       // Date validation for booking form
const checkIn = document.querySelector('input[name="check_in"]');
const checkOut = document.querySelector('input[name="check_out"]');

if (checkIn && checkOut) {
    checkIn.addEventListener('change', function() {
        // Set the minimum check-out date to be the SAME as check-in date
        checkOut.min = this.value;
        
        // Only reset the value if the current check-out is BEFORE the new check-in
        if(checkOut.value && checkOut.value < this.value) {
            checkOut.value = this.value;
        }
    });
}
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });


        // Lazy loading for images
        const images = document.querySelectorAll('img[data-src]');
        const imageOptions = {
            threshold: 0,
            rootMargin: '0px 0px 50px 0px'
        };

        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('fade-in');
                    observer.unobserve(img);
                }
            });
        }, imageOptions);

        images.forEach(img => imageObserver.observe(img));
// Animate sections on scroll
const animateOnScroll = () => {
            const sections = document.querySelectorAll('.animate-on-scroll');
            sections.forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (sectionTop < windowHeight * 0.75) {
                    section.classList.add('fade-in');
                }
            });
        };

        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll(); // Initial check
    });
</script>
@endpush
@endsection