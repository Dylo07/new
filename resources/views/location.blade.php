@extends('layouts.app')

@section('title', 'Location & Directions - Soba Lanka Holiday Resort')

@section('meta_description', 'Find Soba Lanka Holiday Resort in Melsiripura, Kurunegala. Get directions, contact details, and navigate easily to our resort.')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="relative z-0 pt-20">
    <!-- Hero Section -->
    <div class="bg-center bg-cover relative" style="background-image: url('{{ asset('images/pool-bg-min.jpg') }}')">
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="container mx-auto px-4 py-16 md:py-24 relative">
            <div class="text-center">
                <span class="inline-block bg-emerald-500/20 text-emerald-400 px-4 py-2 rounded-full text-sm font-medium mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>Location & Directions
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Find Us</h1>
                <p class="text-gray-300 text-lg max-w-2xl mx-auto">
                    Located in the heart of Melsiripura, Kurunegala - your perfect escape awaits
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-black py-12 md:py-16">
        <div class="container mx-auto px-4">
            
            <!-- Smart Actions Section - Mobile First -->
            <div class="max-w-4xl mx-auto mb-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Get Directions Button -->
                    <a href="https://www.google.com/maps/dir/?api=1&destination=Soba+Lanka+Holiday+Resort+Melsiripura" 
                       target="_blank"
                       class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-2xl p-6 flex items-center justify-center gap-4 transition-all duration-300 transform hover:scale-[1.02] shadow-lg shadow-emerald-500/20">
                        <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-directions text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <span class="block text-lg font-bold">Get Directions</span>
                            <span class="text-emerald-100 text-sm">Open in Google Maps</span>
                        </div>
                        <i class="fas fa-external-link-alt ml-auto opacity-70"></i>
                    </a>

                    <!-- Call Reception Button -->
                    <a href="tel:+94372250308" 
                       class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-2xl p-6 flex items-center justify-center gap-4 transition-all duration-300 transform hover:scale-[1.02] shadow-lg shadow-blue-500/20">
                        <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-phone-alt text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <span class="block text-lg font-bold">Call Reception</span>
                            <span class="text-blue-100 text-sm">+94 37 225 0308</span>
                        </div>
                        <i class="fas fa-phone ml-auto opacity-70"></i>
                    </a>
                </div>

                <!-- WhatsApp Button -->
                <a href="https://wa.me/94717152955?text=Hi, I need directions to Soba Lanka Resort" 
                   target="_blank"
                   class="mt-4 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-2xl p-5 flex items-center justify-center gap-4 transition-all duration-300 transform hover:scale-[1.02] shadow-lg shadow-green-500/20">
                    <i class="fab fa-whatsapp text-2xl"></i>
                    <span class="font-bold">Message us on WhatsApp</span>
                </a>
            </div>

            <!-- Map Card -->
            <div class="max-w-4xl mx-auto mb-10">
                <div class="bg-gray-900 rounded-2xl overflow-hidden border border-gray-800 shadow-2xl">
                    <div class="p-4 md:p-6 border-b border-gray-800">
                        <h2 class="text-white text-xl font-semibold flex items-center gap-3">
                            <i class="fas fa-map text-emerald-400"></i>
                            Our Location
                        </h2>
                    </div>
                    <!-- Responsive Google Map Iframe -->
                    <div class="relative w-full h-64 md:h-96">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.8!2d80.4833!3d7.6167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae33a0e8e8e8e8e%3A0x8e8e8e8e8e8e8e8e!2sSoba%20Lanka%20Holiday%20Resort!5e0!3m2!1sen!2slk!4v1700000000000!5m2!1sen!2slk"
                            class="absolute inset-0 w-full h-full"
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Address Details Card -->
            <div class="max-w-4xl mx-auto mb-10">
                <div class="bg-gray-900 rounded-2xl border border-gray-800 p-6 md:p-8">
                    <div class="flex flex-col md:flex-row md:items-start gap-6">
                        <!-- Address Icon -->
                        <div class="w-16 h-16 bg-emerald-500/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-building text-emerald-400 text-2xl"></i>
                        </div>
                        
                        <!-- Address Content -->
                        <div class="flex-1">
                            <h3 class="text-white text-xl font-semibold mb-3">Soba Lanka Holiday Resort</h3>
                            <p class="text-gray-300 text-lg mb-4" id="address-text">
                                Dambulla Road, Melsiripura,<br>
                                Kurunegala, Sri Lanka
                            </p>
                            
                            <!-- Copy Address Button -->
                            <button onclick="copyAddress()" 
                                    id="copy-btn"
                                    class="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white px-4 py-2 rounded-lg transition-colors">
                                <i class="fas fa-copy"></i>
                                <span id="copy-text">Copy Address</span>
                            </button>
                        </div>

                        <!-- Contact Info -->
                        <div class="flex-shrink-0 space-y-3">
                            <div class="flex items-center gap-3 text-gray-300">
                                <i class="fas fa-phone text-emerald-400 w-5"></i>
                                <a href="tel:+94717152955" class="hover:text-emerald-400 transition-colors">+94 71 715 2955</a>
                            </div>
                            <div class="flex items-center gap-3 text-gray-300">
                                <i class="fas fa-phone text-emerald-400 w-5"></i>
                                <a href="tel:+94372250308" class="hover:text-emerald-400 transition-colors">+94 37 225 0308</a>
                            </div>
                            <div class="flex items-center gap-3 text-gray-300">
                                <i class="fas fa-envelope text-emerald-400 w-5"></i>
                                <a href="mailto:info@sobalanka.com" class="hover:text-emerald-400 transition-colors">info@sobalanka.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Landmarks / How to Find Us -->
            <div class="max-w-4xl mx-auto mb-10">
                <div class="bg-gray-900 rounded-2xl border border-gray-800 p-6 md:p-8">
                    <h3 class="text-white text-xl font-semibold mb-6 flex items-center gap-3">
                        <i class="fas fa-route text-emerald-400"></i>
                        How to Find Us
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-car text-amber-400"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-medium mb-1">From Kurunegala</h4>
                                <p class="text-gray-400 text-sm">Take Dambulla Road, approximately 15 km from Kurunegala town</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-landmark text-blue-400"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-medium mb-1">Nearby Landmark</h4>
                                <p class="text-gray-400 text-sm">Near Melsiripura Junction on the Kurunegala-Dambulla main road</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-plane text-purple-400"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-medium mb-1">From Colombo Airport</h4>
                                <p class="text-gray-400 text-sm">Approximately 2.5 hours drive via Colombo-Kandy Expressway</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-rose-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-rose-400"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-medium mb-1">Travel Time</h4>
                                <p class="text-gray-400 text-sm">~2 hours from Colombo, ~1 hour from Kandy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Share This Page -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl border border-gray-700 p-6 md:p-8 text-center">
                    <h3 class="text-white text-xl font-semibold mb-3">Share This Location</h3>
                    <p class="text-gray-400 mb-6">Help your friends find us easily</p>
                    
                    <div class="flex flex-wrap justify-center gap-3">
                        <!-- WhatsApp Share -->
                        <a href="https://wa.me/?text=Check%20out%20Soba%20Lanka%20Holiday%20Resort%20location%3A%20{{ urlencode(url('/location')) }}" 
                           target="_blank"
                           class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl flex items-center gap-2 transition-colors">
                            <i class="fab fa-whatsapp text-xl"></i>
                            <span>WhatsApp</span>
                        </a>
                        
                        <!-- Facebook Share -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/location')) }}" 
                           target="_blank"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl flex items-center gap-2 transition-colors">
                            <i class="fab fa-facebook text-xl"></i>
                            <span>Facebook</span>
                        </a>
                        
                        <!-- Copy Link -->
                        <button onclick="copyPageLink()" 
                                id="share-btn"
                                class="bg-gray-700 hover:bg-gray-600 text-white px-5 py-3 rounded-xl flex items-center gap-2 transition-colors">
                            <i class="fas fa-link text-xl"></i>
                            <span id="share-text">Copy Link</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function copyAddress() {
    const address = "Soba Lanka Holiday Resort, Dambulla Road, Melsiripura, Kurunegala, Sri Lanka";
    navigator.clipboard.writeText(address).then(() => {
        const btn = document.getElementById('copy-btn');
        const text = document.getElementById('copy-text');
        text.textContent = 'Copied!';
        btn.classList.add('bg-emerald-600');
        btn.classList.remove('bg-gray-800');
        setTimeout(() => {
            text.textContent = 'Copy Address';
            btn.classList.remove('bg-emerald-600');
            btn.classList.add('bg-gray-800');
        }, 2000);
    });
}

function copyPageLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const text = document.getElementById('share-text');
        text.textContent = 'Copied!';
        setTimeout(() => {
            text.textContent = 'Copy Link';
        }, 2000);
    });
}
</script>

@push('styles')
<style>
    body {
        background-color: #000000;
    }
</style>
@endpush

@endsection
