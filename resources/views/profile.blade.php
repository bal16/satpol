<x-layout :pageName="'Profile'">
    <x-header />
    <main>
        <div class="flex lg:max-h-64 max-h-32 bg-[#FDFDFD] overflow-hidden justify-center">
            <span class="flex flex-col justify-center text-center lg:h-64 h-32 lg:gap-15 gap-5 py-auto">
                <h2 class="font-[DM_Serif_Text] lg:text-5xl text-xl font-black">Visi</h2>
                <p class="text-xs lg:text-lg">"Semarang Kota Perdagangan dan Jasa yang Hebat Menuju Masyarakat Semakin
                    Sejahtera"</p>
            </span>
        </div>
        <div class="bg-[#2B2A29] lg:max-h-166.25">
            <div class="flex max-w-7xl justify-center mx-auto">
                <div
                    class="flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#FDFDFD] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <span class="font-bold text-3xl lg:text-5xl">Sejarah</span>
                    <span class="font-sans">
                        Polisi Pamong Praja didirikan di Yogyakarta pada tanggal 3 Maret 1950 dengan semboyan Praja
                        Wibawa,
                        untuk mewadahi sebagian ketugasan pemerintah daerah. Sebenarnya ketugasan ini telah dilaksanakan
                        pemerintah sejak zaman kolonial. Sebelum menjadi Satuan Polisi Pamong Praja setelah proklamasi
                        kemerdekaan dimana diawali dengan kondisi yang tidak stabil dan mengancam NKRI, dibentuklah
                        Detasemen Polisi sebagai Penjaga Keamanan Kapanewon di Yogjakarta sesuai dengan Surat Perintah
                        Jawatan Praja di Daerah Istimewa Yogyakarta untuk menjaga ketentraman dan ketertiban masyarakat.
                    </span>
                    <div class="group font-sans font-bold h-fit w-fit">
                        <div
                            class="border-3 border-[#fdfdfd] transition delay-150 duration-300 ease-in-out group-hover:shadow-lg group-hover:shadow-[#DD1D23] group-hover:inset-shadow-sm group-hover:inset-shadow-[#DD1D23]  group-hover:border-[#DD1D23] text-[#fdfdfd] py-1">
                            <a href="{{ route('services') }}" class="px-2">SEJARAH LENGKAP</a>
                        </div>
                    </div>
                </div>
                <div class="lg:max-w-160 max-w-80 lg:px-17.5 px-8.75 lg:py-24.5 py-12.25">
                    <img class="lg:h-126 h-63" src="image/logo.png" alt="" />
                </div>
            </div>
        </div>
        <div class="bg-[#FDFDFD] lg:max-h-166.25">
            <div class="flex max-w-7xl justify-center mx-auto">
                <div
                    class="hidden lg:flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                </div>
                <div
                    class="flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <span class="font-bold text-3xl lg:text-5xl">Struktur Organisasi</span>
                </div>
            </div>
        </div>
        <div class="bg-[#2B2A29] lg:max-h-166.25">
            <div class="flex max-w-7xl justify-center mx-auto">
                <div
                    class="flex flex-col font-[DM_Serif_Text] justify-center text-center text-xs lg:text-lg text-[#FDFDFD] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <span class="font-bold text-3xl lg:text-5xl">Kegiatan</span>
                    <span class="font-sans">Dalam usahanya untuk menjaga ketentraman dan
                        ketertiban dalam masyarakat, Satuan Polisi Pamong Praja melaksanakan kegiatan-kegiatan
                        penertiban yang dapat mengganggu keamanan dan kenyamanan masyarakat. Beberapa kegiatan yang
                        dilaksanakan adalah menyangkut hal-hal berikut:
                    </span>
                    <ul class="columns-2 font-sans lg:px-17.5 px-8.75">
                        <li>
                            Operasi Yustisi
                        </li>
                        <li>
                            Operasi Rutin
                        </li>
                        <li>
                            Penanganan Unjuk Rasa
                        </li>
                        <li>
                            Patroli Wilayah
                        </li>
                        <li>
                            Patroli Pariwisata
                        </li>
                        <li>
                            Kewaspadaan Dini
                        </li>
                        <li>
                            Sosialisasi
                        </li>
                        <li>
                            Bimbingan dan Penyuluhan
                        </li>
                        <li>
                            Posko Kewaspadaan Linmas
                        </li>
                        <li>
                            Patroli keamanan dan kenyamanan lingkungan
                        </li>
                        <li>
                            Mobilisasi dan pergerakan linmas
                        </li>
                        <li>
                            Pengaduan
                        </li>
                        <li>
                            Pengendalian
                        </li>
                        <li>
                            Penyidikan dan penyelidikan
                        </li>
                        <li>
                            Pembinaan PPNS
                        </li>
                        <li>
                            Kegiatan-kegiatan lain
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-[#FDFDFD] lg:max-h-166.25">
            <div class="flex max-w-7xl justify-center mx-auto">
                <div
                    class="hidden lg:flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                </div>
                <div
                    class="flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <span class="font-bold text-3xl lg:text-5xl">Tupoksi</span>
                </div>
            </div>
        </div>
        <div class="bg-[#2B2A29] lg:max-h-166.25">
            <div class="flex max-w-7xl justify-center mx-auto">
                <div
                    class="flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#FDFDFD] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <span class="font-bold text-3xl lg:text-5xl">SOP</span>
                </div>
                <div
                    class="hidden lg:flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#FDFDFD] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                </div>
            </div>
        </div>
        <div class="bg-[#FDFDFD] lg:max-h-166.25">
            <div class="flex max-w-7xl justify-center mx-auto">
                <div
                    class="hidden lg:flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                </div>
                <div
                    class="flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <span class="font-bold text-3xl lg:text-5xl">Strategi & Kebijakan</span>
                </div>
            </div>
        </div>
    </main>
    <x-footer />
</x-layout>
