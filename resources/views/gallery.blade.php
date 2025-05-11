<x-layout :pageName="'Gallery'">
    <x-header />
    <main class="bg-[#FDFDFD]">
        <div class="flex max-w-7xl justify-center mx-auto">
            <div class="flex flex-col p-25">
                <h1 class="lg:text-5xl text-3xl font-[DM_Serif_Text]">Galeri</h1>
                <div class="flex lg:flex-row flex-col p-6 rounded-sm shadow-xl justify-between lg:gap-0 gap-5">
                    <div class="flex lg:flex-col lg:justify-start justify-between gap-4">
                        <h2 class="lg:border-b-2 lg:w-76">
                            <span
                                class="lg:font-bold lg:text-lg text-xs text-[#FDFDFD] bg-black px-2 py-1">Kategori</span>
                        </h2>
                        <ul class="flex lg:flex-col gap-2 py-1">
                            <li class="font-bold lg:text-xl text-xs"><a href="">Semua Foto</a></li>
                            <li class="opacity-50 lg:text-sm text-xs"><a href="">Kegiatan</a></li>
                            <li class="opacity-50 lg:text-sm text-xs"><a href="">Berita</a></li>
                            <li class="opacity-50 lg:text-sm text-xs"><a href="">Seminar</a></li>
                        </ul>
                    </div>
                    <div class="grid grid-cols-3 lg:pl-16 gap-2">
                        <a href=""><img src="image/tes.png" class="lg:w-50 h-37.5" alt="TES"></a>
                        <a href=""><img src="image/slider.png" class="lg:w-50 h-37.5" alt="TES"></a>
                        <a href=""><img src="image/tes.png" class="lg:w-50 h-37.5" alt="TES"></a>
                        <a href=""><img src="image/slider.png" class="lg:w-50 h-37.5" alt="TES"></a>
                        <a href=""><img src="image/tes.png" class="lg:w-50 h-37.5" alt="TES"></a>
                        <a href=""><img src="image/slider.png" class="lg:w-50 h-37.5" alt="TES"></a>
                        <a href=""><img src="image/tes.png" class="lg:w-50 h-37.5" alt="TES"></a>
                        <a href=""><img src="image/slider.png" class="lg:w-50 h-37.5" alt="TES"></a>
                        <a href=""><img src="image/tes.png" class="lg:w-50 h-37.5" alt="TES"></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-footer />
</x-layout>
