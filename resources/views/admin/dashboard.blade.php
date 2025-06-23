<x-admin-layout :pageTitle="'Dashboard'">
    <!-- Welcome Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800 dark:text-white">Selamat Datang Kembali, Admin!</h2>
        <p class="text-slate-600 dark:text-white">Berikut adalah ringkasan aktivitas terkini.</p>
    </div>

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Stat Card 1: Total Berita --}}
        <x-admin.stat-card
            title="Total Berita"
            :value="$totalNews"
            :subtext="$newsSubtext"
            color="red"
            iconPath="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"
        />

        {{-- Stat Card 2: Item Galeri --}}
        <x-admin.stat-card
            title="Item Galeri"
            :value="$totalGalleryItems"
            :subtext="$gallerySubtext"
            color="green"
            iconPath="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
        />

        <!-- Add more stat cards as needed for Slider, Users, etc. -->
        {{-- Tambahkan kartu statistik lain di sini jika perlu --}}
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
                <x-admin.quick-action-button
                    href="{{ route('admin.news') }}"
                    text="Tambah Berita Baru"
                    color="red"
                    iconPath="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                />
                <x-admin.quick-action-button
                    href="{{ route('admin.gallery') }}"
                    text="Unggah ke Galeri"
                    color="green"
                    iconPath="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                />
                {{-- Add more quick action buttons as needed --}}
            </div>
        </div>
    </div>
</x-admin-layout>
