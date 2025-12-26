@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="container mx-auto px-4">
        
        <!-- Header with Stats -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-light text-white">My Bookings</h1>
                    <p class="text-gray-400">Welcome back, <span class="text-emerald-500">{{ $user->name }}</span></p>
                </div>
                <a href="{{ route('package-builder') }}" class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Booking
                </a>
            </div>
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-gradient-to-br from-emerald-600/20 to-emerald-600/5 rounded-xl p-4 border border-emerald-500/30">
                    <p class="text-emerald-400 text-xs uppercase tracking-wider">Active Bookings</p>
                    <p class="text-3xl text-white font-bold mt-1">{{ $user->bookings->where('status', '!=', 'completed')->where('status', '!=', 'cancelled')->count() }}</p>
                </div>
                <div class="bg-gradient-to-br from-blue-600/20 to-blue-600/5 rounded-xl p-4 border border-blue-500/30">
                    <p class="text-blue-400 text-xs uppercase tracking-wider">Total Bookings</p>
                    <p class="text-3xl text-white font-bold mt-1">{{ $user->bookings->count() }}</p>
                </div>
                <div class="bg-gradient-to-br from-yellow-600/20 to-yellow-600/5 rounded-xl p-4 border border-yellow-500/30">
                    <p class="text-yellow-400 text-xs uppercase tracking-wider">Pending Payment</p>
                    <p class="text-3xl text-white font-bold mt-1">{{ $user->bookings->where('payment_status', 'pending')->count() }}</p>
                </div>
                <div class="bg-gradient-to-br from-purple-600/20 to-purple-600/5 rounded-xl p-4 border border-purple-500/30">
                    <p class="text-purple-400 text-xs uppercase tracking-wider">Total Spent</p>
                    <p class="text-2xl text-white font-bold mt-1">Rs {{ number_format($user->bookings->where('status', '!=', 'cancelled')->sum('total_price'), 0) }}</p>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-emerald-500/10 border border-emerald-500 text-emerald-500 px-4 py-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded-lg text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Main Content: Bookings First -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Bookings Section - Takes 3 columns -->
            <div class="lg:col-span-3 space-y-6">
                
                <div class="bg-gray-900 rounded-lg p-6 border border-gray-800 min-h-[300px]">
                    <div class="flex justify-between items-center mb-6 border-b border-gray-800 pb-2">
                        <h2 class="text-xl text-white font-light">My Bookings</h2>
                        <span class="bg-emerald-500/10 text-emerald-500 text-xs px-2 py-1 rounded">
                            Active: {{ $user->bookings->where('status', '!=', 'completed')->where('status', '!=', 'cancelled')->count() }}
                        </span>
                    </div>

                    @if($user->bookings && $user->bookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($user->bookings->sortByDesc('created_at') as $booking)
                                <div class="bg-gray-800/40 rounded-lg p-4 border border-gray-700 hover:border-emerald-500/50 transition">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="text-emerald-400 font-bold text-lg">
                                                @if($booking->customPackage)
                                                    {{ $booking->customPackage->name }}
                                                @elseif($booking->room)
                                                    {{ $booking->room->name }}
                                                @else
                                                    Custom Booking
                                                @endif
                                            </h3>
                                            <p class="text-xs text-gray-500">Order ID: #{{ $booking->id }}</p>
                                        </div>
                                        
                                        <span class="px-3 py-1 rounded-full text-xs font-bold capitalize
                                            {{ $booking->status === 'confirmed' ? 'bg-emerald-500/20 text-emerald-500' : '' }}
                                            {{ $booking->status === 'pending' ? 'bg-yellow-500/20 text-yellow-500' : '' }}
                                            {{ $booking->status === 'cancelled' ? 'bg-red-500/20 text-red-500' : '' }}
                                            {{ $booking->status === 'completed' ? 'bg-blue-500/20 text-blue-500' : '' }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-300 mb-3 bg-black/20 p-3 rounded">
                                        <div>
                                            <span class="text-gray-500 block text-xs uppercase tracking-wider">Check-in</span>
                                            <span class="font-medium">{{ $booking->check_in->format('M d, Y') }}</span>
                                            @if($booking->customPackage)
                                                @if($booking->customPackage->type === 'day_out')
                                                    <span class="text-emerald-400 text-xs block">9:00 AM</span>
                                                @else
                                                    <span class="text-emerald-400 text-xs block">3:00 PM</span>
                                                @endif
                                            @endif
                                        </div>
                                        <div>
                                            <span class="text-gray-500 block text-xs uppercase tracking-wider">Check-out</span>
                                            <span class="font-medium">{{ $booking->check_out->format('M d, Y') }}</span>
                                            @if($booking->customPackage)
                                                @if($booking->customPackage->type === 'day_out')
                                                    <span class="text-emerald-400 text-xs block">5:00 PM</span>
                                                @elseif($booking->customPackage->type === 'half_board')
                                                    <span class="text-emerald-400 text-xs block">10:00 AM</span>
                                                @elseif($booking->customPackage->type === 'full_board')
                                                    <span class="text-emerald-400 text-xs block">3:00 PM</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Payment Status Section -->
                                    @if($booking->payment_method)
                                    <div class="mb-3 p-3 bg-black/30 rounded border border-gray-700">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-gray-400 text-xs uppercase tracking-wider">Payment</span>
                                            <span class="px-2 py-0.5 rounded text-xs font-medium
                                                {{ $booking->payment_status === 'verified' ? 'bg-emerald-500/20 text-emerald-400' : '' }}
                                                {{ $booking->payment_status === 'uploaded' ? 'bg-blue-500/20 text-blue-400' : '' }}
                                                {{ $booking->payment_status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : '' }}">
                                                {{ ucfirst($booking->payment_status ?? 'Pending') }}
                                            </span>
                                        </div>
                                        <p class="text-gray-300 text-sm">
                                            {{ $booking->payment_method === 'bank_transfer' ? 'Bank Transfer' : 'Card Payment' }}
                                        </p>
                                        
                                        @if($booking->payment_receipt)
                                            <div class="mt-2 flex items-center text-emerald-400 text-xs">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Receipt Uploaded
                                                <a href="{{ asset('storage/' . $booking->payment_receipt) }}" target="_blank" class="ml-2 underline hover:text-emerald-300">View</a>
                                            </div>
                                        @elseif($booking->payment_method === 'bank_transfer' && $booking->status !== 'cancelled')
                                            <!-- Upload Receipt Form -->
                                            <form action="{{ route('bookings.upload-receipt', $booking) }}" method="POST" enctype="multipart/form-data" class="mt-3" id="receipt-form-{{ $booking->id }}">
                                                @csrf
                                                <div class="space-y-2">
                                                    <input type="file" name="payment_receipt" id="receipt-input-{{ $booking->id }}" accept="image/*,.pdf" class="block w-full text-xs text-gray-400 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 file:cursor-pointer" required>
                                                    <button type="submit" class="w-full flex items-center justify-center px-3 py-2 bg-emerald-600 rounded text-white text-xs font-medium hover:bg-emerald-700 transition">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                        </svg>
                                                        Upload Receipt
                                                    </button>
                                                </div>
                                            </form>
                                            
                                            <!-- Bank Details Reminder -->
                                            <div class="mt-3 p-2 bg-yellow-500/10 border border-yellow-500/30 rounded text-xs">
                                                <p class="text-yellow-400 font-medium mb-1">Bank Details:</p>
                                                <p class="text-gray-400">Soba Lanka Holiday Resort (PVT) LTD</p>
                                                <p class="text-gray-400">ACC: 0090201000175926</p>
                                                <p class="text-gray-400">Union Bank - Kurunegala</p>
                                            </div>
                                        @endif
                                    </div>
                                    @endif

                                    <div class="flex justify-between items-center pt-2">
                                        <div class="text-xs text-gray-400">
                                            {{ $booking->guests }} Guests 
                                            @if(isset($booking->package_details['children']) && $booking->package_details['children'] > 0)
                                                (+{{ $booking->package_details['children'] }} Kids)
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <span class="text-white font-bold text-lg">Rs {{ number_format($booking->total_price, 0) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center h-48 text-gray-500 space-y-3">
                            <svg class="w-12 h-12 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p>You have no active bookings.</p>
                            <a href="{{ route('package-builder') }}" class="text-emerald-500 hover:underline text-sm">Book a stay now &rarr;</a>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Profile Settings Sidebar - Takes 1 column -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Profile Card -->
                <div class="bg-gray-900 rounded-lg p-6 border border-gray-800">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-emerald-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-2xl text-white font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <h3 class="text-white font-semibold">{{ $user->name }}</h3>
                        <p class="text-gray-400 text-sm">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Profile Settings (Collapsible) -->
                <details class="bg-gray-900 rounded-lg border border-gray-800 group">
                    <summary class="p-4 cursor-pointer flex justify-between items-center text-white font-light hover:bg-gray-800/50 rounded-lg transition">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Edit Profile
                        </span>
                        <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </summary>
                    <div class="p-4 pt-0 border-t border-gray-800">
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-3">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-gray-400 text-xs mb-1">Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                       class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white text-sm focus:outline-none focus:border-emerald-500">
                            </div>

                            <div>
                                <label class="block text-gray-400 text-xs mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                       class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white text-sm focus:outline-none focus:border-emerald-500">
                            </div>

                            <div>
                                <label class="block text-gray-400 text-xs mb-1">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" 
                                       class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white text-sm focus:outline-none focus:border-emerald-500">
                            </div>

                            <button type="submit" class="w-full bg-emerald-600 text-white py-2 rounded text-sm font-medium hover:bg-emerald-700 transition">
                                Update Profile
                            </button>
                        </form>
                    </div>
                </details>

                <!-- Security Settings (Collapsible) -->
                <details class="bg-gray-900 rounded-lg border border-gray-800 group">
                    <summary class="p-4 cursor-pointer flex justify-between items-center text-white font-light hover:bg-gray-800/50 rounded-lg transition">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Change Password
                        </span>
                        <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </summary>
                    <div class="p-4 pt-0 border-t border-gray-800">
                        <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-3">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-gray-400 text-xs mb-1">Current Password</label>
                                <input type="password" name="current_password" 
                                       class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white text-sm focus:outline-none focus:border-emerald-500">
                            </div>

                            <div>
                                <label class="block text-gray-400 text-xs mb-1">New Password</label>
                                <input type="password" name="password" 
                                       class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white text-sm focus:outline-none focus:border-emerald-500">
                            </div>

                            <div>
                                <label class="block text-gray-400 text-xs mb-1">Confirm Password</label>
                                <input type="password" name="password_confirmation" 
                                       class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white text-sm focus:outline-none focus:border-emerald-500">
                            </div>

                            <button type="submit" class="w-full bg-gray-600 text-white py-2 rounded text-sm font-medium hover:bg-gray-500 transition">
                                Change Password
                            </button>
                        </form>
                    </div>
                </details>

                <!-- Bank Details Quick Reference -->
                <div class="bg-gradient-to-br from-yellow-600/10 to-yellow-600/5 rounded-lg p-4 border border-yellow-500/30">
                    <h4 class="text-yellow-400 text-sm font-medium mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                        </svg>
                        Bank Details for Payment
                    </h4>
                    <div class="text-xs text-gray-400 space-y-1">
                        <p><span class="text-gray-500">Name:</span> Soba Lanka Holiday Resort (PVT) LTD</p>
                        <p><span class="text-gray-500">ACC:</span> <span class="text-white font-mono">0090201000175926</span></p>
                        <p><span class="text-gray-500">Bank:</span> Union Bank of Colombo PLC</p>
                        <p><span class="text-gray-500">Branch:</span> Kurunegala</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection