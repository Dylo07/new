{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Soba Lanka Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @stack('styles')
    <style>
        body { background: #0a0a0a; }
        .sidebar-link { @apply flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200; }
        .sidebar-link:hover { background: rgba(16,185,129,.1); color: #6ee7b7; }
        .sidebar-link.active { background: rgba(16,185,129,.15); color: #34d399; border-left: 3px solid #10b981; }
        .stat-card { @apply bg-gray-900 border border-gray-800 rounded-xl p-5 hover:border-gray-700 transition; }
        .admin-table th { @apply px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider; }
        .admin-table td { @apply px-5 py-3 text-sm; }
        .admin-table tbody tr { @apply border-t border-gray-800 hover:bg-gray-800/40 transition; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
    </style>
</head>
<body class="text-gray-300 antialiased">

    <!-- Mobile Top Bar -->
    <div class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-gray-950 border-b border-gray-800 px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button id="mobileSidebarToggle" class="text-gray-400 hover:text-white">
                <i class="fas fa-bars text-lg"></i>
            </button>
            <img src="{{ asset('images/logo.png') }}" alt="Soba Lanka" class="h-8">
            <span class="text-white font-bold text-sm">Mission Control</span>
        </div>
        <a href="{{ route('home') }}" class="text-gray-400 hover:text-emerald-400 text-sm">
            <i class="fas fa-external-link-alt"></i>
        </a>
    </div>

    <!-- Sidebar Overlay (mobile) -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/60 z-40 lg:hidden hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-50 h-screen w-64 bg-gray-950 border-r border-gray-800 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <!-- Logo -->
        <div class="px-5 py-5 border-b border-gray-800 flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Soba Lanka" class="h-10">
            <div>
                <div class="text-white font-bold text-sm leading-tight">Soba Lanka</div>
                <div class="text-emerald-400 text-xs font-medium">Mission Control</div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-4 py-6">
            <!-- Overview -->
            <div class="mb-6">
                <div class="text-gray-500 text-[10px] font-bold uppercase tracking-widest px-3 mb-3">Overview</div>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-gray-400' }}">
                    <i class="fas fa-th-large w-5 text-center text-sm"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Bookings & CRM -->
            <div class="mb-6">
                <div class="text-gray-500 text-[10px] font-bold uppercase tracking-widest px-3 mb-3">Bookings & CRM</div>
                <div class="space-y-1">
                    <a href="{{ route('admin.bookings.index') }}" class="sidebar-link {{ request()->routeIs('admin.bookings.*') ? 'active' : 'text-gray-400' }}">
                        <i class="fas fa-calendar-check w-5 text-center text-sm"></i>
                        <span>Bookings</span>
                    </a>
                    <a href="{{ route('admin.leads.index') }}" class="sidebar-link {{ request()->routeIs('admin.leads.*') ? 'active' : 'text-gray-400' }}">
                        <i class="fas fa-funnel-dollar w-5 text-center text-sm"></i>
                        <span>Leads CRM</span>
                        @php $pendingLeads = \App\Models\Lead::whereIn('status', ['started','browsing','reviewed'])->count(); @endphp
                        @if($pendingLeads > 0)
                            <span class="ml-auto bg-emerald-500/20 text-emerald-400 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingLeads }}</span>
                        @endif
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="mb-6">
                <div class="text-gray-500 text-[10px] font-bold uppercase tracking-widest px-3 mb-3">Content</div>
                <div class="space-y-1">
                    <a href="{{ route('admin.packages.index') }}" class="sidebar-link {{ request()->routeIs('admin.packages.*') ? 'active' : 'text-gray-400' }}">
                        <i class="fas fa-box w-5 text-center text-sm"></i>
                        <span>Packages</span>
                    </a>
                    <a href="{{ route('admin.custom-packages.index') }}" class="sidebar-link {{ request()->routeIs('admin.custom-packages.*') ? 'active' : 'text-gray-400' }}">
                        <i class="fas fa-puzzle-piece w-5 text-center text-sm"></i>
                        <span>Custom Packages</span>
                    </a>
                    <a href="{{ route('admin.menu-categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.menu-categories.*') ? 'active' : 'text-gray-400' }}">
                        <i class="fas fa-utensils w-5 text-center text-sm"></i>
                        <span>Menu Manager</span>
                    </a>
                    <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : 'text-gray-400' }}">
                        <i class="fas fa-images w-5 text-center text-sm"></i>
                        <span>Galleries</span>
                    </a>
                </div>
            </div>

            <!-- System -->
            <div class="mb-2">
                <div class="text-gray-500 text-[10px] font-bold uppercase tracking-widest px-3 mb-3">System</div>
                <div class="space-y-1">
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : 'text-gray-400' }}">
                        <i class="fas fa-users w-5 text-center text-sm"></i>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('admin.calendar') }}" class="sidebar-link {{ request()->routeIs('admin.calendar*') ? 'active' : 'text-gray-400' }}">
                        <i class="fas fa-calendar-alt w-5 text-center text-sm"></i>
                        <span>Availability</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Bottom -->
        <div class="border-t border-gray-800 px-4 py-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center">
                    <i class="fas fa-user text-emerald-400 text-xs"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-white text-sm font-medium truncate">{{ Auth::user()->name }}</div>
                    <div class="text-gray-500 text-xs truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('home') }}" class="flex-1 text-center text-xs text-gray-400 hover:text-emerald-400 bg-gray-800 rounded-lg py-2 transition">
                    <i class="fas fa-external-link-alt mr-1"></i> View Site
                </a>
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full text-center text-xs text-gray-400 hover:text-red-400 bg-gray-800 rounded-lg py-2 transition">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <div class="pt-16 lg:pt-0">
            <!-- Top Bar (desktop) -->
            <div class="hidden lg:flex items-center justify-between px-8 py-4 border-b border-gray-800 bg-gray-950/80 backdrop-blur-sm sticky top-0 z-30">
                <div>
                    <h1 class="text-white text-lg font-bold">@yield('page_title', 'Dashboard')</h1>
                    <p class="text-gray-500 text-xs">@yield('page_subtitle', now()->format('l, F j, Y'))</p>
                </div>
                <div class="flex items-center gap-4">
                    @yield('page_actions')
                </div>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mx-6 mt-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mx-6 mt-4 bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            <!-- Page Content -->
            <main class="p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggle = document.getElementById('mobileSidebarToggle');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            if (toggle) toggle.addEventListener('click', openSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);
        });
    </script>
</body>
</html>