{{-- resources/views/admin/packages/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Create Package')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Create New Package</h1>
        <a href="{{ route('admin.packages.index') }}" 
           class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Back to Packages
        </a>
    </div>

    <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Package Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Package Name *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Package Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Package Type *</label>
                    <select name="type" 
                            id="type" 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="">Select Type</option>
                        @foreach($packageTypes as $value => $label)
                            <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                    <div class="flex">
                        <select name="currency" class="border border-gray-300 rounded-l-lg px-3 py-2 bg-gray-50">
                            <option value="LKR" {{ old('currency', 'LKR') == 'LKR' ? 'selected' : '' }}>LKR</option>
                            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                        </select>
                        <input type="number" 
                               name="price" 
                               id="price" 
                               value="{{ old('price') }}"
                               step="0.01"
                               min="0"
                               class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                    <input type="text" 
                           name="duration" 
                           id="duration" 
                           value="{{ old('duration') }}"
                           placeholder="e.g., 3:00 PM to 3:00 PM"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('duration')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <input type="text" 
                           name="location" 
                           id="location" 
                           value="{{ old('location') }}"
                           placeholder="e.g., Melsiripura, Kurunegala"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Min Guests -->
                <div>
                    <label for="min_guests" class="block text-sm font-medium text-gray-700 mb-2">Minimum Guests</label>
                    <input type="number" 
                           name="min_guests" 
                           id="min_guests" 
                           value="{{ old('min_guests') }}"
                           min="1"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('min_guests')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Max Guests -->
                <div>
                    <label for="max_guests" class="block text-sm font-medium text-gray-700 mb-2">Maximum Guests</label>
                    <input type="number" 
                           name="max_guests" 
                           id="max_guests" 
                           value="{{ old('max_guests') }}"
                           min="1"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('max_guests')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" 
                          id="description" 
                          rows="3"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Package Image -->
            <div class="mt-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Package Image</label>
                <input type="file" 
                       name="image" 
                       id="image" 
                       accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Recommended size: 800x600px. Max file size: 5MB</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Package Features -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Package Features *</h2>
            
            <div id="features-container">
                @if(old('features'))
                    @foreach(old('features') as $index => $feature)
                        <div class="feature-item flex items-center gap-3 mb-3">
                            <input type="text" 
                                   name="features[]" 
                                   value="{{ $feature }}"
                                   placeholder="Enter feature"
                                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <button type="button" 
                                    onclick="removeFeature(this)"
                                    class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="feature-item flex items-center gap-3 mb-3">
                        <input type="text" 
                               name="features[]" 
                               placeholder="Enter feature"
                               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        <button type="button" 
                                onclick="removeFeature(this)"
                                class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                @endif
            </div>
            
            <button type="button" 
                    onclick="addFeature()"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mt-3">
                <i class="fas fa-plus mr-2"></i>Add Feature
            </button>
            
            @error('features')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Wedding Package Pricing Tiers -->
        <div id="pricing-tiers-section" class="bg-white shadow rounded-lg p-6" style="display: none;">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Pricing Tiers (Wedding Packages)</h2>
            
            <div id="pricing-tiers-container">
                @if(old('pricing_tiers'))
                    @foreach(old('pricing_tiers') as $index => $tier)
                        <div class="pricing-tier flex items-center gap-3 mb-3">
                            <input type="number" 
                                   name="pricing_tiers[{{ $index }}][guests]" 
                                   value="{{ $tier['guests'] ?? '' }}"
                                   placeholder="Number of guests"
                                   min="1"
                                   class="w-32 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <span class="text-gray-600">guests for</span>
                            <input type="number" 
                                   name="pricing_tiers[{{ $index }}][price]" 
                                   value="{{ $tier['price'] ?? '' }}"
                                   placeholder="Price"
                                   min="0"
                                   step="0.01"
                                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="button" 
                                    onclick="removePricingTier(this)"
                                    class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <button type="button" 
                    onclick="addPricingTier()"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mt-3">
                <i class="fas fa-plus mr-2"></i>Add Pricing Tier
            </button>
        </div>

        <!-- Status and Sort Order -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Settings</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Active Status -->
                <div class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" 
                           name="is_active" 
                           id="is_active" 
                           value="1"
                           {{ old('is_active', '1') ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Active (Package will be visible to customers)
                    </label>
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input type="number" 
                           name="sort_order" 
                           id="sort_order" 
                           value="{{ old('sort_order', 0) }}"
                           min="0"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.packages.index') }}" 
               class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                <i class="fas fa-save mr-2"></i>Create Package
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
let featureIndex = {{ old('features') ? count(old('features')) : 1 }};
let pricingTierIndex = {{ old('pricing_tiers') ? count(old('pricing_tiers')) : 0 }};

function addFeature() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'feature-item flex items-center gap-3 mb-3';
    div.innerHTML = `
        <input type="text" 
               name="features[]" 
               placeholder="Enter feature"
               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
               required>
        <button type="button" 
                onclick="removeFeature(this)"
                class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeFeature(button) {
    const container = document.getElementById('features-container');
    if (container.children.length > 1) {
        button.parentElement.remove();
    }
}

function addPricingTier() {
    const container = document.getElementById('pricing-tiers-container');
    const div = document.createElement('div');
    div.className = 'pricing-tier flex items-center gap-3 mb-3';
    div.innerHTML = `
        <input type="number" 
               name="pricing_tiers[${pricingTierIndex}][guests]" 
               placeholder="Number of guests"
               min="1"
               class="w-32 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <span class="text-gray-600">guests for</span>
        <input type="number" 
               name="pricing_tiers[${pricingTierIndex}][price]" 
               placeholder="Price"
               min="0"
               step="0.01"
               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="button" 
                onclick="removePricingTier(this)"
                class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(div);
    pricingTierIndex++;
}

function removePricingTier(button) {
    button.parentElement.remove();
}

// Show/hide pricing tiers based on package type
document.getElementById('type').addEventListener('change', function() {
    const pricingTiersSection = document.getElementById('pricing-tiers-section');
    if (this.value === 'wedding') {
        pricingTiersSection.style.display = 'block';
        // Add first pricing tier if none exist
        if (document.getElementById('pricing-tiers-container').children.length === 0) {
            addPricingTier();
        }
    } else {
        pricingTiersSection.style.display = 'none';
    }
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    if (typeSelect.value === 'wedding') {
        document.getElementById('pricing-tiers-section').style.display = 'block';
    }
});
</script>
@endpush
@endsection