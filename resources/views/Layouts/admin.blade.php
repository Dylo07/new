{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Soba Lanka Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    @stack('styles')
    <style>
        body {
            background-color: #f3f4f6;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <!-- Admin Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Soba Lanka" class="h-12">
                        <span class="ml-3 text-xl font-bold text-gray-800">Admin Panel</span>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('admin.packages.index') }}" 
                           class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm 
                           {{ request()->routeIs('admin.packages.*') ? 'border-emerald-500 text-emerald-600' : '' }}">
                            <i class="fas fa-box mr-2"></i>Packages
                        </a>
                        <a href="{{ route('admin.custom-packages.index') }}" 
       class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm
       {{ request()->routeIs('admin.custom-packages.*') ? 'border-emerald-500 text-emerald-600' : '' }}">
        <i class="fas fa-puzzle-piece mr-2"></i>Custom Packages
    </a>
                        <a href="{{ route('admin.gallery.index') }}" 
                           class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm
                           {{ request()->routeIs('admin.gallery.*') ? 'border-emerald-500 text-emerald-600' : '' }}">
                            <i class="fas fa-images mr-2"></i>Gallery
                        </a>
                        <a href="{{ route('admin.calendar') }}" 
                           class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm
                           {{ request()->routeIs('admin.calendar*') ? 'border-emerald-500 text-emerald-600' : '' }}">
                            <i class="fas fa-calendar mr-2"></i>Calendar
                        </a>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- View Site Link -->
                    <a href="{{ route('home') }}" 
                       class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-external-link-alt mr-1"></i>
                        View Site
                    </a>

                    <!-- User Info -->
                    <div class="ml-3 flex items-center">
                        <span class="text-gray-700 text-sm mr-4">
                            {{ Auth::user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                                <i class="fas fa-sign-out-alt mr-1"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="sm:hidden flex items-center">
                    <button type="button" id="mobile-menu-button" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="sm:hidden hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('admin.packages.index') }}" 
                   class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50
                   {{ request()->routeIs('admin.packages.*') ? 'bg-emerald-50 border-emerald-500 text-emerald-700' : '' }}">
                    <i class="fas fa-box mr-2"></i>Packages
                </a>
                <a href="{{ route('admin.custom-packages.index') }}" 
       class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm
       {{ request()->routeIs('admin.custom-packages.*') ? 'border-emerald-500 text-emerald-600' : '' }}">
        <i class="fas fa-puzzle-piece mr-2"></i>Custom Packages
    </a>
                <a href="{{ route('admin.gallery.index') }}" 
                   class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50
                   {{ request()->routeIs('admin.gallery.*') ? 'bg-emerald-50 border-emerald-500 text-emerald-700' : '' }}">
                    <i class="fas fa-images mr-2"></i>Gallery
                </a>
                <a href="{{ route('admin.calendar') }}" 
                   class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50
                   {{ request()->routeIs('admin.calendar*') ? 'bg-emerald-50 border-emerald-500 text-emerald-700' : '' }}">
                    <i class="fas fa-calendar mr-2"></i>Calendar
                </a>
                <div class="border-t border-gray-200 pt-3 mt-3">
                    <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900">
                        <i class="fas fa-external-link-alt mr-2"></i>View Site
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="block w-full text-left pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="py-6">
        @yield('content')
    </main>

    <!-- Scripts -->
    @stack('scripts')
    
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>