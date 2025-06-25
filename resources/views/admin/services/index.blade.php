<x-admin-layout :pageTitle="'Services'">
    @push('styles')
        <link href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css" rel="stylesheet"
            integrity="sha384-AsA35Lk2b1bdNXsEfz6MqkD/XkQdW8zEykqBZihdl/kU7DLyednCOCzbKfbSoxFb" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.min.css" rel="stylesheet"
            integrity="sha384-kz9bozrCHP/y+wTJV8P+n/dMBOh00rqNmmIAgHckzFWpoSB49V5ornW1aY+uYTyA" crossorigin="anonymous">
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

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg">
        <div class="p-4">
            <table id="servicesTable" class="table-auto">
                <thead class="bg-red-600 dark:bg-stone-700">
                    <tr>
                        <th class="text-left text-xs font-medium text-white uppercase">No.</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Gambar</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Judul Kartu</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Isi Konten</th>
                        
                        <th class="text-left text-xs font-medium text-white uppercase">Dibuat Pada</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Diperbarui Pada</th>
                        <th class="text-left text-xs font-medium text-white uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-stone-700 divide-y divide-slate-200 dark:divide-stone-600">
                </tbody>
            </table>
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

        <script>
            $(document).ready(function() {
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
                                if (type === 'display' && data) { // 'data' now contains the relative path
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
                            data: 'body',
                            name: 'body',
                            render: function(data, type, full, meta) {
                                if (type === 'display') {
                                    if (!data) {
                                        return '<i class="text-slate-400">Tidak ada konten</i>';
                                    }
                                    // Create a temporary element to parse the HTML and get the text content
                                    const tempEl = document.createElement('div');
                                    tempEl.innerHTML = data;
                                    const text = tempEl.textContent || tempEl.innerText || "";
                                    return text.length > 60 ? text.substring(0, 60) + '...' : text;
                                }
                                return data; // Return original data for sorting/filtering
                            }
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

                // Variable to store the currently selected service ID for item management
                let currentServiceId = null;
                let currentServiceTitle = '';

                // --- Handle Delete Button Click (delegated from table) ---
                $('#servicesTable tbody').on('click', 'button.delete-service-btn', function() {
                    const serviceId = $(this).data('id');
                    if (!confirm('Apakah Anda yakin ingin menghapus kartu ini? Semua item di dalamnya juga akan terhapus.')) return;

                    fetch(`/admin/services/${serviceId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Controller akan memberikan respons JSON jika request adalah AJAX
                            if (data.message) {
                                alert(data.message);
                                servicesTable.ajax.reload();
                            } else {
                                alert('Gagal menghapus kartu.');
                            }
                        })
                        .catch(error => console.error('Error deleting service:', error));
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
                        serviceItemsTable.ajax.url(`{{ url('api/services') }}/${serviceId}/items/data`).load();
                    } else {
                        // Initialize serviceItemsTable if not already initialized
                        serviceItemsTable = $('#serviceItemsTable').DataTable({
                            responsive: true,
                            processing: true,
                            serverSide: true,
                            ajax: `{{ url('api/services') }}/${serviceId}/items/data`,
                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'text',
                                    name: 'text',
                                    render: function(data, type, full, meta) {
                                        return type === 'display' ? data : $(data).text();
                                    }
                                },
                                {
                                    data: 'href',
                                    name: 'href',
                                    render: function(data, type, full, meta) {
                                        return type === 'display' && data ? `<a href="${data}" target="_blank" class="text-blue-500 hover:underline">${data}</a>` : data;
                                    }
                                },
                                {
                                    data: 'is_html',
                                    name: 'is_html',
                                    render: function(data) {
                                        return data ? '<span class="text-green-500">Ya</span>' : '<span class="text-red-500">Tidak</span>';
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
                        scrollTop: $('#serviceItemsSection').offset().top - 100 // Adjust offset as needed
                    }, 500);
                });

                // --- Item Modal Handling (moved from _items.blade.php) ---
                const editItemModal = document.getElementById('editItemModal');
                const editItemModalContent = document.getElementById('editItemModalContent');
                const closeEditItemModalBtn = document.getElementById('closeEditItemModalBtn');
                const cancelEditItemModalBtn = document.getElementById('cancelEditItemModalBtn');
                const editItemForm = document.getElementById('editItemForm');

                closeEditItemModalBtn.addEventListener('click', () => closeModal(editItemModal, editItemModalContent));
                cancelEditItemModalBtn.addEventListener('click', () => closeModal(editItemModal, editItemModalContent));
                window.addEventListener('click', (event) => {
                    if (event.target === editItemModal) closeModal(editItemModal, editItemModalContent);
                });

                // --- Handle Create Item Form Submission ---
                const createItemForm = document.getElementById('createItemForm');
                createItemForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (!currentServiceId) {
                        alert('Pilih kartu layanan terlebih dahulu.');
                        return;
                    }
                    const formData = new FormData(this);
                    formData.set('is_html', document.getElementById('create_item_is_html').checked ? '1' : '0');

                    fetch(`{{ url('admin/services') }}/${currentServiceId}/items`, { // Use currentServiceId
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
                            if (data.errors) {
                                displayFormErrors(createItemForm, data.errors);
                            } else {
                                createItemForm.reset();
                                clearFormErrors(createItemForm);
                                servicesTable.ajax.reload(); // Reload main table to update item count
                                serviceItemsTable.ajax.reload(); // Reload items table
                                alert(data.message || 'Item berhasil ditambahkan!');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });

                // --- Handle Edit Item Button Click (delegated from table) ---
                $('#serviceItemsTable tbody').on('click', 'button.edit-item-btn', function() {
                    const data = serviceItemsTable.row($(this).parents('tr')).data();
                    document.getElementById('edit_item_id').value = data.id;
                    document.getElementById('edit_item_text').value = data.text;
                    document.getElementById('edit_item_href').value = data.href || '';
                    document.getElementById('edit_item_is_html').checked = data.is_html == 1;
                    openModal(editItemModal, editItemModalContent); // Use the general openModal
                });

                // --- Handle Edit Item Form Submission ---
                editItemForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (!confirm('Apakah Anda yakin ingin menyimpan perubahan ini?')) return;

                    const itemId = document.getElementById('edit_item_id').value;
                    const formData = new FormData(this);
                    formData.set('is_html', document.getElementById('edit_item_is_html').checked ? '1' : '0');

                    fetch(`/admin/services/items/${itemId}`, {
                            method: 'POST', // Use POST for FormData with _method (PATCH)
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    ?.content,
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
                                alert(data.message || 'Item berhasil diperbarui!');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });

                // --- Handle Delete Item Button Click (delegated from table) ---
                $('#serviceItemsTable tbody').on('click', 'button.delete-item-btn', function() {
                    const itemId = $(this).data('id');
                    if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) return;

                    fetch(`/admin/services/items/${itemId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                alert(data.message);
                                servicesTable.ajax.reload(); // Reload main table to update item count
                                serviceItemsTable.ajax.reload();
                            } else {
                                alert('Gagal menghapus item.');
                            }
                        })
                        .catch(error => console.error('Error deleting item:', error));
                });

                
            });
        </script>
    @endpush
</x-admin-layout>
