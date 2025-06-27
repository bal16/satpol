@props([
    'imageSrc',
    'title',
    'items' => [], // Diubah dari 'links' menjadi 'items' untuk menerima koleksi ServiceItem
    'titleFont' => 'font-[IBM_Plex_Serif]', // Font default untuk judul
    'listFont' => 'font-[IBM_Plex_Serif]',  // Font default untuk daftar link
    'listStyle' => 'list-disc',
    'cardId' => null,
    'hrWidthMobile' => 'w-21',
    'hrWidthDesktop' => 'lg:w-33.5',
    'cardHeightClasses' => 'lg:h-228 h-125.5', // Tinggi kartu default
    'imageHeightClasses' => 'lg:max-h-54.5 max-h-34',
    'listExtraClasses' => '', // Untuk kelas tambahan pada list
    'listContainerClasses' => 'lg:max-w-71.5 w-full', // Kelas untuk kontainer list
    'listItemPadding' => 'lg:px-7 px-4.25', // Padding untuk item list
])

<div
    @if($cardId) id="{{ $cardId }}" @endif
    class="flex flex-col shadow-lg rounded lg:w-81.5 w-full {{ $cardHeightClasses }} lg:border-t-5 border-t-3 border-[#E94B23]">
    <img src="{{ $imageSrc }}" alt="Thumbnail for {{ $title }}" class="{{ $imageHeightClasses }} object-cover">
    <span class="flex flex-col lg:p-5 p-3 lg:gap-8 gap-5 flex-grow">
        <h3 class="font-bold {{ $titleFont }} lg:text-3xl text-lg text-[#E94B23] text-shadow-lg">{{ $title }}</h3>
        <hr class="{{ $hrWidthMobile }} {{ $hrWidthDesktop }} lg:border-2 border border-[#E94B23]">
        @if($items->isNotEmpty())
        <ul
            class="text-[#2B2A29] lg:text-lg text-xs {{ $listFont }} {{ $listExtraClasses }} {{ $listContainerClasses }} {{ $listStyle }} {{ $listItemPadding }} space-y-1.5">
            @foreach($items as $item)
                <li>
                    @if($item->href)
                        <a href="{{ $item->href }}" class="link link-underline link-underline-black">{!! $item->text !!}</a>
                    @else
                        {!! $item->text !!}
                    @endif
                </li>
            @endforeach
        </ul>
        @endif
        {{-- Slot untuk konten tambahan yang tidak sesuai dengan struktur link sederhana --}}
        {{ $slot }}
    </span>
</div>

<style>
    .link-underline {
		border-bottom-width: 0;
		background-image: linear-gradient(transparent, transparent), linear-gradient(#fff, #fff);
		background-size: 0 3px;
		background-position: 0 100%;
		background-repeat: no-repeat;
		transition: background-size .3s ease-in-out;
	}

	.link-underline-black {
		background-image: linear-gradient(transparent, transparent), linear-gradient(#E94B23, #E94B23)
	}

	.link-underline:hover {
		background-size: 100% 3px;
		background-position: 0 100%
	}
</style>