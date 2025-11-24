@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">User Management</h1>
            <p class="text-gray-400">Manage all registered users</p>
        </div>
        <div class="text-white">
            <span class="text-2xl font-bold">{{ $users->total() }}</span>
            <span class="text-gray-400 ml-2">Total Users</span>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg mb-6 flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-white hover:text-gray-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white px-6 py-4 rounded-lg mb-6 flex items-center justify-between">
            <span>{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="text-white hover:text-gray-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- Users Table -->
    <div class="bg-gray-900 rounded-lg shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Phone
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Role
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Registered
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-800 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                #{{ $user->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-white">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ $user->phone ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->is_admin)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-900 text-green-200">
                                        Admin
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-700 text-gray-300">
                                        User
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('admin.users.show', $user) }}" 
                                   class="text-blue-400 hover:text-blue-300">
                                    View
                                </a>
                                
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.toggle-admin', $user) }}" 
                                          method="POST" 
                                          class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="text-yellow-400 hover:text-yellow-300"
                                                onclick="return confirm('Are you sure you want to change this user\'s admin status?')">
                                            {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.users.destroy', $user) }}" 
                                          method="POST" 
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-400 hover:text-red-300"
                                                onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">(You)</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-400">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="bg-gray-800 px-6 py-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
        <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
            <div class="text-gray-400 text-sm mb-2">Total Users</div>
            <div class="text-3xl font-bold text-white">{{ $users->total() }}</div>
        </div>
        <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
            <div class="text-gray-400 text-sm mb-2">Admin Users</div>
            <div class="text-3xl font-bold text-green-400">{{ $users->where('is_admin', true)->count() }}</div>
        </div>
        <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
            <div class="text-gray-400 text-sm mb-2">Regular Users</div>
            <div class="text-3xl font-bold text-blue-400">{{ $users->where('is_admin', false)->count() }}</div>
        </div>
        <div class="bg-gray-900 rounded-lg p-6 border border-gray-700">
            <div class="text-gray-400 text-sm mb-2">New This Month</div>
            <div class="text-3xl font-bold text-purple-400">
                {{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-hide success/error messages after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.bg-green-500, .bg-red-500');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
</script>
@endpush
@endsection
