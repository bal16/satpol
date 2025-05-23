<x-layout :pageName="'Dashboard'">
    <x-header />
    <main>
        <div class="flex w-full lg:max-h-119.5 max-h-74.5 overflow-hidden">
            <img class="w-full object-cover" src="image/slider.png" alt="" />
        </div>
        <div class="bg-[#2B2A29] lg:max-h-166.25">
            <div class="flex max-w-7xl justify-center mx-auto">
                <div class="lg:max-w-160 max-w-80 lg:px-17.5 px-8.75 lg:py-24.5 py-12.25">
                    <img class="lg:h-126 h-63" src="image/logo.png" alt="" />
                </div>
                <div
                    class="flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-xs lg:text-2xl text-[#FDFDFD] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <span class="font-bold text-3xl lg:text-5xl">Informasi Umum</span>
                    <span class="font-bold">Satuan Polisi Pamong Praja, disingkat Satpol PP, adalah perangkat
                        Pemerintah Daerah dalam memelihara ketentraman dan ketertiban umum
                        serta menegakkan Peraturan Daerah.</span>
                    <span class="font-sans">
                        Organisasi dan tata kerja Satuan Polisi Pamong Praja ditetapkan
                        dengan Peraturan Daerah.
                    </span>
                    <div class="group font-sans font-bold h-fit w-fit">
                        <div
                            class="border-3 border-[#fdfdfd] transition delay-150 duration-300 ease-in-out group-hover:shadow-lg group-hover:shadow-[#DD1D23] group-hover:inset-shadow-sm group-hover:inset-shadow-[#DD1D23]  group-hover:border-[#DD1D23] text-[#fdfdfd] py-1">
                            <a href="{{ route('profile') }}" class="px-2">PROFIL LENGKAP</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="flex justify-center lg:h-166.25 h-126.25 items-center bg-[#FDFDFD]">
            <div class="flex lg:max-h-166.25 gap-14">
                <div class="hidden lg:flex flex-col gap-20 max-w-160">
                    <div class="static bg-cover rounded text-[#FDFDFD] max-w-145.25 max-h-81.5 h-81.5"
                        style="background-image:url(image/tes.png)">
                        <div
                            class="static flex flex-col group justify-end w-full h-full bg-gradient-to-b from-white-100/0 to-[#2B2A29]">
                            <a class="z-10 absolute w-145.25 h-81.5" href=""></a>
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
                    <div class="flex mx-auto group font-sans font-bold h-fit w-fit">
                        <div
                            class="border border-[#2B2A29] rounded transition delay-150 duration-300 ease-in-out group-hover:shadow-lg group-hover:shadow-[#ff5f67] group-hover:border-[#e93b23] group-hover:bg-[#e93b23] text-[#2B2A29] group-hover:text-[#fdfdfd] py-1">
                            <button class="px-2">BERITA LENGKAP</button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col lg:max-w-160 gap-4">
                    <div class="static flex lg:w-141 w-121 justify-between group">
                        <a class="z-10 absolute lg:w-141 w-121 lg:h-31.5 h-22.5" href=""></a>
                        <div style="background-image:url(image/tes.png)"
                            class="bg-cover rounded max-w-56 lg:w-56 w-36.5 max-h-31.5 lg:h-31.5 h-22.5">
                        </div>
                        <div class="flex flex-col max-w-75 justify-center">
                            <div class="flex divide-x gap-2 lg:text-xs text-[8px]">
                                <a class="z-20 hover:underline inline-block pe-2" href="#kontol">Berita</a>
                                <span>22 April 2025</span>
                            </div>
                            <span
                                class="lg:text-sm text-xs transition-all delay-150 duration-300 ease-in-out group-hover:border-l-3 group-hover:border-[#e93b23] group-hover:ps-2">Lorem
                                ipsum dolor sit, amet consectetur adipisicing
                                elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis
                                cupiditate ut at, facere quod vel.</span>
                        </div>
                    </div>
                    <div class="static flex lg:w-141 w-121 justify-between group">
                        <a class="z-10 absolute lg:w-141 w-121 lg:h-31.5 h-22.5" href=""></a>
                        <div style="background-image:url(image/tes.png)"
                            class="bg-cover rounded max-w-56 lg:w-56 w-36.5 max-h-31.5 lg:h-31.5 h-22.5">
                        </div>
                        <div class="flex flex-col max-w-75 justify-center">
                            <div class="flex divide-x gap-2 lg:text-xs text-[8px]">
                                <a class="z-20 hover:underline inline-block pe-2" href="#kontol">Berita</a>
                                <span>22 April 2025</span>
                            </div>
                            <span
                                class="lg:text-sm text-xs transition-all delay-150 duration-300 ease-in-out group-hover:border-l-3 group-hover:border-[#e93b23] group-hover:ps-2">Lorem
                                ipsum dolor sit, amet consectetur adipisicing
                                elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis
                                cupiditate ut at, facere quod vel.</span>
                        </div>
                    </div>
                    <div class="static flex lg:w-141 w-121 justify-between group">
                        <a class="z-10 absolute lg:w-141 w-121 lg:h-31.5 h-22.5" href=""></a>
                        <div style="background-image:url(image/tes.png)"
                            class="bg-cover rounded max-w-56 lg:w-56 w-36.5 max-h-31.5 lg:h-31.5 h-22.5">
                        </div>
                        <div class="flex flex-col max-w-75 justify-center">
                            <div class="flex divide-x gap-2 lg:text-xs text-[8px]">
                                <a class="z-20 hover:underline inline-block pe-2" href="#kontol">Berita</a>
                                <span>22 April 2025</span>
                            </div>
                            <span
                                class="lg:text-sm text-xs transition-all delay-150 duration-300 ease-in-out group-hover:border-l-3 group-hover:border-[#e93b23] group-hover:ps-2">Lorem
                                ipsum dolor sit, amet consectetur adipisicing
                                elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis
                                cupiditate ut at, facere quod vel.</span>
                        </div>
                    </div>
                    <div class="static flex lg:w-141 w-121 justify-between group">
                        <a class="z-10 absolute lg:w-141 w-121 lg:h-31.5 h-22.5" href=""></a>
                        <div style="background-image:url(image/tes.png)"
                            class="bg-cover rounded max-w-56 lg:w-56 w-36.5 max-h-31.5 lg:h-31.5 h-22.5">
                        </div>
                        <div class="flex flex-col max-w-75 justify-center">
                            <div class="flex divide-x gap-2 lg:text-xs text-[8px]">
                                <a class="z-20 hover:underline inline-block pe-2" href="#kontol">Berita</a>
                                <span>22 April 2025</span>
                            </div>
                            <span
                                class="lg:text-sm text-xs transition-all delay-150 duration-300 ease-in-out group-hover:border-l-3 group-hover:border-[#e93b23] group-hover:ps-2">Lorem
                                ipsum dolor sit, amet consectetur adipisicing
                                elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis
                                cupiditate ut at, facere quod vel.</span>
                        </div>
                    </div>
                    <div class="lg:hidden flex mx-auto group font-sans font-bold h-fit w-fit">
                        <div
                            class="border border-[#2B2A29] group-hover:border-[#e93b23] group-hover:bg-[#e93b23] text-[#2B2A29] group-hover:text-[#fdfdfd] py-1">
                            <button class="px-2">BERITA LENGKAP</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-footer />
</x-layout>
