@extends('layouts.admin')

@section('title', isset($customPackage) ? 'Edit Custom Package' : 'Create Custom Package')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">
            {{ isset($customPackage) ? 'Edit Custom Package' : 'Create Custom Package' }}
        </h1>
        <a href="{{ route('admin.custom-packages.index') }}" 
           class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Back to List
        </a>
    </div>

    <form method="POST" action="{{ isset($customPackage) ? route('admin.custom-packages.update', $customPackage) : route('admin.custom-packages.store') }}" 
          enctype="multipart/form-data" class="bg-white shadow-sm rounded-lg">
        @csrf
        @if(isset($customPackage))
            @method('PUT')
        @endif
        
        <div class="p-6 space-y-6">
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Package Name *</label>
                    <input type="text" name="name" value="{{ old('name', $customPackage->name ?? '') }}" 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500" required>
                        <option value="">Select Category</option>
                        <option value="couple" {{ old('category', $customPackage->category ?? '') === 'couple' ? 'selected' : '' }}>Couple</option>
                        <option value="family" {{ old('category', $customPackage->category ?? '') === 'family' ? 'selected' : '' }}>Family</option>
                        <option value="group" {{ old('category', $customPackage->category ?? '') === 'group' ? 'selected' : '' }}>Group</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                    <select name="type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500" required>
                        <option value="">Select Type</option>
                        <option value="day_out" {{ old('type', $customPackage->type ?? '') === 'day_out' ? 'selected' : '' }}>Day Out</option>
                        <option value="half_board" {{ old('type', $customPackage->type ?? '') === 'half_board' ? 'selected' : '' }}>Half Board</option>
                        <option value="full_board" {{ old('type', $customPackage->type ?? '') === 'full_board' ? 'selected' : '' }}>Full Board</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sub Type</label>
                    <input type="text" name="sub_type" value="{{ old('sub_type', $customPackage->sub_type ?? '') }}" 
                           placeholder="e.g., Oasis, Paradise, Crown, Gold, Platinum"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500">
                    <p class="text-gray-500 text-sm mt-1">Optional: For group packages with sub-categories</p>
                    @error('sub_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Pricing -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Adult Price (Rs) *</label>
                    <input type="number" name="adult_price" value="{{ old('adult_price', $customPackage->adult_price ?? '') }}" 
                           step="0.01" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500" required>
                    @error('adult_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Child Price (Rs) *</label>
                    <input type="number" name="child_price" value="{{ old('child_price', $customPackage->child_price ?? '0') }}" 
                           step="0.01" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500" required>
                    @error('child_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Adults *</label>
                    <input type="number" name="min_adults" value="{{ old('min_adults', $customPackage->min_adults ?? '1') }}" 
                           min="1" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500" required>
                    <p class="text-gray-500 text-sm mt-1">Minimum number of adults required</p>
                    @error('min_adults')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" 
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500"
                          placeholder="Detailed description of the package...">{{ old('description', $customPackage->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Menu -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Menu Details</label>
                <textarea name="menu" rows="6" 
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500"
                          placeholder="Menu items and meal details...">{{ old('menu', $customPackage->menu ?? '') }}</textarea>
                @error('menu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Images -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Package Images</label>
                <input type="file" name="images[]" multiple accept="image/*" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500">
                <p class="text-gray-500 text-sm mt-1">Select multiple images to showcase the package</p>
                @error('images.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Existing Images -->
                @if(isset($customPackage) && $customPackage->images && count($customPackage->images) > 0)
                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Current Images</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="current-images">
                            @foreach($customPackage->images as $index => $image)
                                <div class="relative image-item">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Package Image" 
                                         class="w-full h-32 object-cover rounded-lg">
                                    <button type="button" 
                                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600"
                                            onclick="removeImage({{ $customPackage->id }}, {{ $index }}, this)">
                                        ×
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Status -->
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" 
                       {{ old('is_active', $customPackage->is_active ?? true) ? 'checked' : '' }}
                       class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                    Active (Package will be available for customers)
                </label>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
            <a href="{{ route('admin.custom-packages.index') }}" 
               class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-emerald-500 text-white px-6 py-2 rounded-lg hover:bg-emerald-600 transition-colors duration-300">
                {{ isset($customPackage) ? 'Update Package' : 'Create Package' }}
            </button>
        </div>
    </form>
</div>

@if(isset($customPackage))
<script>
function removeImage(packageId, imageIndex, button) {
    if (confirm('Are you sure you want to remove this image?')) {
        fetch(`/admin/custom-packages/${packageId}/remove-image`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                image_index: imageIndex
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.closest('.image-item').remove();
            } else {
                alert('Error removing image. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing image. Please try again.');
        });
    }
}
</script>
@endif
@endsection