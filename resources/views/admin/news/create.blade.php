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
        <!-- Tab Nav -->
        <div class="mb-6 border-b border-slate-200 dark:border-stone-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="newsTabs">
                <li class="mr-2">
                    <button type="button"
                        class="inline-block p-4 border-b-2 rounded-t-lg focus:outline-none text-slate-500 dark:text-slate-400 cursor-pointer"
                        data-tab-target="#newsContent">Detail Berita</button>
                </li>
                <li class="mr-2">
                    <button type="button"
                        class="inline-block p-4 border-b-2 rounded-t-lg focus:outline-none text-slate-500 dark:text-slate-400 cursor-pointer"
                        data-tab-target="#newsImages">Gambar Berita</button>
                </li>
            </ul>
        </div>

        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tab Content -->
            <div id="newsContent" data-tab-content class="space-y-4">
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
                    <label for="author"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Author</label>
                    <input type="text" name="title" id="title" value="{{ old('author') }}" required
                        class="mt-1 py-2 px-3 block w-full rounded-md border-slate-300 dark:border-stone-600 dark:bg-stone-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('author') border-red-500 @enderror">
                    @error('author')
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
                    <x-trix-input id="create_news_body" name="body" :value="old('body')"
                        class="mt-1 block w-full min-h-[250px] @error('body') trix-content-invalid @enderror" />
                    @error('body')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div id="newsImages" data-tab-content class="hidden space-y-4">
                <div>
                    <label for="images" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Upload
                        Gambar (Bisa Pilih Banyak)</label>
                    <input type="file" name="images[]" id="images" multiple
                        class="mt-1 block w-full text-sm text-slate-500 dark:text-slate-300
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-red-50 dark:file:bg-red-700 file:text-red-700 dark:file:text-red-100
                                  hover:file:bg-red-100 dark:hover:file:bg-red-600
                                  @error('images.*') border-red-500 @enderror">
                    @error('images.*')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    @error('images')
                        {{-- General error for the images array itself --}}
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end pt-6 mt-6 border-t border-slate-200 dark:border-stone-700">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-stone-800 cursor-pointer">
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            // Slug generation (existing script)
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

                // Tab functionality
                const tabButtons = document.querySelectorAll('[data-tab-target]');
                const tabContents = document.querySelectorAll('[data-tab-content]');
                const activeTabClasses = ['border-red-500', 'text-red-600', 'dark:text-red-500'];
                const inactiveTabClasses = ['border-transparent', 'hover:text-slate-600', 'hover:border-slate-300',
                    'dark:hover:text-slate-300', 'dark:hover:border-slate-600'
                ];

                function activateTab(button) {
                    const target = document.querySelector(button.dataset.tabTarget);

                    tabContents.forEach(tabContent => {
                        tabContent.classList.add('hidden');
                    });
                    tabButtons.forEach(btn => {
                        btn.classList.remove(...activeTabClasses);
                        btn.classList.add(...inactiveTabClasses);
                        btn.setAttribute('aria-selected', 'false');
                    });

                    if (target) {
                        target.classList.remove('hidden');
                    }
                    button.classList.add(...activeTabClasses);
                    button.classList.remove(...inactiveTabClasses);
                    button.setAttribute('aria-selected', 'true');
                    localStorage.setItem('activeNewsTab', button.dataset.tabTarget);
                }

                tabButtons.forEach(button => {
                    button.addEventListener('click', () => activateTab(button));
                });

                const storedTab = localStorage.getItem('activeNewsTab');
                const defaultTabButton = tabButtons.length > 0 ? tabButtons[0] : null;
                let tabToActivate = defaultTabButton;

                if (storedTab) {
                    const storedTabButton = document.querySelector(`[data-tab-target="${storedTab}"]`);
                    if (storedTabButton) {
                        tabToActivate = storedTabButton;
                    }
                }

                if (tabToActivate) {
                    activateTab(tabToActivate);
                } else if (tabButtons.length > 0) {
                    // Fallback if no tab was activated (e.g. localStorage was invalid)
                    activateTab(tabButtons[0]);
                }
            });
        </script>
    @endpush
</x-admin-layout>
