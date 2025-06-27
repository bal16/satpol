<x-admin-layout :pageTitle="'Galeri'">
    @push('styles')
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
         You might want to add a DataTables theme compatible with Tailwind CSS for better styling consistency
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css"> --}}
        <link href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css" rel="stylesheet"
            integrity="sha384-AsA35Lk2b1bdNXsEfz6MqkD/XkQdW8zEykqBZihdl/kU7DLyednCOCzbKfbSoxFb" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.min.css" rel="stylesheet"
            integrity="sha384-kz9bozrCHP/y+wTJV8P+n/dMBOh00rqNmmIAgHckzFWpoSB49V5ornW1aY+uYTyA" crossorigin="anonymous">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @endpush

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Kelola Galeri & Kategori</h1>
    </div>

    {{-- These divs are used to pass session messages to SweetAlert2 --}}
    @if (session('success'))
        <div id="swal-success" data-message="{{ session('success') }}"></div>
    @endif
    @if (session('error'))
        <div id="swal-error" data-message="{{ session('error') }}"></div>
    @endif

    <div class="bg-white dark:bg-stone-800 shadow-xl rounded-lg p-6">
        <!-- Tab Nav -->
        <div class="mb-6 border-b border-slate-200 dark:border-stone-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="galleryTabs">
                <li class="mr-2">
                    <button type="button"
                        class="inline-block p-4 border-b-2 rounded-t-lg focus:outline-none text-slate-500 dark:text-slate-400 cursor-pointer"
                        data-tab-target="#galleryContent">Galeri</button>
                </li>
                <li class="mr-2">
                    <button type="button"
                        class="inline-block p-4 border-b-2 rounded-t-lg focus:outline-none text-slate-500 dark:text-slate-400 cursor-pointer"
                        data-tab-target="#categoryContent">Kategori</button>
                </li>
            </ul>
        </div>

        <!-- Tab Content for Gallery -->
        <div id="galleryContent" data-tab-content class="space-y-4">
            <!-- Page Title & Add New Button -->
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
                <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Daftar Foto Galeri</h1>
                <button id="addGalleryBtn"
                    class="inline-flex items-center px-5 py-2.5 bg-green-100 dark:bg-green-500 text-green-600 dark:text-white text-sm font-medium rounded-lg hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white cursor-pointer">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Unggah ke Galeri
                </button>
            </div>

            <!-- Gallery Management Table -->
            <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg p-4">
                <table id="galleryTable" class="table-auto">
                    <thead class="bg-red-600 dark:bg-stone-700">
                        <tr>
                            <th class="text-left text-xs font-medium text-white uppercase">No.</th>
                            <th class="text-left text-xs font-medium text-white uppercase">Title</th>
                            <th class="text-left text-xs font-medium text-white uppercase">Photo</th>
                            <th class="text-left text-xs font-medium text-white uppercase">Category</th>
                            <th class="text-left text-xs font-medium text-white uppercase">Created At</th>
                            <th class="text-left text-xs font-medium text-white uppercase">Updated At</th>
                            <th class="text-left text-xs font-medium text-white uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-stone-700 divide-y divide-slate-200 dark:divide-stone-600">
                    </tbody>
                </table>
            </div>
        </div>
    <!-- Create Gallery Modal -->
    <x-admin.gallery-modal modalId="createGalleryModal" modalTitle="Tambah Foto Baru" formId="createGalleryForm"
        submitButtonText="Simpan" :isEdit="false" />

    <!-- Edit Gallery Modal -->
    <x-admin.gallery-modal modalId="editGalleryModal" modalTitle="Edit Foto" formId="editGalleryForm"
        submitButtonText="Simpan Perubahan" :isEdit="true" />

    <!-- Spacer -->
    {{-- <div class="my-12"></div> --}} {{-- Removed spacer as tabs handle separation --}}

        <!-- Tab Content for Category -->
        <div id="categoryContent" data-tab-content class="hidden space-y-4">
            <!-- Page Title & Add New Category Button -->
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
                <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Daftar Kategori Galeri</h1>
                <button id="addCategoryBtn"
                    class="inline-flex items-center px-5 py-2.5 bg-blue-100 dark:bg-blue-500 text-blue-600 dark:text-white text-sm font-medium rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white cursor-pointer">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    Tambah Kategori Baru
                </button>
            </div>

            <!-- Category Management Table -->
            <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg p-4">
                <table id="categoryTable" class="table-auto">
                    <thead class="bg-red-600 dark:bg-stone-700">
                        <tr>
                            <th class="text-left text-xs font-medium text-white uppercase">No.</th>
                            <th class="text-left text-xs font-medium text-white uppercase">Nama Kategori</th>
                            <th class="text-left text-xs font-medium text-white uppercase">Created At</th>
                            <th class="text-left text-xs font-medium text-white uppercase">Updated At</th>
                            <th class="text-left text-xs font-medium text-white uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-stone-700 divide-y divide-slate-200 dark:divide-stone-600">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-admin.category-modal modalId="createCategoryModal" modalTitle="Tambah Kategori Baru" formId="createCategoryForm"
        submitButtonText="Simpan" :isEdit="false" />

    <!-- Edit Category Modal (Structure similar to create, adapt as needed) -->
    <x-admin.category-modal modalId="editCategoryModal" modalTitle="Edit Kategori" formId="editCategoryForm"
        submitButtonText="Simpan Perubahan" :isEdit="true" />

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
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                // Display session messages with SweetAlert2
                if ($('#swal-success').length) {
                    Swal.fire({
                        background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b',
                        icon: 'success',
                        title: 'Berhasil!',
                        text: $('#swal-success').data('message'),
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
                if ($('#swal-error').length) {
                    Swal.fire({
                        background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b',
                        icon: 'error',
                        title: 'Gagal!',
                        text: $('#swal-error').data('message'),
                        showConfirmButton: true,
                        timer: 3000
                    });
                }

                // Gallery DataTable
                let GalleryTable = $('#galleryTable').DataTable({
                    responsive: true,
                    processing: true, // Show processing indicator
                    serverSide: true, // Enable server-side processing
                    ajax: "{{ route('gallery.data') }}", // URL to fetch data from
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
                            data: 'path',
                            name: 'path',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                if (type === 'display' && data) {
                                    let imageUrl = data;
                                    // Ensure the URL is correctly formed for public access.
                                    // If 'data' is a relative path like 'gallery_photos/image.jpg',
                                    // prepend '/storage/'.
                                    // If 'data' is already '/storage/gallery_photos/image.jpg' or a full HTTP/S URL,
                                    // it will be used as is.

                                    return `<img src="${imageUrl}" alt="${full.title || 'Gallery image'}" class="h-16 w-auto object-cover rounded"/>`;
                                }
                                return data; // Return data for other types like 'sort' or 'filter'
                            }
                        }, // Body might not be directly searchable/orderable
                        {
                            data: 'category_name',
                            name: 'category_name',
                            orderable: true,
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
                        }, // Actions
                    ],
                    order: [
                        [3, 'desc']
                    ], // Default order: column index 3 (category_name) descending
                    // You can add language options for internationalization if needed
                    // language: {
                    //     url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json', // Example for Indonesian
                    // }
                });
            });

            // Category DataTable
            $(document).ready(function() {
                let categoryTable = $('#categoryTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.categories.data') }}", // Ensure this route exists
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
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
                        }, // Name
                        {
                            responsivePriority: 2,
                            targets: 4
                        } // Actions
                    ],
                    order: [
                        [2, 'desc']
                    ], // Default order by created_at descending
                });
            })

            // Tab functionality for Gallery Page
            document.addEventListener('DOMContentLoaded', function() {
                const tabButtons = document.querySelectorAll('#galleryTabs [data-tab-target]');
                const tabContents = document.querySelectorAll('[data-tab-content]');
                const activeTabClasses = ['border-red-500', 'text-red-600', 'dark:text-red-500'];
                const inactiveTabClasses = ['border-transparent', 'hover:text-slate-600', 'hover:border-slate-300',
                    'dark:hover:text-slate-300', 'dark:hover:border-slate-600'
                ];

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
                    localStorage.setItem('activeGalleryTab', button.dataset.tabTarget);
                }

                tabButtons.forEach(button => {
                    button.addEventListener('click', () => activateTab(button));
                });

                const storedTab = localStorage.getItem('activeGalleryTab');
                const defaultTabButton = tabButtons.length > 0 ? tabButtons[0] : null;
                let tabToActivate = defaultTabButton;

                if (storedTab) {
                    const storedTabButton = document.querySelector(`[data-tab-target="${storedTab}"]`);
                    if (storedTabButton) {
                        tabToActivate = storedTabButton;
                    }
                }

                if (tabToActivate) {
                    activateTab(tabToActivate);
                } else if (tabButtons.length > 0) {
                    // Fallback if no tab was activated (e.g. localStorage was invalid)
                    activateTab(tabButtons[0]);
                }
            });

            // --- Category Modal Handling ---
            const createCategoryModal = document.getElementById('createCategoryModal');
            const createCategoryModalContent = document.getElementById('createCategoryModalContent');
            const addCategoryBtn = document.getElementById('addCategoryBtn');
            const closeCreateCategoryModalBtn = document.getElementById('closeCreateCategoryModalBtn');
            const cancelCreateCategoryModalBtn = document.getElementById('cancelCreateCategoryModalBtn');
            const createCategoryForm = document.getElementById('createCategoryForm');

            const editCategoryModal = document.getElementById('editCategoryModal'); // From x-admin.category-modal
            const editCategoryModalContent = document.getElementById('editCategoryModalContent'); // From x-admin.category-modal
            const closeEditCategoryModalBtn = document.getElementById(
            'closeEditCategoryModalBtn'); // From x-admin.category-modal
            const cancelEditCategoryModalBtn = document.getElementById(
            'cancelEditCategoryModalBtn'); // From x-admin.category-modal
            const editCategoryForm = document.getElementById('editCategoryForm'); // From x-admin.category-modal

            // Modal Handling
            const createGalleryModal = document.getElementById('createGalleryModal');
            const createGalleryModalContent = document.getElementById('createGalleryModalContent');
            const addGalleryBtn = document.getElementById('addGalleryBtn'); // This ID remains the same
            const closeCreateGalleryModalBtn = document.getElementById('closeCreateGalleryModalBtn'); // Adjusted ID
            const cancelCreateGalleryModalBtn = document.getElementById('cancelCreateGalleryModalBtn'); // Adjusted ID
            const createGalleryForm = document.getElementById('createGalleryForm');

            const editGalleryModal = document.getElementById('editGalleryModal'); // From x-admin.gallery-modal
            const editGalleryModalContent = document.getElementById('editGalleryModalContent'); // From x-admin.gallery-modal
            const closeEditGalleryModalBtn = document.getElementById('closeEditGalleryModalBtn'); // From x-admin.gallery-modal
            const cancelEditGalleryModalBtn = document.getElementById(
            'cancelEditGalleryModalBtn'); // From x-admin.gallery-modal
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
                    } else if (modal === createCategoryModal) {
                        createCategoryForm.reset();
                        clearFormErrors(createCategoryForm);
                    } else if (modal === editCategoryModal) { // Added for edit category modal
                        editCategoryForm.reset();
                        clearFormErrors(editCategoryForm);
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
                    let errorSpanId;
                    if (form.id === 'createGalleryForm' || form.id === 'editGalleryForm') {
                        errorSpanId = `${form.id.startsWith('create') ? 'create' : 'edit'}_${field}_error`;
                    } else if (form.id === 'createCategoryForm') { // Adjusted for create category
                        errorSpanId = `create_category_${field}_error`;
                    } else if (form.id === 'editCategoryForm') { // Adjusted for edit category
                        errorSpanId = `${form.id.startsWith('create') ? 'create_category' : 'edit_category'}_${field}_error`;
                    }
                    const errorSpan = form.querySelector(`#${errorSpanId}`);

                    if (errorSpan) {
                        errorSpan.textContent = errors[field][0];
                        errorSpan.classList.remove('hidden');
                    }
                }
            }

            // Create Modal Listeners
            addGalleryBtn.addEventListener('click', () => openModal(createGalleryModal, createGalleryModalContent));
            closeCreateGalleryModalBtn.addEventListener('click', () => closeModal(createGalleryModal,
                createGalleryModalContent));
            cancelCreateGalleryModalBtn.addEventListener('click', () => closeModal(createGalleryModal,
                createGalleryModalContent));
            window.addEventListener('click', (event) => {
                if (event.target === createGalleryModal) closeModal(createGalleryModal, createGalleryModalContent);
                if (event.target === editGalleryModal) closeModal(editGalleryModal, editGalleryModalContent);
                if (event.target === createCategoryModal) closeModal(createCategoryModal, createCategoryModalContent);
                if (event.target === editCategoryModal) closeModal(editCategoryModal, editCategoryModalContent); // Added for edit category modal
            });

            // --- Category Handling ---
            const createCategorySelect = document.getElementById('create_category_id');
            const createNewCategoryInput = document.getElementById('create_new_category_name');
            const editCategorySelect = document.getElementById('edit_category_id');
            const editNewCategoryInput = document.getElementById('edit_new_category_name');

            async function loadCategories(selectElement) {
                try {
                    const response = await fetch("{{ route('api.categories.list') }}");
                    const categories = await response.json();
                    selectElement.innerHTML = '<option value="">Pilih Kategori</option>'; // Reset options
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        selectElement.appendChild(option);
                    });
                    // Add "Create new..." option
                    const createNewOption = document.createElement('option');
                    createNewOption.value = 'create_new';
                    createNewOption.textContent = '--- Buat Kategori Baru ---';
                    selectElement.appendChild(createNewOption);
                } catch (error) {
                    console.error('Error loading categories:', error);
                }
            }

            function handleCategoryChange(selectElement, newCategoryInputElement) {
                selectElement.addEventListener('change', function() {
                    if (this.value === 'create_new') {
                        newCategoryInputElement.classList.remove('hidden');
                        newCategoryInputElement.focus();
                        // Kosongkan pilihan select agar tidak mengirim 'create_new' sebagai category_id
                        this.value = '';
                    } else {
                        newCategoryInputElement.classList.add('hidden');
                        newCategoryInputElement.value = ''; // Clear new category input if an existing one is chosen
                    }
                });
            }

            if (createCategorySelect && createNewCategoryInput) {
                loadCategories(createCategorySelect);
                handleCategoryChange(createCategorySelect, createNewCategoryInput);
            }
            if (editCategorySelect && editNewCategoryInput) {
                // For edit, you might want to load categories and then set the selected value
                // based on the gallery item being edited.
                loadCategories(editCategorySelect);
                handleCategoryChange(editCategorySelect, editNewCategoryInput);
            }
            // --- End Category Handling ---

            // Gallery Edit Modal Listeners
            closeEditGalleryModalBtn.addEventListener('click', () => closeModal(editGalleryModal, editGalleryModalContent));
            cancelEditGalleryModalBtn.addEventListener('click', () => closeModal(editGalleryModal, editGalleryModalContent));

            // Category Modal Listeners
            if (addCategoryBtn) addCategoryBtn.addEventListener('click', () => openModal(createCategoryModal,
                createCategoryModalContent));
            if (closeCreateCategoryModalBtn) closeCreateCategoryModalBtn.addEventListener('click', () => closeModal(
                createCategoryModal, createCategoryModalContent));
            if (cancelCreateCategoryModalBtn) cancelCreateCategoryModalBtn.addEventListener('click', () => closeModal(
                createCategoryModal, createCategoryModalContent));

            // Assuming editCategoryModal elements are present from the x-admin.category-modal component
            if (closeEditCategoryModalBtn) closeEditCategoryModalBtn.addEventListener('click', () => closeModal(
                editCategoryModal, editCategoryModalContent));
            if (cancelEditCategoryModalBtn) cancelEditCategoryModalBtn.addEventListener('click', () => closeModal(
                editCategoryModal, editCategoryModalContent));



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
                            Swal.fire({
                                background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff',
                                color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b',
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message || 'Galeri berhasil ditambahkan!',
                                showConfirmButton: false,
                                timer: 2000
                            });
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
                // document.getElementById('edit_path').value = data.path; // This line is ineffective for file inputs and can be removed.
                // Set selected category for edit modal
                const categoryIdToSelect = data.category_id; // Assuming your datatables data now includes category_id
                if (editCategorySelect && categoryIdToSelect) {
                    editCategorySelect.value = categoryIdToSelect;
                }
                editNewCategoryInput.classList.add('hidden'); // Hide new category input by default on edit
                editNewCategoryInput.value = '';
                openModal(editGalleryModal, editGalleryModalContent);
            });

            // Handle Edit Form Submission
            editGalleryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                const galleryId = document.getElementById('edit_id').value;
                const formData = new FormData(form);

                Swal.fire({
                    title: 'Simpan Perubahan?',
                    text: "Anda yakin ingin menyimpan perubahan pada item galeri ini?",
                    icon: 'question',
                    showCancelButton: true,
                    background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b',
                    customClass: {
                        confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                        cancelButton: 'bg-slate-500 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded ml-2'
                    },
                    buttonsStyling: false,
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/gallery/${galleryId}`, { // Using the standard update route
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
                                Swal.fire({ background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff', color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b', icon: 'success', title: 'Berhasil!', text: data.message || 'Galeri berhasil diperbarui!', showConfirmButton: false, timer: 2000 });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                });
            });

            // Handle Delete Gallery Button Click (delegated from table)
            $('#galleryTable tbody').on('click', 'button.delete-gallery-btn', function() {
                const galleryId = $(this).data('id');
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Item galeri ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b',
                    customClass: {
                        confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded',
                        cancelButton: 'bg-slate-500 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded ml-2'
                    },
                    buttonsStyling: false,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/gallery/${galleryId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                $('#galleryTable').DataTable().ajax.reload();
                                Swal.fire({ background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff', color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b', icon: 'success', title: 'Dihapus!', text: data.message, showConfirmButton: false, timer: 2000 });
                            } else {
                                Swal.fire({ background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff', color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b', icon: 'error', title: 'Gagal!', text: 'Gagal menghapus item galeri.' });
                            }
                        })
                        .catch(error => console.error('Error deleting gallery item:', error));
                    }
                });
            });

            // Handle Create Category Form Submission
            if (createCategoryForm) {
                createCategoryForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    fetch("{{ route('admin.categories.store') }}", { // Ensure this route exists
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.errors) {
                            displayFormErrors(createCategoryForm, data.errors);
                        } else {
                            closeModal(createCategoryModal, createCategoryModalContent);
                            $('#categoryTable').DataTable().ajax.reload();
                            Swal.fire({ background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff', color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b', icon: 'success', title: 'Berhasil!', text: data.message || 'Kategori berhasil ditambahkan!', showConfirmButton: false, timer: 2000 });
                            // Also reload categories in gallery forms
                            if (createCategorySelect) loadCategories(createCategorySelect);
                            if (editCategorySelect) loadCategories(editCategorySelect);
                        }
                    })
                    .catch(error => console.error('Error creating category:', error));
                });
            }

            // Handle Edit Category Button Click (delegated from table)
            $('#categoryTable tbody').on('click', 'button.edit-category-btn', function() {
                const data = $('#categoryTable').DataTable().row($(this).parents('tr')).data();
                document.getElementById('edit_category_id_hidden').value = data.id; // Updated ID
                document.getElementById('edit_category_name').value = data.name;
                openModal(editCategoryModal, editCategoryModalContent);
            });

            // Handle Edit Category Form Submission
            if (editCategoryForm) {
                editCategoryForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const form = this;
                    const categoryId = document.getElementById('edit_category_id_hidden').value;
                    const formData = new FormData(form);

                    Swal.fire({
                        title: 'Simpan Perubahan?',
                        text: "Anda yakin ingin menyimpan perubahan pada kategori ini?",
                        icon: 'question',
                        showCancelButton: true,
                        background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b',
                        customClass: {
                            confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            cancelButton: 'bg-slate-500 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded ml-2'
                        },
                        buttonsStyling: false,
                        confirmButtonText: 'Ya, simpan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/admin/categories/${categoryId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': formData.get('_token'),
                                    'Accept': 'application/json',
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.errors) {
                                    displayFormErrors(editCategoryForm, data.errors);
                                } else {
                                    closeModal(editCategoryModal, editCategoryModalContent);
                                    $('#categoryTable').DataTable().ajax.reload();
                                    Swal.fire({ background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff', color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b', icon: 'success', title: 'Berhasil!', text: data.message || 'Kategori berhasil diperbarui!', showConfirmButton: false, timer: 2000 });
                                    if (createCategorySelect) loadCategories(createCategorySelect);
                                    if (editCategorySelect) loadCategories(editCategorySelect);
                                }
                            })
                            .catch(error => console.error('Error updating category:', error));
                        }
                    });
                });
            }

            // Handle Delete Category Button Click (delegated from table)
            $('#categoryTable tbody').on('click', 'button.delete-category-btn', function() {
                const categoryId = $(this).data('id');
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Menghapus kategori akan membuat item galeri terkait menjadi tidak berkategori. Aksi ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b',
                    customClass: {
                        confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded',
                        cancelButton: 'bg-slate-500 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded ml-2'
                    },
                    buttonsStyling: false,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/categories/${categoryId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                $('#categoryTable').DataTable().ajax.reload();
                                Swal.fire({ background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff', color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b', icon: 'success', title: 'Dihapus!', text: data.message, showConfirmButton: false, timer: 2000 });
                                if (createCategorySelect) loadCategories(createCategorySelect);
                                if (editCategorySelect) loadCategories(editCategorySelect);
                            } else {
                                Swal.fire({ background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff', color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b', icon: 'error', title: 'Gagal!', text: 'Gagal menghapus kategori.' });
                            }
                        })
                        .catch(error => console.error('Error deleting category:', error));
                    }
                });
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
