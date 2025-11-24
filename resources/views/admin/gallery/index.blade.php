<!-- resources/views/admin/gallery/index.blade.php -->
@extends('layouts.app')

@section('title', 'Manage Galleries')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Manage Gallery Images</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- General Room Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">General Rooms Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of general hotel rooms and suites.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $roomImagesCount }} images</p>
                <a href="{{ route('admin.gallery.rooms') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>

            <!-- Family Cottages Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Family Cottages Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of family cottage accommodations.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $familyCottageImagesCount }} images</p>
                <a href="{{ route('admin.gallery.family-cottages') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>

            <!-- Couple Cottages Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Couple Cottages Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of romantic couple cottage accommodations.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $coupleCottageImagesCount }} images</p>
                <a href="{{ route('admin.gallery.couple-cottages') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>

            <!-- Family Rooms Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Family Rooms Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of family room accommodations.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $familyRoomImagesCount }} images</p>
                <a href="{{ route('admin.gallery.family-rooms') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>
            
            <!-- Outdoor Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Outdoor Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of outdoor spaces and facilities.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $outdoorImagesCount }} images</p>
                <a href="{{ route('admin.gallery.outdoor') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>
            
            <!-- Weddings Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Weddings Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of weddings and events.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $weddingImagesCount }} images</p>
                <a href="{{ route('admin.gallery.weddings') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>

            <!-- Conference Hall Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Conference Hall Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of conference halls and meeting rooms.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $conferenceHallImagesCount }} images</p>
                <a href="{{ route('admin.gallery.conference-hall') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>

            <!-- Event Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Event Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of various events and celebrations.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $eventImagesCount }} images</p>
                <a href="{{ route('admin.gallery.events') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>

            <!-- Indoor Game Area Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Indoor Game Area Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of indoor gaming and recreation areas.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $indoorGameImagesCount }} images</p>
                <a href="{{ route('admin.gallery.indoor-games') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>

            <!-- Outdoor Game Area Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Outdoor Game Area Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of outdoor gaming and sports areas.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $outdoorGameImagesCount }} images</p>
                <a href="{{ route('admin.gallery.outdoor-games') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>

            <!-- Swimming Pool Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Swimming Pool Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of swimming pools and aquatic areas.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $swimmingPoolImagesCount }} images</p>
                <a href="{{ route('admin.gallery.swimming-pool') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>

            <!-- Dining Area Gallery Card -->
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Dining Area Gallery</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Manage images of dining areas and restaurants.</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $diningAreaImagesCount }} images</p>
                <a href="{{ route('admin.gallery.dining-area') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                    Manage Images
                </a>
            </div>
        </div>
    </div>
</div>
@endsection