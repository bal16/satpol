@props(['type']) {{-- Expects 'daftar' or 'tempo' --}}

@php
$pageName = 'Pajak'; // Common for both types
$headerTitle = '';
$iframeSrc = '';
$iframeTitle = '';
$divId = '';

if ($type === 'daftar') {
    $headerTitle = 'Daftar Wajib Pajak';
    $iframeSrc = 'https://jatuhtempo.satpolpp.semarangkota.go.id/data';
    $iframeTitle = 'Daftar Wajib Pajak';
    $divId = 'daftar-pajak';
} elseif ($type === 'tempo') {
    $headerTitle = 'Jatuh Tempo Pajak';
    $iframeSrc = 'https://jatuhtempo.satpolpp.semarangkota.go.id';
    $iframeTitle = 'Jatuh Tempo Pajak';
    $divId = 'tempo-pajak';
}

@endphp

<x-layout :pageName="$pageName">
    <x-header />
    <main class="flex flex-col items-center">
        <div 
        class="flex font-bold w-full text-[#FDFDFD] text-4xl font-[IBM_Plex_Serif] text-shadow-lg justify-center"
        style="
        background-image: url({{ asset('image/300.jpg') }});
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;"
        >
            <h1 class="lg:w-7xl lg:px-26 lg:text-start text-center py-12 lg:py-0 lg:pt-36">
                {{ $headerTitle }}
            </h1>
        </div>
        <div
            class="flex flex-col justify-between items-center bg-[#FDFDFD] w-full lg:max-w-7xl lg:py-17 py-8.75 px-0 lg:px-23.5 lg:gap-14 gap-8.75">
            <div id="{{ $divId }}"
                class="flex flex-col lg:shadow-lg rounded lg:w-273 w-full lg:h-auto h-auto lg:mx-0 lg:border-t-5 lg:border-[#E94B23]">
                <div class="flex flex-col lg:py-5 px-0 lg:p-5 lg:pt-10">
                    <iframe class="lg:w-full w-full h-[75vh] lg:h-[800px]" title="{{ $iframeTitle }}" src="{{ $iframeSrc }}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </main>
    <x-footer />
</x-layout>