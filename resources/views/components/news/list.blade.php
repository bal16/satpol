@props([
    'date' => '22 April 2025',
    'title' =>
        'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis cupiditate ut at, facere quod vel.',
    'image' => 'image/tes.png',
    'category' => 'Berita',
    'href' => '#',
])

<div class="static flex lg:w-141 md:w-121 w-screen lg:justify-between justify-center lg:gap-0 gap-6 group">
    <a class="z-10 absolute lg:w-141 md:w-121 w-screen lg:h-31.5 h-22.5" href="{{ $href }}"></a>
    <div style="background-image:url('{{ $image }}')"
        class="bg-cover rounded max-w-56 lg:w-56 w-36.5 max-h-31.5 lg:h-31.5 h-22.5">
    </div>
    <div class="flex flex-col lg:max-w-75 max-w-55 justify-center">
        <div class="flex divide-x gap-2 lg:text-xs text-[8px]">
            <a class="z-20 hover:underline inline-block pe-2" href="{{ $href }}">{{ $category }}</a>
            <span>{{ $date }}</span>
        </div>
        <span
            class="lg:text-sm text-xs transition-all delay-150 duration-300 ease-in-out group-hover:border-l-3 group-hover:border-[#e93b23] group-hover:ps-2">{{ Str::words($title, 15, '...') }}</span>
    </div>
</div>
