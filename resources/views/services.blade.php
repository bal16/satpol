<x-layout :pageName="'Services'">
    <x-header />
    <main class="flex flex-col items-center">
        <div 
        class="flex font-bold w-full text-[#FDFDFD] text-4xl font-[IBM_Plex_Serif] text-shadow-lg justify-center"
        style="
        background-image: url({{ asset('image/300.jpg') }});
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;"
        >
            <h1 class="lg:w-7xl lg:px-26 lg:text-start text-center pt-36">
                Informasi Umum
            </h1>
        </div>
        <div
            class="flex flex-col justify-between items-center bg-[#FDFDFD] lg:max-w-7xl max-w-160 lg:py-17 py-8.75 px-5 lg:px-23.5 lg:gap-14 gap-8.75">
            <div class="grid lg:grid-cols-3 grid-cols-1 mx-auto lg:gap-14 gap-8.75">
                @foreach ($services as $service)
                    <x-info-card 
                        imageSrc="{{ asset('storage/' . $service->image_src) }}" 
                        title="{{ $service->title }}"
                        :items="$service->items" {{-- Pass the collection of ServiceItems --}}
                        :cardId="$service->card_id" />
                @endforeach
            </div>
            <div class="grid lg:grid-cols-3 grid-cols-1 mx-auto lg:gap-14 gap-8.75">

            </div>
            <div id="view-history"
                class="flex flex-col shadow-lg rounded lg:w-273 w-full lg:h-257 h-auto lg:mx-0 border-t-5 border-[#E94B23]">
                <span class="flex flex-col p-8 lg:pt-10 lg:gap-8 gap-5">
                    <h3 class="font-bold font-[IBM_Plex_Serif] lg:text-5xl text-2xl text-shadow-lg text-[#E94B23]">
                        Sejarah Lengkap</h3>
                    <hr class="lg:w-95.5 w-59.5 lg:border-2 border border-[#E94B23]">
                    <p class="lg:text-2xl text-xs text-justify font-[IBM_Plex_Serif] lg:w-253 w-full px-4">
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
            <div
                class="flex flex-col shadow-lg rounded lg:w-273 w-full lg:h-245 h-auto lg:mx-0 border-t-5 border-[#E94B23]">
                <span class="flex flex-col p-8 lg:pt-10 lg:gap-8 gap-5">
                    <h3 class="font-bold font-[IBM_Plex_Serif] lg:text-5xl text-2xl text-shadow-lg text-[#E94B23]">Map
                    </h3>
                    <hr class="lg:w-95.5 w-59.5 lg:border-2 border border-[#E94B23]">
                    <iframe class="mx-auto lg:w-238 w-full lg:h-185 h-123"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.247579238948!2d110.38884333955568!3d-6.980085989247468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b2d9507a13b%3A0xf137c4f77567b38c!2sKantor+Satpol+PP!5e0!3m2!1sid!2sid!4v1523937750085"
                        style="border:0" data-ruffle-polyfilled=""></iframe>
                </span>
            </div>
        </div>
    </main>
    <x-footer />
</x-layout>
