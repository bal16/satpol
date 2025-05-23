<div class="flex min-h-screen flex-col items-center justify-center bg-gray-100 pt-6 dark:bg-boxdark-2 sm:pt-0">
    <div class="w-full max-w-[500px] rounded-lg bg-white p-6 shadow-default dark:bg-boxdark sm:p-10 md:p-15">
        {{ $logo ?? '' }}
        {{ $slot }}
    </div>
</div>
