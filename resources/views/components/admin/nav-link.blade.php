@props(['active' => false, 'href'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 text-base font-medium text-white bg-red-800 rounded-lg transition-colors duration-150 group'  // Active link: darker red background
            : 'flex items-center px-4 py-3 text-base font-medium text-red-100 hover:text-white hover:bg-red-600 rounded-lg transition-colors duration-150 group'; // Inactive link: light red text, lighter red hover
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
