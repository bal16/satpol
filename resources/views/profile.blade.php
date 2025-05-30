<x-layout :pageName="'Profile'">
    <x-header />
    <style>
        .dropdown:focus-within .dropdown-menu {
            display: block;
            opacity: 1;
        }
    </style>
    <main>
        <div class="flex lg:max-h-64 max-h-32 bg-[#FDFDFD] overflow-hidden justify-center">
            <span class="flex flex-col justify-center text-center lg:h-64 h-32 lg:gap-15 gap-5 py-auto">
                <h3 class="font-[DM_Serif_Text] lg:text-7xl text-xl font-black">Visi</h3>
                <p class="text-xs lg:text-lg">"Semarang Kota Perdagangan dan Jasa yang Hebat Menuju Masyarakat Semakin
                    Sejahtera"</p>
            </span>
        </div>
        <div class="bg-[#2B2A29] lg:max-h-166.25">
            <div class="flex max-w-7xl justify-center mx-auto">
                <div
                    class="flex flex-col font-[DM_Serif_Text] justify-center lg:max-w-160 max-w-80 text-justify text-xs lg:text-lg text-[#FDFDFD] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <h3 class="font-bold text-3xl lg:text-7xl">Sejarah</h3>
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
                    <h3 class="font-bold text-3xl lg:text-7xl text-center">Struktur Organisasi</h3>
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
            <div class="flex max-w-7xl justify-center mx-auto">
                <div
                    class="flex flex-col font-[DM_Serif_Text] justify-center  text-justify text-xs lg:text-lg text-[#2B2A29] lg:px-17.5 px-8.75 lg:py-24.5 py-12.25 lg:gap-7.5 gap-4.5">
                    <h3 class="font-bold text-3xl lg:text-7xl text-center">Tupoksi</h3>
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
                                Bidang PPUD ▼
                            </button>
                            <div aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117"
                                role="menu"
                                class="dropdown-menu absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-md opacity-0 hidden group-hover:opacity-100 group-hover:block transition duration-200 z-10">
                                <a href="#"
                                    class="text-[16px] block px-4 py-2 bg-white text-black rounded hover:bg-red-700 hover:text-white sop-control-button"
                                    onclick="changeIframeSrc('https://drive.google.com/file/d/10p8_xDAzRh3vKwv0tXipj4Wo0SzxufMt/preview', this)">Bidang
                                    PPUD</a>
                                <a href="#"
                                    class="text-[16px] block px-4 py-2 bg-white text-black rounded hover:bg-red-700 hover:text-white sop-control-button"
                                    onclick="changeIframeSrc('https://drive.google.com/file/d/1uw65fA59SUyZjm6qmSARL8mtqwDcWBas/preview', this)">Penegakan
                                    Perda</a>
                                <a href="#"
                                    class="text-[16px] block px-4 py-2 bg-white text-black rounded hover:bg-red-700 hover:text-white sop-control-button"
                                    onclick="changeIframeSrc('https://drive.google.com/file/d/1umhMSZK1Bbv6rum0E55zYFHUuHYRWr8-/preview', this)">Gelar
                                    Perkara</a>
                                <a href="#"
                                    class="text-[16px] block px-4 py-2 bg-white text-black rounded hover:bg-red-700 hover:text-white sop-control-button"
                                    onclick="changeIframeSrc('https://drive.google.com/file/d/1TXABrxwP6kd9du4oxvuzOvnEal9uxLCS/preview', this)">Sidang
                                    di Tempat</a>
                                <a href="#"
                                    class="text-[16px] block px-4 py-2 bg-white text-black rounded hover:bg-red-700 hover:text-white sop-control-button"
                                    onclick="changeIframeSrc('https://drive.google.com/file/d/1Zj6pYe4hsiSURZvca84eGnCjTwtUKRxo/preview', this)">Hubungan
                                    Antar OPD</a>
                                <a href="#"
                                    class="text-[16px] block px-4 py-2 bg-white text-black rounded hover:bg-red-700 hover:text-white sop-control-button"
                                    onclick="changeIframeSrc('https://drive.google.com/file/d/18Pv7ShM6vRGW0ic4q-qHRdbqE4W_Qaif/preview', this)">Pembinaan
                                    PPNS</a>
                                <a href="#"
                                    class="text-[16px] block px-4 py-2 bg-white text-black rounded hover:bg-red-700 hover:text-white sop-control-button"
                                    onclick="changeIframeSrc('https://drive.google.com/file/d/1J9bUFlh7opRIbfp9Gpuh9vy9GMd5tUOT/preview', this)">Sekretariat
                                    PPNS</a>
                            </div>
                        </div>
                        <button
                            class="bg-white text-black px-4 py-2 rounded hover:bg-red-700 hover:text-white sop-control-button"
                            onclick="changeIframeSrc('https://drive.google.com/file/d/1rXh3RG54VFu6N6-xKSF_ksDstd7ERYeP/preview', this)">
                            Bidang Tibum
                        </button>
                        <button
                            class="bg-white text-black px-4 py-2 rounded hover:bg-red-700 hover:text-white sop-control-button"
                            onclick="changeIframeSrc('https://drive.google.com/file/d/1i4vtkTyHw9uh6ro-KF8hU4ISrKL3VjFM/preview', this)">
                            Bidang Linmas
                        </button>
                        <button
                            class="bg-white text-black px-4 py-2 rounded hover:bg-red-700 hover:text-white sop-control-button"
                            onclick="changeIframeSrc('https://drive.google.com/file/d/1SxUEH52slktWxLzWLj3vY4VodQzWheoP/preview', this)">
                            Bidang Sekretariat
                        </button>
                        <button
                            class="bg-white text-black px-4 py-2 rounded hover:bg-red-700 hover:text-white sop-control-button"
                            onclick="changeIframeSrc('https://drive.google.com/file/d/1BIKXvqq8AwYBCpiF0tnGyvbsitKJmpA0/preview', this)">
                            Bidang Binmas
                        </button>
                    </div>

                    <!-- === IFRAME === -->
                    <iframe id="Iframe"
                        src="https://drive.google.com/file/d/10p8_xDAzRh3vKwv0tXipj4Wo0SzxufMt/preview"
                        class="w-11/12 h-[400px] border border-gray-300 rounded mx-auto"></iframe>
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
                    <h3 class="font-bold text-3xl lg:text-7xl">Strategi & Kebijakan</h3>
                </div>
            </div>
        </div>
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
