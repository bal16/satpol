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
        <div class="bg-[#FDFDFD]">
            <div class="flex max-w-7xl justify-center mx-auto">
                <div
                    class="flex flex-col items-center font-[DM_Serif_Text] justify-center text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <span class="font-bold text-3xl lg:text-5xl text-center">Struktur Organisasi</span>
                    <div class="w-full mt-4 lg:mt-6">
                        <img class="w-full h-auto max-w-3xl mx-auto" src="image/struktur-organisasi.jpg"
                            alt="Struktur Organisasi" />
                    </div>
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
        <div class="bg-[#FDFDFD]">
            <div class="flex justify-center mx-auto">
                <div
                    class="flex flex-col font-[DM_Serif_Text] justify-center  text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <h3 class="font-bold text-3xl lg:text-5xl text-center">Tupoksi</h3>
                    <h4 class="font-bold text-3xl lg:text-2xl">GAMBARAN PELAYANAN SATUAN POLISI PAMONG PRAJA KOTA
                        SEMARANG</h4>
                    <p class="font-sans">
                        Didalam Undang-undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah disebutkan bahwa
                        kewenangan Satuan polisi pamong praja adalah : (a) melakukan tindakan penertiban non-yustisial
                        terhadap warga masyarakat, aparatur, atau badan hukum yang melakukan pelanggaran atas Perda
                        dan/atau Perkada; (b) menindak warga masyarakat, aparatur, atau badan hukum yang mengganggu
                        ketertiban umum dan ketenteraman masyarakat; (c) melakukan tindakan penyelidikan terhadap warga
                        masyarakat, aparatur, atau badan hukum yang diduga melakukan pelanggaran atas Perda dan/atau
                        Perkada; dan (d) melakukan tindakan administratif terhadap warga masyarakat, aparatur, atau
                        badan hukum yang melakukan pelanggaran atas Perda dan/atau Perkada.

                        Dalam pelaksanaan tugasnya Satpol PP Kota Semarang berdasar pada Peraturan Pemerintah Nomor 6
                        Tahun 2010 tentang Pedoman Satuan Polisi Pamong Praja yang berisi tentang penyusunan Struktur
                        organisasi dan tata kerja, tugas dan fungsi Satpol PP serta pedoman-pedoman dasar lainnya.
                        Adapun Struktur Organisasi dan Tata Kerja Satpol PP Kota Semarang diatur dalam Peraturan Daerah
                        Kota Semarang Nomor 14 Tahun 2016 tentang Pembentukan dan Susunan Perangkat Daerah Kota Semarang
                        dengan penjabaran tugas pokok dan fungsi masing-masing bagian, bidang dan seksi diatur dalam
                        Peraturan Walikota Semarang Nomor 67 Tahun 2016 tentang Kedudukan, Susunan Organisasi, Tugas
                        Gungsi Serta Tata Kerja Satuan Polisi Pamong Praja Kota Semarang.
                    </p>
                    <h4 class="font-sans font-bold text-3xl lg:text-xl">TUGAS: </h4>
                    <p class="font-sans">Membantu Walikota dalam melaksanakan urusan pemerintahan bidang Ketenteraman
                        dan ketertiban umum serta perlindungan masyarakat yang menjadi kewenangan daerah dan tugas
                        pembantuan yang ditugaskan kepada daerah. </p>
                    <h4 class="font-sans font-bold text-3xl lg:text-xl">FUNGSI: </h4>
                    <ol class="font-sans order-1 list-decimal lg:px-17.5 px-8.75">
                        <li>Perumusan kebijakan Bidang Pembinaan Masyarakat, Bidang Ketertiban Umum
                            dan Ketenteraman Masyarakat, Bidang Penegakan Perundang-Undangan Daerah, dan Bidang Satuan
                            Perlindungan Masyarakat;</li>
                        <li>Perumusan rencana strategis sesuai dengan visi dan misi Walikota;</li>
                        <li>Pengkoordinasian tugas-tugas dalam rangka pelaksanaan program dan kegiatan
                            Kesekretariatan,
                            Bidang Pembinaan Masyarakat, Bidang Ketertiban Umum dan Ketenteraman Masyarakat, Bidang
                            Penegakan Perundang-Undangan Daerah, dan Bidang Satuan Perlindungan Masyarakat;</li>
                        <li>Penyelenggaraan pembinaan kepada bawahan dalam lingkup tanggungjawabnya;</li>
                        <li>Penyelenggaraan penyusunan Sasaran Kerja Pegawai;</li>
                        <li>Penyelenggaraan kerjasama Bidang Pembinaan Masyarakat, Bidang Ketertiban Umum dan
                            Ketenteraman Masyarakat, Bidang Penegakan Perundang-Undangan Daerah, dan Bidang Satuan
                            Perlindungan Masyarakat;</li>
                        <li>Penyelenggaraan kesekretariatan Satpol PP;</li>
                        <li>Penyelenggaraan program dan kegiatan Bidang Pembinaan Masyarakat, Bidang Ketertiban Umum
                            dan
                            Ketenteraman Masyarakat, Bidang Penegakan Perundang-Undangan Daerah, dan Bidang Satuan
                            Perlindungan Masyarakat;</li>
                        <li>Penyelenggaraan penilaian kinerja Pegawai;</li>
                        <li>Penyelenggaraan monitoring dan evaluasi program dan kegiatan Bidang Penegakan
                            Perundang-Undangan Daerah, Bidang Pembinaan Masyarakat, Bidang Ketertiban Umum dan
                            Ketenteraman
                            Masyarakat, Bidang
                            Penegakan Perundang-Undangan Daerah, dan Bidang Satuan Perlindungan Masyarakat;</li>
                        <li>Penyelenggaraan laporan pelaksanaan program dan kegiatan; dan</li>
                        <li>Pelaksanaan fungsi lain yang diberikan oleh Walikota terkait dengan tugas dan
                            fungsinya.</li>
                    </ol>
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
