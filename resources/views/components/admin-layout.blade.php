@props(['pageTitle' => 'Admin Panel'])

<!DOCTYPE html> {{-- Kelas 'dark' akan dikelola oleh JavaScript --}}
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

<body class="bg-slate-200 dark:bg-stone-800 font-sans antialiased">

    <div id="admin-app-container" class="flex min-h-screen">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.515-1.32 1.958-2.182 3.46-1.827 1.502.355 2.582 1.78 2.067 3.102l-.707 1.768a1 1 0 00.547 1.342l1.768.707c1.32.515 2.182 1.958 1.827 3.46-.355 1.502-1.78 2.582-3.102 2.067l-1.768-.707a1 1 0 00-1.342.547l-.707 1.768c-.515 1.32-1.958 2.182-3.46 1.827-1.502-.355-2.582-1.78-2.067-3.102l.707-1.768a1 1 0 00-.547-1.342l-1.768-.707c-1.32-.515-2.182-1.958-1.827-3.46.355-1.502 1.78-2.582 3.102-2.067l1.768.707a1 1 0 001.342-.547l.707-1.768z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
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
                    <!-- Theme Switcher -->
                    <div class="relative">
                        <button id="theme-toggle-button" type="button" class="p-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-stone-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                            <svg id="theme-toggle-system-icon" class="hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="theme-toggle-dropdown" class="hidden absolute right-0 mt-2 w-36 bg-white dark:bg-stone-800 rounded-md shadow-lg py-1 z-50 border dark:border-stone-700">
                            <button data-theme="light" class="theme-choice-button w-full text-left px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-stone-700 flex items-center"><svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>Light</button>
                            <button data-theme="dark" class="theme-choice-button w-full text-left px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-stone-700 flex items-center"><svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>Dark</button>
                            <button data-theme="system" class="theme-choice-button w-full text-left px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-stone-700 flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>System</button>
                        </div>
                    </div>

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
                            class="cursor-pointer px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150 ease-in-out flex items-center">
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
        document.addEventListener('DOMContentLoaded', function () {
            // --- Sidebar Toggle Logic ---
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('admin-sidebar');
            const appContainer = document.getElementById('admin-app-container'); // Or the body if preferred

            const checkSidebarState = () => {
                if (window.innerWidth < 768) { // Tailwind's 'md' breakpoint
                    appContainer.classList.add('sidebar-collapsed');
                } else {
                    // On larger screens, you might want to remove the collapsed state by default
                    // appContainer.classList.remove('sidebar-collapsed'); 
                }
            };

            checkSidebarState();

            sidebarToggle.addEventListener('click', function () {
                appContainer.classList.toggle('sidebar-collapsed');
            });

            window.addEventListener('resize', checkSidebarState);

            // --- Theme Switcher Logic ---
            const themeToggleButton = document.getElementById('theme-toggle-button');
            const themeToggleDropdown = document.getElementById('theme-toggle-dropdown');
            const lightIcon = document.getElementById('theme-toggle-light-icon');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const systemIcon = document.getElementById('theme-toggle-system-icon');

            function updateIcon(theme) {
                lightIcon.classList.add('hidden');
                darkIcon.classList.add('hidden');
                systemIcon.classList.add('hidden');

                if (theme === 'dark') {
                    darkIcon.classList.remove('hidden');
                } else if (theme === 'light') {
                    lightIcon.classList.remove('hidden');
                } else {
                    systemIcon.classList.remove('hidden');
                }
            }

            function applyTheme(theme) {
                if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }

            function handleThemeSelection(theme) {
                if (theme === 'system') {
                    localStorage.removeItem('theme');
                } else {
                    localStorage.setItem('theme', theme);
                }
                applyTheme(theme);
                updateIcon(theme);
            }

            themeToggleButton.addEventListener('click', () => {
                themeToggleDropdown.classList.toggle('hidden');
            });

            window.addEventListener('click', (e) => {
                if (themeToggleButton && !themeToggleButton.contains(e.target) && themeToggleDropdown && !themeToggleDropdown.contains(e.target)) {
                    themeToggleDropdown.classList.add('hidden');
                }
            });

            document.querySelectorAll('.theme-choice-button').forEach(button => {
                button.addEventListener('click', () => {
                    handleThemeSelection(button.getAttribute('data-theme'));
                    themeToggleDropdown.classList.add('hidden');
                });
            });

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (!('theme' in localStorage)) {
                    handleThemeSelection('system');
                }
            });

            // Apply theme on initial load
            const savedTheme = localStorage.getItem('theme') || 'system';
            handleThemeSelection(savedTheme);
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
