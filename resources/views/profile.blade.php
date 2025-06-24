<x-layout :pageName="'Profile'">
    <x-header />
    <style>
        .dropdown:focus-within .dropdown-menu {
            display: block;
            opacity: 1;
        }
        ol {
            list-style-type: decimal;
        }
        .bagi ul {
            display: grid;
            grid-template-columns: auto auto;
        }
    </style>
    <main>
        @if ($items->first()->show)
            <div class="flex lg:max-h-64 max-h-32 bg-[#FDFDFD] overflow-hidden justify-center">
                <span class="flex flex-col justify-center text-center lg:h-64 h-32 lg:gap-15 gap-5 py-auto">
                    <h3 class="font-[DM_Serif_Text] lg:text-7xl text-3xl font-black">{{ $items->first()->title }}</h3>
                    <p class="text-xs lg:text-lg">&quot;{{ $items->first()->content }}&quot;</p>
                </span>
            </div>
        @endif
        @if ($items[1]->show)
            <div class="bg-[#2B2A29] lg:max-h-166.25">
                <div class="flex max-w-7xl justify-center mx-auto">
                    <div
                        class="flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-xs lg:text-lg text-[#FDFDFD] lg:px-17.5 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                        <h3 class="font-bold md:text-start text-center text-3xl lg:text-7xl">{{ $items[1]->title }}</h3>
                        <span class="font-sans text-justify">{{ $items[1]->content }}
                        </span>
                        <div class="group font-sans font-bold h-fit w-fit text-xs lg:text-lg">
                            <div
                                class="p-1 before:ease relative overflow-hidden border border-[#DD1D23] text-[#DD1D23] shadow-2xl transition-all before:absolute before:top-1/2 before:h-0 before:w-64 before:origin-center before:-translate-x-20 before:rotate-45 before:bg-[#DD1D23] before:duration-300 hover:text-white hover:shadow-[#DD1D23] hover:before:h-64 hover:before:-translate-y-32">
                                <a href="{{ route('services') }}" class="px-2 relative z-10 text-xs lg:text-lg">SEJARAH LENGKAP</a>
                            </div>
                        </div>
                    </div>
                    <div class="md:flex flex-row hidden items-center max-w-160 px-17.5 py-24.5">
                        <img class="lg:h-84 md:h-63" src="image/logo.png" alt="" />
                    </div>
                </div>
            </div>
        @endif
        @if ($items[2]->show)
            <div class="bg-[#FDFDFD]">
                <div class="flex max-w-7xl justify-center mx-auto">
                    <div
                        class="flex flex-col items-center font-[DM_Serif_Text] justify-center text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                        <h3 class="font-bold text-3xl lg:text-7xl text-center">{{ $items[2]->title }}</h3>
                        <div class="w-full mt-4 lg:mt-6">
                            <img class="w-full h-auto max-w-3xl mx-auto"
                                src="{{ asset('storage/' . $items[2]->content) }}" alt="Struktur Organisasi" />
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($items[3]->show)
            <div class="bg-[#2B2A29] lg:max-h-166.25">
                <div class="flex lg:max-w-7xl justify-center mx-auto">
                    <div
                        class="flex flex-col font-[DM_Serif_Text] justify-center text-center text-xs lg:text-lg text-[#FDFDFD] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                        <h3 class="font-bold text-3xl lg:text-5xl">{{ $items[3]->title }}</h3>
                        <div class="font-sans bagi text-xs lg:text-lg">
                            {!! $items[3]->body !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($items[4]->show)
            <div class="bg-[#FDFDFD]">
                <div class="flex max-w-7xl justify-center mx-auto">
                    <div
                        class="flex flex-col font-[DM_Serif_Text] justify-center  text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                        <h3 class="font-bold text-3xl lg:text-7xl text-center">{{ $items[4]->title }}</h3>
                        <div class="font-sans text-xs lg:text-lg">
                            {!! $items[4]->body !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($items[5]->show)
            <div class="bg-[#2B2A29]">
                <div class="flex justify-center mx-auto">
                    <div
                        class=" flex flex-col font-[DM_Serif_Text]  justify-center  text-justify text-xs lg:text-lg text-[#FDFDFD] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                        <h3 class="font-bold text-3xl lg:text-7xl">SOP</h3>
                        <div class="flex items-center justify-center space-x-4">
                            <div class="relative dropdown">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    aria-controls="headlessui-menu-items-117"
                                    class=" bg-red-700 text-white px-4 py-2 rounded hover:bg-red-700 hover:text-white">
                                    {{ $sops[4]->title }} ▼
                                </button>
                                <div aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117"
                                    role="menu"
                                    class="dropdown-menu absolute left-0 mt-2 lg:w-48 bg-white border border-gray-200 rounded shadow-md opacity-0 hidden group-hover:opacity-100 group-hover:block transition duration-200 z-10 text-xs lg:text-lg">
                                    @foreach ($sops->skip(4) as $sop)
                                        <a href="#"
                                            class="text-[16px] block px-4 py-2 bg-white text-black rounded hover:bg-red-700 hover:text-white sop-control-button"
                                            onclick="changeIframeSrc('{{ $sop->link }}', this)">{{ $sop->title }}</a>
                                    @endforeach
                                </div>
                            </div>
                            @foreach ($sops->take(4) as $sop)
                                <button
                                    class="bg-white text-black px-4 py-2 rounded hover:bg-red-700 hover:text-white sop-control-button"
                                    onclick="changeIframeSrc('{{ $sop->link }}', this)">
                                    {{ $sop->title }}
                                </button>
                            @endforeach
                        </div>

                        <!-- === IFRAME === -->
                        <iframe id="Iframe"
                            src="https://drive.google.com/file/d/10p8_xDAzRh3vKwv0tXipj4Wo0SzxufMt/preview"
                            class="lg:w-11/12 lg:h-[400px] border border-gray-300 rounded mx-auto"></iframe>
                    </div>

                </div>
            </div>
        @endif
        @if ($items[6]->show)
            <div class="bg-[#FDFDFD] lg:max-h-166.25">
                <div class="flex max-w-7xl justify-center mx-auto">
                    <div
                        class="hidden lg:flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    </div>
                    <div
                        class="flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                        <h3 class="font-bold text-3xl lg:text-7xl">Strategi & Kebijakan</h3>
                    </div>
                </div>
            </div>
        @endif
        <script>
            let currentActiveButton = null; // Menyimpan elemen <button> atau <a> yang iframe-nya aktif
            let currentActiveDropdownTrigger = null; // Menyimpan tombol trigger dropdown utama yang aktif (misal "Bidang PPUD")

            function changeIframeSrc(url, clickedElement) {
                if (url && clickedElement) {
                    document.getElementById('Iframe').src = url;

                    if (event) { // 'event' secara implisit tersedia pada inline event handler
                        event.preventDefault();
                    }

                    // 1. Reset style tombol/link yang sebelumnya aktif
                    if (currentActiveButton && currentActiveButton !== clickedElement) {
                        currentActiveButton.classList.remove('bg-red-700', 'text-white');
                        currentActiveButton.classList.add('bg-white', 'text-black'); // Kembalikan ke style default
                    }

                    // 2. Reset style dan teks tombol trigger dropdown yang sebelumnya aktif (jika ada)
                    if (currentActiveDropdownTrigger) {
                        currentActiveDropdownTrigger.classList.remove('bg-red-700', 'text-white');
                        currentActiveDropdownTrigger.classList.add('bg-white', 'text-black');
                        if (currentActiveDropdownTrigger.dataset.originalText) {
                            currentActiveDropdownTrigger.innerHTML = currentActiveDropdownTrigger.dataset.originalText;
                        }
                        currentActiveDropdownTrigger = null; // Reset
                    }

                    // 3. Tambahkan style aktif ke elemen yang baru diklik (<a> atau <button>)
                    clickedElement.classList.remove('bg-white', 'text-black');
                    clickedElement.classList.add('bg-red-700', 'text-white');
                    currentActiveButton = clickedElement; // Perbarui elemen yang sedang aktif

                    // 4. Jika yang diklik adalah item dropdown (<a>), perbarui tombol trigger dropdown-nya
                    const dropdownGroup = clickedElement.closest('.relative.dropdown');
                    if (clickedElement.tagName === 'A' && dropdownGroup) {
                        const mainDropdownButton = dropdownGroup.querySelector('button');
                        if (mainDropdownButton) {
                            if (!mainDropdownButton.dataset.originalText) {
                                mainDropdownButton.dataset.originalText = mainDropdownButton.innerHTML.trim();
                            }
                            mainDropdownButton.innerHTML = clickedElement.textContent.trim() + ' ▼';
                            mainDropdownButton.classList.remove('bg-white', 'text-black');
                            mainDropdownButton.classList.add('bg-red-700', 'text-white');
                            currentActiveDropdownTrigger = mainDropdownButton; // Set trigger dropdown yang aktif
                        }
                    }
                }
            }
        </script>
    </main>
    <x-footer />
</x-layout>
