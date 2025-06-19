<x-admin-layout :title="'SOP'">
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Kelola SOP</h1>
        {{-- Optional: Add a "Create New" button if needed in the future --}}
        <button id="addSOPBtn"
            class="inline-flex items-center px-5 py-2.5 bg-red-100 dark:bg-red-500 text-red-700 dark:text-white text-sm font-medium rounded-lg hover:bg-red-800 dark:hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:ring-offset-2 dark:focus:ring-offset-slate-800 transition duration-150 ease-in-out focus:text-white hover:text-white">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"></path>
            </svg>
            Tambah
        </button>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg">
        <div class="p-4 overflow-x-auto">
            <table class="table-auto w-full" id="sopTable">
                <thead class="bg-red-600 dark:bg-stone-700 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Judul
                            (Title)</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Link</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-stone-600">
                    @forelse ($items as $item)
                        <tr>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $item->title }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <a href="{{ $item->link }}"
                                    class="inline-flex items-center px-2.5 py-1.5 hover:text-blue-600 underline transition-colors">
                                    {{ $item->link }}

                                </a>
                            </td>
                            <td class="flex gap-2 px-4 py-2 whitespace-nowrap">
                                <button type="button"
                                    class="edit-sop-btn inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    data-id="{{ $item->id }}"
                                    data-title="{{ $item->title }}"
                                    data-link="{{ $item->link }}">
                                    Edit
                                </button>
                                <form method="post" action="{{ route('admin.profile.sop.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus SOP ini?')">Delete</button>
                                </form>
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

    <x-admin.sop-modal modalId="createSOPModal" modalTitle="Tambah SOP Baru" formId="createSOPForm"
        submitButtonText="Simpan" :isEdit="false" />

    <!-- Edit SOP Modal -->
    <x-admin.sop-modal modalId="editSOPModal" modalTitle="Edit SOP" formId="editSOPForm"
        submitButtonText="Simpan Perubahan" :isEdit="true" />
    @push('scripts')
        <script>
            // Modal Handling
            const createSOPModal = document.getElementById('createSOPModal');
            const createSOPModalContent = document.getElementById('createSOPModalContent');
            const addSOPBtn = document.getElementById('addSOPBtn'); // This ID remains the same
            const closeCreateSOPModalBtn = document.getElementById('closeCreateSOPModalBtn');
            const cancelCreateSOPModalBtn = document.getElementById('cancelCreateSOPModalBtn');
            const createSOPForm = document.getElementById('createSOPForm');

            const editSOPModal = document.getElementById('editSOPModal');
            const editSOPModalContent = document.getElementById('editSOPModalContent');
            const closeEditSOPModalBtn = document.getElementById('closeEditSOPModalBtn');
            const cancelEditSOPModalBtn = document.getElementById('cancelEditSOPModalBtn');
            const editSOPForm = document.getElementById('editSOPForm');

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
                    if (modal === createSOPModal) {
                        createSOPForm.reset();
                        clearFormErrors(createSOPForm, 'create');
                    } else if (modal === editSOPModal) {
                        editSOPForm.reset();
                        document.getElementById('edit_id').value = ''; // Clear hidden ID
                        clearFormErrors(editSOPForm, 'edit');
                    }
                }, 300);
            }

            function clearFormErrors(form, prefix) {
                const fields = ['title', 'link']; // Fields specific to SOP
                fields.forEach(field => {
                    const errorSpan = form.querySelector(`#${prefix}_${field}_error`);
                    if (errorSpan) {
                        errorSpan.classList.add('hidden');
                        errorSpan.textContent = '';
                    }
                });
            }

            function displayFormErrors(form, errors, prefix) {
                clearFormErrors(form, prefix);
                for (const field in errors) {
                    // field will be 'title', 'link' from server validation
                    const errorSpanId = `${prefix}_${field}_error`;
                    const errorSpan = form.querySelector(`#${errorSpanId}`);
                    if (errorSpan) {
                        errorSpan.textContent = errors[field][0];
                        errorSpan.classList.remove('hidden');
                    }
                }
            }

            // Create Modal Listeners
            addSOPBtn.addEventListener('click', () => openModal(createSOPModal, createSOPModalContent));
            closeCreateSOPModalBtn.addEventListener('click', () => closeModal(createSOPModal,
                createSOPModalContent));
            cancelCreateSOPModalBtn.addEventListener('click', () => closeModal(createSOPModal,
                createSOPModalContent));
            window.addEventListener('click', (event) => {
                if (event.target === createSOPModal) closeModal(createSOPModal, createSOPModalContent);
                if (event.target === editSOPModal) closeModal(editSOPModal, editSOPModalContent);
            });

            // SOP Edit Modal Listeners
            closeEditSOPModalBtn.addEventListener('click', () => closeModal(editSOPModal, editSOPModalContent));
            cancelEditSOPModalBtn.addEventListener('click', () => closeModal(editSOPModal, editSOPModalContent));

            createSOPForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch("{{ route('admin.profile.sop.store') }}", {
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
                            displayFormErrors(createSOPForm, data.errors, 'create');
                        } else {
                            closeModal(createSOPModal, createSOPModalContent);
                            alert(data.message || 'SOP berhasil ditambahkan!');
                            window.location.reload();
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Handle Edit Button Click (delegated from table)
            document.querySelector('#sopTable tbody').addEventListener('click', function(event) {
                const editButton = event.target.closest('button.edit-sop-btn');
                if (editButton) {
                    const sopId = editButton.dataset.id;
                    const sopTitle = editButton.dataset.title;
                    const sopLink = editButton.dataset.link;

                    document.getElementById('edit_id').value = sopId; // Assuming your modal has <input type="hidden" id="edit_id" name="id">
                    document.getElementById('edit_title').value = sopTitle; // Assuming <input id="edit_title" name="title">
                    document.getElementById('edit_link').value = sopLink; // Assuming <input id="edit_link" name="link">

                    // Dynamically set form action, though fetch URL is what matters more
                    // editSOPForm.action = `/admin/profile/sop/${sopId}`;

                    openModal(editSOPModal, editSOPModalContent);
                }
            });

                    // Handle Edit Form Submission
            editSOPForm.addEventListener('submit', function(e) {
                e.preventDefault();
                if (!confirm('Apakah Anda yakin ingin menyimpan perubahan SOP ini?')) return;

                const sopId = document.getElementById('edit_id').value;
                const formData = new FormData(this);
                // formData.append('_method', 'PUT'); // Ensure _method is part of the FormData for Laravel

                // Construct the URL for the update operation
                // Make sure this matches your route definition (e.g., Route::put('/admin/profile/sop/{sop}', ...))
                // or Route::post('/admin/profile/sop/{sop}' if you rely on _method field with POST)
                const updateUrl = `/admin/profile/sop/${sopId}`;

                fetch(updateUrl, {
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
                                    displayFormErrors(editSOPForm, data.errors, 'edit');
                                } else {
                                    closeModal(editSOPModal, editSOPModalContent);
                                    alert(data.message || 'SOP berhasil diperbarui!');
                                    window.location.reload();
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });
        </script>
    @endpush
</x-admin-layout>
