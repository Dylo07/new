<!-- resources/views/admin/gallery/rooms.blade.php -->
@extends('layouts.app')

@section('title', 'Manage Room Gallery')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Room Gallery</h1>
            <a href="{{ route('admin.gallery.index') }}" class="text-blue-500 hover:text-blue-700">
                &larr; Back to Galleries
            </a>
        </div>
        
        <!-- Upload Form -->
        <div class="mb-8 bg-gray-100 dark:bg-gray-700 p-6 rounded-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Upload New Images</h2>
            
            <form action="{{ route('admin.gallery.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="gallery_type" value="room">
                
                <div>
                    <label for="images" class="block text-gray-700 dark:text-gray-300 mb-2">Select Images (multiple allowed)</label>
                    <input 
                        type="file" 
                        name="images[]" 
                        id="images" 
                        accept="image/*" 
                        multiple 
                        class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-800"
                        required
                    >
                    @error('images')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('images.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="title" class="block text-gray-700 dark:text-gray-300 mb-2">Title (Optional - will be applied to all uploads)</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-800"
                    >
                </div>
                
                <div>
                    <button type="submit" class="bg-emerald-500 text-white px-6 py-2 rounded hover:bg-emerald-600 transition-colors">
                        Upload Images
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Gallery Images -->
        <div>
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Existing Images</h2>
            
            @if(session('success'))
                <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(count($galleryImages) > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($galleryImages as $image)
                        <div class="relative group">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->title }}" 
                                class="w-full aspect-square object-cover rounded"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <form action="{{ route('admin.gallery.delete', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white p-2 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    {{ $galleryImages->links() }}
                </div>
            @else
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <p>No images found in this gallery. Upload some images to get started.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 
