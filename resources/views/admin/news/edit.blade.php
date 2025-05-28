<x-admin-layout :pageTitle="'Edit Berita: ' . $news->title">
    @push('styles')
        <x-rich-text-laravel::styles theme="richtextlaravel" />
    @endpush

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Edit Berita</h1>
        <a href="{{ route('admin.news') }}"
            class="inline-flex items-center px-4 py-2 bg-slate-200 dark:bg-stone-600 text-slate-700 dark:text-white text-sm font-medium rounded-lg hover:bg-slate-300 dark:hover:bg-stone-500 focus:outline-none focus:ring-2 focus:ring-slate-500 dark:focus:ring-stone-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Daftar Berita
        </a>
    </div>

    <div class="bg-white dark:bg-stone-800 shadow-xl rounded-lg p-6">
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="title"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}"
                        required
                        class="mt-1 py-2.5 px-4 block w-full rounded-lg border-slate-300 dark:border-stone-600 dark:bg-stone-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="edit_news_body"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Isi Berita</label>
                    <x-trix-input id="edit_news_body" name="body" :value="old('body', $news->body)"
                        class="mt-1 block w-full trix-content-tailwind @error('body')
trix-content-invalid
@enderror" />
                    @error('body')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-slate-200 dark:border-stone-700">
                    <a href="{{ route('admin.news') }}"
                        class="mr-3 px-5 py-2.5 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-stone-700 rounded-lg hover:bg-slate-200 dark:hover:bg-stone-600 transition duration-150 ease-in-out">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
