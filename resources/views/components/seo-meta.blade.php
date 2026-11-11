@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'url' => null,
    'type' => 'website',
    'noindex' => true,
])

@php
    $siteName = config('app.name', 'Satpol PP Kota Semarang');
    $defaultTitle = $siteName . ' - Showcase Portofolio';
    $finalTitle = ! empty($title) ? $title : $defaultTitle;

    $defaultDescription = 'Website showcase portofolio pengembangan web - simulasi portal Satpol PP Kota Semarang.';
    $finalDescription = ! empty($description) ? $description : $defaultDescription;

    $finalUrl = $url ?? url()->current();

    $defaultImage = asset('image.png');
    $rawImage = ! empty($image) ? $image : $defaultImage;
    $finalImage = str_starts_with($rawImage, 'http://') || str_starts_with($rawImage, 'https://')
        ? $rawImage
        : url($rawImage);
@endphp

<!-- Anti-indexing Shield for Portfolio Showcase -->
@if ($noindex)
    <meta name="robots" content="noindex, nofollow">
@endif

<!-- Standard Meta Tags -->
<meta name="title" content="{{ $finalTitle }}">
<meta name="description" content="{{ $finalDescription }}">
<link rel="canonical" href="{{ $finalUrl }}">

<!-- Open Graph / Facebook / LinkedIn / WhatsApp -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $finalUrl }}">
<meta property="og:title" content="{{ $finalTitle }}">
<meta property="og:description" content="{{ $finalDescription }}">
<meta property="og:image" content="{{ $finalImage }}">
<meta property="og:site_name" content="{{ $siteName }} (Demo Portofolio)">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $finalUrl }}">
<meta name="twitter:title" content="{{ $finalTitle }}">
<meta name="twitter:description" content="{{ $finalDescription }}">
<meta name="twitter:image" content="{{ $finalImage }}">
