<x-layout :pageName="'Dashboard'">
    <x-header />
    <main>
        <div class="flex lg:max-h-119.5 max-h-69.5 overflow-hidden justify-center">
            <img class="w-full object-cover" src="image/slider.png" alt="" />
        </div>
        <div
            class="bg-[#2B2A29] max-w-screen lg:max-h-166.25 flex justify-center lg:gap-35 gap-10 lg:px-40 px-20 lg:py-20 py-10">
            <img class="w-40 lg:w-85 h-fit my-auto" src="image/logo.png" alt="" />
            <div
                class="flex flex-col font-[DM_Serif_Text] justify-center text-xs lg:text-xl text-[#FDFDFD] px-5 lg:gap-10 gap-5">
                <span class="font-bold text-xl lg:text-5xl">Informasi Umum</span>
                <span class="font-bold">Satuan Polisi Pamong Praja, disingkat Satpol PP, adalah perangkat
                    Pemerintah Daerah dalam memelihara ketentraman dan ketertiban umum
                    serta menegakkan Peraturan Daerah.</span>
                <span class="font-sans">
                    Organisasi dan tata kerja Satuan Polisi Pamong Praja ditetapkan
                    dengan Peraturan Daerah.
                </span>
                <div class="group font-sans font-bold">
                    <div class="border border-[#fdfdfd] group-hover:border-[#DD1D23] text-[#fdfdfd] h-fit w-fit py-1">
                        <button class="px-2">PROFIL LENGKAP</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex bg-[#FDFDFD] lg:max-h-166.25 max-h-69.5">
            <div class="flex flex-col justify-between">
                <a class="flex flex-col justify-between text-[#FDFDFD] max-w-145.25 max-h-81.5 m-4"
                    style="background-image:url(image/tes.png)">
                    <div class="flex flex-col text-sm gap-2 m-4">
                        <div class="flex divide-x text-xs px-2 gap-2">
                            <span class="pe-2">Berita</span>
                            <span>22 April 2025</span>
                        </div>
                        <span class="px-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                            Officia aliquam dignissimos voluptatum voluptatibus perspiciatis
                            cupiditate ut at, facere quod vel.</span>
                    </div>
                </a>
            </div>
        </div>
    </main>
    <x-footer />
</x-layout>
