{{-- resources/views/menu/show.blade.php --}}
@extends('layouts.app')

@section('title', $menu->name . ' Menu')

@section('meta_description', $menu->description ?? 'View our ' . $menu->name . ' menu at Soba Lanka Resort. Delicious food options for your stay in Kurunegala, Sri Lanka.')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Main Content Container -->
<div class="relative z-0 pt-20">
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative" style="background-image: url('{{ $menu->image_path ? asset('storage/' . $menu->image_path) : asset('images/pool-bg-min.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-24 relative">
            <div class="flex items-center justify-center mb-4">
                <span class="bg-{{ $menu->color }}-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                    <i class="fas {{ $menu->icon }} mr-2"></i>
                    Menu Category
                </span>
            </div>
            <h1 class="text-center text-5xl mb-4 opacity-0 animate-fade-in-up">
                <span class="text-{{ $menu->color }}-400">{{ strtoupper($menu->name) }}</span>
            </h1>
            @if($menu->description)
                <p class="text-center text-white text-xl max-w-3xl mx-auto">
                    {{ $menu->description }}
                </p>
            @endif
        </div>
    </div>

    <!-- Menu Content Section -->
    <div class="bg-black py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Left Column: Features & Info -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-900 rounded-lg p-6 border border-gray-800 sticky top-24">
                        <h3 class="text-{{ $menu->color }}-400 text-xl font-semibold mb-6 flex items-center">
                            <i class="fas {{ $menu->icon }} mr-3"></i>
                            What's Included
                        </h3>
                        
                        @if($menu->features && count($menu->features) > 0)
                            <ul class="space-y-3 mb-8">
                                @foreach($menu->features as $feature)
                                    <li class="flex items-start text-gray-300">
                                        <i class="fas fa-check text-{{ $menu->color }}-500 mr-3 mt-1"></i>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="border-t border-gray-700 pt-6">
                            <h4 class="text-white font-semibold mb-4">Need More Information?</h4>
                            <div class="space-y-3">
                                <a href="https://wa.me/94717152955?text=Hi, I'm interested in the {{ $menu->name }} menu" 
                                   target="_blank"
                                   class="w-full bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition-colors duration-300 flex items-center justify-center gap-2">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                    WhatsApp Us
                                </a>
                                <a href="{{ route('contact') }}" 
                                   class="w-full bg-{{ $menu->color }}-500 text-white px-4 py-3 rounded-lg hover:bg-{{ $menu->color }}-600 transition-colors duration-300 flex items-center justify-center gap-2">
                                    <i class="fas fa-envelope"></i>
                                    Contact Us
                                </a>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-700">
                            <a href="{{ route('menu.index') }}" class="text-gray-400 hover:text-{{ $menu->color }}-400 transition-colors flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to All Menus
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Menu Images -->
                <div class="lg:col-span-2">
                    @php
                        $hasMenuImages = $menu->menu_image_path || $menu->menuImages->count() > 0;
                        $allImages = collect();
                        if ($menu->menu_image_path) {
                            $allImages->push(['path' => $menu->menu_image_path, 'title' => 'Primary Menu']);
                        }
                        foreach ($menu->menuImages as $img) {
                            $allImages->push(['path' => $img->image_path, 'title' => $img->title ?? 'Menu Page']);
                        }
                    @endphp

                    @if($hasMenuImages)
                        <div class="bg-gray-900 rounded-lg p-6 border border-gray-800">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-white text-xl font-semibold">
                                    <i class="fas fa-file-image text-{{ $menu->color }}-400 mr-2"></i>
                                    {{ $menu->name }} Menu
                                    @if($allImages->count() > 1)
                                        <span class="text-gray-500 text-sm font-normal">({{ $allImages->count() }} pages)</span>
                                    @endif
                                </h3>
                            </div>
                            
                            <!-- Menu Images Gallery -->
                            <div class="space-y-6">
                                @foreach($allImages as $index => $image)
                                    <div class="relative cursor-pointer group" onclick="openLightbox({{ $index }})">
                                        <img src="{{ asset('storage/' . $image['path']) }}" 
                                             alt="{{ $image['title'] }}"
                                             class="w-full rounded-lg shadow-2xl border border-gray-700 group-hover:opacity-90 transition-opacity">
                                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="bg-black/70 text-white px-6 py-3 rounded-lg flex items-center gap-2">
                                                <i class="fas fa-search-plus text-xl"></i>
                                                Click to Zoom
                                            </span>
                                        </div>
                                        @if($allImages->count() > 1)
                                            <div class="absolute top-3 left-3 bg-black/70 text-white px-3 py-1 rounded-full text-sm">
                                                Page {{ $index + 1 }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <p class="text-gray-500 text-sm mt-4 text-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Click on any image to view in full size
                            </p>
                        </div>
                    @else
                        <!-- No Menu Image Uploaded -->
                        <div class="bg-gray-900 rounded-lg p-12 border border-gray-800 text-center">
                            <div class="w-24 h-24 bg-{{ $menu->color }}-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas {{ $menu->icon }} text-{{ $menu->color }}-400 text-4xl"></i>
                            </div>
                            <h3 class="text-white text-2xl mb-4">Menu Coming Soon</h3>
                            <p class="text-gray-400 mb-8 max-w-md mx-auto">
                                Our {{ $menu->name }} menu is being prepared. Please contact us directly for current offerings and pricing.
                            </p>
                            <div class="flex justify-center gap-4 flex-wrap">
                                <a href="https://wa.me/94717152955?text=Hi, I'd like to know about the {{ $menu->name }} menu" 
                                   target="_blank"
                                   class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                                    <i class="fab fa-whatsapp"></i>
                                    Ask on WhatsApp
                                </a>
                                <a href="tel:+94372250308" 
                                   class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-colors flex items-center gap-2">
                                    <i class="fas fa-phone"></i>
                                    Call Us
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Related Categories Section -->
    <div class="bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-white text-3xl mb-12">Explore Other Menus</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @php
                    $otherCategories = \App\Models\MenuCategory::active()
                        ->where('id', '!=', $menu->id)
                        ->ordered()
                        ->limit(6)
                        ->get();
                @endphp
                @foreach($otherCategories as $category)
                    <a href="{{ route('menu.show', $category->slug) }}" 
                       class="bg-gray-800 rounded-lg p-4 text-center hover:bg-gray-700 transition-colors group">
                        <div class="w-12 h-12 bg-{{ $category->color }}-500/20 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas {{ $category->icon }} text-{{ $category->color }}-400 text-xl"></i>
                        </div>
                        <span class="text-gray-300 text-sm group-hover:text-{{ $category->color }}-400 transition-colors">
                            {{ $category->name }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal for Full-Size Menu Images -->
@if($hasMenuImages)
<div id="lightbox" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4" onclick="closeLightbox(event)">
    <button onclick="closeLightbox(event)" 
            class="absolute top-4 right-4 text-white text-3xl hover:text-gray-300 transition-colors z-10">
        <i class="fas fa-times"></i>
    </button>
    
    <div class="absolute top-4 left-4 flex gap-2 z-10">
        <a id="downloadBtn" href="#" download="{{ $menu->slug }}-menu.jpg"
           class="bg-white/10 text-white px-4 py-2 rounded-lg hover:bg-white/20 transition-colors flex items-center gap-2"
           onclick="event.stopPropagation()">
            <i class="fas fa-download"></i>
            Download
        </a>
        @if($allImages->count() > 1)
            <span id="pageIndicator" class="bg-white/10 text-white px-4 py-2 rounded-lg">
                1 / {{ $allImages->count() }}
            </span>
        @endif
    </div>

    @if($allImages->count() > 1)
        <button onclick="prevImage(event)" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition-colors z-10 bg-black/50 rounded-full w-12 h-12 flex items-center justify-center">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button onclick="nextImage(event)" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition-colors z-10 bg-black/50 rounded-full w-12 h-12 flex items-center justify-center">
            <i class="fas fa-chevron-right"></i>
        </button>
    @endif

    <div class="max-w-4xl max-h-[90vh] overflow-auto" onclick="event.stopPropagation()">
        <img id="lightboxImage" src="" alt="{{ $menu->name }} Menu" class="w-full h-auto rounded-lg shadow-2xl">
    </div>
</div>

<script>
const menuImages = @json($allImages->pluck('path')->map(fn($p) => asset('storage/' . $p)));
let currentImageIndex = 0;

function openLightbox(index = 0) {
    currentImageIndex = index;
    updateLightboxImage();
    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function updateLightboxImage() {
    document.getElementById('lightboxImage').src = menuImages[currentImageIndex];
    document.getElementById('downloadBtn').href = menuImages[currentImageIndex];
    @if($allImages->count() > 1)
    document.getElementById('pageIndicator').textContent = (currentImageIndex + 1) + ' / ' + menuImages.length;
    @endif
}

function nextImage(event) {
    if (event) event.stopPropagation();
    currentImageIndex = (currentImageIndex + 1) % menuImages.length;
    updateLightboxImage();
}

function prevImage(event) {
    if (event) event.stopPropagation();
    currentImageIndex = (currentImageIndex - 1 + menuImages.length) % menuImages.length;
    updateLightboxImage();
}

function closeLightbox(event) {
    if (event) event.stopPropagation();
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
});
</script>
@endif

@push('styles')
<style>
    body {
        background-color: #000000;
        color: #e5e7eb;
    }
    
    .transition-all {
        transition: all 0.3s ease-in-out;
    }

    /* Smooth scroll for lightbox */
    #lightbox {
        backdrop-filter: blur(4px);
    }
</style>
@endpush
@endsection
