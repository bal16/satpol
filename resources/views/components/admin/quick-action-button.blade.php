@props(['href', 'text', 'color' => 'red', 'iconPath'])

<a href="{{ $href }}"
    class="inline-flex items-center px-5 py-2.5 bg-{{ $color }}-100 dark:bg-{{ $color }}-500 text-{{ $color }}-700 dark:text-white text-sm font-medium rounded-lg hover:bg-{{ $color }}-800 dark:hover:bg-{{ $color }}-700 focus:outline-none focus:ring-2 focus:ring-{{ $color }}-500 dark:focus:ring-{{ $color }}-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white">
    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="{{ $iconPath }}" clip-rule="evenodd"></path>
    </svg>
    {{ $text }}
</a>
