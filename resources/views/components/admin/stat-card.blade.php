@props([
    'title',
    'value',
    'subtext' => '',
    'color' => 'red',
    'iconPath'
])
@php
$colorClasses = [
    'red' => [
        'container' => 'bg-red-700 dark:bg-stone-700 border-red-700 dark:border-red-600',
        'icon_bg' => 'bg-white dark:bg-red-500',
        'icon_text' => 'text-red-600 dark:text-white',
    ],
    'green' => [
        'container' => 'bg-green-600 dark:bg-stone-700 border-green-600 dark:border-green-500',
        'icon_bg' => 'bg-white dark:bg-green-500',
        'icon_text' => 'text-green-600 dark:text-white',
    ],
    'blue' => [
        'container' => 'bg-blue-600 dark:bg-stone-700 border-blue-600 dark:border-blue-500',
        'icon_bg' => 'bg-white dark:bg-blue-500',
        'icon_text' => 'text-blue-600 dark:text-white',
    ],
];
$selectedColor = $colorClasses[$color] ?? $colorClasses['red']; // Default to red if color not found
@endphp
<div
    class="{{ $selectedColor['container'] }} p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out border-l-4">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-white dark:text-white uppercase">{{ $title }}</p>
            <p class="text-3xl font-bold text-white dark:text-white">{{ $value }}</p>
        </div>
        <div class="p-3 {{ $selectedColor['icon_bg'] }} rounded-full">
            <svg class="w-6 h-6 {{ $selectedColor['icon_text'] }}" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="{{ $iconPath }}">
                </path>
            </svg>
        </div>
    </div>
    @if ($subtext)
        <p class="text-xs text-white dark:text-white mt-2">{{ $subtext }}</p>
    @endif
</div>
