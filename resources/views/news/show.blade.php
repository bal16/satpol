<x-layout :pageName="'Show'">
    <x-header />
    <main class="flex flex-col items-center font-[DM_Sans]">
        <div
            class="flex flex-col font-bold lg:w-250 max-w-display text-black text-5xl  justify-center border-b-2 border-gray-500 pb-5">
            <h1 class="lg:w-7xl  lg:text-start text-center pt-26">
                {{ $news->title }}
            </h1>
            <h3 class="lg:w-7xl  lg:text-start text-center text-xl">
                Oleh "{{ $news->author }}" <span
                    class="text-gray-500 font-normal italic pl-4">{{ $news->created_at }}</span></h3>
        </div>
        <div class="flex flex-col text-blue-500 lg:w-250 max-w-display text-black justify-center py-3">
            <a href="#" class="flex-row flex justify-start lg:px-5 py-2">
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

        <div class="lg:w-250  lg:text-lg text-[11px] w-display  flex flex-col  lg:px-1 px-8 items-center ofervlow-x-hidden">

            {{-- Pastikan variabel $sliders sudah terdefinisi sebelum baris ini --}}
            {{-- Jika Anda mengambil data dari controller, pastikan $sliders sudah di-pass ke view --}}
            <x-news.slider :sliderData="$news->images" />
            {{-- <img class="" src="https://picsum.photos/1000/400" alt="Thumbnail"> --}}
            <div class="py-4 border-b-2 border-gray-500 pb-5">
                {!! $news->body !!}
            </div>
        </div>

        <div class="lg:w-250  flex flex-col py-4 px-4">
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
