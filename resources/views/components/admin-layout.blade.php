@props(['pageTitle' => 'Admin Panel'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }} - Satpol PP Admin </title>
    <link rel="icon" type="image/png" href="{{ asset('image.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Add any other common admin head elements here --}}
    @stack('styles')
</head>

<body class="bg-slate-100 dark:bg-stone-600 font-sans antialiased">

    <div id="admin-app-container" class="flex min-h-screen bg-slate-100 dark:bg-stone-600">
        <!-- Sidebar -->
        {{-- Sidebar: w-64 by default, w-16 when collapsed --}}
        <aside id="admin-sidebar"
            class="w-64 bg-red-700 dark:bg-stone-800 text-slate-100 flex flex-col transition-all duration-300 ease-in-out shadow-lg">
            <div
                class="p-5 text-2xl font-bold text-white border-b border-red-800 dark:border-red-400 flex items-center sidebar-header">
                {{-- You can add a small logo here if you have one --}}
                {{-- <img src="/path/to/admin-logo.png" alt="Logo" class="h-8 mr-2"> --}}
                <span class="sidebar-text">Admin Panel</span>
            </div>
            <nav class="mt-4 flex-1 px-2 space-y-1">
                <x-admin.nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="sidebar-text">Dashboard</span>
                </x-admin.nav-link>
                <x-admin.nav-link :href="route('admin.news')" :active="request()->routeIs('admin.news')"> {{-- Adjust route check as needed --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                    <span class="sidebar-text">Berita</span>
                </x-admin.nav-link>
                <x-admin.nav-link :href="route('admin.gallery')" :active="request()->routeIs('admin.gallery')"> {{-- Adjust route check as needed --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class="sidebar-text">Galeri</span>
                </x-admin.nav-link>
                <x-admin.nav-link :href="route('admin.sliders')" :active="request()->routeIs('admin.sliders')"> {{-- Adjust route check as needed --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    <span class="sidebar-text">Slider</span>
                </x-admin.nav-link>

                {{-- Expandable Profile Link --}}
                @php
                    $isProfileSectionActive = request()->routeIs('admin.profile*');
                    $profileButtonClasses = $isProfileSectionActive
                        ? 'flex items-center w-full px-4 py-3 text-base font-medium text-white bg-red-800 rounded-lg transition-colors duration-150 group'
                        : 'flex items-center w-full px-4 py-3 text-base font-medium text-red-100 hover:text-white hover:bg-red-600 rounded-lg transition-colors duration-150 group';
                @endphp
                <div>
                    <button type="button" class="{{ $profileButtonClasses }}"
                        onclick="toggleAdminSubmenu(this, 'profileSubmenu')">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="sidebar-text flex-1 text-left">Profile</span>
                        <svg class="w-4 h-4 admin-submenu-arrow {{ $isProfileSectionActive ? 'rotate-90' : '' }} transition-transform duration-200"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="profileSubmenu" class="mt-1 pl-5 space-y-1 {{ $isProfileSectionActive ? '' : 'hidden' }}">
                        <x-admin.nav-link :href="route('admin.profile')" :active="request()->routeIs('admin.profile') || request()->routeIs('admin.profile.edit')">
                            <span class="sidebar-text">Kelola Halaman</span>
                        </x-admin.nav-link>
                        <x-admin.nav-link :href="route('admin.profile.sop')" :active="request()->routeIs('admin.profile.sop')">
                            <span class="sidebar-text">SOP</span>
                        </x-admin.nav-link>
                        {{-- You can add more profile sub-links here --}}
                    </div>

                </div>
                <x-admin.nav-link :href="route('admin.services')" :active="request()->routeIs('admin.services')"> {{-- Adjust route check as needed --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    <span class="sidebar-text">Services</span>
                </x-admin.nav-link>
            </nav>

            {{-- Tombol Kembali ke Halaman Utama --}}
            <div class="mt-auto px-2 py-2 border-t border-red-800 dark:border-red-400">
                <a href="{{ url('/') }}"
                    class="flex items-center p-2 text-base font-normal text-slate-100 rounded-lg hover:bg-red-600 dark:hover:bg-stone-700 group">
                    <svg class="w-5 h-5 mr-3 text-slate-100 transition duration-75 group-hover:text-white"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    <span class="sidebar-text">Kembali ke Situs</span>
                </a>
                </nav>
                <div class="p-4 mt-auto border-t border-red-800 sidebar-footer">
                    <p class="text-xs text-slate-400 text-center sidebar-text">&copy; {{ date('Y') }} Satpol PP
                        Admin
                    </p>
                </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-x-hidden"> {{-- Added overflow-x-hidden --}}
            <!-- Header -->
            <header
                class="bg-white dark:bg-stone-700 shadow-md p-4 flex justify-between items-center sticky top-0 z-30">
                <div class="flex items-center">
                    {{-- Hamburger button --}}
                    <button id="sidebar-toggle"
                        class="text-slate-600 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-red-500 rounded-md p-1 mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-xl md:text-2xl font-semibold text-slate-700 dark:text-white">{{ $pageTitle }}
                    </h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="flex items-center text-sm focus:outline-none group">
                            <img class="w-8 h-8 rounded-full object-cover mr-2 border-2 border-transparent group-hover:border-red-600 transition-colors"
                                src="https://ui-avatars.com/api/?name=Admin&background=c0392b&color=fff&font-size=0.5"
                                alt="Admin Avatar">
                            <span
                                class="hidden md:inline text-slate-700 dark:text-white group-hover:text-red-700">Admin</span>
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
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150 ease-in-out flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('admin-sidebar');
            const appContainer = document.getElementById('admin-app-container'); // Or the body if preferred

            // Function to check if sidebar should be collapsed based on screen size
            const checkSidebarState = () => {
                if (window.innerWidth < 768) { // Tailwind's 'md' breakpoint
                    appContainer.classList.add('sidebar-collapsed');
                } else {
                    // Optional: remove collapsed state on larger screens if you want it expanded by default
                    // appContainer.classList.remove('sidebar-collapsed');
                }
            };

            // Initial check
            checkSidebarState();

            sidebarToggle.addEventListener('click', function() {
                appContainer.classList.toggle('sidebar-collapsed');
            });

            // Optional: Re-check on window resize
            window.addEventListener('resize', checkSidebarState);
        });

        function toggleAdminSubmenu(button, submenuId) {
            const submenu = document.getElementById(submenuId);
            const arrow = button.querySelector('.admin-submenu-arrow');
            submenu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-90');
        }
    </script>
    @stack('scripts')
</body>

</html>
