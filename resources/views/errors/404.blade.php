@extends('layouts.app')

@section('title', 'Page Not Found - Soba Lanka')

@section('content')
<div class="min-h-screen bg-black py-24">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-6xl text-white font-light mb-8">404</h1>
        <h2 class="text-3xl text-white mb-8">Page Not Found</h2>
        <p class="text-gray-300 mb-12">The page you are looking for doesn't exist or has been moved.</p>
        <a href="{{ route('home') }}" class="bg-emerald-500 text-white px-6 py-3 rounded-lg hover:bg-emerald-600 transition-all duration-300">
            Return to Homepage
        </a>
    </div>
</div>
@endsection