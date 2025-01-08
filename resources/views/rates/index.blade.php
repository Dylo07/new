@extends('layouts.app')

@section('title', 'Rates & Packages')

@section('content')
<!-- Main Content Container -->
<div class="relative z-0 pt-20">
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative" style="background-image: url('{{ asset('images/rates-bg.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-24 relative">
            <h1 class="text-center text-green-500 text-5xl mb-4">RATES & PACKAGES</h1>
            <p class="text-center text-white text-xl">Exclusive Packages For Our Valued Clients</p>
        </div>
    </div>

    <div class="bg-black py-24">
        <div class="container mx-auto px-4">
            <!-- Couples Section -->
            <div class="mb-16">
                <div class="mb-8">
                    <p class="text-gray-400">For Couples</p>
                    <h3 class="text-pink-500 text-3xl mb-4">Couple Packages</h3>
                    <p class="text-gray-300">Indulge in our exclusive couple packages featuring cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games for a perfect getaway</p>
                </div>

                <!-- Couple Packages Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Special Couple Package (HB) -->
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

                    <!-- Day Out Couple Package -->
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

                    <!-- Special Couple Package (FB) -->
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

            <!-- Family Packages Section -->
            <div class="mb-16">
                <div class="mb-8">
                    <p class="text-gray-400">For Families (2 to 10 Guests)</p>
                    <h3 class="text-purple-500 text-3xl mb-4">Family Packages</h3>
                    <p class="text-gray-300">Enjoy our family packages with cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games, perfect for groups of 2 to 10 guests.</p>
                </div>

                <!-- Family Packages Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Family Night Stay (HB) -->
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

                    <!-- Family Day Out -->
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

                    <!-- Family Night Stay (FB) -->
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
            <div class="mb-16">
                <div class="mb-8">
                    <p class="text-gray-400">Suitable for Offices, Large Families, and Groups (10+ Guests)</p>
                    <h3 class="text-green-500 text-3xl mb-4">Group Packages</h3>
                    <p class="text-gray-300">Experience our group packages with cozy cottage accommodations, delicious meals, swimming pool access, and a variety of games, perfect for groups of more than 10 guests.</p>
                </div>

                <!-- Group Packages Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Night Stay (HB) -->
                    <div class="bg-gray-900 rounded-lg overflow-hidden">
                        <div class="relative">
                            <img src="{{ asset('images/packages/group-night.jpg') }}" alt="Group Night Stay Package" class="w-full h-55 object-cover">
                        </div>
                        <div class="p-6">
                            <h4 class="text-2xl text-white mb-4">NIGHT-STAY(HB)</h4>
                            <ul class="text-gray-300 mb-6 space-y-2">
                                <li>• ACCOMMODATION</li>
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

                    <!-- Night Stay (FB) -->
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
                            <img src="{{ asset('images/packages/group-day.jpg') }}" alt="Group Day Out Package" class="w-full h-55 object-cover">
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

            <!-- Wedding Package Section -->
            <div class="py-16">
                <div class="mb-16">
                    <h3 class="text-purple-500 text-3xl mb-4">Wedding Packages</h3>
                    <h4 class="text-white text-xl mb-4">Experience Unmatched Elegance with Our Luxury Wedding Packages</h4>
                    <p class="text-gray-300 mb-6">Celebrate your special day in unparalleled style and sophistication with our exclusive luxury wedding packages. Our meticulously curated offerings include opulent accommodations, gourmet dining experiences, and access to our stunning swimming pool and other premium amenities.</p>
                </div>

                <!-- Wedding Package Images -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="relative group overflow-hidden rounded-lg">
                        <img src="{{ asset('images/packages/wedding1.jpg') }}" alt="Wedding Venue" class="w-[148px] h-[105px] object-cover">
                    </div>
                    <div class="relative group overflow-hidden rounded-lg">
                        <img src="{{ asset('images/packages/wedding2.jpg') }}" alt="Wedding Reception" class="w-[148px] h-[105px] object-cover">
                    </div>
                </div>

                <!-- Wedding Package Details -->
                <div class="bg-gray-900 rounded-xl overflow-hidden">
                    <div class="p-8">
                        <div class="grid md:grid-cols-2 gap-12">
                            <!-- Package Details -->
                            <div class="space-y-6">
                                <div class="border-b border-gray-700 pb-4">
                                    <h4 class="text-white text-3xl font-light">WEDDING PACKAGE</h4>
                                    <p class="text-gray-400 mt-2">All-inclusive luxury wedding experience</p>
                                </div>
                                
                                <ul class="text-gray-300 space-y-3">
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>WEDDING MENU (32 ITEMS)</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>LUXURY BANQUET HALL</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>LED DANCE FLOOR</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>JAYA MANGALA GATHA</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>TRADITIONAL DANCING GROUP</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>ASHTAKA</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>DJ MUSIC</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>ENTRANCE DECORATIONS</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>OIL LAMP, TABLES & CHAIR DECORATIONS</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>SETTEE AND PORUWA</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>LUXURY HONEYMOON COTTAGE (HB)</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>VIP BAR SERVICE</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>PHOTOGRAPHY LOCATIONS</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="text-purple-400 text-xl">•</span>
                                        <span>EVENT COORDINATION</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Pricing -->
                            <div class="space-y-8">
                                <div class="bg-black/40 p-8 rounded-xl border border-gray-800">
                                    <h5 class="text-white text-2xl mb-6 font-light">PRICING</h5>
                                    <ul class="text-gray-300 space-y-4">
                                        <li class="flex justify-between items-center border-b border-gray-700 pb-3">
                                            <span>50 Pax</span>
                                            <span class="text-purple-400 font-semibold">350,000 /-</span>
                                        </li>
                                        <li class="flex justify-between items-center border-b border-gray-700 pb-3">
                                            <span>100 Pax</span>
                                            <span class="text-purple-400 font-semibold">560,000 /-</span>
                                        </li>
                                        <li class="flex justify-between items-center border-b border-gray-700 pb-3">
                                            <span>150 Pax</span>
                                            <span class="text-purple-400 font-semibold">480,000 /-</span>
                                        </li>
                                        <li class="flex justify-between items-center border-b border-gray-700 pb-3">
                                            <span>200 Pax</span>
                                            <span class="text-purple-400 font-semibold">550,000 /-</span>
                                        </li>
                                        <li class="flex justify-between items-center border-b border-gray-700 pb-3">
                                            <span>300 Pax</span>
                                            <span class="text-purple-400 font-semibold">795,000 /-</span>
                                        </li>
                                        <li class="flex justify-between items-center">
                                            <span>400 Pax</span>
                                            <span class="text-purple-400 font-semibold">995,000 /-</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Special Discount -->
                                <div class="bg-purple-900/20 p-8 rounded-xl text-center border border-purple-800/30">
                                    <p class="text-purple-400 mb-2 text-lg">Special Discount</p>
                                    <p class="text-white text-6xl font-bold mb-2">25%</p>
                                    <p class="text-gray-400">Valid till May 2025</p>
                                </div>

                                <!-- Contact Button -->
                                <div class="text-center">
                                    <a href="https://wa.me/94717152555" 
                                       class="bg-purple-500 text-white px-8 py-3 rounded-lg hover:bg-purple-600 inline-block transition-all duration-300">
                                        Contact Us
                                    </a>
                                </div>
                            </div>
                        </div>
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
            src="{{ asset('images/pool-bg-min.jpg') }}" 
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
</div>

@push('styles')
<style>
    body {
        background-color: #000000;
    }
</style>
@endpush
@endsection