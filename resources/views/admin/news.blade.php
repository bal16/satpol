<x-admin-layout :pageTitle="'Berita'">
    @push('styles')
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
         You might want to add a DataTables theme compatible with Tailwind CSS for better styling consistency
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css"> --}}
        <link href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css" rel="stylesheet"
            integrity="sha384-AsA35Lk2b1bdNXsEfz6MqkD/XkQdW8zEykqBZihdl/kU7DLyednCOCzbKfbSoxFb" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.min.css" rel="stylesheet"
            integrity="sha384-kz9bozrCHP/y+wTJV8P+n/dMBOh00rqNmmIAgHckzFWpoSB49V5ornW1aY+uYTyA" crossorigin="anonymous">
        <x-rich-text-laravel::styles theme="richtextlaravel" />
    @endpush

    <!-- Page Title & Add New Button -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Kelola Berita</h1>
        <button id="addNewsBtn"
            class="inline-flex items-center px-5 py-2.5 bg-red-100 dark:bg-red-500 text-red-700 dark:text-white text-sm font-medium rounded-lg hover:bg-red-800 dark:hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            Tambah Berita Baru
        </button>
    </div>

    <!-- News Management Table -->
    <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg">
        <div class="p-4 overflow-x-auto">
            <table id="newsTable" class="table-auto">
                <thead class="bg-red-600 dark:bg-stone-700">
                    <tr>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            ID</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Title</th>

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

    <!-- Create News Modal -->
    <x-admin.news-modal modalId="createNewsModal" modalTitle="Tambah Berita Baru" formId="createNewsForm"
        submitButtonText="Simpan" :isEdit="false" />

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
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'title',
                            name: 'title'
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

            // Modal Handling
            const createNewsModal = document.getElementById('createNewsModal');
            const createNewsModalContent = document.getElementById('createNewsModalContent');
            const addNewsBtn = document.getElementById('addNewsBtn'); // This ID remains the same
            const closeCreateNewsModalBtn = document.getElementById('closeCreateNewsModalBtn'); // Adjusted ID
            const cancelCreateNewsModalBtn = document.getElementById('cancelCreateNewsModalBtn'); // Adjusted ID
            const createNewsForm = document.getElementById('createNewsForm');

            function openModal(modal, modalContent) {
                modal.classList.remove('hidden');
                setTimeout(() => { // For transition
                    modal.classList.remove('opacity-0');
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            function closeModal(modal, modalContent) {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                modal.classList.add('opacity-0');
                setTimeout(() => { // For transition
                    modal.classList.add('hidden');
                    // Clear form fields and errors
                    if (modal === createNewsModal) {
                        createNewsForm.reset();
                        clearFormErrors(editNewsForm);
                    }
                }, 300);
            }

            function clearFormErrors(form) {
                form.querySelectorAll('span[id$="_error"]').forEach(span => {
                    span.classList.add('hidden');
                    span.textContent = '';
                });
            }

            function displayFormErrors(form, errors) {
                clearFormErrors(form);
                for (const field in errors) {
                    const errorSpan = form.querySelector(`#${form.id.startsWith('create') ? 'create' : 'edit'}_${field}_error`);
                    if (errorSpan) {
                        errorSpan.textContent = errors[field][0];
                        errorSpan.classList.remove('hidden');
                    }
                }
            }

            // Create Modal Listeners
            addNewsBtn.addEventListener('click', () => openModal(createNewsModal, createNewsModalContent));
            closeCreateNewsModalBtn.addEventListener('click', () => closeModal(createNewsModal, createNewsModalContent));
            cancelCreateNewsModalBtn.addEventListener('click', () => closeModal(createNewsModal, createNewsModalContent));
            window.addEventListener('click', (event) => {
                if (event.target === createNewsModal) closeModal(createNewsModal, createNewsModalContent);
            });


            // Handle Create Form Submission
            createNewsForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                // console.log("🚀 ~ createNewsForm.addEventListener ~ formData:", formData)

                fetch("{{ route('admin.news.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                'content') || formData.get('_token'), // Ensure CSRF token is sent
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.errors) {
                            displayFormErrors(createNewsForm, data.errors);
                        } else {
                            closeModal(createNewsModal, createNewsModalContent);
                            $('#newsTable').DataTable().ajax.reload(); // Reload DataTable
                            // Add a success notification if you have one (e.g., Toastr)
                            alert(data.message || 'Berita berhasil ditambahkan!');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

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
