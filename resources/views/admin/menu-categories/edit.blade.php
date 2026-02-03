@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="container mx-auto px-4">
        
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.menu-categories.index') }}" class="text-gray-400 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-light text-white">Edit Menu Category</h1>
                <p class="text-gray-400 mt-1">{{ $menuCategory->name }}</p>
            </div>
        </div>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500 text-emerald-500 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.menu-categories.update', $menuCategory) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Info -->
                    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                        <h2 class="text-white text-lg font-semibold mb-6">Basic Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Category Name *</label>
                                <input type="text" name="name" value="{{ old('name', $menuCategory->name) }}" required
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none"
                                       placeholder="e.g., Wedding Menu">
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">URL Slug</label>
                                <input type="text" name="slug" value="{{ old('slug', $menuCategory->slug) }}"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none"
                                       placeholder="auto-generated if empty">
                                <p class="text-gray-500 text-xs mt-1">Current URL: /menu/{{ $menuCategory->slug }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-gray-400 text-sm mb-2">Description</label>
                            <textarea name="description" rows="3"
                                      class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none"
                                      placeholder="Brief description of this menu category">{{ old('description', $menuCategory->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                        <h2 class="text-white text-lg font-semibold mb-6">Features / Highlights</h2>
                        
                        <div id="features-container" class="space-y-3">
                            @php
                                $features = old('features', $menuCategory->features ?? []);
                                if (empty($features)) $features = [''];
                            @endphp
                            @foreach($features as $index => $feature)
                                <div class="flex gap-2 feature-row">
                                    <input type="text" name="features[]" value="{{ $feature }}"
                                           class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-emerald-500 focus:outline-none"
                                           placeholder="e.g., Welcome Drink included">
                                    <button type="button" onclick="removeFeature(this)" class="text-red-400 hover:text-red-300 px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        
                        <button type="button" onclick="addFeature()" 
                                class="mt-4 text-emerald-400 hover:text-emerald-300 text-sm flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Feature
                        </button>
                    </div>

                    <!-- Images -->
                    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                        <h2 class="text-white text-lg font-semibold mb-6">Images</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cover Image -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Cover Image</label>
                                @if($menuCategory->image_path)
                                    <div class="mb-3 relative inline-block">
                                        <img src="{{ asset('storage/' . $menuCategory->image_path) }}" 
                                             alt="Cover" class="w-32 h-24 object-cover rounded-lg border border-gray-700">
                                        <button type="button" onclick="removeImage('cover')" 
                                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">×</button>
                                    </div>
                                @endif
                                <input type="file" name="image" accept="image/*"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-emerald-600 file:text-white file:cursor-pointer">
                                <p class="text-gray-500 text-xs mt-1">Card thumbnail (recommended: 800x600px)</p>
                            </div>

                            <!-- Menu Image (Legacy - single) -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Primary Menu Image</label>
                                @if($menuCategory->menu_image_path)
                                    <div class="mb-3 relative inline-block">
                                        <a href="{{ asset('storage/' . $menuCategory->menu_image_path) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $menuCategory->menu_image_path) }}" 
                                                 alt="Menu" class="w-24 h-32 object-cover rounded-lg border border-gray-700">
                                        </a>
                                        <button type="button" onclick="removeImage('menu')" 
                                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">×</button>
                                    </div>
                                @endif
                                <input type="file" name="menu_image" accept="image/*"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-emerald-600 file:text-white file:cursor-pointer">
                                <p class="text-gray-500 text-xs mt-1">Primary menu image (A4 size, max 10MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Multiple Menu Images Section -->
                    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                        <h2 class="text-white text-lg font-semibold mb-6">Additional Menu Pages</h2>
                        <p class="text-gray-400 text-sm mb-4">Upload multiple menu pages/images. Drag to reorder.</p>
                        
                        <!-- Existing Menu Images -->
                        @if($menuCategory->menuImages->count() > 0)
                            <div id="menu-images-grid" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                @foreach($menuCategory->menuImages as $image)
                                    <div class="relative group cursor-move" data-id="{{ $image->id }}">
                                        <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                 alt="{{ $image->title ?? 'Menu page' }}" 
                                                 class="w-full h-40 object-cover rounded-lg border border-gray-700">
                                        </a>
                                        @if($image->title)
                                            <p class="text-gray-400 text-xs mt-1 truncate">{{ $image->title }}</p>
                                        @endif
                                        <button type="button" onclick="deleteMenuImage({{ $image->id }})" 
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 opacity-0 group-hover:opacity-100 transition">×</button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm mb-4">No additional menu pages uploaded yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Appearance -->
                    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                        <h2 class="text-white text-lg font-semibold mb-6">Appearance</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Icon (FontAwesome)</label>
                                <input type="text" name="icon" value="{{ old('icon', $menuCategory->icon) }}"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none"
                                       placeholder="fa-utensils">
                                <p class="text-gray-500 text-xs mt-1">e.g., fa-utensils, fa-heart, fa-birthday-cake</p>
                            </div>
                            
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Color Theme</label>
                                <select name="color" 
                                        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none">
                                    @php $currentColor = old('color', $menuCategory->color); @endphp
                                    <option value="emerald" {{ $currentColor == 'emerald' ? 'selected' : '' }}>Emerald (Green)</option>
                                    <option value="pink" {{ $currentColor == 'pink' ? 'selected' : '' }}>Pink</option>
                                    <option value="purple" {{ $currentColor == 'purple' ? 'selected' : '' }}>Purple</option>
                                    <option value="amber" {{ $currentColor == 'amber' ? 'selected' : '' }}>Amber (Yellow)</option>
                                    <option value="orange" {{ $currentColor == 'orange' ? 'selected' : '' }}>Orange</option>
                                    <option value="red" {{ $currentColor == 'red' ? 'selected' : '' }}>Red</option>
                                    <option value="rose" {{ $currentColor == 'rose' ? 'selected' : '' }}>Rose</option>
                                    <option value="indigo" {{ $currentColor == 'indigo' ? 'selected' : '' }}>Indigo</option>
                                    <option value="teal" {{ $currentColor == 'teal' ? 'selected' : '' }}>Teal</option>
                                    <option value="cyan" {{ $currentColor == 'cyan' ? 'selected' : '' }}>Cyan</option>
                                    <option value="sky" {{ $currentColor == 'sky' ? 'selected' : '' }}>Sky Blue</option>
                                    <option value="yellow" {{ $currentColor == 'yellow' ? 'selected' : '' }}>Yellow</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Settings -->
                    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                        <h2 class="text-white text-lg font-semibold mb-6">Settings</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Sort Order</label>
                                <input type="number" name="sort_order" value="{{ old('sort_order', $menuCategory->sort_order) }}"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none">
                            </div>
                            
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="is_active" value="1" id="is_active" 
                                       {{ old('is_active', $menuCategory->is_active) ? 'checked' : '' }}
                                       class="w-5 h-5 rounded bg-gray-800 border-gray-700 text-emerald-500 focus:ring-emerald-500">
                                <label for="is_active" class="text-gray-300">Active (visible on website)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                        <button type="submit" 
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-lg font-semibold transition">
                            Update Category
                        </button>
                        <a href="{{ route('menu.show', $menuCategory->slug) }}" target="_blank"
                           class="block w-full text-center text-emerald-400 hover:text-emerald-300 py-3 mt-2 transition">
                            <i class="fas fa-external-link-alt mr-1"></i> View on Site
                        </a>
                        <a href="{{ route('admin.menu-categories.index') }}" 
                           class="block w-full text-center text-gray-400 hover:text-white py-3 transition">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <!-- Separate form for uploading multiple menu images -->
        <div class="mt-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-gray-900 rounded-lg border border-emerald-800 p-6">
                        <h2 class="text-emerald-400 text-lg font-semibold mb-4">
                            <i class="fas fa-upload mr-2"></i>Upload Additional Menu Pages
                        </h2>
                        <form action="{{ route('admin.menu-categories.upload-images', $menuCategory) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">Select Menu Images (Multiple)</label>
                                    <input type="file" name="menu_images[]" accept="image/*" multiple required
                                           class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-emerald-600 file:text-white file:cursor-pointer">
                                    <p class="text-gray-500 text-xs mt-1">Select multiple A4 menu images (max 10MB each). Hold Ctrl/Cmd to select multiple files.</p>
                                </div>
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg font-semibold transition flex items-center gap-2">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    Upload Menu Pages
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Danger Zone - Outside main form to prevent nesting issues -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-6">
            <div class="lg:col-start-3">
                <div class="bg-gray-900 rounded-lg border border-red-900/50 p-6">
                    <h2 class="text-red-400 text-lg font-semibold mb-4">Danger Zone</h2>
                    <form action="{{ route('admin.menu-categories.destroy', $menuCategory) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white py-3 rounded-lg font-semibold transition border border-red-600/50"
                                onclick="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                            Delete Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const row = document.createElement('div');
    row.className = 'flex gap-2 feature-row';
    row.innerHTML = `
        <input type="text" name="features[]"
               class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-emerald-500 focus:outline-none"
               placeholder="e.g., Welcome Drink included">
        <button type="button" onclick="removeFeature(this)" class="text-red-400 hover:text-red-300 px-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    `;
    container.appendChild(row);
}

function removeFeature(btn) {
    const rows = document.querySelectorAll('.feature-row');
    if (rows.length > 1) {
        btn.closest('.feature-row').remove();
    }
}

function removeImage(type) {
    if (!confirm('Remove this image?')) return;
    
    const url = type === 'cover' 
        ? '{{ route("admin.menu-categories.remove-image", $menuCategory) }}'
        : '{{ route("admin.menu-categories.remove-menu-image", $menuCategory) }}';
    
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    }).then(() => {
        window.location.reload();
    });
}

function deleteMenuImage(imageId) {
    if (!confirm('Delete this menu image?')) return;
    
    fetch('/admin/menu-images/' + imageId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    }).then(() => {
        window.location.reload();
    });
}
</script>
@endsection
