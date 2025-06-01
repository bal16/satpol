<x-layout :pageName="Str::words($news->title, 20, '...')">
    <x-header />
    <main class="flex flex-col items-center font-[DM_Sans] overflow-x-hidden"> {{-- Menambahkan overflow-x-hidden sebagai pengaman --}}
        {{-- Bagian Judul --}}
        <div
            class="w-full lg:max-w-4xl xl:max-w-5xl mx-auto px-4 sm:px-6 lg:px-0 flex flex-col font-bold text-black justify-center border-b-2 border-gray-500 pb-5 pt-12 lg:pt-20">
            {{-- Mengganti lg:w-250 max-w-display dengan max-width responsif dan padding. Menyesuaikan padding atas. --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl lg:text-start text-center">
                {{-- Menghapus lg:w-7xl, menyesuaikan ukuran font agar responsif --}}
                {{ $news->title }}
            </h1>
            <h3 class="text-base sm:text-lg lg:text-xl lg:text-start text-center mt-2">
                {{-- Menghapus lg:w-7xl, menyesuaikan ukuran font agar responsif --}}
                Oleh "{{ $news->author }}" <span
                    class="text-gray-500 font-normal italic pl-4">{{ $news->created_at }}</span></h3>
        </div>
        {{-- Bagian Tombol Salin Tautan --}}
        <div
            class="w-full lg:max-w-4xl xl:max-w-5xl mx-auto px-4 sm:px-6 lg:px-0 flex flex-col text-blue-500 text-black justify-center py-3">
            {{-- Mengganti lg:w-250 max-w-display dengan max-width responsif dan padding --}}
            <a href="#" class="flex flex-row items-center justify-start py-2">
                {{-- Menghapus lg:px-5, menambahkan items-center untuk alignment ikon dan teks --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.5" color="currentColor">
                        <path
                            d="M14.556 13.218a2.67 2.67 0 0 1-3.774-3.774l2.359-2.36a2.67 2.67 0 0 1 3.628-.135m-.325-3.167a2.669 2.669 0 1 1 3.774 3.774l-2.359 2.36a2.67 2.67 0 0 1-3.628.135" />
                        <path
                            d="M21 13c0 3.771 0 5.657-1.172 6.828S16.771 21 13 21h-2c-3.771 0-5.657 0-6.828-1.172S3 16.771 3 13v-2c0-3.771 0-5.657 1.172-6.828S7.229 3 11 3" />
                    </g>
                </svg>
                <p class="flex text-left pl-1">Salin Tautan</p>
            </a>
        </div>

        {{-- Bagian Slider dan Isi Berita --}}
        {{-- Div sebelumnya: class="lg:w-250 lg:text-lg text-[11px] w-display flex flex-col lg:px-1 px-8 items-center ofervlow-x-hidden" --}}
        {{-- Sekarang dipecah menjadi kontainer w-full untuk slider, dan kontainer max-width terpisah untuk teks isi berita --}}
        <div class="w-full flex flex-col items-center"> {{-- Ini memastikan slider bisa full-width jika komponennya dirancang demikian --}}
            {{-- Pastikan variabel $sliders sudah terdefinisi sebelum baris ini --}}
            {{-- Jika Anda mengambil data dari controller, pastikan $sliders sudah di-pass ke view --}}
            <x-news.show-slider :sliderData="$news->images" />

            {{-- Isi Berita --}}
            <div
                class="w-full lg:max-w-4xl xl:max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-4 border-b-2 border-gray-500 pb-5 text-sm lg:text-lg">
                {{-- Menambahkan max-width responsif, padding, dan ukuran teks untuk isi berita --}}
                {!! $news->body !!}
            </div>
        </div>
        {{-- Bagian "Artikel baru" --}}
        <div class="w-full lg:max-w-4xl xl:max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col py-4">
            {{-- Mengganti lg:w-250 dengan max-width responsif dan padding --}}
            <h4 class="text-xl font-bold italic lg:text-start text-center">Artikel baru</h4>
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                {{-- Ini Mulai isi Berita --}}
                <div class="static bg-cover rounded text-[#FDFDFD] max-w-145.25 max-h-81.5 h-81.5"
                    style="background-image:url(image/tes.png)">
                    <div
                        class="static flex flex-col group justify-end w-full h-full bg-gradient-to-b from-white-100/0 to-[#2B2A29]">
                        <a class="z-10 absolute lg:w-145.25 w-75.25 h-81.5" href=""></a>
                        <div class="flex flex-col gap-2 m-4">
                            <div class="flex divide-x gap-2 text-xs">
                                <a class="z-20 hover:underline inline-block pe-2" href="#kontol">Berita</a>
                                <span>22 April 2025</span>
                            </div>
                            <span
                                class="transition-all delay-150 duration-300 ease-in-out group-hover:border-l-3 group-hover:ps-2">Lorem
                                ipsum dolor sit, amet consectetur adipisicing
                                elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis
                                cupiditate ut at, facere quod vel.</span>
                        </div>
                    </div>
                </div>
                <div class="static bg-cover rounded text-[#FDFDFD] max-w-145.25 max-h-81.5 h-81.5"
                    style="background-image:url(image/tes.png)">
                    <div
                        class="static flex flex-col group justify-end w-full h-full bg-gradient-to-b from-white-100/0 to-[#2B2A29]">
                        <a class="z-10 absolute lg:w-145.25 w-75.25 h-81.5" href=""></a>
                        <div class="flex flex-col gap-2 m-4">
                            <div class="flex divide-x gap-2 text-xs">
                                <a class="z-20 hover:underline inline-block pe-2" href="#kontol">Berita</a>
                                <span>22 April 2025</span>
                            </div>
                            <span
                                class="transition-all delay-150 duration-300 ease-in-out group-hover:border-l-3 group-hover:ps-2">Lorem
                                ipsum dolor sit, amet consectetur adipisicing
                                elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis
                                cupiditate ut at, facere quod vel.</span>
                        </div>
                    </div>
                </div>
                <div class="static bg-cover rounded text-[#FDFDFD] max-w-145.25 max-h-81.5 h-81.5"
                    style="background-image:url(image/tes.png)">
                    <div
                        class="static flex flex-col group justify-end w-full h-full bg-gradient-to-b from-white-100/0 to-[#2B2A29]">
                        <a class="z-10 absolute lg:w-145.25 w-75.25 h-81.5" href=""></a>
                        <div class="flex flex-col gap-2 m-4">
                            <div class="flex divide-x gap-2 text-xs">
                                <a class="z-20 hover:underline inline-block pe-2" href="#kontol">Berita</a>
                                <span>22 April 2025</span>
                            </div>
                            <span
                                class="transition-all delay-150 duration-300 ease-in-out group-hover:border-l-3 group-hover:ps-2">Lorem
                                ipsum dolor sit, amet consectetur adipisicing
                                elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis
                                cupiditate ut at, facere quod vel.</span>
                        </div>
                    </div>
                </div>
                <div class="static bg-cover rounded text-[#FDFDFD] max-w-145.25 max-h-81.5 h-81.5"
                    style="background-image:url(image/tes.png)">
                    <div
                        class="static flex flex-col group justify-end w-full h-full bg-gradient-to-b from-white-100/0 to-[#2B2A29]">
                        <a class="z-10 absolute lg:w-145.25 w-75.25 h-81.5" href=""></a>
                        <div class="flex flex-col gap-2 m-4">
                            <div class="flex divide-x gap-2 text-xs">
                                <a class="z-20 hover:underline inline-block pe-2" href="#kontol">Berita</a>
                                <span>22 April 2025</span>
                            </div>
                            <span
                                class="transition-all delay-150 duration-300 ease-in-out group-hover:border-l-3 group-hover:ps-2">Lorem
                                ipsum dolor sit, amet consectetur adipisicing
                                elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis
                                cupiditate ut at, facere quod vel.</span>
                        </div>
                    </div>
                </div>
                {{-- Ini Akhir isi Berita --}}
            </div>
        </div>
    </main>
    <x-footer />
</x-layout>
