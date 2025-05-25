<x-admin-layout :pageTitle="'Galeri'">
    @push('styles')
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
         You might want to add a DataTables theme compatible with Tailwind CSS for better styling consistency 
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css"> --}}
        <link href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css" rel="stylesheet"
            integrity="sha384-AsA35Lk2b1bdNXsEfz6MqkD/XkQdW8zEykqBZihdl/kU7DLyednCOCzbKfbSoxFb" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.min.css" rel="stylesheet"
            integrity="sha384-kz9bozrCHP/y+wTJV8P+n/dMBOh00rqNmmIAgHckzFWpoSB49V5ornW1aY+uYTyA" crossorigin="anonymous">
    @endpush

    <!-- Page Title & Add New Button -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Kelola Galeri</h1>
        <a href="#"
            class="inline-flex items-center px-5 py-2.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-white text-sm font-medium rounded-lg hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                    clip-rule="evenodd"></path>
            </svg>
            Unggah ke Galeri
        </a>
    </div>

    <!-- News Management Table -->
    <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg">
        <div class="p-4">
            <table id="newsTable" class="table-auto">
                <thead class="bg-red-600 dark:bg-stone-700">
                    <tr>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            ID</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Title</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Foto</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Created At</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Updated At</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-stone-700 divide-y divide-slate-200 dark:divide-stone-600">
                    @php
                        // Dummy data for Blade preview. Replace with data from your controller.
                        // Example: $newsItems = App\Models\News::latest()->paginate(10);
                        if (!isset($newsItems)) {
                            $newsItems = collect([
                                (object) [
                                    'id' => 1,
                                    'title' => 'First News Title Example',
                                    'body' => 'https://placehold.co/600x400',
                                    'created_at' => now()->subDays(2)->setTime(10, 30),
                                    'updated_at' => now()->subDay()->setTime(11, 00),
                                ],
                                (object) [
                                    'id' => 2,
                                    'title' => 'Second News Article Showcase',
                                    'body' => 'https://placehold.co/600x400',
                                    'created_at' => now()->subDays(1)->setTime(14, 15),
                                    'updated_at' => now()->setTime(9, 45),
                                ],
                                (object) [
                                    'id' => 3,
                                    'title' => 'Breaking News: System Update',
                                    'body' => 'https://placehold.co/600x400',
                                    'created_at' => now()->setTime(8, 00),
                                    'updated_at' => now()->setTime(8, 05),
                                ],
                            ]);
                        }
                    @endphp
                    @forelse ($newsItems as $item)
                        <tr>
                            <td class="text-sm font-medium">
                                {{ $item->id }}</td>
                            <td class="text-sm">
                                {{ $item->title }}</td>
                            <td class="text-sm">
                                <img src="{{ $item->body }}">
                            </td>
                            <td class="text-sm">
                                {{ $item->created_at->format('M d, Y H:i') }}</td>
                            <td class="text-sm">
                                {{ $item->updated_at->format('M d, Y H:i') }}</td>
                            <td class="text-sm font-medium">
                                <a href="{{-- route('admin.news.edit', $item->id) --}}"
                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Edit</a>
                                <form action="{{-- route('admin.news.destroy', $item->id) --}}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-sm text-center text-slate-500 dark:text-slate-400">
                                Tidak ada berita ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Pagination (Uncomment and use if $newsItems is a paginated collection from your controller) --}}
        {{--
        @if (isset($newsItems) && $newsItems instanceof \Illuminate\Pagination\LengthAwarePaginator && $newsItems->hasPages())
        <div class="px-4 py-3 bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-stone-600">            
            {{ $newsItems->links() }}
        </div>
        @endif
        --}}
    </div>

    @push('scripts')
        {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
         DataTables Responsive extension 
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script> --}}
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha384-NXgwF8Kv9SSAr+jemKKcbvQsz+teULH/a5UNJvZc6kP47hZgl62M1vGnw6gHQhb1" crossorigin="anonymous">
        </script>
        <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"
            integrity="sha384-LiV1KhVIIiAY/+IrQtQib29gCaonfR5MgtWzPCTBVtEVJ7uYd0u8jFmf4xka4WVy" crossorigin="anonymous">
        </script>
        <script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.min.js"
            integrity="sha384-A6In5tKqlvPZKDpH+ei4A3A4TZrEsyvvN2Fe+oCB1IaQfGD5HNqDIxwjztNKSGDd" crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function() {
                $('#newsTable').DataTable({
                    responsive: true, // Enables DataTables' responsive behavior
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        }, // 'Title' column (index 1)
                        {
                            responsivePriority: 2,
                            targets: 5
                        }, // 'Actions' co ?Second
                        // 
                        // lumn (index 5)
                        // Columns with lower 'responsivePriority' values are hidden later.
                        // Default priority is 10000.
                        // 'ID' (index 0) could be { responsivePriority: 3, targets: 0 } if needed.
                        // 'Body' (index 2) might be lower priority if it's long.
                        // 'Created At' (3) and 'Updated At' (4) can have default or higher numeric priority.
                    ],
                    // Add any other DataTables configuration options here
                });
            });

            let prefers = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            let html = document.querySelector('html');

            html.classList.add(prefers);
            html.setAttribute('data-bs-theme', prefers);
        </script>
    @endpush
</x-admin-layout>
