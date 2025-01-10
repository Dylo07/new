@extends('layouts.app')

@section('title', 'Add New Room')

@section('content')
<div class="min-h-screen bg-black text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-light mb-8">Add New Room</h1>

            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Room Number -->
                    <div>
                        <label class="block text-gray-300 mb-2">Room Number *</label>
                        <input 
                            type="text" 
                            name="room_number" 
                            value="{{ old('room_number') }}"
                            class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-green-500 focus:ring-1 focus:ring-green-500"
                            required
                        >
                        @error('room_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Room Type -->
                    <div>
                        <label class="block text-gray-300 mb-2">Room Type *</label>
                        <input 
                            type="text" 
                            name="type" 
                            value="{{ old('type') }}"
                            class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-green-500 focus:ring-1 focus:ring-green-500"
                            required
                        >
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-gray-300 mb-2">Category *</label>
                    <select 
                        name="category" 
                        class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-green-500 focus:ring-1 focus:ring-green-500"
                        required
                    >
                        <option value="">Select Category</option>
                        <option value="ac" {{ old('category') == 'ac' ? 'selected' : '' }}>A/C Room</option>
                        <option value="ac-balcony" {{ old('category') == 'ac-balcony' ? 'selected' : '' }}>A/C Room with Balcony</option>
                        <option value="couple" {{ old('category') == 'couple' ? 'selected' : '' }}>Couple Cottage</option>
                        <option value="family-cottage" {{ old('category') == 'family-cottage' ? 'selected' : '' }}>Family Cottage</option>
                        <option value="family-ac" {{ old('category') == 'family-ac' ? 'selected' : '' }}>Family A/C Room</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-gray-300 mb-2">Description *</label>
                    <textarea 
                        name="description" 
                        rows="4" 
                        class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-green-500 focus:ring-1 focus:ring-green-500"
                        required
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-gray-300 mb-2">Price per Night (Rs.) *</label>
                    <input 
                        type="number" 
                        name="price" 
                        value="{{ old('price') }}"
                        step="0.01"
                        class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-green-500 focus:ring-1 focus:ring-green-500"
                        required
                    >
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-gray-300 mb-2">Room Image</label>
                    <input 
                        type="file" 
                        name="image"
                        accept="image/*"
                        class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-green-500 focus:ring-1 focus:ring-green-500"
                    >
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Availability -->
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="is_available" 
                        id="is_available"
                        class="rounded bg-gray-900 border-gray-800 text-green-500 focus:ring-green-500"
                        {{ old('is_available') ? 'checked' : '' }}
                    >
                    <label for="is_available" class="ml-2 text-gray-300">Room is Available</label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a 
                        href="{{ route('rooms.index') }}"
                        class="px-6 py-3 bg-gray-800 text-white rounded hover:bg-gray-700 transition-colors"
                    >
                        Cancel
                    </a>
                    <button 
                        type="submit"
                        class="px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600 transition-colors"
                    >
                        Create Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview functionality
        const imageInput = document.querySelector('input[name="image"]');
        const previewImage = document.getElementById('image-preview');
        
        if (imageInput && previewImage) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush