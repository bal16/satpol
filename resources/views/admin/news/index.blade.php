<x-admin-layout :pageTitle="'Berita'">
    @push('styles')
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
         You might want to add a DataTables theme compatible with Tailwind CSS for better styling consistency
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css"> --}}
        <link href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css" rel="stylesheet"
            integrity="sha384-AsA35Lk2b1bdNXsEfz6MqkD/XkQdW8zEykqBZihdl/kU7DLyednCOCzbKfbSoxFb" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.min.css" rel="stylesheet"
            integrity="sha384-kz9bozrCHP/y+wTJV8P+n/dMBOh00rqNmmIAgHckzFWpoSB49V5ornW1aY+uYTyA" crossorigin="anonymous">
        <!-- Di dalam <head> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Sebelum </body> penutup -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-rich-text-laravel::styles theme="richtextlaravel" />
    @endpush

    <!-- Page Title & Add New Button -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Kelola Berita</h1>
        <a href="{{ route('admin.news.create') }}"
            class="inline-flex items-center px-5 py-2.5 bg-red-100 dark:bg-red-500 text-red-700 dark:text-white text-sm font-medium rounded-lg hover:bg-red-800 dark:hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            Tambah Berita Baru
        </a>
    </div>

    <!-- News Management Table -->
    <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg">
        <div class="p-4 overflow-x-auto">
            <table id="newsTable" class="table-auto">
                <thead class="bg-red-600 dark:bg-stone-700">
                    <tr>
                        <th class="text-left text-xs font-medium text-white uppercase w-12">
                            No</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Title</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Slug</th>

                        <th class="text-left text-xs font-medium text-white uppercase">
                            Created At</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Updated At</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-stone-700 divide-y divide-slate-200 dark:divide-stone-600">
                    {{-- DataTables will populate this --}}
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

    {{-- Modal untuk create berita telah dihapus, digantikan halaman terpisah --}}

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
                let newsTable = $('#newsTable').DataTable({
                    responsive: true,
                    processing: true, // Show processing indicator
                    serverSide: true, // Enable server-side processing
                    ajax: "{{ route('news.data') }}", // URL to fetch data from
                    columns: [{
                            data: 'DT_RowIndex', // Gunakan DT_RowIndex yang disediakan server
                            name: 'DT_RowIndex', // Nama untuk referensi server-side (jika diperlukan)
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'slug',
                            name: 'slug'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    order: [
                        [3, 'desc']
                    ], // Default order: column index 2 (created_at) descending
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 1
                        }, // Title
                    ],
                    // You can add language options for internationalization if needed
                    // language: {
                    //     url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json', // Example for Indonesian
                    // }
                });
            });

            // Display session messages with SweetAlert2
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: true
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    timer: 3000,
                    showConfirmButton: true
                });
            @endif

            // SweetAlert2 for delete confirmation (if not using DataTables built-in confirm)
            // This example assumes your delete form in DataTables action column has a specific class or structure
            // If your delete is a direct link or a simple form, you might need to adjust the selector
            $(document).on('submit', 'form[action*="/admin/news/"]', function(e) {
                // Check if the form method is DELETE (or POST with _method=DELETE)
                const formMethod = $(this).find('input[name="_method"]').val() || $(this).attr('method');
                if (formMethod.toUpperCase() === 'DELETE' || (formMethod.toUpperCase() === 'POST' && $(this).find(
                        'input[name="_method"]').val() === 'DELETE')) {
                    e.preventDefault(); // Prevent default form submission
                    const form = this;
                    Swal.fire({
                        title: 'Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit the form if confirmed
                        }
                    });
                }
            });

            // JavaScript untuk modal create telah dihapus karena create sekarang adalah halaman terpisah.
            // Fungsi openModal, closeModal, clearFormErrors, displayFormErrors mungkin masih berguna jika Anda memiliki modal lain.
            // Jika tidak, Anda bisa menghapusnya atau memindahkannya ke file JS global jika digunakan di tempat lain.

            // // Handle Edit Button Click (delegated from table)
            // $('#newsTable tbody').on('click', 'button.edit-news-btn', function() {
            //     const data = $('#newsTable').DataTable().row($(this).parents('tr')).data(); // Get row data
            //     if (data && data.id) {
            //         // Redirect to the edit page
            //         window.location.href = `/admin/news/${data.id}/edit`;
            //     }
            // });

            // CSRF Token for AJAX
            // Add this if not already globally configured for jQuery AJAX
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            let prefers = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            let html = document.querySelector('html');

            html.classList.add(prefers);
            html.setAttribute('data-bs-theme', prefers);
        </script>
    @endpush
</x-admin-layout>
