@extends('layouts.app')

@section('title', 'Rates & Packages')

@section('meta_description', 'View our rates and packages at Soba Lanka Resort. Affordable couple, family, group, wedding, and event packages with luxury accommodations in Kurunegala, Sri Lanka.')
    </div>

    <div class="bg-black py-24">
        <div class="container mx-auto px-4">
            @if($allPackages->count() > 0)
                @foreach(['couple', 'family', 'group', 'wedding', 'engagement', 'birthday', 'honeymoon'] as $packageType)
                    @if($packagesByType[$packageType]->count() > 0)
                        <!-- {{ ucfirst($packageType) }} Section -->
                        <div class="mb-16">
                            <div class="mb-8">
                                <p class="text-gray-400">{{ $packageTypeInfo[$packageType]['subtitle'] }}</p>
                                <h3 class="text-{{ $packageTypeInfo[$packageType]['color'] }}-500 text-3xl mb-4">
                                    {{ $packageTypeInfo[$packageType]['title'] }}
                                </h3>
                                <p class="text-gray-300">{{ $packageTypeInfo[$packageType]['description'] }}</p>
                                <a href="{{ route('packages.' . $packageType) }}" 
                                   class="inline-block text-white hover:text-{{ $packageTypeInfo[$packageType]['color'] }}-500 transition-colors duration-300 mt-4 border-b-2 border-transparent hover:border-{{ $packageTypeInfo[$packageType]['color'] }}-500 pb-1">
                                    View All {{ $packageTypeInfo[$packageType]['title'] }} →
                                </a>
                            </div>

                            <!-- Package Cards Grid -->
                            @if($packageType === 'wedding')
                                <!-- Special Wedding Package Layout -->
                                @foreach($packagesByType[$packageType] as $package)
                                    <div class="bg-gray-900 rounded-xl overflow-hidden shadow-2xl mb-8">
                                        <div class="grid md:grid-cols-2 gap-0">
                                            <!-- Image Section -->
                                            <div class="relative">
                                                @if($package->image_path)
                                                    <img src="{{ asset('storage/' . $package->image_path) }}" 
                                                         alt="{{ $package->name }}" 
                                                         class="w-full h-full object-cover min-h-96">
                                                @else
                                                    <div class="w-full h-full bg-gradient-to-r from-purple-600 to-pink-600 flex items-center justify-center min-h-96">
                                                        <i class="fas fa-rings-wedding text-white text-8xl"></i>
                                                    </div>
                                                @endif
                                                <div class="absolute top-4 right-4">
                                                    <span class="bg-purple-500 text-white px-4 py-2 rounded-full text-lg font-bold">
                                                        Premium Package
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Content Section -->
                                            <div class="p-8">
                                                <div class="border-b border-gray-700 pb-4 mb-6">
                                                    <h2 class="text-white text-4xl font-light mb-2">{{ $package->name }}</h2>
                                                    @if($package->description)
                                                        <p class="text-gray-400">{{ $package->description }}</p>
                                                    @endif
                                                </div>

                                                @if($package->features)
                                                    <div class="mb-8">
                                                        <h3 class="text-white text-xl mb-4">Package Includes:</h3>
                                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-60 overflow-y-auto">
                                                            @foreach(array_slice($package->features, 0, 10) as $feature)
                                                                <div class="flex items-center">
                                                                    <i class="fas fa-check text-purple-400 mr-3"></i>
                                                                    <span class="text-gray-300 text-sm">{{ $feature }}</span>
                                                                </div>
                                                            @endforeach
                                                            @if(count($package->features) > 10)
                                                                <div class="col-span-2 text-center">
                                                                    <span class="text-purple-400 text-sm">+ {{ count($package->features) - 10 }} more features</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Pricing Section -->
                                                @if($package->pricing_tiers && count($package->pricing_tiers) > 0)
                                                    <div class="bg-black/40 p-6 rounded-xl border border-gray-800 mb-6">
                                                        <h3 class="text-white text-xl mb-4">Starting from</h3>
                                                        <div class="flex justify-between items-center">
                                                            <span class="text-gray-300">{{ $package->pricing_tiers[0]['guests'] }} Guests</span>
                                                            <span class="text-purple-400 font-bold text-2xl">Rs.{{ number_format($package->pricing_tiers[0]['price'], 0) }}</span>
                                                        </div>
                                                        @if(count($package->pricing_tiers) > 1)
                                                            <p class="text-gray-400 text-sm mt-2">Multiple pricing options available</p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="bg-black/40 p-6 rounded-xl border border-gray-800 mb-6">
                                                        <div class="text-center">
                                                            <p class="text-gray-400 mb-2">Starting from</p>
                                                            <p class="text-purple-400 text-3xl font-bold">Rs.{{ number_format($package->price, 0) }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Contact Buttons -->
                                                <div class="flex gap-4">
                                                    <a href="{{ $package->whatsapp_url }}" 
                                                       target="_blank"
                                                       class="flex-1 bg-purple-500 text-white px-6 py-3 rounded-lg hover:bg-purple-600 transition-all duration-300 text-center flex items-center justify-center gap-2">
                                                        <i class="fab fa-whatsapp"></i>
                                                        Book Now
                                                    </a>
                                                    <a href="{{ route('packages.wedding') }}" 
                                                       class="flex-1 border-2 border-purple-500 text-purple-500 px-6 py-3 rounded-lg hover:bg-purple-500 hover:text-white transition-all duration-300 text-center">
                                                        View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Regular Package Cards Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    @foreach($packagesByType[$packageType] as $package)
                                        <div class="bg-gray-900 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all duration-300">
                                            <div class="relative">
                                                @if($package->image_path)
                                                    <img src="{{ asset('storage/' . $package->image_path) }}" 
                                                         alt="{{ $package->name }}" 
                                                         class="w-full h-64 object-cover">
                                                @else
                                                    <div class="w-full h-64 bg-gradient-to-r 
                                                        @if($packageType === 'couple') from-pink-500 to-purple-600
                                                        @elseif($packageType === 'family') from-purple-500 to-blue-600
                                                        @elseif($packageType === 'group') from-emerald-500 to-teal-600
                                                        @elseif($packageType === 'engagement') from-rose-500 to-pink-600
                                                        @elseif($packageType === 'birthday') from-yellow-500 to-orange-600
                                                        @elseif($packageType === 'honeymoon') from-red-500 to-pink-600
                                                        @endif flex items-center justify-center">
                                                        <i class="fas fa-
                                                            @if($packageType === 'couple') heart
                                                            @elseif($packageType === 'family') users
                                                            @elseif($packageType === 'group') user-friends
                                                            @elseif($packageType === 'engagement') ring
                                                            @elseif($packageType === 'birthday') birthday-cake
                                                            @elseif($packageType === 'honeymoon') heart
                                                            @endif text-white text-6xl"></i>
                                                    </div>
                                                @endif
                                                <div class="absolute top-4 right-4">
                                                    <span class="bg-{{ $packageTypeInfo[$packageType]['color'] }}-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                                        Rs.{{ number_format($package->price, 0) }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="p-6">
                                                <h4 class="text-2xl text-white mb-4 font-semibold">{{ $package->name }}</h4>
                                                
                                                @if($package->description)
                                                    <p class="text-gray-300 mb-4">{{ Str::limit($package->description, 100) }}</p>
                                                @endif

                                                @if($package->features)
                                                    <ul class="text-gray-300 mb-6 space-y-2 max-h-40 overflow-y-auto">
                                                        @foreach(array_slice($package->features, 0, 6) as $feature)
                                                            <li class="flex items-center">
                                                                <i class="fas fa-check text-{{ $packageTypeInfo[$packageType]['color'] }}-500 mr-2"></i>
                                                                <span class="text-sm">{{ $feature }}</span>
                                                            </li>
                                                        @endforeach
                                                        @if(count($package->features) > 6)
                                                            <li class="text-{{ $packageTypeInfo[$packageType]['color'] }}-400 text-sm">
                                                                + {{ count($package->features) - 6 }} more features
                                                            </li>
                                                        @endif
                                                    </ul>
                                                @endif

                                                <div class="flex items-center justify-between mb-4">
                                                    <div>
                                                        <p class="text-gray-400">Starting from</p>
                                                        <p class="text-{{ $packageTypeInfo[$packageType]['color'] }}-500 text-2xl font-bold">Rs.{{ number_format($package->price, 0) }}</p>
                                                        @if($package->min_guests && $package->max_guests)
                                                            <p class="text-gray-400 text-sm">{{ $package->min_guests }}-{{ $package->max_guests }} guests</p>
                                                        @elseif($package->min_guests)
                                                            <p class="text-gray-400 text-sm">Min {{ $package->min_guests }} guests</p>
                                                        @endif
                                                    </div>
                                                    <a href="{{ $package->whatsapp_url }}" 
                                                       target="_blank"
                                                       class="bg-{{ $packageTypeInfo[$packageType]['color'] }}-500 text-white px-6 py-3 rounded-lg hover:bg-{{ $packageTypeInfo[$packageType]['color'] }}-600 transition-colors duration-300 flex items-center gap-2">
                                                        <i class="fab fa-whatsapp"></i>
                                                        BOOK NOW
                                                    </a>
                                                </div>

                                                <div class="space-y-1 text-gray-400 text-sm">
                                                    @if($package->location)
                                                        <p>
                                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                                            Location: {{ $package->location }}
                                                        </p>
                                                    @endif
                                                    
                                                    @if($package->duration)
                                                        <p>
                                                            <i class="fas fa-clock mr-1"></i>
                                                            Duration: {{ $package->duration }}
                                                        </p>
                                                    @endif

                                                    @if($package->additional_info)
                                                        @foreach($package->additional_info as $key => $value)
                                                            @if(in_array($key, ['minimum_requirement', 'special_discount']))
                                                                <p class="text-{{ $packageTypeInfo[$packageType]['color'] }}-400">
                                                                    <i class="fas fa-info-circle mr-1"></i>
                                                                    {{ $value }}
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            @else
                <!-- No Packages Available -->
                <div class="text-center py-16">
                    <i class="fas fa-box-open text-gray-500 text-6xl mb-4"></i>
                    <h3 class="text-white text-2xl mb-4">No Packages Available</h3>
                    <p class="text-gray-400">We're currently updating our packages. Please check back soon or contact us directly for current rates and availability.</p>
                    <div class="mt-8">
                        <a href="{{ route('contact') }}" 
                           class="bg-emerald-500 text-white px-8 py-3 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                            Contact Us
                        </a>
                    </div>
                </div>
            @endif
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
    
    /* Custom scrollbar for feature lists */
    .overflow-y-auto::-webkit-scrollbar {
        width: 4px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #374151;
        border-radius: 2px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #6B7280;
        border-radius: 2px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #9CA3AF;
    }
</style>
@endpush
@endsection