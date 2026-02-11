@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-24">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            
            <!-- Success Icon -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl text-white font-light mb-2">Booking Received!</h1>
                <p class="text-gray-400">Please complete the advance payment to confirm your booking</p>
            </div>

            <div class="bg-gray-900 rounded-lg p-8 border border-gray-800">
                
                <!-- Booking Reference -->
                <div class="text-center mb-8 pb-6 border-b border-gray-800">
                    <p class="text-gray-400 text-sm mb-1">Booking Reference</p>
                    <p class="text-3xl text-emerald-500 font-bold">#{{ $booking->id }}</p>
                </div>

                <!-- Booking Details -->
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between border-b border-gray-800 pb-2">
                        <span class="text-gray-400">Package</span>
                        <span class="text-white font-medium">{{ $booking->customPackage->name ?? 'Custom Booking' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-800 pb-2">
                        <span class="text-gray-400">Check-in</span>
                        <span class="text-white">
                            {{ $booking->check_in->format('M d, Y') }}
                            @if($booking->customPackage)
                                <span class="text-emerald-400 text-sm ml-1">
                                    @if($booking->customPackage->type === 'day_out')
                                        (9:00 AM)
                                    @else
                                        (3:00 PM)
                                    @endif
                                </span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between border-b border-gray-800 pb-2">
                        <span class="text-gray-400">Check-out</span>
                        <span class="text-white">
                            {{ $booking->check_out->format('M d, Y') }}
                            @if($booking->customPackage)
                                <span class="text-emerald-400 text-sm ml-1">
                                    @if($booking->customPackage->type === 'day_out')
                                        (5:00 PM)
                                    @elseif($booking->customPackage->type === 'half_board')
                                        (10:00 AM)
                                    @elseif($booking->customPackage->type === 'full_board')
                                        (3:00 PM)
                                    @endif
                                </span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between border-b border-gray-800 pb-2">
                        <span class="text-gray-400">Guests</span>
                        <span class="text-white">
                            {{ $booking->guests }} Adults
                            @if(isset($booking->package_details['children']) && $booking->package_details['children'] > 0)
                                , {{ $booking->package_details['children'] }} Children
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-xl font-bold pt-2">
                        <span class="text-white">Total Amount</span>
                        <span class="text-emerald-500">Rs {{ number_format($booking->total_price, 0) }}</span>
                    </div>
                </div>

                <!-- Payment Info -->
                @if($booking->payment_method === 'bank_transfer')
                <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-lg p-6 mb-8">
                    <h3 class="text-emerald-400 font-semibold mb-4">Payment Information</h3>
                    
                    @if($booking->payment_receipt)
                        <div class="flex items-center text-emerald-400 mb-4">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Payment receipt uploaded successfully!
                        </div>
                    @else
                        <p class="text-gray-300 mb-4">Please transfer the amount to the following account:</p>
                        
                        <div class="space-y-2 text-gray-300 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Account Name</span>
                                <span>Dilanka Gamlath</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Account Number</span>
                                <span class="font-mono font-bold">8160092768</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Bank</span>
                                <span>Commercial Bank of Ceylon</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Branch</span>
                                <span>Kurunegala (Code: 16)</span>
                            </div>
                        </div>

                        <div class="p-3 bg-yellow-500/10 border border-yellow-500/30 rounded text-yellow-400 text-sm">
                            <strong>Reference:</strong> Please use Booking #{{ $booking->id }} as your payment reference.
                        </div>
                    @endif
                </div>
                @endif

                <!-- Next Steps -->
                <div class="bg-gray-800/50 rounded-lg p-6 mb-8">
                    <h3 class="text-white font-semibold mb-4">What's Next?</h3>
                    <ul class="space-y-3 text-gray-300 text-sm">
                        <li class="flex items-start">
                            <span class="w-6 h-6 bg-emerald-500/20 text-emerald-500 rounded-full flex items-center justify-center text-xs mr-3 mt-0.5">1</span>
                            <span>A booking details email has been sent to your registered email address.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-6 h-6 bg-yellow-500/20 text-yellow-500 rounded-full flex items-center justify-center text-xs mr-3 mt-0.5">2</span>
                            <span><strong class="text-yellow-400">Pay the advance payment</strong> using the bank details above and upload the receipt from your profile page.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="w-6 h-6 bg-emerald-500/20 text-emerald-500 rounded-full flex items-center justify-center text-xs mr-3 mt-0.5">3</span>
                            <span>Once we verify your payment, you will receive a <strong class="text-emerald-400">Booking Confirmed</strong> email.</span>
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('profile') }}" class="block text-center bg-gray-700 text-white py-4 rounded-lg hover:bg-gray-600 transition font-semibold">
                        View My Bookings
                    </a>
                    <a href="{{ route('home') }}" class="block text-center bg-emerald-600 text-white py-4 rounded-lg hover:bg-emerald-700 transition font-bold">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
