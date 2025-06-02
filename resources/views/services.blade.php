<x-layout :pageName="'Services'">
    <x-header />
    <main class="flex flex-col items-center">
        <div
            class="flex font-bold w-full text-[#FDFDFD] font-[DM_Serif_Text] justify-center bg-[url(https://picsum.photos/2000/300)] bg-cover bg-center">
            <h1 class="lg:w-7xl text-3xl md:text-4xl lg:px-26 px-4 lg:text-start text-center pt-24 sm:pt-32 lg:pt-43">
                Informasi Umum
            </h1>
        </div>
        <div
            class="flex flex-col bg-[#FDFDFD] w-full lg:max-w-7xl max-w-screen-xl mx-auto py-8 sm:py-12 lg:py-17 px-4 sm:px-6 md:px-10 lg:px-23.5 gap-8 sm:gap-10 lg:gap-14">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mx-auto gap-6 md:gap-8 lg:gap-14 w-full">
                <x-service-card imageSrc="https://picsum.photos/600/401" title="Layanan">
                    <x-slot name="listItems">
                        <ul
                            class="text-[#2B2A29] font-[DM_Serif_Text] lg:max-w-71.5 max-w-full list-disc lg:px-7 px-4.25">
                            <li><a href="">Sarana dan Prasarana</a></li>
                            <li><a href="">Daftar Informasi Publik</a></li>
                            <li><a href="">Peraturan</a></li>
                        </ul>
                    </x-slot>
                </x-service-card>

                <x-service-card imageSrc="https://picsum.photos/600/400" title="Pemberdayaan">
                    <x-slot name="listItems">
                        <ul
                            class="text-[#2B2A29] font-[DM_Serif_Text] lg:max-w-71.5 max-w-full list-disc lg:px-7 px-4.25">
                            <li><a href="">Bidang Kamtibnas</a></li>
                            <li><a href="">Bidang Kesehatan</a></li>
                            <li><a href="">Bidang Pariwisata</a></li>
                        </ul>
                    </x-slot>
                </x-service-card>

                <x-service-card imageSrc="https://picsum.photos/600/402" title="PPID">
                    <x-slot name="listItems">
                        <ul
                            class="text-[#2B2A29] font-[DM_Serif_Text] lg:max-w-71.5 max-w-full list-disc lg:px-7 px-4.25">
                            <li><a href="">Dasar Hukum</a></li>
                            <li><a href="">Pelayanan Informasi</a></li>
                            <li><a href="">Informasi</a></li>
                            <li><a href="">Profil PPID</a></li>
                        </ul>
                    </x-slot>
                </x-service-card>

                <x-service-card id="contact" imageSrc="https://picsum.photos/600/403" title="Kontak">
                    <x-slot name="listItems">
                        <ul
                            class="text-[#2B2A29] font-bold font-[DM_Sans] lg:max-w-71.5 max-w-full list-disc lg:px-7 px-4.25">
                            <li><a href="Tel: +621326317741">No. Telp<br>
                                    <p class="font-normal">+621326317741</p>
                                </a></li>
                            <li><a href="mailto: satpolpp@semarangkota.go.id">Email<br>
                                    <p class="font-normal">satpolpp@semarangkota.go.id</p>
                                </a></li>
                            <li><a href="https://www.facebook.com/satpolppsemarangkota/?locale=id_ID">Facebook<br>
                                    <p class="font-normal">satpolppsemarangkota</p>
                                </a></li>
                            <li><a href="https://x.com/satpolpp_smg">X<br>
                                    <p class="font-normal">@satpolpp.smg</p>
                                </a></li>
                            <li><a href="https://www.instagram.com/satpolpp.smg/">Instagram<br>
                                    <p class="font-normal">@satpolpp.smg</p>
                                </a></li>
                        </ul>
                    </x-slot>
                </x-service-card>

                <x-service-card imageSrc="https://picsum.photos/600/404" title="Perda Kota Semarang">
                    <x-slot name="listItems">
                        <ul
                            class="text-[#2B2A29] font-[DM_Serif_Text] lg:max-w-71.5 max-w-full list-disc lg:px-7 px-4.25">
                            <li><a href="#">Perda Bangunan Gedung</a></li>
                            <li><a href="#">Perda Minuman Beralkohol</a></li>
                            <li><a href="#">Perda Pengelolaan Rumah</a></li>
                            <li><a href="#">Perda Pengendalian Lingkungan Hidup</a></li>
                            <li><a href="#">Perda Penyelenggaraan Administrasi Kependudukan</a></li>
                            <li><a href="#">Perda Pendidik Pegawai Negeri Sipil</a></li>
                            <li><a href="#">Perda Rencana Tata Ruang Wilayah</a></li>
                            <li><a href="#">Perda Reklame</a></li>
                            <li><a href="#">Perda Pengelolaan Pohon Pada Ruang Terbuka Hijau</a></li>
                        </ul>
                    </x-slot>
                </x-service-card>

                <x-service-card imageSrc="https://picsum.photos/600/405" title="SOP">
                    <x-slot name="listItems">
                        <ul
                            class="text-[#2B2A29] font-[DM_Serif_Text] lg:max-w-71.5 max-w-full list-disc lg:px-7 px-4.25">
                            <li><a href="#">Bidang PPUD</a></li>
                            <li><a href="#">Bidang Tibum</a></li>
                            <li><a href="#">Bidang Linmas</a></li>
                            <li><a href="#">Bidang Sekretariat</a></li>
                            <li><a href="#">Bidang Binmas</a></li>
                        </ul>
                    </x-slot>
                </x-service-card>

                <x-service-card imageSrc="https://picsum.photos/600/406" title="Pajak Daerah">
                    <x-slot name="listItems">
                        <ul
                            class="text-[#2B2A29] font-[DM_Serif_Text] lg:max-w-71.5 max-w-full list-disc lg:px-7 px-4.25">
                            <li><a href="https://jatuhtempo.satpolpp.semarangkota.go.id/data">Daftar Wajib Pajak</a>
                            </li>
                            <li><a href="#">Jatuh Tempo Pajak</a></li>
                        </ul>
                    </x-slot>
                </x-service-card>

                <x-service-card imageSrc="https://picsum.photos/600/407" title="Perjanjian Kinerja">
                    <x-slot name="listItems">
                        <ul
                            class="text-[#2B2A29] font-[DM_Serif_Text] lg:max-w-71.5 max-w-full list-disc lg:px-7 px-4.25">
                            <li><a href="#">Menuju</a></li>
                        </ul>
                    </x-slot>
                </x-service-card>

            </div>
            <div id="view-history"
                class="flex flex-col shadow-lg rounded w-full lg:w-273 lg:h-245 h-auto border-t-5 border-[#E94B23]">
                <span class="flex flex-col p-5 lg:pt-10 lg:gap-8 gap-5">
                    <h3 class="font-bold font-[DM_Serif_Text] lg:text-5xl text-2xl text-shadow-lg text-[#E94B23]">
                        Sejarah Lengkap</h3>
                    <hr class="lg:w-95.5 w-59.5 lg:border-2 border border-[#E94B23]">
                    <p class="text-sm lg:text-xl text-justify font-[DM_Serif_Text] w-full lg:w-253">
                        Satuan Polisi Pamong Praja, disingkat Satpol PP, adalah perangkat Pemerintah Daerah dalam
                        memelihara ketentraman dan ketertiban umum serta menegakkan Peraturan Daerah. Organisasi dan
                        tata kerja Satuan Polisi Pamong Praja ditetapkan dengan Peraturan Daerah.</br></br>
                        Polisi Pamong Praja didirikan di Yogyakarta pada tanggal 3 Maret 1950 dengan semboyan Praja
                        Wibawa, untuk mewadahi sebagian ketugasan pemerintah daerah. Sebenarnya ketugasan ini telah
                        dilaksanakan pemerintah sejak zaman kolonial. Sebelum menjadi Satuan Polisi Pamong Praja setelah
                        proklamasi kemerdekaan dimana diawali dengan kondisi yang tidak stabil dan mengancam NKRI,
                        dibentuklah Detasemen Polisi sebagai Penjaga Keamanan Kapanewon di Yogjakarta sesuai dengan
                        Surat Perintah Jawatan Praja di Daerah Istimewa Yogyakarta untuk menjaga ketentraman dan
                        ketertiban masyarakat.</br></br>
                        Pada tanggal 10 November 1948, lembaga ini berubah menjadi Detasemen Polisi Pamong Praja. Di
                        Jawa dan Madura Satuan Polisi Pamong Praja dibentuk tanggal 3 Maret 1950. Inilah awal mula
                        terbentuknya Satpol PP. dan oleh sebab itu, setiap tanggal 3 Maret ditetapkan sebagai Hari Jadi
                        Satuan Polisi Pamong Praja (Satpol PP) dan diperingati setiap tahun. Pada Tahun 1960, dimulai
                        pembentukan Kesatuan Polisi Pamong Praja di luar Jawa dan Madura, dengan dukungan para petinggi
                        militer /Angkatan Perang. Tahun 1962 namanya berubah menjadi Kesatuan Pagar Baya untuk
                        membedakan dari korps Kepolisian Negara seperti dimaksud dalam UU No 13/1961 tentang Pokok-pokok
                        Kepolisian. Tahun 1963 berubah nama lagi menjadi Kesatuan Pagar Praja. Istilah Satpol PP mulai
                        terkenal sejak pemberlakuan UU No 5/1974 tentang Pokok-pokok Pemerintahan di Daerah.
                    </p>
                </span>
            </div>
            <div id="view-map"
                class="flex flex-col shadow-lg rounded w-full lg:w-273 lg:h-auto h-auto border-t-5 border-[#E94B23]">
                <span class="flex flex-col p-5 lg:pt-10 lg:gap-8 gap-5">
                    <h3 class="font-bold font-[DM_Serif_Text] lg:text-5xl text-2xl text-shadow-lg text-[#E94B23]">Map
                    </h3>
                    <hr class="lg:w-95.5 w-59.5 lg:border-2 border border-[#E94B23]">
                    <iframe class="mx-auto w-full lg:w-238 h-64 sm:h-80 md:h-96 lg:h-185"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.247579238948!2d110.38884333955568!3d-6.980085989247468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b2d9507a13b%3A0xf137c4f77567b38c!2sKantor+Satpol+PP!5e0!3m2!1sid!2sid!4v1523937750085"
                        style="border:0" width="100%" data-ruffle-polyfilled=""></iframe>
                </span>
            </div>
        </div>
    </main>
    <x-footer />
</x-layout>
