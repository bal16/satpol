@props([
    'page' => null,
    'pageName' => null,
    'seoTitle' => null,
    'seoDescription' => null,
    'seoImage' => null,
    'seoType' => 'website',
])

@php
    $effectivePage = $pageName ?? $page;
    $computedTitle = $seoTitle ?? (config('app.name') . ($effectivePage ? " - $effectivePage" : ''));
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $computedTitle }}</title>

    <x-seo-meta
        :title="$seoTitle ?? ($effectivePage ? ($effectivePage . ' - ' . config('app.name')) : null)"
        :description="$seoDescription"
        :image="$seoImage"
        :type="$seoType"
    />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
{{ $slot }}

</html>
