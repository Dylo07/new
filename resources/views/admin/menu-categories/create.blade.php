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
                <h1 class="text-3xl font-light text-white">Add Menu Category</h1>
                <p class="text-gray-400 mt-1">Create a new food & beverage menu category</p>
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

        <form action="{{ route('admin.menu-categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Info -->
                    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                        <h2 class="text-white text-lg font-semibold mb-6">Basic Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Category Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none"
                                       placeholder="e.g., Wedding Menu">
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">URL Slug</label>
                                <input type="text" name="slug" value="{{ old('slug') }}"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none"
                                       placeholder="auto-generated if empty">
                                <p class="text-gray-500 text-xs mt-1">Leave empty to auto-generate from name</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-gray-400 text-sm mb-2">Description</label>
                            <textarea name="description" rows="3"
                                      class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none"
                                      placeholder="Brief description of this menu category">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                        <h2 class="text-white text-lg font-semibold mb-6">Features / Highlights</h2>
                        
                        <div id="features-container" class="space-y-3">
                            @if(old('features'))
                                @foreach(old('features') as $index => $feature)
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
                            @else
                                <div class="flex gap-2 feature-row">
                                    <input type="text" name="features[]"
                                           class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-emerald-500 focus:outline-none"
                                           placeholder="e.g., Welcome Drink included">
                                    <button type="button" onclick="removeFeature(this)" class="text-red-400 hover:text-red-300 px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
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
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Cover Image</label>
                                <input type="file" name="image" accept="image/*"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-emerald-600 file:text-white file:cursor-pointer">
                                <p class="text-gray-500 text-xs mt-1">Card thumbnail (recommended: 800x600px)</p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Menu Image (A4 JPG)</label>
                                <input type="file" name="menu_image" accept="image/*"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-emerald-600 file:text-white file:cursor-pointer">
                                <p class="text-gray-500 text-xs mt-1">The actual menu document (A4 size, max 10MB)</p>
                            </div>
                        </div>
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
                                <input type="text" name="icon" value="{{ old('icon', 'fa-utensils') }}"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none"
                                       placeholder="fa-utensils">
                                <p class="text-gray-500 text-xs mt-1">e.g., fa-utensils, fa-heart, fa-birthday-cake</p>
                            </div>
                            
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">Color Theme</label>
                                <select name="color" 
                                        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none">
                                    <option value="emerald" {{ old('color') == 'emerald' ? 'selected' : '' }}>Emerald (Green)</option>
                                    <option value="pink" {{ old('color') == 'pink' ? 'selected' : '' }}>Pink</option>
                                    <option value="purple" {{ old('color') == 'purple' ? 'selected' : '' }}>Purple</option>
                                    <option value="amber" {{ old('color') == 'amber' ? 'selected' : '' }}>Amber (Yellow)</option>
                                    <option value="orange" {{ old('color') == 'orange' ? 'selected' : '' }}>Orange</option>
                                    <option value="red" {{ old('color') == 'red' ? 'selected' : '' }}>Red</option>
                                    <option value="rose" {{ old('color') == 'rose' ? 'selected' : '' }}>Rose</option>
                                    <option value="indigo" {{ old('color') == 'indigo' ? 'selected' : '' }}>Indigo</option>
                                    <option value="teal" {{ old('color') == 'teal' ? 'selected' : '' }}>Teal</option>
                                    <option value="cyan" {{ old('color') == 'cyan' ? 'selected' : '' }}>Cyan</option>
                                    <option value="sky" {{ old('color') == 'sky' ? 'selected' : '' }}>Sky Blue</option>
                                    <option value="yellow" {{ old('color') == 'yellow' ? 'selected' : '' }}>Yellow</option>
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
                                <input type="number" name="sort_order" value="{{ old('sort_order') }}"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-emerald-500 focus:outline-none"
                                       placeholder="Auto">
                            </div>
                            
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="is_active" value="1" id="is_active" 
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="w-5 h-5 rounded bg-gray-800 border-gray-700 text-emerald-500 focus:ring-emerald-500">
                                <label for="is_active" class="text-gray-300">Active (visible on website)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                        <button type="submit" 
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-lg font-semibold transition">
                            Create Category
                        </button>
                        <a href="{{ route('admin.menu-categories.index') }}" 
                           class="block w-full text-center text-gray-400 hover:text-white py-3 mt-2 transition">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
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
</script>
@endsection
