@props([
    'title',
    'value',
    'subtext' => '',
    'color' => 'red',
    'iconPath'
])

<div
    class="dark:bg-stone-500 bg-{{ $color }}-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out border-l-4 border-{{ $color }}-700 dark:border-{{ $color }}-800">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-white dark:text-white uppercase">{{ $title }}</p>
            <p class="text-3xl font-bold text-white dark:text-white">{{ $value }}</p>
        </div>
        <div class="p-3 dark:bg-{{ $color }}-500 bg-white rounded-full">
            <svg class="w-6 h-6 dark:text-white text-{{ $color }}-600" fill="none" stroke="currentColor"
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
