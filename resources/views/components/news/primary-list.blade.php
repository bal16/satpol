@props([
    'date' => '22 April 2025',
    'title' =>
        'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis cupiditate ut at, facere quod vel.',
    'image' => 'image/tes.png',
    'category' => 'Berita',
    'href' => '#',
])

<div class="flex justify-between items-center group gap-5">
    <a class="z-10 absolute w-138.5 h-33" href="{{ $href }}"></a>
    <div style="background-image:url({{ $image }})" class="bg-cover rounded w-58.5 h-33">
    </div>
    <div class="flex flex-col max-w-75 justify-center">
        <div class="flex divide-x gap-2 lg:text-sm text-xs">
            <a class="z-20 hover:underline inline-block pe-2" href="{{ $href }}">{{ $category }}</a>
            <span>{{ $date }}</span>
        </div>
        <span class="lg:text-lg text-xs group-hover:border-l-3 group-hover:border-[#e93b23] group-hover:ps-2">Lorem
            {{ Str::words($title, 15, '...') }}</span>
    </div>
</div>
