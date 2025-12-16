{{-- resources/views/admin/packages/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manage Packages')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Manage Packages</h1>
        <div class="flex gap-4">
            <button id="sortModeBtn" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 transition-colors duration-300">
                <i class="fas fa-sort mr-2"></i>Sort Mode
            </button>
            <a href="{{ route('admin.packages.create') }}" 
               class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                <i class="fas fa-plus mr-2"></i>Add New Package
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Sort Mode Instructions -->
    <div id="sortInstructions" class="hidden bg-purple-50 border border-purple-200 text-purple-800 px-4 py-3 rounded mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                <span><strong>Sort Mode Active:</strong> Drag and drop packages to reorder. Changes are saved automatically.</span>
            </div>
            <button id="exitSortMode" class="text-purple-600 hover:text-purple-800">
                <i class="fas fa-times"></i> Exit Sort Mode
            </button>
        </div>
    </div>

    <!-- Package Type Tabs -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" id="package-tabs">
                <button class="tab-button active border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600" 
                        data-type="all">
                    All Packages ({{ $packages->count() }})
                </button>
                <button class="tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" 
                        data-type="couple">
                    Couple ({{ $packages->where('type', 'couple')->count() }})
                </button>
                <button class="tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" 
                        data-type="family">
                    Family ({{ $packages->where('type', 'family')->count() }})
                </button>
                <button class="tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" 
                        data-type="group">
                    Group ({{ $packages->where('type', 'group')->count() }})
                </button>
                <button class="tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" 
                        data-type="wedding">
                    Wedding ({{ $packages->where('type', 'wedding')->count() }})
                </button>
                <button class="tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" 
                        data-type="engagement">
                    Engagement ({{ $packages->where('type', 'engagement')->count() }})
                </button>
                <button class="tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" 
                        data-type="birthday">
                    Birthday ({{ $packages->where('type', 'birthday')->count() }})
                </button>
                <button class="tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" 
                        data-type="honeymoon">
                    Honeymoon ({{ $packages->where('type', 'honeymoon')->count() }})
                </button>
            </nav>
        </div>
    </div>

    <!-- Packages List -->
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200" id="packages-list">
            @forelse($packages as $package)
                <li class="package-item cursor-default" data-type="{{ $package->type }}" data-id="{{ $package->id }}">
                    <div class="px-4 py-4 flex items-center justify-between">
                        <!-- Drag Handle (Hidden by default) -->
                        <div class="drag-handle hidden mr-4 cursor-move text-gray-400 hover:text-gray-600">
                            <i class="fas fa-grip-vertical text-lg"></i>
                        </div>

                        <div class="flex items-center flex-1">
                            <!-- Sort Order Badge -->
                            <div class="sort-order-badge bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs font-medium mr-3">
                                #{{ $package->sort_order }}
                            </div>

                            <div class="flex-shrink-0 h-20 w-20">
                                @if($package->image_path)
                                    <img class="h-20 w-20 rounded-lg object-cover" 
                                         src="{{ asset('storage/' . $package->image_path) }}" 
                                         alt="{{ $package->name }}">
                                @else
                                    <div class="h-20 w-20 rounded-lg bg-gray-300 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-500 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $package->name }}</h3>
                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
    @if($package->type === 'couple') bg-pink-100 text-pink-800
    @elseif($package->type === 'family') bg-purple-100 text-purple-800
    @elseif($package->type === 'group') bg-emerald-100 text-emerald-800
    @elseif($package->type === 'wedding') bg-indigo-100 text-indigo-800
    @elseif($package->type === 'engagement') bg-pink-100 text-pink-800
    @elseif($package->type === 'birthday') bg-yellow-100 text-yellow-800
    @elseif($package->type === 'honeymoon') bg-red-100 text-red-800
    @endif">
    {{ ucfirst($package->type) }}
</span>
                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $package->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $package->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">{{ Str::limit($package->description, 100) }}</p>
                                <div class="flex items-center mt-2 text-sm text-gray-500">
                                    <span class="font-semibold text-gray-900">Rs.{{ number_format($package->price, 0) }}</span>
                                    @if($package->location)
                                        <span class="ml-4">📍 {{ $package->location }}</span>
                                    @endif
                                    @if($package->min_guests)
                                        <span class="ml-4">👥 Min: {{ $package->min_guests }} guests</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="action-buttons flex items-center space-x-3">
                            <!-- Toggle Status -->
                            <form action="{{ route('admin.packages.toggle-status', $package) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="text-sm px-3 py-1 rounded {{ $package->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' }}">
                                    {{ $package->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            
                            <!-- View -->
                            <a href="{{ route('admin.packages.show', $package) }}" 
                               class="text-blue-600 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <!-- Edit -->
                            <a href="{{ route('admin.packages.edit', $package) }}" 
                               class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <!-- Delete -->
                            <form action="{{ route('admin.packages.destroy', $package) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this package?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @empty
                <li class="px-4 py-8 text-center text-gray-500">
                    <i class="fas fa-box-open text-4xl mb-4"></i>
                    <p>No packages found. <a href="{{ route('admin.packages.create') }}" class="text-blue-600 hover:text-blue-800">Create your first package</a>.</p>
                </li>
            @endforelse
        </ul>
    </div>
</div>

<!-- Include SortableJS from CDN -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.3/Sortable.min.js"></script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const packageItems = document.querySelectorAll('.package-item');
    const sortModeBtn = document.getElementById('sortModeBtn');
    const exitSortModeBtn = document.getElementById('exitSortMode');
    const sortInstructions = document.getElementById('sortInstructions');
    const packagesList = document.getElementById('packages-list');
    
    let sortable = null;
    let isSortMode = false;

    // Tab functionality
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const type = this.dataset.type;

            // Update active tab
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            this.classList.add('active', 'border-blue-500', 'text-blue-600');
            this.classList.remove('border-transparent', 'text-gray-500');

            // Filter packages
            packageItems.forEach(item => {
                if (type === 'all' || item.dataset.type === type) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });

            // Re-initialize sortable if in sort mode
            if (isSortMode) {
                initializeSortable();
            }
        });
    });

    // Sort mode functionality
    sortModeBtn.addEventListener('click', function() {
        toggleSortMode(true);
    });

    exitSortModeBtn.addEventListener('click', function() {
        toggleSortMode(false);
    });

    function toggleSortMode(enable) {
        isSortMode = enable;
        
        if (enable) {
            // Enable sort mode
            sortModeBtn.classList.add('hidden');
            sortInstructions.classList.remove('hidden');
            
            // Show drag handles
            document.querySelectorAll('.drag-handle').forEach(handle => {
                handle.classList.remove('hidden');
            });
            
            // Hide action buttons during sorting
            document.querySelectorAll('.action-buttons').forEach(buttons => {
                buttons.classList.add('hidden');
            });
            
            // Add sorting class to items
            packageItems.forEach(item => {
                item.classList.add('cursor-move', 'hover:bg-gray-50');
                item.classList.remove('cursor-default');
            });
            
            initializeSortable();
        } else {
            // Disable sort mode
            sortModeBtn.classList.remove('hidden');
            sortInstructions.classList.add('hidden');
            
            // Hide drag handles
            document.querySelectorAll('.drag-handle').forEach(handle => {
                handle.classList.add('hidden');
            });
            
            // Show action buttons
            document.querySelectorAll('.action-buttons').forEach(buttons => {
                buttons.classList.remove('hidden');
            });
            
            // Remove sorting class from items
            packageItems.forEach(item => {
                item.classList.remove('cursor-move', 'hover:bg-gray-50');
                item.classList.add('cursor-default');
            });
            
            if (sortable) {
                sortable.destroy();
            }
        }
    }

    function initializeSortable() {
        if (sortable) {
            sortable.destroy();
        }
        
        sortable = Sortable.create(packagesList, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'bg-blue-50',
            chosenClass: 'bg-blue-100',
            dragClass: 'opacity-50',
            filter: function(evt, item) {
                // Only allow sorting of visible items
                return item.style.display === 'none';
            },
            onEnd: function(evt) {
                if (evt.oldIndex !== evt.newIndex) {
                    updateSortOrder();
                }
            }
        });
    }

    function updateSortOrder() {
        const visibleItems = Array.from(packageItems).filter(item => item.style.display !== 'none');
        const packageIds = visibleItems.map(item => item.dataset.id);
        
        // Show loading state
        const originalText = sortInstructions.innerHTML;
        sortInstructions.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-spinner fa-spin mr-2"></i>
                <span>Saving new order...</span>
            </div>
        `;
        
        // Send AJAX request to update sort order
        fetch("{{ route('admin.packages.sort') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                packages: packageIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update sort order badges
                visibleItems.forEach((item, index) => {
                    const badge = item.querySelector('.sort-order-badge');
                    if (badge) {
                        badge.textContent = `#${index + 1}`;
                    }
                });
                
                // Show success message
                sortInstructions.innerHTML = `
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-emerald-600 mr-2"></i>
                            <span><strong>Sort Mode Active:</strong> Order updated successfully! Drag and drop packages to reorder.</span>
                        </div>
                        <button id="exitSortMode" class="text-purple-600 hover:text-purple-800">
                            <i class="fas fa-times"></i> Exit Sort Mode
                        </button>
                    </div>
                `;
                
                // Re-attach exit button event
                document.getElementById('exitSortMode').addEventListener('click', function() {
                    toggleSortMode(false);
                });
                
                // Reset to original message after 3 seconds
                setTimeout(() => {
                    sortInstructions.innerHTML = originalText;
                    // Re-attach exit button event
                    document.getElementById('exitSortMode').addEventListener('click', function() {
                        toggleSortMode(false);
                    });
                }, 3000);
            } else {
                // Show error message
                sortInstructions.innerHTML = `
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                            <span><strong>Error:</strong> Failed to update order. Please try again.</span>
                        </div>
                        <button id="exitSortMode" class="text-purple-600 hover:text-purple-800">
                            <i class="fas fa-times"></i> Exit Sort Mode
                        </button>
                    </div>
                `;
                
                // Re-attach exit button event
                document.getElementById('exitSortMode').addEventListener('click', function() {
                    toggleSortMode(false);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            sortInstructions.innerHTML = originalText;
            // Re-attach exit button event
            document.getElementById('exitSortMode').addEventListener('click', function() {
                toggleSortMode(false);
            });
        });
    }
});
</script>
@endpush

@push('styles')
<style>
.tab-button.active {
    border-color: #3B82F6 !important;
    color: #2563EB !important;
}

.package-item.cursor-move {
    transition: background-color 0.2s ease;
}

.drag-handle {
    transition: color 0.2s ease;
}

.sortable-ghost {
    opacity: 0.4;
}

.sortable-chosen {
    transform: scale(1.02);
}
</style>
@endpush
@endsection