<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        body {
            background-color: #000000;
            min-height: 100vh;
        }
    </style>
</head>
<body>
  <!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-black bg-opacity-50 backdrop-blur-sm">
   <div class="container mx-auto px-4">
       <div class="flex justify-between items-center h-20">
           <!-- Logo -->
           <div class="flex items-center">
               <img src="{{ asset('images/logo.png') }}" alt="Soba Lanka Holiday Resort" class="h-24">
           </div>
           <!-- Navigation Links -->
           <div class="flex gap-6">
               <a href="{{ route('home') }}" class="text-white hover:text-green-400">Home</a>
               <a href="{{ route('gallery') }}" class="text-white hover:text-green-400">Gallery</a>
               <a href="{{ route('rates') }}" class="text-white hover:text-green-400">Rates & Packages</a>
               <a href="{{ route('about') }}" class="text-white hover:text-green-400">About</a>
               <a href="{{ route('contact') }}" class="text-white hover:text-green-400">Contact</a>
               <a href="#" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Call Us Now</a>
           </div>
       </div>
   </div>
</nav>

    <!-- Content -->
    @yield('content')

    @stack('scripts')
</body>
</html>