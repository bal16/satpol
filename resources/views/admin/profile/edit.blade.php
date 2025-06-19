<x-admin-layout :pageTitle="'Edit Profile Item: ' . $item->title">
    @push('styles')
        <x-rich-text-laravel::styles theme="richtextlaravel" />
        <!-- Di dalam <head> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Sebelum </body> penutup -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush


    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-white">Edit Profile Item: <span
                class="text-red-600">{{ $item->title }}</span></h1>
    </div>

    @if (session('error'))
        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white dark:bg-stone-800 text-stone-900 dark:text-white shadow-xl rounded-lg p-6">
        <form action="{{ route('admin.profile.update', $item->id) }}" method="POST" enctype="multipart/form-data"">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Judul
                        (Title)</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $item->title) }}"
                        class="mt-1 block w-full px-3 py-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                        required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tipe</label>
                    <select name="type" id="type"
                        class="mt-1 block w-full px-3 py-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                        required>
                        <option value="text" {{ old('type', $item->type) == 'text' ? 'selected' : '' }}>Text</option>
                        <option value="image" {{ old('type', $item->type) == 'image' ? 'selected' : '' }}>Image</option>
                        <option value="html" {{ old('type', $item->type) == 'html' ? 'selected' : '' }}>HTML</option>
                        {{-- Tambahkan opsi lain jika diperlukan di masa mendatang --}}
                    </select>
                    @error('type')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Pilih tipe konten yang akan ditampilkan.
                    </p>
                </div>

                {{-- Conditional Content Input Area --}}
                <div id="content-input-area" class="space-y-6">
                    {{-- Image Input Section --}}
                    <div id="image-content-section" style="display: {{ old('type', $item->type) == 'image' ? 'block' : 'none' }};">
                        <label for="content_image" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Unggah Gambar</label>
                        <input type="file" name="content_image_input" id="content_image"
                            class="mt-1 block w-full px-3 py-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                            accept="image/*" onchange="previewImage(event)">

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                            @if ($item->type == 'image' && $item->content)
                            <div>
                                <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 mb-1">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $item->content) }}" alt="Gambar saat ini" class="rounded-md max-h-48 w-auto shadow">
                            </div>
                            @endif
                            <div>
                                <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 mb-1">Pratinjau gambar baru:</p>
                                <img id="image_preview" src="#" alt="Pratinjau gambar baru" class="rounded-md max-h-48 w-auto shadow" style="display: none;">
                            </div>
                        </div>

                        @if ($item->type == 'image' && $item->content)
                        @endif
                        @error('content') {{-- Assuming 'content' is the field name for validation regardless of type --}}
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- HTML (Trix Editor) Input Section --}}
                    <div id="html-content-section" style="display: {{ old('type', $item->type) == 'html' ? 'block' : 'none' }};">
                        <label for="content_html_editor"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Konten HTML</label>
                        <x-trix-input id="content_html_editor" name="body" :value="old('body', $item->body->toTrixHtml())" {{-- Changed name --}}
                            class="mt-1 block w-full min-h-[250px] @error('content') trix-content-invalid @enderror" />
                        @error('content')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Text (Textarea) Input Section --}}
                    <div id="text-content-section" style="display: {{ old('type', $item->type) == 'text' || (old('type', $item->type) != 'image' && old('type', $item->type) != 'html') ? 'block' : 'none' }};">
                        <label for="content_text_input"
                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Konten</label>
                        <textarea name="content_text_input" id="content_text_input" rows="10" {{-- Changed name --}}
                            class="mt-1 block w-full px-3 py-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">{{ old('content', $item->content) }}</textarea>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="show" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        Tampilkan item ini di halaman profil?
                    </label>
                    <label for="show" class="relative inline-flex items-center cursor-pointer">
                        <!-- Toggle Track -->
                        <!-- Input Checkbox (Hidden but functional, and acts as a peer) -->
                        <input id="show" name="show" type="checkbox" value="1" class="sr-only peer"
                            {{ old('show', $item->show) ? 'checked' : '' }}>
                        <!-- Track -->
                        <div
                            class="w-14 h-8 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 rounded-full peer dark:bg-slate-700 peer-checked:bg-red-300 dark:peer-checked:bg-red-400 transition-colors duration-300 ease-in-out">
                        </div>
                        <!-- Dot -->
                        <div
                            class="absolute top-1 left-1 bg-white peer-checked:bg-red-600 w-6 h-6 rounded-full shadow-md transform transition-all duration-300 ease-in-out peer-checked:translate-x-full">
                        </div>
                    </label>
                    @error('show')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="pt-6">
                <div class="flex justify-end">
                    <a href="{{ route('admin.profile') }}"
                        class="bg-white dark:bg-slate-700 py-2 px-4 border border-slate-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const typeSelect = document.getElementById('type');
                const imageContentSection = document.getElementById('image-content-section');
                const htmlContentSection = document.getElementById('html-content-section');
                const textContentSection = document.getElementById('text-content-section');

                const imageInput = document.getElementById('content_image');
                const htmlInput = document.querySelector('#html-content-section trix-editor'); // Trix editor is a web component
                const textInput = document.getElementById('content_text_input');

                function updateContentFieldName() {
                    // Disable all content inputs first to ensure only one is active
                    if (imageInput) imageInput.name = '';
                    if (htmlInput) htmlInput.inputElement.name = ''; // Trix stores its input in a hidden field
                    if (textInput) textInput.name = '';

                    const selectedType = typeSelect.value;

                    if (selectedType === 'image') {
                        if (imageInput) imageInput.name = 'content';
                    } else if (selectedType === 'html') {
                        if (htmlInput && htmlInput.inputElement) {
                             // The actual hidden input for Trix is typically named after the 'input' attribute of the editor or the 'name' of the x-trix-input
                             // Let's assume x-trix-input component handles setting its hidden input's name to 'content' if its own name prop is 'content'
                             // For now, we ensure the original x-trix-input component's name prop is 'content' when it's visible.
                             // The Blade component <x-trix-input name="content_html_input"...
                             // We need to ensure the actual submitted name is 'content'.
                             // The easiest is to have three distinct named inputs in blade and then in controller pick the right one.
                             // Or, more cleanly, ensure the x-trix-input component's 'name' attribute is dynamically set or its hidden input is.
                             // For simplicity with current structure, we'll rely on the blade name for trix being `content_html_input`
                             // and adjust it here if needed, or handle it server-side.
                             // Let's rename the trix-editor's hidden input directly if possible.
                             const trixHiddenInput = document.getElementById('content_html_editor'); // This is the ID of the x-trix-input
                             if(trixHiddenInput) trixHiddenInput.name = 'content'; // This should target the hidden input generated by trix
                        }
                    } else { // text or default
                        if (textInput) textInput.name = 'content';
                    }
                }

                function toggleContentFields() {
                    const selectedType = typeSelect.value;

                    imageContentSection.style.display = selectedType === 'image' ? 'block' : 'none';
                    htmlContentSection.style.display = selectedType === 'html' ? 'block' : 'none';
                    textContentSection.style.display = (selectedType === 'text' || (selectedType !== 'image' && selectedType !== 'html')) ? 'block' : 'none';

                    updateContentFieldName(); // Update the name attribute of the active input to 'content'
                }

                typeSelect.addEventListener('change', toggleContentFields);
                toggleContentFields(); // Initial call
            });

            function previewImage(event) {
                const reader = new FileReader();
                const imagePreview = document.getElementById('image_preview');
                reader.onload = function() {
                    if (reader.readyState === 2) {
                        imagePreview.src = reader.result;
                        imagePreview.style.display = 'block';
                    }
                }
                if (event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                } else {
                    imagePreview.src = '#';
                    imagePreview.style.display = 'none';
                }
            }
        </script>
    @endpush
</x-admin-layout>
