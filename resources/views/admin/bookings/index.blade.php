@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="container mx-auto px-4">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-light text-white">Booking Management</h1>
            <div class="text-gray-400">
                Total Bookings: <span class="text-white font-bold">{{ $bookings->total() }}</span>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500 text-emerald-500 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-gray-900 rounded-lg border border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-800 text-gray-400 text-sm uppercase">
                            <th class="px-6 py-4">Order ID</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Package / Room</th>
                            <th class="px-6 py-4">Dates</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Payment</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-gray-800/50 transition">
                                <td class="px-6 py-4 text-gray-300">
                                    #{{ $booking->id }}
                                    <div class="text-xs text-gray-500">{{ $booking->created_at->format('M d, Y H:i') }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-white font-medium">{{ $booking->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                                    <a href="tel:{{ $booking->user->phone }}" class="text-sm text-emerald-500 hover:underline">
                                        {{ $booking->user->phone ?? 'No Phone' }}
                                    </a>
                                </td>

                                <td class="px-6 py-4 text-gray-300">
                                    @if($booking->customPackage)
                                        <span class="text-emerald-400 font-medium">{{ $booking->customPackage->name }}</span>
                                        <div class="text-xs text-gray-500">
                                            {{ $booking->guests }} Guests 
                                            @if(!empty($booking->package_details['children']))
                                                (+{{ $booking->package_details['children'] }} Kids)
                                            @endif
                                        </div>
                                    @elseif($booking->room)
                                        <span class="text-blue-400 font-medium">{{ $booking->room->name }}</span>
                                    @else
                                        <span class="text-red-400">Unknown Item</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-gray-300">
                                    <div>In: {{ $booking->check_in->format('M d') }}</div>
                                    <div>Out: {{ $booking->check_out->format('M d') }}</div>
                                </td>

                                <td class="px-6 py-4 text-white font-bold">
                                    Rs {{ number_format($booking->total_price, 0) }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($booking->payment_method)
                                        <div class="text-xs text-gray-400 mb-1">
                                            {{ $booking->payment_method === 'bank_transfer' ? 'Bank Transfer' : 'Card' }}
                                        </div>
                                        <span class="px-2 py-0.5 rounded text-xs font-medium
                                            {{ $booking->payment_status === 'verified' ? 'bg-emerald-500/20 text-emerald-400' : '' }}
                                            {{ $booking->payment_status === 'uploaded' ? 'bg-blue-500/20 text-blue-400' : '' }}
                                            {{ $booking->payment_status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : '' }}">
                                            {{ ucfirst($booking->payment_status ?? 'Pending') }}
                                        </span>
                                        @if($booking->payment_receipt)
                                            <a href="{{ asset('storage/' . $booking->payment_receipt) }}" target="_blank" class="block text-xs text-emerald-400 hover:underline mt-1">
                                                View Receipt
                                            </a>
                                        @endif
                                    @else
                                        <span class="text-gray-500 text-xs">N/A</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        {{ $booking->status === 'confirmed' ? 'bg-emerald-500/20 text-emerald-500' : '' }}
                                        {{ $booking->status === 'pending' ? 'bg-yellow-500/20 text-yellow-500' : '' }}
                                        {{ $booking->status === 'cancelled' ? 'bg-red-500/20 text-red-500' : '' }}
                                        {{ $booking->status === 'completed' ? 'bg-blue-500/20 text-blue-500' : '' }}
                                    ">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($booking->status === 'pending')
                                            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1 rounded text-xs" onclick="return confirm('Confirm this booking?')">
                                                    Confirm
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs" onclick="return confirm('Cancel this booking?')">
                                                    Cancel
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-gray-500 hover:text-red-500" onclick="return confirm('Delete this record permanently?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                    No bookings found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-800">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection