<footer>
    <div
        class="bg-[#2B2A29] text-[#FDFDFD] py-8 lg:py-12 px-6 sm:px-10 lg:px-16 text-xs lg:text-sm">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">

            <!-- Kolom 1: Tentang Instansi -->
            <div class="space-y-3">
                <h5 class="font-bold text-base lg:text-lg mb-2 uppercase">Satpol PP Kota Semarang</h5>
                <p class="text-justify leading-relaxed">
                    Satuan Polisi Pamong Praja Kota Semarang berkomitmen untuk menjaga ketertiban umum,
                    ketentraman, dan perlindungan masyarakat serta menegakkan peraturan daerah
                    demi mewujudkan Kota Semarang yang aman, nyaman, dan tertib.
                </p>
            </div>

            <!-- Kolom 2: Tautan Cepat -->
            <div class="space-y-3">
                <h5 class="font-bold text-base lg:text-lg mb-2 uppercase">Tautan Cepat</h5>
                <ul class="space-y-1.5 md:grid md:grid-cols-2 md:gap-x-6 md:gap-y-1.5 md:space-y-0">
                    <li><a href="{{ route('home') }}" class="hover:text-gray-300 hover:underline transition-colors">Beranda</a></li>
                    <li><a href="{{ route('profile') }}" class="hover:text-gray-300 hover:underline transition-colors">Profil</a></li>
                    <li><a href="{{ route('news') }}" class="hover:text-gray-300 hover:underline transition-colors">Berita</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-gray-300 hover:underline transition-colors">Galeri</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-gray-300 hover:underline transition-colors">Layanan Publik</a> </li>
                    <li><a href="#" class="hover:text-gray-300 hover:underline transition-colors">Kontak Kami</a> {{-- TODO: Ganti # dengan URL/route yang sesuai --}} </li>
                    <li><a href="https://data.semarangkota.go.id/" target="_blank" rel="noopener noreferrer" class="hover:text-gray-300 hover:underline transition-colors">Satu Data Kota Semarang</a></li>
                    <li><a href="https://semarangkota.go.id/" target="_blank" rel="noopener noreferrer" class="hover:text-gray-300 hover:underline transition-colors">Website Kota Semarang</a></li>
                    <li><a href="https://smartcity.semarangkota.go.id/" target="_blank" rel="noopener noreferrer" class="hover:text-gray-300 hover:underline transition-colors">Smart City Semarang</a></li>
                    <li><a href="https://ppid.semarangkota.go.id/" target="_blank" rel="noopener noreferrer" class="hover:text-gray-300 hover:underline transition-colors">PPID Kota Semarang</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Kontak & Media Sosial -->
            <div class="space-y-3">
                <h5 class="font-bold text-base lg:text-lg mb-2 uppercase">Hubungi Kami</h5>
                <address class="not-italic space-y-1.5">
                    <p>Jl. Pemuda No. 148, Sekayu, Semarang Tengah,</p>
                    <p>Kota Semarang, Jawa Tengah 50132</p>
                    <p>Telepon: (024) 3547542</p>
                    <p>Email: <a href="mailto:satpolpp@semarangkota.go.id" class="hover:text-gray-300 hover:underline transition-colors">satpolpp@semarangkota.go.id</a></p>
                </address>
                {{-- <div class="mt-4">
                    <h6 class="font-semibold mb-2">Ikuti Kami:</h6>
                    <div class="flex space-x-3">
                        <a href="#" aria-label="Facebook" class="text-[#FDFDFD] hover:text-gray-300 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"> Facebook Icon Path </svg>
                        </a>
                        <a href="#" aria-label="Instagram" class="text-[#FDFDFD] hover:text-gray-300 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"> Instagram Icon Path </svg>
                        </a>
                        <a href="#" aria-label="Twitter" class="text-[#FDFDFD] hover:text-gray-300 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"> Twitter Icon Path </svg>
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="bg-[#000] text-white py-3 text-center">
        <span class="mx-auto text-xs">&copy; {{ date('Y') }} Satuan Polisi Pamong Praja Kota Semarang. All rights
            reserved</span>
    </div>
</footer>
