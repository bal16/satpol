<x-admin-layout :pageTitle="'Edit Berita: ' . Str::limit($news->title, 10, '...')">
    @push('styles')
        <x-rich-text-laravel::styles theme="richtextlaravel" />
        <!-- Di dalam <head> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Sebelum </body> penutup -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Edit Berita</h1>
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
                        class="inline-block p-4 border-b-2 rounded-t-lg focus:outline-none"
                        data-tab-target="#newsContent">Detail Berita</button>
                </li>
                <li class="mr-2">
                    <button type="button"
                        class="inline-block p-4 border-b-2 rounded-t-lg focus:outline-none"
                        data-tab-target="#newsImages">Gambar Berita</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div id="newsContent" data-tab-content class="space-y-6">
            <form action="{{ route('admin.news.update', $news->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Judul</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required
                            class="mt-1 py-2 px-3 block w-full rounded-md border-slate-300 dark:border-stone-600 dark:bg-stone-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="author" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Author</label>
                        <input type="text" name="author" id="author" value="{{ old('author', $news->author) }}" required
                            class="mt-1 py-2 px-3 block w-full rounded-md border-slate-300 dark:border-stone-600 dark:bg-stone-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('author') border-red-500 @enderror">
                        @error('author')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $news->slug) }}"
                            class="mt-1 py-2 px-3 block w-full rounded-md border-slate-300 dark:border-stone-600 dark:bg-stone-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('slug') border-red-500 @enderror"
                            placeholder="Akan terisi otomatis berdasarkan judul" readonly>
                        @error('slug')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="edit_news_body" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Isi Berita</label>
                        <x-trix-input id="edit_news_body" name="body" :value="old('body', $news->body->toTrixHtml())"
                            class="mt-1 block w-full min-h-[250px] @error('body') trix-content-invalid @enderror" />
                        @error('body')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-stone-800 cursor-pointer">
                            Simpan Perubahan Berita
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div id="newsImages" data-tab-content class="hidden space-y-6">
            {{-- Form for uploading new images --}}
            <form action="{{ route('admin.news.images.store', $news->id) }}" method="POST" enctype="multipart/form-data" class="mb-6 p-4 border rounded-md dark:border-stone-700">
                @csrf
                <div>
                    <label for="new_images" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tambah Gambar Baru (Bisa Pilih Banyak)</label>
                    <input type="file" name="images[]" id="new_images" multiple
                           class="mt-1 block w-full text-sm text-slate-500 dark:text-slate-300
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-red-50 dark:file:bg-red-700 file:text-red-100 dark:file:text-red-100
                                  hover:file:bg-red-100 dark:hover:file:bg-red-600
                                  @error('images.*', 'imageUpload') border-red-500 @enderror">
                     @error('images', 'imageUpload') {{-- General error for the images array itself --}}
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    @foreach ($errors->imageUpload->get('images.*') as $message)
                         <p class="mt-1 text-xs text-red-500">{{ $message[0] }}</p>
                    @endforeach
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-stone-800">
                        Upload Gambar
                    </button>
                </div>
            </form>

            {{-- Display existing images --}}
            <div>
                <h3 class="text-lg font-medium text-slate-800 dark:text-white mb-3">Gambar Saat Ini</h3>
                @if ($news->images->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach ($news->images as $image)
                            <div class="relative group border rounded-md dark:border-stone-700 p-2">
                                <img src="{{ Storage::url($image->path) }}" alt="News image" class="rounded-md object-cover w-full h-32">
                                <form action="{{ route('admin.news.images.destroy', $image->id) }}" method="POST" class="absolute top-1 right-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)" class="p-1.5 bg-red-600 text-white rounded-full opacity-75 group-hover:opacity-100 hover:bg-red-700 transition-opacity text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500 dark:text-slate-400">Belum ada gambar untuk berita ini.</p>
                @endif
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            // Slug generation (existing script)
            document.addEventListener('DOMContentLoaded', function() {
                const titleInput = document.getElementById('title');
                const slugInput = document.getElementById('slug');

                // Only regenerate slug if the title changes AND the slug field is empty or matches the old title's slug pattern
                // This prevents overwriting a manually set slug or a slug from a previous title if the title is edited again.
                // For simplicity, the current script always regenerates. If you need more sophisticated slug handling on edit,
                // this part might need adjustment or server-side logic to decide whether to update the slug.
                // The `readonly` attribute on slug input currently means it's primarily for display after initial generation.
                // If you allow editing the title to change the slug, ensure the slug remains unique.

                if (titleInput && slugInput) {
                    titleInput.addEventListener('input', function() {
                        const title = this.value;
                        const randomNumber = Math.floor(1000 + Math.random() * 9000); // Angka random 4 digit

                        let slug = title.toLowerCase()
                            .trim()
                            .replace(/\s+/g, '-')
                            .replace(/[^\w-]+/g, '')
                            .replace(/--+/g, '-');

                        if (slug) {
                            slugInput.value = `${slug}-${randomNumber}`;
                        } else {
                            slugInput.value = '';
                        }
                    });

                    // Do NOT automatically regenerate slug on edit page load if a slug already exists.
                    // The existing slug should be preserved unless the title is actively changed.
                    // The current script will regenerate if titleInput.value is present, which is always true on edit.
                    // This behavior might be undesirable as it changes the slug (and adds a new random number)
                    // every time the edit page is loaded and the title field has content.
                    // Consider removing the automatic dispatchEvent on edit, or make it conditional.
                    // For now, I'll leave it as it was in your `create.blade.php` for consistency,
                    // but be aware of this behavior on the edit page.
                    // if (titleInput.value && !slugInput.value) { // Only generate if slug is empty
                    // titleInput.dispatchEvent(new Event('input'));
                    // }
                }

                // Tab functionality
                const tabButtons = document.querySelectorAll('[data-tab-target]');
                const tabContents = document.querySelectorAll('[data-tab-content]');
                const activeTabClasses = ['border-red-500', 'text-red-600', 'dark:text-red-500'];
                const inactiveTabClasses = ['border-transparent', 'hover:text-slate-600', 'hover:border-slate-300', 'dark:hover:text-slate-300', 'dark:hover:border-slate-600'];

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

                // Initial tab activation
                if (tabButtons.length > 0) {
                    let buttonToActivate = tabButtons[0]; // Default to the first tab button
                    const storedTargetId = localStorage.getItem('activeNewsTab');

                    if (storedTargetId) {
                        const foundButton = Array.from(tabButtons).find(btn => btn.dataset.tabTarget === storedTargetId);
                        if (foundButton) {
                            buttonToActivate = foundButton;
                        } else {
                            localStorage.removeItem('activeNewsTab'); // Clean up stale item
                        }
                    }
                    activateTab(buttonToActivate);
                }
            });

            // SweetAlert for delete confirmation
            function confirmDelete(button) {
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Gambar ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                })
            }
        </script>
    @endpush
</x-admin-layout>
