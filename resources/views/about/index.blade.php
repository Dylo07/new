@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <h1 class="text-4xl font-bold mb-4">About Our Hotel</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">{{ $aboutInfo['description'] }}</p>
    </div>

    <!-- Mission & Vision -->
    <div class="grid md:grid-cols-2 gap-8 mb-16">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Our Mission</h2>
            <p class="text-gray-600">{{ $aboutInfo['mission'] }}</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Our Vision</h2>
            <p class="text-gray-600">{{ $aboutInfo['vision'] }}</p>
        </div>
    </div>

    <!-- Features -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center mb-8">Hotel Features</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($aboutInfo['features'] as $feature)
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <div class="text-green-500 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold">{{ $feature }}</h3>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Team Section -->
    <div>
        <h2 class="text-3xl font-bold text-center mb-8">Our Team</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($aboutInfo['team'] as $member)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img 
                    src="{{ asset($member['image']) }}" 
                    alt="{{ $member['name'] }}" 
                    class="w-full h-64 object-cover"
                >
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold mb-2">{{ $member['name'] }}</h3>
                    <p class="text-gray-600">{{ $member['position'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('styles')
<style>
    .team-card {
        transition: transform 0.3s ease;
    }
    .team-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
@endsection