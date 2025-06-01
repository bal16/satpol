@props([
    'date' => '22 April 2025',
    'title' =>
        'Judul berita default yang cukup panjang untuk menguji pembatasan kata dan tata letak responsif.',
    'image' => 'image/tes.png',
    'category' => 'Berita',
    'href' => '#',
])

<a href="{{ $href }}" class="block group p-2 lg:py-2 rounded-md transition-colors duration-150 ease-in-out hover:bg-gray-100">
    <div class="flex flex-row items-start sm:items-center gap-3 sm:gap-4">
        {{-- Image Container --}}
        <div class="flex-shrink-0">
            <div style="background-image:url('{{ $image }}')"
                 class="bg-cover bg-center rounded
                        w-20 h-20                {{-- Mobile: 80px x 80px --}}
                        sm:w-24 sm:h-24          {{-- SM (Small screens and up): 96px x 96px --}}
                        lg:w-[14.625rem] lg:h-[8.25rem]  {{-- LG (Large screens and up): 234px x 132px (sesuai w-58.5, h-33 asli) --}}
                        ">
            </div>
        </div>

        {{-- Text Content --}}
        <div class="flex flex-col justify-center flex-grow min-w-0"> {{-- min-w-0 penting untuk flexbox menangani overflow teks --}}
            <div class="flex flex-wrap items-center text-xs text-gray-500 mb-1">
                <span class="font-semibold text-red-600 me-2">{{ $category }}</span>
                <span>{{ $date }}</span>
            </div>
            <h3 class="text-sm sm:text-base font-semibold text-gray-800 group-hover:text-[#e93b23] transition-colors duration-150 ease-in-out">
                {{ Str::words($title, 15, '...') }}
            </h3>
        </div>
    </div>
</a>
