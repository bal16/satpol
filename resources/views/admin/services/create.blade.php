<x-admin-layout :pageTitle="'Tambah Kartu Informasi'">
    @push('styles')
        <x-rich-text-laravel::styles theme="richtextlaravel" />
    @endpush

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Tambah Kartu Informasi Baru</h1>
        <a href="{{ route('admin.services') }}"
            class="inline-flex items-center px-5 py-2.5 bg-stone-100 dark:bg-stone-700 text-stone-700 dark:text-white text-sm font-medium rounded-lg hover:bg-stone-200 dark:hover:bg-stone-600 focus:outline-none focus:ring-2 focus:ring-stone-500 dark:focus:ring-stone-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white dark:bg-stone-800 shadow-xl rounded-lg p-6">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.services._form', ['service' => new \App\Models\Service()])

            <div class="flex justify-end pt-6">
                <button type="submit"
                    class="px-6 py-2.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-stone-800 cursor-pointer">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>