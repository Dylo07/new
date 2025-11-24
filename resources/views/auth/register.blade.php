@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-gray-900 rounded-lg p-8">
            <h1 class="text-2xl text-white font-light mb-6">Register</h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-300 mb-2" for="name">Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name"
                        class="w-full bg-gray-800 border border-gray-700 rounded p-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500"
                        required
                        autofocus
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-300 mb-2" for="email">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        class="w-full bg-gray-800 border border-gray-700 rounded p-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500"
                        required
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
<div class="mt-4">
    <label for="phone" class="block text-gray-300 mb-2" >Phone Number</label>
    <input id="phone"  class="w-full bg-gray-800 border border-gray-700 rounded p-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500"
           type="text" 
           name="phone" 
           value="{{ old('phone') }}" 
           required />
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

                <div>
                    <label class="block text-gray-300 mb-2" for="password_confirmation">Confirm Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation"
                        class="w-full bg-gray-800 border border-gray-700 rounded p-3 text-white focus:border-green-500 focus:ring-1 focus:ring-green-500"
                        required
                    >
                </div>

                <button 
                    type="submit"
                    class="w-full bg-green-500 text-white py-3 rounded hover:bg-green-600 transition-colors"
                >
                    Register
                </button>

                <p class="text-center text-gray-400">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-green-500 hover:text-green-400">Login</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection