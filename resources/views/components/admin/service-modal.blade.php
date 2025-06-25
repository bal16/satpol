@props(['modalId', 'modalTitle', 'formId', 'submitButtonText', 'isEdit' => false])

<div id="{{ $modalId }}"
    class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50 transition-opacity duration-300 ease-in-out opacity-0">
    <div id="{{ $modalId }}Content"
        class="relative mx-auto my-6 w-full max-w-2xl transform rounded-lg bg-white p-6 shadow-xl transition-all duration-300 ease-in-out scale-95 opacity-0 dark:bg-stone-800">
        <!-- Modal header -->
        <div class="flex items-center justify-between rounded-t border-b pb-3 dark:border-stone-700">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $modalTitle }}</h3>
            <button type="button" id="close{{ ucfirst($modalId) }}Btn"
                class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-stone-700 dark:hover:text-white">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <!-- Modal body -->
        <form id="{{ $formId }}" class="space-y-6 py-4" enctype="multipart/form-data">
            @csrf
            @if ($isEdit)
                @method('PUT')
                <input type="hidden" id="edit_service_id" name="id" value="">
            @endif

            <div>
                <label for="{{ $isEdit ? 'edit_title' : 'create_title' }}"
                    class="mb-2.5 block font-medium text-black dark:text-white">Judul Kartu</label>
                <input type="text" id="{{ $isEdit ? 'edit_title' : 'create_title' }}" name="title"
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-6 pr-10 text-black outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Masukkan judul kartu" required>
                <span id="{{ $formId }}_title_error" class="mt-1 text-xs text-red-500 hidden"></span>
            </div>

            <div>
                <label for="{{ $isEdit ? 'edit_image_src' : 'create_image_src' }}"
                    class="mb-2.5 block font-medium text-black dark:text-white">URL Gambar</label>
                <input type="text" id="{{ $isEdit ? 'edit_image_src' : 'create_image_src' }}" name="image_src"
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-6 pr-10 text-black outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Masukkan URL gambar" required>
                <span id="{{ $formId }}_image_src_error" class="mt-1 text-xs text-red-500 hidden"></span>
            </div>

            <div>
                <label for="{{ $isEdit ? 'edit_card_id' : 'create_card_id' }}"
                    class="mb-2.5 block font-medium text-black dark:text-white">ID Kartu (Opsional)</label>
                <input type="text" id="{{ $isEdit ? 'edit_card_id' : 'create_card_id' }}" name="card_id"
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-6 pr-10 text-black outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Contoh: contact">
                <span id="{{ $formId }}_card_id_error" class="mt-1 text-xs text-red-500 hidden"></span>
            </div>

            <div>
                <label for="{{ $isEdit ? 'edit_list_font' : 'create_list_font' }}"
                    class="mb-2.5 block font-medium text-black dark:text-white">Font Daftar (Opsional)</label>
                <input type="text" id="{{ $isEdit ? 'edit_list_font' : 'create_list_font' }}" name="list_font"
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-6 pr-10 text-black outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Contoh: font-[IBM_Plex_Serif]">
                <span id="{{ $formId }}_list_font_error" class="mt-1 text-xs text-red-500 hidden"></span>
            </div>

            <div>
                <label for="{{ $isEdit ? 'edit_list_extra_classes' : 'create_list_extra_classes' }}"
                    class="mb-2.5 block font-medium text-black dark:text-white">Kelas Tambahan Daftar (Opsional)</label>
                <input type="text" id="{{ $isEdit ? 'edit_list_extra_classes' : 'create_list_extra_classes' }}"
                    name="list_extra_classes"
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-6 pr-10 text-black outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Contoh: font-bold">
                <span id="{{ $formId }}_list_extra_classes_error" class="mt-1 text-xs text-red-500 hidden"></span>
            </div>

            <div>
                <label for="{{ $isEdit ? 'edit_order' : 'create_order' }}"
                    class="mb-2.5 block font-medium text-black dark:text-white">Urutan</label>
                <input type="number" id="{{ $isEdit ? 'edit_order' : 'create_order' }}" name="order"
                    class="w-full rounded-lg border border-stroke bg-transparent py-3 pl-6 pr-10 text-black outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Masukkan urutan" value="0" required>
                <span id="{{ $formId }}_order_error" class="mt-1 text-xs text-red-500 hidden"></span>
            </div>

            <!-- Modal footer -->
            <div class="flex items-center justify-end space-x-2 rounded-b border-t pt-3 dark:border-stone-700">
                <button type="submit"
                    class="rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                    {{ $submitButtonText }}
                </button>
                <button type="button" id="cancel{{ ucfirst($modalId) }}Btn"
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-stone-500 dark:bg-stone-700 dark:text-gray-300 dark:hover:bg-stone-600 dark:hover:text-white dark:focus:ring-stone-700">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>