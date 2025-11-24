@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="container mx-auto px-4">
        
        <div class="mb-8">
            <h1 class="text-3xl font-light text-white">My Dashboard</h1>
            <p class="text-gray-400">Welcome back, <span class="text-green-500">{{ $user->name }}</span></p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-8">
                
                <div class="bg-gray-900 rounded-lg p-6 border border-gray-800">
                    <h2 class="text-xl text-white font-light mb-6 border-b border-gray-800 pb-2">Profile Settings</h2>
                    
                    @if(session('success'))
                        <div class="mb-4 bg-green-500/10 border border-green-500 text-green-500 px-4 py-2 rounded text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-gray-400 text-sm mb-1">Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white focus:outline-none focus:border-green-500">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-400 text-sm mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white focus:outline-none focus:border-green-500">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-400 text-sm mb-1">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white focus:outline-none focus:border-green-500">
                            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded transition">
                            Update Profile
                        </button>
                    </form>
                </div>

                <div class="bg-gray-900 rounded-lg p-6 border border-gray-800">
                    <h2 class="text-xl text-white font-light mb-6 border-b border-gray-800 pb-2">Security</h2>
                    
                    <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-gray-400 text-sm mb-1">Current Password</label>
                            <input type="password" name="current_password" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white focus:outline-none focus:border-green-500">
                            @error('current_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-400 text-sm mb-1">New Password</label>
                            <input type="password" name="password" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white focus:outline-none focus:border-green-500">
                            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-400 text-sm mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 text-white focus:outline-none focus:border-green-500">
                        </div>

                        <button type="submit" class="w-full bg-gray-800 hover:bg-gray-700 text-white border border-gray-600 py-2 rounded transition">
                            Change Password
                        </button>
                    </form>
                </div>

            </div>

            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-gray-900 rounded-lg p-6 border border-gray-800 min-h-[300px]">
                    <div class="flex justify-between items-center mb-6 border-b border-gray-800 pb-2">
                        <h2 class="text-xl text-white font-light">My Bookings</h2>
                        <span class="bg-green-500/10 text-green-500 text-xs px-2 py-1 rounded">Upcoming: 0</span>
                    </div>

                    <div class="flex flex-col items-center justify-center h-48 text-gray-500 space-y-3">
                        <svg class="w-12 h-12 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p>You have no active bookings.</p>
                        <a href="{{ route('rooms.index') }}" class="text-green-500 hover:underline text-sm">Book a stay now &rarr;</a>
                    </div>
                </div>

                <div class="bg-gray-900 rounded-lg p-6 border border-gray-800 min-h-[300px]">
                    <h2 class="text-xl text-white font-light mb-6 border-b border-gray-800 pb-2">Spendings & History</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-800/50 p-4 rounded border border-gray-800">
                            <p class="text-gray-400 text-sm">Total Spent</p>
                            <p class="text-2xl text-white font-bold mt-1">LKR 0.00</p>
                        </div>

                        <div class="bg-gray-800/50 p-4 rounded border border-gray-800">
                            <p class="text-gray-400 text-sm">Total Nights</p>
                            <p class="text-2xl text-white font-bold mt-1">0</p>
                        </div>
                    </div>
                    
                    <div class="mt-8 text-center text-gray-500 text-sm italic">
                        Detailed transaction history will appear here once you start booking.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection