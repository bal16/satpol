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
    <!-- Sidebar Component -->
    <x-sidebar />

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
