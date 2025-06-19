<x-admin-layout :pageTitle="'Dashboard'">
    <!-- Welcome Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800 dark:text-white">Selamat Datang Kembali, Admin!</h2>
        <p class="text-slate-600 dark:text-white">Berikut adalah ringkasan aktivitas terkini.</p>
    </div>

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1: Total Berita -->
        <div
            class="dark:bg-stone-500 bg-red-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out border-l-4 border-red-700 dark:border-red-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-white dark:text-white uppercase">Total Berita</p>
                    <p class="text-3xl font-bold text-white dark:text-white">150</p> {{-- Replace with dynamic data --}}
                </div>
                <div class="p-3 dark:bg-red-500 bg-white rounded-full">
                    <svg class="w-6 h-6 dark:text-white text-red-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-white dark:text-white mt-2">+5% dari bulan lalu</p> {{-- Example sub-text --}}
        </div>
        <!-- Stat Card 2: Item Galeri -->
        <div
            class="dark:bg-stone-500 bg-red-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out border-l-4 border-green-500 dark:border-green-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-white dark:text-white uppercase">Item Galeri</p>
                    <p class="text-3xl font-bold text-white dark:text-white">78</p> {{-- Replace with dynamic data --}}
                </div>
                <div class="p-3 bg-white dark:bg-green-500 rounded-full">
                    <svg class="w-6 h-6 text-green-600 dark:text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-white dark:text-white mt-2">+2 baru minggu ini</p> {{-- Example sub-text --}}
        </div>
        <!-- Add more stat cards as needed for Slider, Users, etc. -->
        {{-- Example:
        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out border-l-4 border-purple-500 dark:border-purple-700">
            ...
        </div>
        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out border-l-4 border-yellow-500 dark:border-yellow-700">
            ...
        </div>
        --}}
    </div>
    <!-- Main Content Area / Welcome Message -->
    <div class="dark:bg-stone-500 bg-red-700 p-6 md:p-8 rounded-xl shadow-2xl">
        <h3 class="text-xl font-black dark:text-white text-slate-200 mb-4">Panduan Pengelolaan Konten</h3>
        <p class="dark:text-white text-white mb-6 leading-relaxed">
            Selamat datang di panel admin Satuan Polisi Pamong Praja. Dari sini, Anda memiliki kontrol penuh untuk
            mengelola berbagai aspek penting dari website.
            Gunakan menu navigasi di sebelah kiri untuk mengakses modul-modul seperti pengelolaan Berita, Galeri foto
            dan video, serta konten Slider pada halaman utama.
            Pastikan semua informasi yang dimasukkan akurat dan terkini.
        </p>
        <div class="border-t border-slate-200 dark:border-stone-700 pt-6">
            <h4 class="text-lg font-medium dark:text-white text-slate-300 mb-3">Tindakan Cepat:</h4>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.news') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-red-100 dark:bg-red-500 text-red-700 dark:text-white text-sm font-medium rounded-lg hover:bg-red-800 dark:hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tambah Berita Baru
                </a>
                <a href="{{ route('admin.gallery') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-white text-sm font-medium rounded-lg hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Unggah ke Galeri
                </a>
                {{-- Add more quick action buttons as needed --}}
            </div>
        </div>
    </div>
</x-admin-layout>
