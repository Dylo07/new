{{-- resources/views/menu/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Food & Beverage Menus')

@section('meta_description', 'Explore our delicious food and beverage menus at Soba Lanka Resort. From wedding catering to a la carte dining, discover our culinary offerings in Kurunegala, Sri Lanka.')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Main Content Container -->
<div class="relative z-0 pt-20">
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative" style="background-image: url('{{ asset('images/pool-bg-min.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-24 relative">
            <h1 class="text-center text-5xl mb-4 opacity-0 animate-fade-in-up"><span class="gradient-text">FOOD & BEVERAGE</span></h1>
            <p class="text-center text-white text-xl max-w-3xl mx-auto">
                Discover our culinary delights crafted with fresh ingredients and authentic Sri Lankan flavors. 
                From intimate dinners to grand celebrations, we have the perfect menu for every occasion.
            </p>
        </div>
    </div>

    <!-- Menu Categories Section -->
    <div class="bg-black py-24">
        <div class="container mx-auto px-4">
            @if($categories->count() > 0)
                <!-- Category Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($categories as $category)
                        <a href="{{ route('menu.show', $category->slug) }}" 
                           class="bg-gray-900 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all duration-300 block group">
                            <div class="relative">
                                @if($category->image_path)
                                    <img src="{{ asset('storage/' . $category->image_path) }}" 
                                         alt="{{ $category->name }}" 
                                         class="w-full h-64 object-cover group-hover:opacity-90 transition-opacity">
                                @else
                                    <div class="w-full h-64 bg-gradient-to-r from-{{ $category->color }}-500 to-{{ $category->color }}-700 flex items-center justify-center">
                                        <i class="fas {{ $category->icon }} text-white text-6xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="bg-{{ $category->color }}-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas {{ $category->icon }} mr-1"></i>
                                        Menu
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <h4 class="text-2xl text-white mb-4 font-semibold group-hover:text-{{ $category->color }}-400 transition-colors">
                                    {{ $category->name }}
                                </h4>
                                
                                @if($category->description)
                                    <p class="text-gray-300 mb-4">{{ $category->description }}</p>
                                @endif

                                @if($category->features && count($category->features) > 0)
                                    <ul class="text-gray-300 mb-6 space-y-2">
                                        @foreach(array_slice($category->features, 0, 4) as $feature)
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-{{ $category->color }}-500 mr-2"></i>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                        @if(count($category->features) > 4)
                                            <li class="text-{{ $category->color }}-400 text-sm">
                                                + {{ count($category->features) - 4 }} more items
                                            </li>
                                        @endif
                                    </ul>
                                @endif

                                <div class="flex items-center justify-between">
                                    <span class="text-{{ $category->color }}-500 font-semibold group-hover:underline">
                                        View Menu →
                                    </span>
                                    @if($category->menu_image_path)
                                        <span class="text-gray-500 text-sm">
                                            <i class="fas fa-file-image mr-1"></i>
                                            PDF Available
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <!-- No Categories Available -->
                <div class="text-center py-16">
                    <i class="fas fa-utensils text-emerald-500 text-6xl mb-4"></i>
                    <h3 class="text-white text-2xl mb-4">Menus Coming Soon</h3>
                    <p class="text-gray-400">We're preparing our menu selections. Please check back soon or contact us for current offerings!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Special Features Section -->
    <div class="bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-white text-3xl mb-12">Why Dine With Us?</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-emerald-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-leaf text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Fresh Ingredients</h3>
                    <p class="text-gray-300">Locally sourced, farm-fresh produce</p>
                </div>
                <div class="text-center">
                    <div class="bg-emerald-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-pepper-hot text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Authentic Flavors</h3>
                    <p class="text-gray-300">Traditional Sri Lankan cuisine</p>
                </div>
                <div class="text-center">
                    <div class="bg-emerald-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Expert Chefs</h3>
                    <p class="text-gray-300">Experienced culinary team</p>
                </div>
                <div class="text-center">
                    <div class="bg-emerald-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white text-xl mb-2">Made with Love</h3>
                    <p class="text-gray-300">Every dish crafted with care</p>
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
                    src="{{ asset('images/pool-bg-min.jpg') }}" 
                    alt="Swimming Pool" 
                    class="w-full h-full object-cover"
                >
                <div class="absolute inset-0 bg-black bg-opacity-60"></div>
            </div>

            <!-- Content -->
            <div class="relative container mx-auto px-4 py-24 text-center">
                <h2 class="text-emerald-400 text-4xl mb-4">SPECIAL DIETARY REQUIREMENTS?</h2>
                <p class="text-white text-lg mb-8">
                    We accommodate vegetarian, vegan, halal, and other dietary needs. Contact us to discuss your requirements.
                </p>
                <div class="flex justify-center gap-4 flex-wrap">
                    <a 
                        href="{{ route('contact') }}" 
                        class="inline-block bg-emerald-500 text-white px-8 py-3 rounded-lg hover:bg-emerald-600 transition-colors duration-300"
                    >
                        GET IN TOUCH
                    </a>
                    <a 
                        href="https://wa.me/94717152955" 
                        target="_blank"
                        class="inline-block bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors duration-300 flex items-center gap-2"
                    >
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
    body {
        background-color: #000000;
        color: #e5e7eb;
    }
    
    .hover\:transform:hover {
        transform: translateY(-5px);
    }
    
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
</style>
@endpush
@endsection
