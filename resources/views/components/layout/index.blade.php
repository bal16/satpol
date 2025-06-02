<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} {{ isset($pageName) ? " - $pageName" : '' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('image.png') }}">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap");
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Serif+Text:ital@0;1&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    </style>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="grid grid-rows-[auto_1fr_auto] font-sans antialiased">
    <!-- Sidebar -->
    <aside id="nav-sidebar"
        class="fixed top-0 left-0 z-50 w-64 h-screen p-4 overflow-y-auto bg-red-700 dark:bg-stone-800 text-slate-100 shadow-lg transition-transform duration-300 ease-in-out -translate-x-full">
        <div class="flex justify-between items-center mb-6">
            <h5 class="text-lg font-semibold text-white uppercase">Menu</h5>
            <button type="button" id="close-sidebar-button"
                class="text-slate-300 bg-transparent hover:bg-red-600 hover:text-white rounded-lg text-sm p-1.5">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
        </div>
        <ul class="space-y-2 font-medium">
            <li><a href="{{ route('home') }}"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-red-600 dark:hover:bg-stone-700 group">Beranda</a>
            </li>
            <li><a href="{{ route('profile') }}"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-red-600 dark:hover:bg-stone-700 group">Profil</a>
            </li>
            <li><a href="{{ route('news') }}"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-red-600 dark:hover:bg-stone-700 group">Berita</a>
            </li>
            <li><a href="{{ route('gallery') }}"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-red-600 dark:hover:bg-stone-700 group">Galeri</a>
            </li>
            <li><a href="{{ route('services') }}"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-red-600 dark:hover:bg-stone-700 group">Informasi
                    Umum</a></li>
            <li><a href="{{ route('services') }}/#view-history"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-red-600 dark:hover:bg-stone-700 group">Sejarah</a>
            </li>
            {{-- Anda bisa menambahkan tautan lain di sini jika diperlukan --}}
        </ul>
    </aside>

    <!-- Overlay for sidebar -->
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-stone-500 opacity-50 hidden"></div>

    {{ $slot }}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggleBtn = document.getElementById('sidebar-toggle-button');
            const navSidebar = document.getElementById('nav-sidebar');
            const closeSidebarBtn = document.getElementById('close-sidebar-button');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            function openSidebar() {
                if (navSidebar && sidebarOverlay) {
                    navSidebar.classList.remove('-translate-x-full');
                    navSidebar.classList.add('translate-x-0');
                    sidebarOverlay.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden'); // Mencegah scroll konten utama
                }
            }

            function closeSidebar() {
                if (navSidebar && sidebarOverlay) {
                    navSidebar.classList.add('-translate-x-full');
                    navSidebar.classList.remove('translate-x-0');
                    sidebarOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            }

            if (sidebarToggleBtn) {
                sidebarToggleBtn.addEventListener('click', openSidebar);
            }
            if (closeSidebarBtn) {
                closeSidebarBtn.addEventListener('click', closeSidebar);
            }
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeSidebar);
            }
        });
    </script>
</body>

</html>
