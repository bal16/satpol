<x-admin-layout :pageTitle="'Services'">
    @push('styles')
        <link href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css" rel="stylesheet"
            integrity="sha384-AsA35Lk2b1bdNXsEfz6MqkD/XkQdW8zEykqBZihdl/kU7DLyednCOCzbKfbSoxFb" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.min.css" rel="stylesheet"
            integrity="sha384-kz9bozrCHP/y+wTJV8P+n/dMBOh00rqNmmIAgHckzFWpoSB49V5ornW1aY+uYTyA" crossorigin="anonymous">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @endpush

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Kelola Halaman Informasi Umum</h1>
        <a href="{{ route('admin.services.create') }}"
            class="inline-flex items-center px-5 py-2.5 bg-red-600 dark:bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-700 dark:hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            Tambah Kartu Baru
        </a>
    </div>

    {{-- These divs are used to pass session messages to SweetAlert2 --}}
    @if (session('success'))
        <div id="swal-success" data-message="{{ session('success') }}"></div>
    @endif
    @if (session('error'))
        <div id="swal-error" data-message="{{ session('error') }}"></div>
    @endif

    <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg">
        <div class="p-4">
            <table id="servicesTable" class="table-auto">
                <thead class="bg-red-600 dark:bg-stone-700">
                    <tr>
                        <th class="text-left text-xs font-medium text-white uppercase">No.</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Gambar</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Judul</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Jumlah Item</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Dibuat Pada</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Diperbarui Pada</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody
                    class="bg-white dark:bg-stone-700 divide-y divide-slate-200 dark:divide-stone-600 text-stone-900 dark:text-white">
                    <!-- Data rows will be populated by DataTables -->

                </tbody>
            </table>
        </div>
    </div>


    {{-- Service Items Management Section --}}
    <div id="serviceItemsSection"
        class="hidden mt-8 dark:text-white text-stone-800 bg-white dark:bg-stone-800 shadow-xl rounded-lg p-4">
        <h2 id="serviceItemsSectionTitle" class="text-xl font-semibold text-slate-800 dark:text-white mb-4">
            Kelola Item untuk Kartu:
        </h2>

        {{-- Form to Add New Item --}}
        <div class="mb-6 p-4 border border-slate-200 dark:border-stone-700 rounded-lg">
            <h3 class="text-lg font-medium text-slate-700 dark:text-white mb-3">Tambah Item Baru</h3>
            <form id="createItemForm" class="space-y-4">
                @csrf
                <div>
                    <label for="create_item_text"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Teks Item</label>
                    <textarea name="text" id="create_item_text" rows="3"
                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-stone-700 dark:border-stone-600 dark:text-white"></textarea>
                    <p class="text-red-500 text-xs mt-1 hidden" data-error-for="text"></p>
                </div>
                <div>
                    <label for="create_item_href"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Link (Opsional)</label>
                    <input type="url" name="href" id="create_item_href"
                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-stone-700 dark:border-stone-600 dark:text-white">
                    <p class="text-red-500 text-xs mt-1 hidden" data-error-for="href"></p>
                </div>
                <button type="submit"
                    class="px-5 py-2.5 bg-red-600 dark:bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-700 dark:hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out">
                    Tambah Item
                </button>
            </form>
        </div>

        {{-- Items List Table --}}
        <div class="p-4">
            <table id="serviceItemsTable" class="table-auto w-full">
                <thead class="bg-red-600 dark:bg-stone-700">
                    <tr>
                        <th class="text-left text-xs font-medium text-white uppercase">No.</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Teks Item</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Link</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody
                    class="bg-white dark:bg-stone-700 divide-y divide-slate-200 dark:divide-stone-600 text-stone-900 dark:text-white">
                </tbody>
            </table>
        </div>
    </div>

    {{-- Edit Item Modal --}}
    <div id="editItemModal" class="fixed inset-0 bg-black/70 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-stone-800"
            id="editItemModalContent">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-slate-800 dark:text-white">Edit Item Layanan</h3>
                <button type="button" id="closeEditItemModalBtn"
                    class="text-slate-400 hover:text-slate-600 dark:text-slate-300 dark:hover:text-slate-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="editItemForm" class="space-y-4">
                @csrf
                @method('PUT') {{-- Use PUT method for update --}}
                <input type="hidden" id="edit_item_id" name="id">
                <div>
                    <label for="edit_item_text"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Teks Item</label>
                    <textarea name="text" id="edit_item_text" rows="3"
                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-stone-700 dark:border-stone-600 dark:text-white"></textarea>
                    <p class="text-red-500 text-xs mt-1 hidden" data-error-for="text"></p>
                </div>
                <div>
                    <label for="edit_item_href"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Link (Opsional)</label>
                    <input type="url" name="href" id="edit_item_href"
                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-stone-700 dark:border-stone-600 dark:text-white">
                    <p class="text-red-500 text-xs mt-1 hidden" data-error-for="href"></p>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelEditItemModalBtn"
                        class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-stone-700 rounded-md hover:bg-slate-200 dark:hover:bg-stone-600 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 dark:focus:ring-offset-stone-800">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-stone-800">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
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


        <script>
            // Helper functions for modals and form errors
            function openModal(modalElement, contentElement) {
                modalElement.classList.remove('hidden');
                setTimeout(() => contentElement.classList.add('scale-100', 'opacity-100'), 50);
            }

            function closeModal(modalElement, contentElement) {
                contentElement.classList.remove('scale-100', 'opacity-100');
                setTimeout(() => modalElement.classList.add('hidden'), 300);
            }
        </script>

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

                let servicesTable = $('#servicesTable').DataTable({
                    responsive: true,
                    processing: true, // Show processing indicator
                    serverSide: true, // Enable server-side processing
                    ajax: "{{ route('services.data') }}",
                    columns: [{ // Use DT_RowIndex provided by server
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'image_src',
                            name: 'image_src',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                if (type === 'display' &&
                                    data) { // 'data' now contains the relative path
                                    return `<img src="{{ asset('storage/') }}/${data}" alt="${full.title || 'Service image'}" class="h-12 w-auto object-cover rounded"/>`; // Smaller image for better fit
                                }
                                return 'No Image';
                            }
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'items_count',
                            name: 'items_count',
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });

                // Function to display form errors
                function displayFormErrors(formElement, errors) {
                    clearFormErrors(formElement); // Clear previous errors first
                    for (const field in errors) {
                        const errorElement = formElement.querySelector(`[data-error-for="${field}"]`);
                        if (errorElement) {
                            errorElement.textContent = errors[field][0];
                            errorElement.classList.remove('hidden');
                        }
                    }
                }

                // Function to clear form errors
                function clearFormErrors(formElement) {
                    formElement.querySelectorAll('[data-error-for]').forEach(el => {
                        el.textContent = '';
                        el.classList.add('hidden');
                    });
                }

                // Variable to store the currently selected service ID for item management
                let currentServiceId = null;
                let currentServiceTitle = '';

                // --- Handle Delete Button Click (delegated from table) ---
                $('#servicesTable tbody').on('click', 'button.delete-service-btn', function() {
                    const serviceId = $(this).data('id');
                    Swal.fire({
                        title: 'Anda yakin?',
                        text: "Kartu ini dan semua item di dalamnya akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        background: document.documentElement.classList.contains('dark') ? '#292524' :
                            '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#d6d3d1' :
                            '#1e293b',
                        customClass: {
                            confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded',
                            cancelButton: 'bg-slate-500 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded ml-2'
                        },
                        buttonsStyling: false,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`{{ url('admin/services') }}/${serviceId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').content,
                                        'Accept': 'application/json',
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.message) {
                                        Swal.fire({
                                            background: document.documentElement.classList
                                                .contains('dark') ? '#292524' : '#fff',
                                            color: document.documentElement.classList
                                                .contains('dark') ? '#d6d3d1' : '#1e293b',
                                            icon: 'success',
                                            title: 'Dihapus!',
                                            text: data.message,
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                        servicesTable.ajax.reload();
                                    } else {
                                        Swal.fire({
                                            background: document.documentElement.classList
                                                .contains('dark') ? '#292524' : '#fff',
                                            color: document.documentElement.classList
                                                .contains('dark') ? '#d6d3d1' : '#1e293b',
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: data.message || 'Gagal menghapus kartu.'
                                        });
                                    }
                                })
                                .catch(error => console.error('Error deleting service:', error));
                        }
                    });
                });
                // --- Handle "Kelola Item" Button Click ---
                $('#servicesTable tbody').on('click', 'button.manage-items-btn', function() {
                    const serviceId = $(this).data('id');
                    const serviceTitle = $(this).data('title');
                    currentServiceId = serviceId;
                    currentServiceTitle = serviceTitle;

                    // Update the title for the items section
                    $('#serviceItemsSectionTitle').text(`Kelola Item untuk Kartu: ${serviceTitle}`);

                    // Show the items section
                    $('#serviceItemsSection').removeClass('hidden');

                    // Initialize or reload the items DataTable
                    if ($.fn.DataTable.isDataTable('#serviceItemsTable')) {
                        serviceItemsTable.ajax.url(
                            `{{ route('admin.services.items.data', ['service' => ':serviceId']) }}`.replace(
                                ':serviceId', serviceId)).load();
                    } else { // Only initialize if it doesn't exist
                        // Initialize serviceItemsTable if not already initialized
                        serviceItemsTable = $('#serviceItemsTable').DataTable({
                            responsive: true,
                            processing: true,
                            serverSide: true,
                            ajax: `{{ route('admin.services.items.data', ['service' => ':serviceId']) }}`
                                .replace(':serviceId', serviceId),
                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'text',
                                    name: 'text'
                                    // Render langsung sebagai HTML, karena kolom is_html sudah dihapus
                                },
                                {
                                    data: 'href',
                                    name: 'href',
                                    render: function(data, type) {
                                        if (type === 'display' && data) {
                                            const displayLink = data.length > 30 ? data
                                                .substring(0, 30) + '...' : data;
                                            return `<a href="${data}" target="_blank" class="text-blue-500 hover:underline">${displayLink}</a>`;
                                        }
                                        return 'Tidak ada';
                                    }
                                },
                                {
                                    data: 'action',
                                    name: 'action',
                                    orderable: false,
                                    searchable: false
                                }
                            ],
                            order: [
                                [0, 'asc']
                            ],
                        });
                    }

                    // Scroll to the items section
                    $('html, body').animate({
                        scrollTop: $('#serviceItemsSection').offset().top -
                            100 // Adjust offset as needed
                    }, 500);
                });


                // --- Handle Create Item Form Submission ---
                const createItemForm = document.getElementById('createItemForm');
                createItemForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (!currentServiceId) {
                        alert('Pilih kartu layanan terlebih dahulu.');
                        return;
                    }
                    const formData = new FormData(createItemForm);

                    fetch(`{{ route('admin.services.items.store', ['service' => ':serviceId']) }}`.replace(
                            ':serviceId', currentServiceId), { // Use currentServiceId
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    ?.content,
                                'Accept': 'application/json',
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.errors) { // Laravel validation errors
                                displayFormErrors(createItemForm, data
                                    .errors); // Display errors on the form
                            } else {
                                createItemForm.reset(); // Clear form fields
                                clearFormErrors(createItemForm);
                                servicesTable.ajax.reload(); // Reload main table to update item count
                                serviceItemsTable.ajax.reload(); // Reload items table
                                Swal.fire({
                                    background: document.documentElement.classList.contains(
                                        'dark') ? '#292524' : '#fff',
                                    color: document.documentElement.classList.contains('dark') ?
                                        '#d6d3d1' : '#1e293b',
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: data.message || 'Item berhasil ditambahkan!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });

                // --- Handle Edit Item Button Click (delegated from table) ---
                $('#serviceItemsTable tbody').on('click', 'button.edit-item-btn', function() {
                    const data = serviceItemsTable.row($(this).parents('tr')).data();
                    const editItemModal = document.getElementById('editItemModal');
                    const editItemModalContent = document.getElementById('editItemModalContent');
                    document.getElementById('edit_item_id').value = data.id;
                    document.getElementById('edit_item_text').value = data.text;
                    document.getElementById('edit_item_href').value = data.href || '';
                    clearFormErrors(document.getElementById('editItemForm')); // Clear errors when opening

                    openModal(editItemModal, editItemModalContent); // Use the general openModal
                });

                // --- Handle Edit Item Form Submission ---
                const editItemForm = document.getElementById('editItemForm');
                editItemForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const form = this;
                    const editItemModal = document.getElementById('editItemModal');
                    const editItemModalContent = document.getElementById('editItemModalContent');
                    const itemId = document.getElementById('edit_item_id').value;
                    const formData = new FormData(form);
                    // Use PATCH method for update
                    formData.append('_method', 'PUT'); // Laravel expects _method for PUT/PATCH with form data

                    Swal.fire({
                        title: 'Simpan Perubahan?',
                        text: "Anda yakin ingin menyimpan perubahan pada item ini?",
                        icon: 'question',
                        showCancelButton: true,
                        background: document.documentElement.classList.contains('dark') ? '#292524' :
                            '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#d6d3d1' :
                            '#1e293b',
                        customClass: {
                            confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                            cancelButton: 'bg-slate-500 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded ml-2'
                        },
                        buttonsStyling: false,
                        confirmButtonText: 'Ya, simpan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`{{ route('admin.services.items.update', ['item' => ':itemId']) }}`
                                    .replace(':itemId', itemId), {
                                        method: 'POST', // Fetch API uses POST for FormData with _method
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').content,
                                            'Accept': 'application/json',
                                        },
                                        body: formData
                                    })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.errors) {
                                        displayFormErrors(editItemForm, data.errors);
                                    } else {
                                        closeModal(editItemModal, editItemModalContent);
                                        serviceItemsTable.ajax.reload();
                                        Swal.fire({
                                            background: document.documentElement.classList
                                                .contains('dark') ? '#292524' : '#fff',
                                            color: document.documentElement.classList
                                                .contains('dark') ? '#d6d3d1' : '#1e293b',
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            text: data.message ||
                                                'Item berhasil diperbarui!',
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    });
                });

                // --- Handle Delete Item Button Click (delegated from table) ---
                $('#serviceItemsTable tbody').on('click', 'button.delete-item-btn', function() {
                    const itemId = $(this).data('id');
                    Swal.fire({
                        title: 'Anda yakin?',
                        text: "Item ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        background: document.documentElement.classList.contains('dark') ? '#292524' :
                            '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#d6d3d1' :
                            '#1e293b',
                        customClass: {
                            confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded',
                            cancelButton: 'bg-slate-500 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded ml-2'
                        },
                        buttonsStyling: false,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`{{ route('admin.services.items.destroy', ['item' => ':itemId']) }}`
                                    .replace(':itemId', itemId), {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').content,
                                            'Accept': 'application/json',
                                        }
                                    })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.message) {
                                        Swal.fire({
                                            background: document.documentElement.classList
                                                .contains('dark') ? '#292524' : '#fff',
                                            color: document.documentElement.classList
                                                .contains('dark') ? '#d6d3d1' : '#1e293b',
                                            icon: 'success',
                                            title: 'Dihapus!',
                                            text: data.message,
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                        servicesTable.ajax
                                    .reload(); // Reload main table to update item count
                                        serviceItemsTable.ajax.reload();
                                    } else {
                                        Swal.fire({
                                            background: document.documentElement.classList
                                                .contains('dark') ? '#292524' : '#fff',
                                            color: document.documentElement.classList
                                                .contains('dark') ? '#d6d3d1' : '#1e293b',
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: 'Gagal menghapus item.'
                                        });
                                    }
                                })
                                .catch(error => console.error('Error deleting item:', error));
                        }
                    });
                });

                // Modal close event listeners
                const editItemModal = document.getElementById('editItemModal');
                const editItemModalContent = document.getElementById('editItemModalContent');
                document.getElementById('closeEditItemModalBtn').addEventListener('click', () => closeModal(
                    editItemModal, editItemModalContent));
                document.getElementById('cancelEditItemModalBtn').addEventListener('click', () => closeModal(
                    editItemModal, editItemModalContent));
                window.addEventListener('click', (event) => {
                    if (event.target === editItemModal) closeModal(editItemModal, editItemModalContent);
                });

            });
        </script>
    @endpush
</x-admin-layout>
