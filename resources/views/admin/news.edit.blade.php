<x-admin-layout :pageTitle="'Edit Berita: ' . $news->title">
    @push('styles')
        <x-rich-text-laravel::styles theme="richtextlaravel" />
    @endpush

    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Edit Berita</h1>
    </div>

    <div class="bg-white dark:bg-stone-800 shadow-xl rounded-lg p-6">
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- atau PATCH --}}

            <div class="space-y-4">
                <div>
                    <label for="title"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Judul</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required
                        class="mt-1 py-2 px-3 block w-full rounded-md border-slate-300 dark:border-stone-600 dark:bg-stone-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="body" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Isi
                        Berita</label>
                    {{-- Pastikan ID unik jika ada beberapa editor Trix di halaman lain --}}
                    <x-trix-input :attachment="true" id="edit_news_body" name="body" :value="old('body', $news->body)"
                        class="mt-1 block w-full @error('body')
trix-content-invalid
@enderror" />
                    @error('body')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <a href="{{ route('admin.news') }}"
                        class="mr-2 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-stone-700 rounded-md hover:bg-slate-200 dark:hover:bg-stone-600">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-stone-800">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
