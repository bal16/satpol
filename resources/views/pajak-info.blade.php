@props(['type']) {{-- Expects 'daftar' or 'tempo' --}}

@php
$pageName = 'Pajak'; // Common for both types
$headerTitle = '';
$iframeSrc = '';
$iframeTitle = '';
$divId = '';

// Base classes for the header section
$headerDivBaseClasses = 'flex font-bold w-full font-[IBM_Plex_Serif] text-shadow-lg justify-center';
$h1BaseClasses = 'lg:px-26 text-center';

// Type-specific classes and content
$headerDivSpecificClasses = '';
$h1SpecificClasses = '';

if ($type === 'daftar') {
    $headerTitle = 'Daftar Wajib Pajak';
    $iframeSrc = 'https://jatuhtempo.satpolpp.semarangkota.go.id/data';
    $iframeTitle = 'Daftar Wajib Pajak';
    $divId = 'daftar-pajak';

    $headerDivSpecificClasses = 'text-black text-4xl lg:text-7xl pt-10';
    # $h1SpecificClasses = 'lg:w-7xl lg:text-start pt-43';
} elseif ($type === 'tempo') {
    $headerTitle = 'Jatuh Tempo Pajak';
    $iframeSrc = 'https://jatuhtempo.satpolpp.semarangkota.go.id';
    $iframeTitle = 'Jatuh Tempo Pajak';
    $divId = 'tempo-pajak';

    $headerDivSpecificClasses = 'text-black text-4xl lg:text-7xl pt-10';
    // h1SpecificClasses remains empty for 'tempo', using base classes
}

$finalHeaderDivClasses = trim($headerDivBaseClasses . ' ' . $headerDivSpecificClasses);
$finalH1Classes = trim($h1BaseClasses . ' ' . $h1SpecificClasses);
@endphp

<x-layout :pageName="$pageName">
    <x-header />
    <main class="flex flex-col items-center">
        <div class="{{ $finalHeaderDivClasses }}">
            <h1 class="{{ $finalH1Classes }}">
                {{ $headerTitle }}
            </h1>
        </div>
        <div
            class="flex flex-col justify-between items-center bg-[#FDFDFD] lg:max-w-7xl max-w-160 lg:py-17 py-8.75 px-5 lg:px-23.5 lg:gap-14 gap-8.75">
            <div id="{{ $divId }}"
                class="flex flex-col shadow-lg rounded lg:w-273 w-full lg:h-auto h-auto lg:mx-0 border-t-5 border-[#E94B23]">
                <div class="flex flex-col p-5 lg:pt-10 lg:gap-8 gap-5">
                    <iframe class="w-full h-[75vh] lg:h-[800px]" title="{{ $iframeTitle }}" src="{{ $iframeSrc }}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </main>
    <x-footer />
</x-layout>