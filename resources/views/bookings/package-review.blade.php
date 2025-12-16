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
                    <span>Dates:</span>
                    <span>{{ $bookingData['check_in'] }} to {{ $bookingData['check_out'] }}</span>
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

            <form action="{{ route('bookings.package.store') }}" method="POST">
                @csrf
                <p class="text-gray-400 text-sm mb-6 text-center">
                    By clicking Confirm, our team will receive your request and call you shortly to arrange the advance payment.
                </p>
                
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('package-builder') }}" class="block text-center bg-gray-700 text-white py-3 rounded hover:bg-gray-600 transition">
                        Cancel
                    </a>
                    <button type="submit" class="block w-full text-center bg-emerald-600 text-white py-3 rounded hover:bg-emerald-700 transition font-bold">
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection