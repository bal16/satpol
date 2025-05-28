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
        <button id="addGalleryBtn"
            class="inline-flex items-center px-5 py-2.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-white text-sm font-medium rounded-lg hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                    clip-rule="evenodd"></path>
            </svg>
            Unggah ke Galeri
        </button>
    </div>

    <!-- Gallery Management Table -->
    <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg">
        <div class="p-4">
            <table id="galleryTable" class="table-auto">
                <thead class="bg-red-600 dark:bg-stone-700">
                    <tr>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            ID</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Title</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Photo</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Category</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Created At</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Updated At</th>
                        <th class="text-left text-xs font-medium text-white uppercase">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-stone-700 divide-y divide-slate-200 dark:divide-stone-600">
                </tbody>
            </table>
        </div>
        {{-- Pagination (Uncomment and use if $GalleryItems is a paginated collection from your controller) --}}
        {{--
        @if (isset($GalleryItems) && $GalleryItems instanceof \Illuminate\Pagination\LengthAwarePaginator && $GalleryItems->hasPages())
        <div class="px-4 py-3 bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-stone-600">
            {{ $GalleryItems->links() }}
        </div>
        @endif
        --}}
    </div>

    <!-- Create Gallery Modal -->
    <x-admin.gallery-modal
        modalId="createGalleryModal"
        modalTitle="Tambah Foto Baru"
        formId="createGalleryForm"
        submitButtonText="Simpan"
        :isEdit="false"
    />

    <!-- Edit Gallery Modal -->
    <x-admin.gallery-modal
        modalId="editGalleryModal"
        modalTitle="Edit Foto"
        formId="editGalleryForm"
        submitButtonText="Simpan Perubahan"
        :isEdit="true"
    />

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

        {{-- <script>
            $(document).ready(function() {
                $('#GalleryTable').DataTable({
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
        </script> --}}

    <script>
            $(document).ready(function() {
                let GalleryTable = $('#galleryTable').DataTable({
                    responsive: true,
                    processing: true, // Show processing indicator
                    serverSide: true, // Enable server-side processing
                    ajax: "{{ route('gallery.data') }}", // URL to fetch data from
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'path',
                            name: 'path',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                if (type === 'display' && data) {
                                    // Assuming 'data' is the path relative to your public storage symlink
                                    // e.g., if images are in 'storage/app/public/gallery_photos'
                                    // and your symlink is 'public/storage' -> 'storage/app/public'
                                    // then 'data' might be 'gallery_photos/image.jpg'
                                    return `<img src="${data}" alt="${full.title || 'Gallery image'}" class="h-16 w-auto object-cover rounded"/>`;
                                }
                                return data; // Return data for other types like 'sort' or 'filter'
                            }
                        }, // Body might not be directly searchable/orderable
                        {
                            data: 'category',
                            name: 'category',
                            orderable: false,
                            searchable: false
                        }, // Body might not be directly searchable/orderable
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
                        {
                            responsivePriority: 2,
                            targets: 5
                        } // Actions
                    ],
                    // You can add language options for internationalization if needed
                    // language: {
                    //     url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json', // Example for Indonesian
                    // }
                });
            });

            // Modal Handling
            const createGalleryModal = document.getElementById('createGalleryModal');
            const createGalleryModalContent = document.getElementById('createGalleryModalContent');
            const addGalleryBtn = document.getElementById('addGalleryBtn'); // This ID remains the same
            const closeCreateGalleryModalBtn = document.getElementById('closeCreateGalleryModalBtn'); // Adjusted ID
            const cancelCreateGalleryModalBtn = document.getElementById('cancelCreateGalleryModalBtn'); // Adjusted ID
            const createGalleryForm = document.getElementById('createGalleryForm');

            const editGalleryModal = document.getElementById('editGalleryModal');
            const editGalleryModalContent = document.getElementById('editGalleryModalContent');
            const closeEditGalleryModalBtn = document.getElementById('closeEditGalleryModalBtn'); // Adjusted ID
            const cancelEditGalleryModalBtn = document.getElementById('cancelEditGalleryModalBtn'); // Adjusted ID
            const editGalleryForm = document.getElementById('editGalleryForm');

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
                    if (modal === createGalleryModal) {
                        createGalleryForm.reset();
                        clearFormErrors(createGalleryForm);
                    } else if (modal === editGalleryModal) {
                        editGalleryForm.reset();
                        clearFormErrors(editGalleryForm);
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
            addGalleryBtn.addEventListener('click', () => openModal(createGalleryModal, createGalleryModalContent));
            closeCreateGalleryModalBtn.addEventListener('click', () => closeModal(createGalleryModal, createGalleryModalContent));
            cancelCreateGalleryModalBtn.addEventListener('click', () => closeModal(createGalleryModal, createGalleryModalContent));
            window.addEventListener('click', (event) => {
                if (event.target === createGalleryModal) closeModal(createGalleryModal, createGalleryModalContent);
                if (event.target === editGalleryModal) closeModal(editGalleryModal, editGalleryModalContent);
            });

            // Edit Modal Listeners
            closeEditGalleryModalBtn.addEventListener('click', () => closeModal(editGalleryModal, editGalleryModalContent));
            cancelEditGalleryModalBtn.addEventListener('click', () => closeModal(editGalleryModal, editGalleryModalContent));

            // Handle Create Form Submission
            createGalleryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch("{{ route('admin.gallery.store') }}", {
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
                            displayFormErrors(createGalleryForm, data.errors);
                        } else {
                            closeModal(createGalleryModal, createGalleryModalContent);
                            $('#galleryTable').DataTable().ajax.reload(); // Reload DataTable
                            // Add a success notification if you have one (e.g., Toastr)
                            alert(data.message || 'Galeri berhasil ditambahkan!');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Handle Edit Button Click (delegated from table)
            $('#galleryTable tbody').on('click', 'button.edit-gallery-btn', function() {
                const data = $('#galleryTable').DataTable().row($(this).parents('tr')).data();
                // Fetch full data if necessary, or use what's available
                // For simplicity, assuming 'body' in datatable is sufficient or you fetch full data
                // If you need to fetch full data:
                // fetch(`/admin/api/Gallery/${data.id}`) // Create this API endpoint
                // .then(response => response.json())
                // .then(GalleryItem => {
                //    document.getElementById('edit_id').value = GalleryItem.id;
                //    document.getElementById('edit_title').value = GalleryItem.title;
                //    document.getElementById('edit_body').value = GalleryItem.body;
                //    openModal(editGalleryModal, editGalleryModalContent);
                // });

                // Using data directly from the row (ensure 'body' is complete enough or fetch separately)
                document.getElementById('edit_id').value = data.id; // This ID is from the hidden input in the component
                document.getElementById('edit_title').value = data.title;
                // Set edit_path to the value used in the <img> src attribute, which is data.path
                document.getElementById('edit_path').value = data.path;
                document.getElementById('edit_category').value = data.original_category || data.category; // Assuming you might send original_body
                openModal(editGalleryModal, editGalleryModalContent);
            });

            // Handle Edit Form Submission
            editGalleryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                if (!confirm('Apakah Anda yakin ingin menyimpan perubahan ini?')) return;

                const GalleryId = document.getElementById('edit_id').value;
                const formData = new FormData(this);

                fetch(`/admin/gallery/${GalleryId}`, { // Using the standard update route
                        method: 'POST', // HTML forms don't support PUT directly, so use POST and _method field
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'Accept': 'application/json',
                        },
                        body: formData // FormData will include _method: 'PUT'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.errors) {
                            displayFormErrors(editGalleryForm, data.errors);
                        } else {
                            closeModal(editGalleryModal, editGalleryModalContent);
                            $('#galleryTable').DataTable().ajax.reload();
                            alert(data.message || 'Galeri berhasil diperbarui!');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

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
