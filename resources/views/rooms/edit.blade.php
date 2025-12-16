{{-- resources/views/rooms/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Room - ' . $room->room_number)

@section('content')
<div class="min-h-screen bg-black text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-light mb-8">Edit Room {{ $room->room_number }}</h1>

            <!-- Update Room Form -->
            <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- PUT method for updating -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Room Number -->
                    <div>
                        <label class="block text-gray-300 mb-2">Room Number *</label>
                        <input 
                            type="text" 
                            name="room_number" 
                            value="{{ old('room_number', $room->room_number) }}"
                            class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
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
                            value="{{ old('type', $room->type) }}"
                            class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
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
                        class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
                        required
                    >
                        <option value="">Select Category</option>
                        <option value="ac" {{ old('category', $room->category) == 'ac' ? 'selected' : '' }}>A/C Room</option>
                        <option value="ac-balcony" {{ old('category', $room->category) == 'ac-balcony' ? 'selected' : '' }}>A/C Room with Balcony</option>
                        <option value="couple" {{ old('category', $room->category) == 'couple' ? 'selected' : '' }}>Couple Cottage</option>
                        <option value="family-cottage" {{ old('category', $room->category) == 'family-cottage' ? 'selected' : '' }}>Family Cottage</option>
                        <option value="family-ac" {{ old('category', $room->category) == 'family-ac' ? 'selected' : '' }}>Family A/C Room</option>
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
                        class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
                        required
                    >{{ old('description', $room->description) }}</textarea>
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
                        value="{{ old('price', $room->price) }}"
                        step="0.01"
                        class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
                        required
                    >
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if($room->image)
                    <div>
                        <label class="block text-gray-300 mb-2">Current Image</label>
                        <img 
                            src="{{ asset('storage/' . $room->image) }}" 
                            alt="Current room image"
                            class="w-48 h-32 object-cover rounded"
                        >
                    </div>
                @endif

                <!-- New Image -->
                <div>
                    <label class="block text-gray-300 mb-2">Update Image</label>
                    <input 
                        type="file" 
                        name="image"
                        accept="image/*"
                        class="w-full p-3 bg-gray-900 rounded text-white border border-gray-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
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
                        class="rounded bg-gray-900 border-gray-800 text-emerald-500 focus:ring-emerald-500"
                        {{ old('is_available', $room->is_available) ? 'checked' : '' }}
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
                    <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded hover:bg-emerald-600">
                        Update Room
                    </button>
                </div>
            </form>

            <!-- Delete Room Form -->
            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE') <!-- DELETE method for deleting -->
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Delete Room
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
