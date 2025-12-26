@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-24">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-gray-900 rounded-lg p-8 border border-gray-800">
            <h1 class="text-3xl text-white font-light mb-6">Confirm Your Booking</h1>
            
            <div class="space-y-4 mb-8 text-gray-300">
                <div class="flex justify-between border-b border-gray-800 pb-2">
                    <span>Package:</span>
                    <span class="text-emerald-500 font-bold">{{ $package->name }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-800 pb-2">
                    <span>Check-in:</span>
                    <span>
                        {{ $bookingData['check_in'] }}
                        <span class="text-emerald-400 text-sm">
                            @if($package->type === 'day_out')
                                (9:00 AM)
                            @else
                                (3:00 PM)
                            @endif
                        </span>
                    </span>
                </div>
                <div class="flex justify-between border-b border-gray-800 pb-2">
                    <span>Check-out:</span>
                    <span>
                        {{ $bookingData['check_out'] }}
                        <span class="text-emerald-400 text-sm">
                            @if($package->type === 'day_out')
                                (5:00 PM)
                            @elseif($package->type === 'half_board')
                                (10:00 AM)
                            @elseif($package->type === 'full_board')
                                (3:00 PM)
                            @endif
                        </span>
                    </span>
                </div>
                <div class="flex justify-between border-b border-gray-800 pb-2">
                    <span>Guests:</span>
                    <span>{{ $bookingData['adults'] }} Adults, {{ $bookingData['children'] }} Children</span>
                </div>
                <div class="flex justify-between text-xl font-bold pt-2">
                    <span class="text-white">Total Price:</span>
                    <span class="text-emerald-500">Rs {{ number_format($bookingData['total_price'], 0) }}</span>
                </div>
            </div>

            <p class="text-gray-400 text-sm mb-6 text-center">
                By clicking Confirm, you will proceed to select your payment method.
            </p>
            
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('package-builder') }}" class="block text-center bg-gray-700 text-white py-3 rounded hover:bg-gray-600 transition">
                    Cancel
                </a>
                <a href="{{ route('bookings.package.payment') }}" class="block text-center bg-emerald-600 text-white py-3 rounded hover:bg-emerald-700 transition font-bold">
                    Confirm Booking
                </a>
            </div>
        </div>
    </div>
</div>
@endsection