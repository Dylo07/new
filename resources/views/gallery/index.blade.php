@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Our Gallery</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($images as $image)
        <div class="overflow-hidden rounded-lg shadow-lg">
            <img 
                src="{{ asset($image['image']) }}" 
                alt="{{ $image['title'] }}" 
                class="w-full h-64 object-cover transform hover:scale-105 transition-transform duration-300"
            >
            <div class="p-4 bg-white">
                <h3 class="text-xl font-semibold">{{ $image['title'] }}</h3>
                <p class="text-gray-600">{{ $image['category'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection