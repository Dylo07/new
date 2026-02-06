@extends('layouts.admin')

@section('title', 'Menu Manager')
@section('page_title', 'Menu Categories')
@section('page_subtitle', 'Manage food & beverage menu categories')

@section('page_actions')
    <a href="{{ route('admin.menu-categories.create') }}" 
       class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg flex items-center gap-2 text-sm font-medium transition">
        <i class="fas fa-plus"></i> Add Category
    </a>
@endsection

@section('content')
        <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
            @if($categories->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-800 text-gray-400 text-sm uppercase">
                                <th class="px-6 py-4 w-16">#</th>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4">Description</th>
                                <th class="px-6 py-4 text-center">Menu Image</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800" id="sortable-categories">
                            @foreach($categories as $category)
                                <tr class="hover:bg-gray-800/50 transition" data-id="{{ $category->id }}">
                                    <td class="px-6 py-4 text-gray-500 cursor-move">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            @if($category->image_path)
                                                <img src="{{ asset('storage/' . $category->image_path) }}" 
                                                     alt="{{ $category->name }}" 
                                                     class="w-12 h-12 rounded-lg object-cover">
                                            @else
                                                <div class="w-12 h-12 rounded-lg bg-{{ $category->color }}-500/20 flex items-center justify-center">
                                                    <i class="fas {{ $category->icon }} text-{{ $category->color }}-400"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="text-white font-medium">{{ $category->name }}</div>
                                                <div class="text-gray-500 text-sm">/menu/{{ $category->slug }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 text-sm max-w-xs truncate">
                                        {{ $category->description ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($category->menu_image_path)
                                            <a href="{{ asset('storage/' . $category->menu_image_path) }}" target="_blank" 
                                               class="text-emerald-400 hover:text-emerald-300 text-sm">
                                                <i class="fas fa-file-image mr-1"></i> View
                                            </a>
                                        @else
                                            <span class="text-gray-500 text-sm">Not uploaded</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('admin.menu-categories.toggle-status', $category) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-3 py-1 rounded-full text-xs font-bold transition
                                                {{ $category->is_active ? 'bg-emerald-500/20 text-emerald-500 hover:bg-emerald-500/30' : 'bg-red-500/20 text-red-500 hover:bg-red-500/30' }}">
                                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('menu.show', $category->slug) }}" target="_blank"
                                               class="text-gray-400 hover:text-white transition" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.menu-categories.edit', $category) }}" 
                                               class="text-blue-400 hover:text-blue-300 transition" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.menu-categories.destroy', $category) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 transition" 
                                                        onclick="return confirm('Delete this category?')" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-16">
                    <i class="fas fa-utensils text-gray-600 text-5xl mb-4"></i>
                    <h3 class="text-white text-xl mb-2">No Menu Categories</h3>
                    <p class="text-gray-400 mb-6">Get started by creating your first menu category.</p>
                    <a href="{{ route('admin.menu-categories.create') }}" 
                       class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg inline-flex items-center gap-2 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add First Category
                    </a>
                </div>
            @endif
        </div>

        <div class="mt-6 text-gray-500 text-sm">
            <i class="fas fa-info-circle mr-1"></i>
            Drag and drop rows to reorder categories. Changes are saved automatically.
        </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('sortable-categories');
    if (el) {
        new Sortable(el, {
            animation: 150,
            handle: 'td:first-child',
            onEnd: function() {
                const ids = Array.from(document.querySelectorAll('#sortable-categories tr')).map(row => row.dataset.id);
                fetch('{{ route("admin.menu-categories.sort") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ categories: ids })
                });
            }
        });
    }
});
</script>
@endpush
@endsection
