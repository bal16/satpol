@props(['title', 'subtitle'])

<div class="mb-8 text-center">
    <h1 class="text-2xl font-bold text-black dark:text-white sm:text-3xl">
        {{ $title }}
    </h1>
    <p class="mt-2 text-base font-medium text-gray-600 dark:text-gray-400">
        {{ $subtitle }}
    </p>
</div>
