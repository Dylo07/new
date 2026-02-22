@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-24">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl text-white font-light mb-4">Return & Refund Policy</h1>
                <p class="text-gray-400">Last Updated: {{ date('F d, Y') }}</p>
            </div>

            <div class="bg-gray-900 rounded-lg p-8 border border-gray-800 space-y-8">
                
                <!-- Introduction -->
                <div>
                    <p class="text-gray-300 leading-relaxed">
                        At Soba Lanka, we understand that plans can change. This Return and Refund Policy outlines the terms and conditions for cancellations and refunds for bookings made through our website.
                    </p>
                </div>

                <!-- Cancellation Policy -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">1. Cancellation Policy</h2>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-800/50 p-4 rounded-lg border-l-4 border-emerald-500">
                            <h3 class="text-emerald-400 font-semibold mb-2">Free Cancellation Period</h3>
                            <p class="text-gray-300">Bookings can be cancelled free of charge up to <strong>14 days</strong> before the check-in date. A full refund will be processed within 7-10 business days.</p>
                        </div>

                        <div class="bg-gray-800/50 p-4 rounded-lg border-l-4 border-yellow-500">
                            <h3 class="text-yellow-400 font-semibold mb-2">Partial Refund Period</h3>
                            <p class="text-gray-300">Cancellations made between <strong>3-14 days</strong> before check-in will receive a 50% refund of the total booking amount.</p>
                        </div>

                        <div class="bg-gray-800/50 p-4 rounded-lg border-l-4 border-red-500">
                            <h3 class="text-red-400 font-semibold mb-2">No Refund Period</h3>
                            <p class="text-gray-300">Cancellations made within <strong>72 hours (3 days)</strong> of the check-in date are non-refundable. The full booking amount will be retained.</p>
                        </div>
                    </div>
                </div>

                <!-- Refund Process -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">2. Refund Process</h2>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>To request a cancellation, please contact us via email at <a href="mailto:info@sobalanka.com" class="text-emerald-400 hover:underline">info@sobalanka.com</a> or call us at <a href="tel:+94717152955" class="text-emerald-400 hover:underline">0717152955</a>.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Refunds will be processed to the original payment method used for booking.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>For online payments via PayHere, refunds will be credited within 7-10 business days.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>For bank transfers, refunds will be processed to the account from which payment was made within 7-10 business days.</span>
                        </li>
                    </ul>
                </div>

                <!-- Special Circumstances -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">3. Special Circumstances</h2>
                    <div class="text-gray-300 space-y-3">
                        <p><strong class="text-white">Weather or Natural Disasters:</strong> In case of extreme weather conditions or natural disasters that make travel unsafe, we will offer a full refund or the option to reschedule your booking at no additional charge.</p>
                        <p><strong class="text-white">Medical Emergencies:</strong> If you need to cancel due to a medical emergency, please provide supporting documentation (medical certificate). We will review each case individually and may offer a full or partial refund.</p>
                        <p><strong class="text-white">Hotel Closure:</strong> If we need to close the property due to unforeseen circumstances, a full refund will be issued immediately.</p>
                    </div>
                </div>

                <!-- No-Show Policy -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">4. No-Show Policy</h2>
                    <p class="text-gray-300">
                        If you do not arrive on your scheduled check-in date without prior notification, this will be considered a "no-show." No-show bookings are non-refundable, and the full booking amount will be retained.
                    </p>
                </div>

                <!-- Modification Policy -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">5. Booking Modifications</h2>
                    <p class="text-gray-300 mb-3">
                        If you wish to modify your booking dates or room type:
                    </p>
                    <ul class="space-y-2 text-gray-300 list-disc list-inside ml-4">
                        <li>Modifications are subject to availability</li>
                        <li>Changes made more than 7 days before check-in are free of charge</li>
                        <li>Changes made within 14 days may incur additional fees or rate differences</li>
                        <li>Contact us to discuss modification options</li>
                    </ul>
                </div>

                <!-- Payment Gateway Fees -->
                <div>
                    <h2 class="text-2xl text-white font-semibold mb-4">6. Payment Gateway Fees</h2>
                    <p class="text-gray-300">
                        Please note that payment gateway transaction fees (if applicable) are non-refundable. The refund amount will reflect the actual amount paid minus any third-party processing fees.
                    </p>
                </div>

                <!-- Contact Information -->
                <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-lg p-6">
                    <h2 class="text-2xl text-emerald-400 font-semibold mb-4">Questions About Cancellations?</h2>
                    <p class="text-gray-300 mb-4">
                        If you have any questions about our cancellation and refund policy, please contact us:
                    </p>
                    <div class="space-y-2 text-gray-300">
                        <p><strong class="text-white">Email:</strong> <a href="mailto:info@sobalanka.com" class="text-emerald-400 hover:underline">info@sobalanka.com</a></p>
                        <p><strong class="text-white">Phone:</strong> <a href="tel:+94717152955" class="text-emerald-400 hover:underline">071 715 2955</a></p>
                        <p><strong class="text-white">Address:</strong> Soba Lanka, Sri Lanka</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
