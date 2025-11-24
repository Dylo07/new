@extends('layouts.admin')

@section('title', 'View Custom Package')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">{{ $customPackage->name }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.custom-packages.edit', $customPackage) }}" 
               class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.custom-packages.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-300">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <!-- Images -->
        @if($customPackage->images && count($customPackage->images) > 0)
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Package Images</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($customPackage->images as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $customPackage->name }}" 
                             class="w-full h-32 object-cover rounded-lg">
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Package Details -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Basic Info -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                            {{ $customPackage->category === 'couple' ? 'bg-pink-100 text-pink-800' : 
                               ($customPackage->category === 'family' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800') }}">
                            {{ ucfirst($customPackage->category) }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Type</label>
                        <p class="text-gray-900">{{ str_replace('_', ' ', ucfirst($customPackage->type)) }}</p>
                    </div>

                    @if($customPackage->sub_type)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sub Type</label>
                            <p class="text-gray-900">{{ ucfirst($customPackage->sub_type) }}</p>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        @if($customPackage->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Inactive
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Pricing Info -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Adult Price</label>
                        <p class="text-2xl font-bold text-green-600">Rs {{ number_format($customPackage->adult_price, 0) }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Child Price</label>
                        <p class="text-xl font-semibold text-gray-900">Rs {{ number_format($customPackage->child_price, 0) }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Minimum Adults Required</label>
                        <p class="text-gray-900">{{ $customPackage->min_adults }}</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($customPackage->description)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                    <div class="text-gray-700 bg-gray-50 p-4 rounded-lg">
                        {!! nl2br(e($customPackage->description)) !!}
                    </div>
                </div>
            @endif

            <!-- Menu -->
            @if($customPackage->menu)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Menu Details</h3>
                    <div class="text-gray-700 bg-gray-50 p-4 rounded-lg">
                        {!! nl2br(e($customPackage->menu)) !!}
                    </div>
                </div>
            @endif

            <!-- Package Info Summary -->
            <div class="bg-blue-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Package Summary</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="font-medium">Created:</span>
                        {{ $customPackage->created_at->format('M d, Y') }}
                    </div>
                    <div>
                        <span class="font-medium">Last Updated:</span>
                        {{ $customPackage->updated_at->format('M d, Y') }}
                    </div>
                    <div>
                        <span class="font-medium">Package ID:</span>
                        {{ $customPackage->id }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection