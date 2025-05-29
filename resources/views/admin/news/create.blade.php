<x-admin-layout :pageTitle="'Tambah Berita Baru'">
    @push('styles')
        <x-rich-text-laravel::styles theme="richtextlaravel" />
        <!-- Di dalam <head> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Sebelum </body> penutup -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Tambah Berita Baru</h1>
        <a href="{{ route('admin.news') }}"
            class="inline-flex items-center px-5 py-2.5 bg-stone-100 dark:bg-stone-700 text-stone-700 dark:text-white text-sm font-medium rounded-lg hover:bg-stone-200 dark:hover:bg-stone-600 focus:outline-none focus:ring-2 focus:ring-stone-500 dark:focus:ring-stone-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
            Kembali ke Daftar Berita
        </a>
    </div>

    <div class="bg-white dark:bg-stone-800 shadow-xl rounded-lg p-6">
        <form action="{{ route('admin.news.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="title"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Judul</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="mt-1 py-2 px-3 block w-full rounded-md border-slate-300 dark:border-stone-600 dark:bg-stone-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Slug
                        (Otomatis)</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                        class="mt-1 py-2 px-3 block w-full rounded-md border-slate-300 dark:border-stone-600 dark:bg-stone-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('slug') border-red-500 @enderror"
                        placeholder="Akan terisi otomatis berdasarkan judul" readonly>
                    @error('slug')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="create_news_body"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Isi Berita</label>
                    <x-trix-input :attachment="true" id="create_news_body" name="body" :value="old('body')"
                        class="mt-1 block w-full min-h-[250px] @error('body') trix-content-invalid @enderror" />
                    @error('body')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-stone-800 cursor-pointer">
                        Simpan Berita
                    </button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const titleInput = document.getElementById('title');
                const slugInput = document.getElementById('slug');

                if (titleInput && slugInput) {
                    titleInput.addEventListener('input', function() {
                        const title = this.value;
                        const randomNumber = Math.floor(1000 + Math.random() * 9000); // Angka random 4 digit

                        // Membuat slug dari title
                        let slug = title.toLowerCase()
                            .trim()
                            .replace(/\s+/g, '-') // Ganti spasi dengan strip
                            .replace(/[^\w-]+/g, '') // Hapus karakter non-alphanumeric kecuali strip
                            .replace(/--+/g, '-'); // Ganti multiple strip dengan satu strip

                        if (slug) {
                            slugInput.value = `${slug}-${randomNumber}`;
                        } else {
                            slugInput.value = ''; // Kosongkan slug jika judul kosong
                        }
                    });

                    // Jika ada nilai lama untuk judul (misalnya saat validasi gagal), picu event input untuk mengisi slug
                    if (titleInput.value) {
                        titleInput.dispatchEvent(new Event('input'));
                    }
                }
            });
        </script>
    @endpush
</x-admin-layout>
