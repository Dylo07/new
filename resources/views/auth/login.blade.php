@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-gray-900 rounded-lg p-8">
            <h1 class="text-2xl text-white font-light mb-6">Login</h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-300 mb-2" for="email">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        class="w-full bg-gray-800 border border-gray-700 rounded p-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500"
                        required
                        autofocus
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 mb-2" for="password">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="w-full bg-gray-800 border border-gray-700 rounded p-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500"
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember" 
                            class="rounded bg-gray-800 border-gray-700 text-green-500 focus:ring-green-500"
                        >
                        <label class="ml-2 text-gray-300" for="remember">Remember me</label>
                    </div>
                </div>

                <button 
                    type="submit"
                    class="w-full bg-green-500 text-white py-3 rounded hover:bg-green-600 transition-colors"
                >
                    Login
                </button>

                <p class="text-center text-gray-400">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-green-500 hover:text-green-400">Register</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection