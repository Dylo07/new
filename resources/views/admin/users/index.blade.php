@extends('layouts.admin')

@section('title', 'Users')
@section('page_title', 'User Management')
@section('page_subtitle', 'Total: ' . $users->total() . ' registered users')

@section('content')

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
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-900 text-emerald-200">
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
            <div class="text-3xl font-bold text-emerald-400">{{ $users->where('is_admin', true)->count() }}</div>
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
@endsection
