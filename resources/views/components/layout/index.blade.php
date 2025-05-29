<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} {{ isset($pageName) ? " - $pageName" : '' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('image.png') }}">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap");
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Serif+Text:ital@0;1&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    </style>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @slot('head')
    @endslot

</head>

<body class="grid grid-rows-[auto_1fr_auto]">
    {{ $slot }}
</body>

</html>
