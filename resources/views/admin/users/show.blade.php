@extends('layouts.admin')

@section('title', 'User Details - ' . $user->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 mb-6">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Users
    </a>

    <!-- User Header -->
    <div class="bg-gray-900 rounded-lg p-8 mb-6 border border-gray-700">
        <div class="flex items-start justify-between">
            <div class="flex items-center space-x-6">
                <!-- Avatar -->
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white text-3xl font-bold">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                
                <!-- User Info -->
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $user->name }}</h1>
                    <p class="text-gray-400 mb-3">{{ $user->email }}</p>
                    <div class="flex items-center space-x-4">
                        @if($user->is_admin)
                            <span class="px-4 py-2 bg-green-900 text-green-200 rounded-lg font-semibold">
                                Administrator
                            </span>
                        @else
                            <span class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg font-semibold">
                                Regular User
                            </span>
                        @endif
                        <span class="text-gray-400">
                            Member since {{ $user->created_at->format('F Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            @if($user->id !== auth()->id())
                <div class="space-x-2">
                    <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors"
                                onclick="return confirm('Are you sure you want to change this user\'s admin status?')">
                            {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                                onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                            Delete User
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- User Details Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Contact Information -->
        <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-4">Contact Information</h2>
            <div class="space-y-4">
                <div>
                    <label class="text-gray-400 text-sm">Email Address</label>
                    <p class="text-white font-medium">{{ $user->email }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Phone Number</label>
                    <p class="text-white font-medium">{{ $user->phone ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">User ID</label>
                    <p class="text-white font-medium">#{{ $user->id }}</p>
                </div>
            </div>
        </div>

        <!-- Account Information -->
        <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-4">Account Information</h2>
            <div class="space-y-4">
                <div>
                    <label class="text-gray-400 text-sm">Registration Date</label>
                    <p class="text-white font-medium">{{ $user->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Last Updated</label>
                    <p class="text-white font-medium">{{ $user->updated_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Account Status</label>
                    <p class="text-green-400 font-medium">Active</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking History -->
    <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
        <h2 class="text-xl font-bold text-white mb-4">Booking History</h2>
        
        @if($user->bookings && $user->bookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Booking ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Room</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Check-in</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Check-out</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($user->bookings as $booking)
                            <tr class="hover:bg-gray-800">
                                <td class="px-6 py-4 text-sm text-gray-300">#{{ $booking->id }}</td>
                                <td class="px-6 py-4 text-sm text-white">{{ $booking->room->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-300">{{ $booking->check_in }}</td>
                                <td class="px-6 py-4 text-sm text-gray-300">{{ $booking->check_out }}</td>
                                <td class="px-6 py-4 text-sm text-white font-semibold">
                                    LKR {{ number_format($booking->total_price, 2) }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($booking->status === 'confirmed')
                                        <span class="px-3 py-1 bg-green-900 text-green-200 rounded-full text-xs">Confirmed</span>
                                    @elseif($booking->status === 'pending')
                                        <span class="px-3 py-1 bg-yellow-900 text-yellow-200 rounded-full text-xs">Pending</span>
                                    @elseif($booking->status === 'cancelled')
                                        <span class="px-3 py-1 bg-red-900 text-red-200 rounded-full text-xs">Cancelled</span>
                                    @else
                                        <span class="px-3 py-1 bg-blue-900 text-blue-200 rounded-full text-xs">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="mt-4 text-gray-400">No bookings found for this user</p>
            </div>
        @endif
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
        <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
            <div class="text-gray-400 text-sm mb-2">Total Bookings</div>
            <div class="text-3xl font-bold text-white">{{ $user->bookings->count() ?? 0 }}</div>
        </div>
        <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
            <div class="text-gray-400 text-sm mb-2">Confirmed</div>
            <div class="text-3xl font-bold text-green-400">
                {{ $user->bookings->where('status', 'confirmed')->count() ?? 0 }}
            </div>
        </div>
        <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
            <div class="text-gray-400 text-sm mb-2">Pending</div>
            <div class="text-3xl font-bold text-yellow-400">
                {{ $user->bookings->where('status', 'pending')->count() ?? 0 }}
            </div>
        </div>
        <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
            <div class="text-gray-400 text-sm mb-2">Total Spent</div>
            <div class="text-3xl font-bold text-blue-400">
                LKR {{ number_format($user->bookings->sum('total_price') ?? 0, 2) }}
            </div>
        </div>
    </div>
</div>
@endsection
