<x-admin-layout :pageTitle="'Profile'">
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Kelola Profile Halaman</h1>
        {{-- Optional: Add a "Create New" button if needed in the future --}}
        {{-- <a href="{{ route('admin.profile.create') }}"
            class="inline-flex items-center px-5 py-2.5 bg-red-100 dark:bg-red-500 text-red-700 dark:text-white text-sm font-medium rounded-lg hover:bg-red-800 dark:hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            Tambah Item Profile Baru
        </a> --}}
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg">
        <div class="p-4 overflow-x-auto">
            <table class="table-auto w-full">
                <thead class="bg-red-600 dark:bg-stone-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Judul
                            (Title)</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Ditampilkan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-stone-700 divide-y divide-slate-200 dark:divide-stone-600">
                    @forelse ($items as $item)
                        <tr>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $item->title }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                @if ($item->show)
                                    <span class="inline-flex items-center justify-center text-green-500" title="Ya">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center text-red-500" title="Tidak">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                @if ($item->title == 'SOP')
                                    <a href="{{ route('admin.profile.sop') }}"
                                        class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Edit</a>
                                @else
                                    <a href="{{ route('admin.profile.edit', $item->id) }}"
                                        class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Edit</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center">Tidak ada item profile ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
