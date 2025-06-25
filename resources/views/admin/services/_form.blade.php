@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Kartu</label>
        <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" required
            class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-stone-700 dark:border-stone-600 dark:text-white">
    </div>
    <div>
        <label for="image_src" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Gambar</label>
        <input type="file" name="image_src" id="image_src" accept="image/*"
            class="block w-full text-sm text-slate-500 dark:text-slate-300
                file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-semibold
                file:bg-red-50 dark:file:bg-red-700 file:text-red-700 dark:file:text-red-100
                hover:file:bg-red-100 dark:hover:file:bg-red-600
                file:cursor-pointer cursor-pointer">
        @if ($service->image_src)
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Gambar saat ini:</p>
            <img src="{{ asset('storage/' . $service->image_src) }}" alt="Gambar saat ini"
                class="mt-2 h-32 w-auto object-cover rounded-md shadow-sm">
        @else
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Tidak ada gambar saat ini.</p>
        @endif
    </div>
</div>

<div class="mt-6">
    <label for="service_body" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Isi Konten</label>
    {{-- Pastikan model Service Anda menggunakan trait HasRichText agar ini berfungsi --}}
    <x-trix-input id="service_body" name="body" :value="old('body', $service->body)"
        class="mt-1 block w-full min-h-[250px] @error('body') trix-content-invalid @enderror" />
    @error('body')
        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <div>
        <label for="card_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">ID Kartu (Opsional)</label>
        <input type="text" name="card_id" id="card_id" value="{{ old('card_id', $service->card_id) }}"
            placeholder="e.g., contact"
            class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-stone-700 dark:border-stone-600 dark:text-white">
    </div>

</div>