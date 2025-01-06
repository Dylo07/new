@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

<!-- Video Background -->
<div class="video-container h-screen fixed top-0 left-0 w-full">
    <iframe 
        src="https://www.youtube.com/embed/KKjaD5vsRtY?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&rel=0&playlist=KKjaD5vsRtY" 
        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 min-w-full min-h-full w-auto h-auto"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
    ></iframe>
    <div class="absolute inset-0 bg-black bg-opacity-70"></div>
</div>

<!-- Main Content -->
<main>

<div class="relative">
<!-- Search Section -->
<section class="min-h-screen flex items-center justify-center relative z-10">
   <div class="content container mx-auto px-4">
       <div class="text-center mb-16">
           <h1 class="text-white text-5xl font-bold mb-4">Soba Lanka Holiday Resort</h1>
           <h2 class="text-white text-3xl mb-4">Opulence Beyond Imagination</h2>
           <p class="text-white text-xl">Enjoy your most glorious moments with us</p>
       </div>
       
       <!-- Booking Form -->
       <div class="max-w-4xl mx-auto bg-black bg-opacity-50 p-6 rounded-lg">
       
       <form action="{{ route('search') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            @csrf
            <div class="md:col-span-1">
                <label class="block text-white mb-2">Check-in *</label>
                <input type="date" name="check_in" class="w-full p-2 rounded bg-white" required
                       min="{{ date('Y-m-d') }}" value="{{ old('check_in') }}">
                @error('check_in')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="md:col-span-1">
                <label class="block text-white mb-2">Check-out *</label>
                <input type="date" name="check_out" class="w-full p-2 rounded bg-white" required
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('check_out') }}">
                @error('check_out')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="md:col-span-1">
                <label class="block text-white mb-2">Adults</label>
                <select name="adults" class="w-full p-2 rounded bg-white">
                    @for($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{ old('adults') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="md:col-span-1">
                <label class="block text-white mb-2">Children</label>
                <select name="children" class="w-full p-2 rounded bg-white">
                    @for($i = 0; $i <= 3; $i++)
                        <option value="{{ $i }}" {{ old('children') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="md:col-span-1">
                <label class="block text-white mb-2">&nbsp;</label>
                <button type="submit" class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">
                    Search
                </button>
            </div>
        </form>
    </div>
</div>
</section>
<!-- Promotional Section -->
<section class="relative z-10 bg-black">


<div class="container mx-auto px-4 py-24 relative z-10">
   <div class="flex flex-col md:flex-row items-center gap-12">
       <!-- Left side - Image -->
       <div class="w-full md:w-1/2">
           <img 
               src="{{ asset('images/pool-night.jpg') }}" 
               alt="Luxury Pool at Night" 
               class="rounded-lg shadow-2xl w-full h-auto"
           >
       </div>
       <!-- Right side - Text -->
       <div class="w-full md:w-1/2 text-white">
           <h2 class="text-5xl font-bold leading-tight mb-6">
               Discover a hotel that defines a new dimension of luxury.
           </h2>
           <p class="text-3xl mb-8">Emotional luxury.</p>
           <a href="{{ route('about') }}" 
               class="inline-block border-2 border-white text-white px-8 py-3 hover:bg-white hover:text-black transition-300">
               View More
           </a>
           
       </div>
       
   </div>
  
</div>





<!-- Suite Cards Grid -->
<section class="relative z-10 bg-black">
<div class="grid md:grid-cols-3 gap-8">
        <!-- Deluxe Suite -->
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/deluxe-suite.jpg') }}" 
                alt="Deluxe Suite" 
                class="w-full h-96 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:bg-opacity-30"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-3xl font-semibold">Deluxe Suite</h3>
        </div>

        <!-- Signature Suite -->
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/signature-suite.jpg') }}" 
                alt="Signature Suite" 
                class="w-full h-96 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:bg-opacity-30"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-3xl font-semibold">Signature Suite</h3>
        </div>

        <!-- Luxury Suite -->
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/luxury-suite.jpg') }}" 
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
                src="{{ asset('images/restaurant-dish.jpg') }}" 
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
                src="{{ asset('images/facilities/restaurant.jpg') }}" 
                alt="Restaurant" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Restaurant</h3>
        </div>

        <!-- Banquet Hall -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/banquet-hall.jpg') }}" 
                alt="Banquet Hall" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Banquet Hall</h3>
        </div>

        <!-- Swimming Pool -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/swimming-pool.jpg') }}" 
                alt="Swimming Pool" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Swimming Pool</h3>
        </div>

        <!-- Pub & Bar -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/pub-bar.jpg') }}" 
                alt="Pub & Bar" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Pub & Bar</h3>
        </div>

        <!-- Indoor Games -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/indoor-games.jpg') }}" 
                alt="Indoor Games" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Indoor Games</h3>
        </div>

        <!-- Outdoor Games -->
        <div class="relative group overflow-hidden cursor-pointer">
            <img 
                src="{{ asset('images/facilities/outdoor-games.jpg') }}" 
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
                src="{{ asset('images/facilities/rooms-cottages.jpg') }}" 
                alt="Rooms & Cottages" 
                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>
            <h3 class="absolute bottom-6 left-6 text-white text-2xl font-semibold">Rooms & Cottages</h3>
        </div>
    </div>
</div>


<!-- Photo Gallery Section -->
<section class="relative z-10 bg-black">
<div class="container mx-auto px-4 py-24">
    <!-- Header -->
    <div class="text-center mb-16">
        <span class="text-yellow-400 mb-4 block">Hotel Gallery</span>
        <h2 class="text-white text-4xl font-light mb-12 max-w-3xl mx-auto leading-relaxed">
            Enjoy and join the handful of guests who already sent their best photographic memories of their stay.
        </h2>
        
        <!-- Social Media Links -->
        <div class="flex justify-center items-center gap-6">
            <a href="#" class="text-white hover:text-yellow-400 transition-colors duration-300">Facebook</a>
            <a href="#" class="text-white hover:text-yellow-400 transition-colors duration-300">Instagram</a>
            <a href="#" class="text-white hover:text-yellow-400 transition-colors duration-300">Twitter</a>
        </div>
    </div>

    <!-- Photo Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Row 1 -->
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-1.jpg') }}" 
                alt="Hotel Interior" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-2.jpg') }}" 
                alt="Hotel Feature" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-3.jpg') }}" 
                alt="Room Detail" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-4.jpg') }}" 
                alt="Hotel View" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>

        <!-- Row 2 -->
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-5.jpg') }}" 
                alt="Hotel Area" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-6.jpg') }}" 
                alt="Hotel Feature" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-7.jpg') }}" 
                alt="Night View" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-8.jpg') }}" 
                alt="Pool View" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>

         <!-- Row 3 -->
         <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-9.jpg') }}" 
                alt="Hotel Area" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-10.jpg') }}" 
                alt="Hotel Feature" 
                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
        </div>
        <div class="relative group overflow-hidden">
            <img 
                src="{{ asset('images/gallery/gallery-11.jpg') }}" 
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
                <h3 class="text-pink-500 text-3xl mb-4">Couple Packages</h3>
                <p class="text-gray-300">Indulge in our exclusive couple packages featuring cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games for a perfect getaway</p>
                <a href="#" class="inline-block text-white hover:text-pink-500 transition-colors duration-300 mt-4">View Details</a>
            </div>

            <!-- Package Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Package Card 1 -->
                <div class="bg-gray-900 rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/packages/special-couple.jpg') }}" alt="Special Couple Package" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4">
                            <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="w-8 h-8">
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl text-white mb-4">SPECIAL COUPLE PACKAGE</h4>
                        <ul class="text-gray-300 mb-6 space-y-2">
                            <li>• LUXURY COTTAGE</li>
                            <li>• SWIMMING POOL</li>
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
                                <p class="text-pink-500 text-xl">Rs.12,000</p>
                            </div>
                            <a href="https://wa.me/94717152555" class="bg-pink-500 text-white px-6 py-2 rounded-lg hover:bg-pink-600 transition-colors duration-300">
                                BOOK NOW
                            </a>
                        </div>
                        <p class="text-gray-400 text-sm mt-4">Location: Matiriagama, Suriyagoda</p>
                        <p class="text-gray-400 text-sm">Check In/out: 3:00 PM to 3:00 pm</p>
                    </div>
                </div>

                <!-- Package Card 2 -->
                <div class="bg-gray-900 rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/packages/day-out.jpg') }}" alt="Day Out Package" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4">
                            <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="w-8 h-8">
                        </div>
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
                                <p class="text-pink-500 text-xl">Rs.7,000</p>
                            </div>
                            <a href="https://wa.me/94717152555" class="bg-pink-500 text-white px-6 py-2 rounded-lg hover:bg-pink-600 transition-colors duration-300">
                                BOOK NOW
                            </a>
                        </div>
                        <p class="text-gray-400 text-sm mt-4">Location: Matiriagama, Suriyagoda</p>
                        <p class="text-gray-400 text-sm">Check In/out: 8:00 AM to 5:00 pm</p>
                    </div>
                </div>

                <!-- Package Card 3 -->
                <div class="bg-gray-900 rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset('images/packages/special-couple-fb.jpg') }}" alt="Special Couple FB Package" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4">
                            <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="w-8 h-8">
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl text-white mb-4">SPECIAL COUPLE FB PACKAGE</h4>
                        <ul class="text-gray-300 mb-6 space-y-2">
                            <li>• LUXURY COTTAGE</li>
                            <li>• SWIMMING POOL</li>
                            <li>• WELCOME DRINK</li>
                            <li>• EVENING SNACK</li>
                            <li>• DINNER</li>
                            <li>• BED TEA</li>
                            <li>• BREAKFAST</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400">ONLY FOR</p>
                                <p class="text-pink-500 text-xl">Rs.10,000</p>
                            </div>
                            <a href="https://wa.me/94717152555" class="bg-pink-500 text-white px-6 py-2 rounded-lg hover:bg-pink-600 transition-colors duration-300">
                                BOOK NOW
                            </a>
                        </div>
                        <p class="text-gray-400 text-sm mt-4">Location: Matiriagama, Suriyagoda</p>
                        <p class="text-gray-400 text-sm">Check In/out: 3:00 PM to 12:00 pm</p>
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
        <h3 class="text-purple-500 text-3xl mb-4">Family Packages</h3>
        <p class="text-gray-300">Enjoy our family packages with cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games, perfect for groups of 2 to 10 guests.</p>
        <a href="#" class="inline-block text-white hover:text-purple-500 transition-colors duration-300 mt-4">View Details</a>
    </div>

    <!-- Package Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Night Stay Package -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="relative">
                <img src="{{ asset('images/packages/family-night.jpg') }}" alt="Family Night Stay Package" class="w-full h-48 object-cover">
                <div class="absolute top-4 right-4">
                    <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="w-8 h-8">
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-2xl text-white mb-4">FAMILY NIGHT-STAY</h4>
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
                        <p class="text-purple-500 text-xl">Rs.5,500/-</p>
                    </div>
                    <a href="https://wa.me/94717152555" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 transition-colors duration-300">
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
                <img src="{{ asset('images/packages/family-day.jpg') }}" alt="Family Day Out Package" class="w-full h-48 object-cover">
                <div class="absolute top-4 right-4">
                    <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="w-8 h-8">
                </div>
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
                        <p class="text-purple-500 text-xl">Rs.3,000/-</p>
                    </div>
                    <a href="https://wa.me/94717152555" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 transition-colors duration-300">
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
                <img src="{{ asset('images/packages/family-night-2.jpg') }}" alt="Family Night Stay Package 2" class="w-full h-48 object-cover">
                <div class="absolute top-4 right-4">
                    <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="w-8 h-8">
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-2xl text-white mb-4">FAMILY NIGHT-STAY</h4>
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
                        <p class="text-purple-500 text-xl">Rs.4,500/-</p>
                    </div>
                    <a href="https://wa.me/94717152555" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 transition-colors duration-300">
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
        <h3 class="text-green-500 text-3xl mb-4">Group Packages</h3>
        <p class="text-gray-300">Experience our group packages with cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games, perfect for groups of more than 10 guests.</p>
        <a href="#" class="inline-block text-white hover:text-green-500 transition-colors duration-300 mt-4">View Details</a>
    </div>

    <!-- Package Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Night Stay Package -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="relative">
                <img src="{{ asset('images/packages/group-night.jpg') }}" alt="Group Night Stay Package" class="w-full h-48 object-cover">
                <div class="absolute top-4 right-4">
                    <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="w-8 h-8">
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-2xl text-white mb-4">NIGHT-STAY</h4>
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
                        <p class="text-green-500 text-xl">Rs.3,990</p>
                    </div>
                    <a href="https://wa.me/94717152555" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300">
                        BOOK NOW
                    </a>
                </div>
            </div>
        </div>

        <!-- Night Stay FB Package -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="relative">
                <img src="{{ asset('images/packages/group-night-fb.jpg') }}" alt="Group Night Stay FB Package" class="w-full h-48 object-cover">
                <div class="absolute top-4 right-4">
                    <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="w-8 h-8">
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-2xl text-white mb-4">NIGHT-STAY-FB</h4>
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
                        <p class="text-green-500 text-xl">Rs.4,790</p>
                    </div>
                    <a href="https://wa.me/94717152555" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300">
                        BOOK NOW
                    </a>
                </div>
            </div>
        </div>

        <!-- Day Out Package -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="relative">
                <img src="{{ asset('images/packages/group-day.jpg') }}" alt="Group Day Out Package" class="w-full h-48 object-cover">
                <div class="absolute top-4 right-4">
                    <img src="{{ asset('images/logo-small.png') }}" alt="Logo" class="w-8 h-8">
                </div>
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
                        <p class="text-green-500 text-xl">Rs.1,990</p>
                    </div>
                    <a href="https://wa.me/94717152555" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300">
                        BOOK NOW
                    </a>
                </div>
                <p class="text-gray-400 text-sm mt-4">* Minimum of 10 guests required</p>
                <p class="text-gray-400 text-sm">Location: Melsiripura, Kurunegala</p>
            </div>
        </div>
    </div>
</div>

<!-- Wedding Packages Section -->
<section class="relative z-10 bg-black">
<div class="bg-black py-16">
    <div class="container mx-auto px-4">
        <div class="mb-16">
            <h3 class="text-purple-500 text-3xl mb-4">Wedding Packages</h3>
            <h4 class="text-white text-xl mb-4">Experience Unmatched Elegance with Our Luxury Wedding Packages</h4>
            <p class="text-gray-300 mb-6">Celebrate your special day in unparalleled style and sophistication with our exclusive luxury wedding packages. Our meticulously curated offerings include opulent accommodations, gourmet dining experiences, and access to our stunning swimming pool and other premium amenities. Whether you're planning an intimate ceremony or a grand celebration, our dedicated team ensures every detail is perfect, creating memories that will last a lifetime. Indulge in the ultimate wedding experience at our hotel, where luxury meets romance.</p>
        </div>

        <!-- Wedding Package Images Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
            <div class="relative group overflow-hidden rounded-lg">
                <img src="{{ asset('images/packages/wedding1.jpg') }}" alt="Wedding Venue" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
            </div>
            <div class="relative group overflow-hidden rounded-lg">
                <img src="{{ asset('images/packages/wedding2.jpg') }}" alt="Wedding Decoration" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
            </div>
            <div class="relative group overflow-hidden rounded-lg">
                <img src="{{ asset('images/packages/wedding3.jpg') }}" alt="Wedding Ceremony" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
            </div>
            <div class="relative group overflow-hidden rounded-lg">
                <img src="{{ asset('images/packages/wedding4.jpg') }}" alt="Wedding Reception" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
            </div>
        </div>

        <!-- Wedding Package Card -->
        <div class="bg-gray-900 rounded-lg overflow-hidden">
            <div class="p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Left Column - Package Details -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-start">
                            <h4 class="text-white text-2xl">WEDDING PACKAGE</h4>
                            
                        </div>
                        <ul class="text-gray-300 space-y-2">
                            <li>• WEDDING MENU (12 ITEMS)</li>
                            <li>• LUXURY BANQUET HALL</li>
                            <li>• BED MENU(02)</li>
                            <li>• JAYA MANGALA GATHA</li>
                            <li>• TRADITIONAL DANCING GROUP</li>
                            <li>• ASHTAKA</li>
                            <li>• DJ MUSIC</li>
                            <li>• ENTRANCE DECORATIONS</li>
                            <li>• OIL LAMP, TABLES & CHAIR DECORATIONS</li>
                            <li>• SETTEE AND PORUWA</li>
                            <li>• LUXURY HONEYMOON COTTAGE (HB)</li>
                            <li>• VIP BAR SERVICE</li>
                            <li>• PHOTOGRAPHY LOCATIONS</li>
                            <li>• EVENT COORDINATION</li>
                        </ul>
                    </div>

                    <!-- Right Column - Pricing -->
                    <div>
                        <div class="bg-black bg-opacity-50 p-6 rounded-lg">
                            <h5 class="text-white mb-4">PRICING</h5>
                            <ul class="text-gray-300 space-y-2">
                                <li>50 Pax - 350,000 /-</li>
                                <li>100 Pax - 560,000 /-</li>
                                <li>150 Pax - 480,000 /-</li>
                                <li>200 Pax - 550,000 /-</li>
                                <li>300 Pax - 795,000 /-</li>
                                <li>400 Pax - 995,000 /-</li>
                            </ul>
                        </div>
                        <div class="mt-6">
                            <p class="text-purple-400 mb-2">Special Discount</p>
                            <p class="text-white text-4xl font-bold">25%</p>
                            <p class="text-gray-400">Valid till May 2023</p>
                        </div>
                        <div class="mt-6">
                            <a href="https://wa.me/94717152555" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 inline-block">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FAQ Section -->
<section class="relative z-10 bg-black">
<div class="bg-black py-24">
    <div class="container mx-auto px-4">
        <h2 class="text-brown-400 text-3xl mb-12 text-center">Frequently Asked Questions</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- FAQ List -->
            <div class="space-y-4">
                <!-- Question 1 -->
                <div x-data="{ open: true }" class="border-b border-gray-700">
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
                <div x-data="{ open: false }" class="border-b border-gray-700">
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
                <div x-data="{ open: false }" class="border-b border-gray-700">
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
                <div x-data="{ open: false }" class="border-b border-gray-700">
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
                <div x-data="{ open: false }" class="border-b border-gray-700">
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
                    src="{{ asset('images/chef-cooking.jpg') }}" 
                    alt="Chef cooking with fire" 
                    class="rounded-lg w-full h-full object-cover"
                >
            </div>
        </div>
    </div>
</div>



<!-- Location Section -->
<section class="relative z-10 bg-black">
<div class="bg-black py-24">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Map Section -->
            <div class="w-full h-[400px] rounded-lg overflow-hidden">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1069447446457!2d80.5640347!3d7.3340456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3185b771428d9%3A0x9b9c8f7d0c8c8f7a!2sSoba%20Lanka%20Holiday%20Resort!5e0!3m2!1sen!2slk!4v1625147458769!5m2!1sen!2slk"
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"
                ></iframe>
            </div>

            <!-- Contact Details -->
            <div class="space-y-8">
                <h2 class="text-3xl text-green-500">Location</h2>

                <div class="space-y-6">
                    <!-- Address -->
                    <div>
                        <h3 class="text-green-400 text-xl mb-2">Address</h3>
                        <p class="text-white">
                            Soba Lanka Holiday Resort PVT (LTD), Balawattala Road, Melsiripura, Kurunegala
                        </p>
                    </div>

                    <!-- Hours -->
                    <div>
                        <h3 class="text-green-400 text-xl mb-2">Hours</h3>
                        <div class="text-white">
                            <p>Open / Close - 8AM to 10PM</p>
                            <p>Open Every Day</p>
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <h3 class="text-green-400 text-xl mb-2">Contact Number</h3>
                        <div class="text-white">
                            <p>Contact Number - 037 22 50 308 / 071 71 52 955</p>
                        </div>
                    </div>

                    <!-- Review Section -->
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <span class="text-white text-xl mr-2">3.7</span>
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
                                <svg class="w-5 h-5 text-yellow-400/50" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                        </div>
                        <a href="#" class="text-blue-400 hover:text-blue-300">364 reviews</a>
                    </div>

                    <!-- Directions Button -->
                    <a 
                        href="https://www.google.com/maps/dir//Soba+Lanka+Holiday+Resort" 
                        target="_blank"
                        class="inline-block bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300"
                    >
                        Get Directions
                    </a>
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
            src="{{ asset('images/pool-bg.jpg') }}" 
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
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>

    
    // Add date validation
    document.addEventListener('DOMContentLoaded', function() {
        const checkIn = document.querySelector('input[name="check_in"]');
        const checkOut = document.querySelector('input[name="check_out"]');

        checkIn.addEventListener('change', function() {
            const date = new Date(this.value);
            date.setDate(date.getDate() + 1);
            checkOut.min = date.toISOString().split('T')[0];
            
            if(checkOut.value && checkOut.value <= this.value) {
                checkOut.value = date.toISOString().split('T')[0];
            }
        });
    });
</script>
@endpush
@endsection