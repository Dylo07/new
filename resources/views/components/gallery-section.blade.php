@props(['title', 'route', 'images'])

@if(isset($images) && $images->count() > 0)
    <div class="mb-16">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-white text-2xl font-bold">{{ $title }}</h3>
            <a href="{{ route($route) }}" class="text-white hover:text-emerald-400 transition-colors duration-300">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($images->take(8) as $index => $image)
                <div class="relative group overflow-hidden">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}"
                        class="w-full aspect-square object-cover transition-transform duration-500 group-hover:scale-110"
                        width="300" height="300">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif