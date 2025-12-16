<!-- resources/views/gallery/index.blade.php -->
@extends('layouts.app')

@section('title', 'Gallery - Soba Lanka Resort')

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
            <h1 class="text-5xl md:text-6xl mb-4 text-center opacity-0 animate-fade-in-up"><span class="gradient-text">GALLERY</span></h1>
            <p class="text-white text-xl text-center opacity-0 animate-fade-in-up stagger-2">
                Explore our beautiful resort through captivating images.
            </p>
        </div>
    </div>
</div>

<!-- Gallery Categories Section -->
<div class="bg-black py-24">
    <div class="container mx-auto px-4">
        <!-- Category Navigation -->
        <div class="flex justify-center items-center gap-4 mb-16 flex-wrap">
            <a href="{{ route('gallery') }}" class="bg-emerald-500 text-white px-4 py-2 rounded-lg">
                All Gallery
            </a>
            <a href="{{ route('gallery.rooms') }}" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
                General Rooms
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

        <!-- Gallery Grid - All Categories -->
        <div class="space-y-16">
            <!-- General Rooms Section -->
            @if($roomImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">General Rooms</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($roomImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.rooms') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Room Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Family Cottages Section -->
            @if($familyCottageImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Family Cottages</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($familyCottageImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.family_cottages') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Family Cottage Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Couple Cottages Section -->
            @if($coupleCottageImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Couple Cottages</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($coupleCottageImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.couple_cottages') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Couple Cottage Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Family Rooms Section -->
            @if($familyRoomImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Family Rooms</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($familyRoomImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.family_rooms') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Family Room Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Outdoor Section -->
            @if($outdoorImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Outdoor</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($outdoorImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.outdoor') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Outdoor Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Weddings Section -->
            @if($weddingImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Weddings</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($weddingImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.weddings') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Wedding Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Conference Hall Section -->
            @if($conferenceHallImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Conference Hall</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($conferenceHallImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.conference_hall') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Conference Hall Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Events Section -->
            @if($eventImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Events</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($eventImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.events') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Event Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Indoor Games Section -->
            @if($indoorGameImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Indoor Game Area</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($indoorGameImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.indoor_games') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Indoor Game Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Outdoor Games Section -->
            @if($outdoorGameImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Outdoor Game Area</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($outdoorGameImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.outdoor_games') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Outdoor Game Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Swimming Pool Section -->
            @if($swimmingPoolImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Swimming Pool</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($swimmingPoolImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.swimming_pool') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Swimming Pool Images
                    </a>
                </div>
            </div>
            @endif

            <!-- Dining Area Section -->
            @if($diningAreaImages->count() > 0)
            <div>
                <h2 class="text-white text-3xl mb-6 text-center font-light">Dining Area</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($diningAreaImages->take(8) as $image)
                        <div class="relative group overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('gallery.dining_area') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors">
                        View All Dining Area Images
                    </a>
                </div>
            </div>
            @endif
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
            <h2 class="text-emerald-400 text-4xl mb-4">TALK TO US</h2>
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

@push('styles')
<style>
    body {
        background-color: #000000;
        color: #e5e7eb;
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