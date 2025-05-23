@props(['pageTitle' => 'Admin Panel'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }} - Satpol PP Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Add any other common admin head elements here --}}
    @stack('styles')
</head>
<body class="bg-slate-100 dark:bg-slate-900 font-sans antialiased">

    <div class="flex min-h-screen bg-slate-100 dark:bg-stone-600">
        <!-- Sidebar -->
        <aside class="w-64 bg-red-700 dark:bg-stone-800 text-slate-100 flex flex-col transition-all duration-300 ease-in-out shadow-lg">
            <div class="p-5 text-2xl font-bold text-white border-b border-red-800 dark:border-red-400 flex items-center justify-center">
                {{-- You can add a small logo here if you have one --}}
                {{-- <img src="/path/to/admin-logo.png" alt="Logo" class="h-8 mr-2"> --}}
                <span>Admin Panel</span>
            </div>
            <nav class="mt-4 flex-1 px-2 space-y-1">
                <x-admin.nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </x-admin.nav-link>
                <x-admin.nav-link href="#" :active="request()->is('admin/berita*')"> {{-- Adjust route check as needed --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Berita
                </x-admin.nav-link>
                <x-admin.nav-link href="#" :active="request()->is('admin/galeri*')"> {{-- Adjust route check as needed --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Galeri
                </x-admin.nav-link>
                <x-admin.nav-link href="#" :active="request()->is('admin/slider*')"> {{-- Adjust route check as needed --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    Slider
                </x-admin.nav-link>
            </nav>
            <div class="p-4 mt-auto border-t border-red-800">
                <p class="text-xs text-slate-400 text-center">&copy; {{ date('Y') }} Satpol PP Admin</p>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white dark:bg-stone-700 shadow-md p-4 flex justify-between items-center sticky top-0 z-30">
                <div class="flex items-center">
                    {{-- Hamburger for mobile (optional, needs JS for toggling sidebar) --}}
                    {{-- <button class="text-gray-600 focus:outline-none lg:hidden mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button> --}}
                    <h1 class="text-xl md:text-2xl font-semibold text-slate-700 dark:text-white">{{ $pageTitle }}</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="flex items-center text-sm focus:outline-none group">
                            <img class="w-8 h-8 rounded-full object-cover mr-2 border-2 border-transparent group-hover:border-red-600 transition-colors" src="https://ui-avatars.com/api/?name=Admin&background=c0392b&color=fff&font-size=0.5" alt="Admin Avatar">
                            <span class="hidden md:inline text-slate-700 dark:text-white group-hover:text-red-700">Admin</span>
                        </button>
                        {{-- Basic Dropdown (can be enhanced with JS for toggle) --}}
                        {{-- <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl py-1 z-50 hidden group-focus-within:block">
                            <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-red-700">Profile</a>
                            <form action="{{ route('admin.logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-red-600">
                                    Logout
                                </button>
                            </form>
                        </div> --}}
                    </div>
                     <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150 ease-in-out flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
