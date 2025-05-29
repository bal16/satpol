@props([
    'modalId' => 'editCategoryModal', // Defaulted to match existing JS for edit
    'modalTitle' => 'Edit Kategori',
    'formId' => 'editCategoryForm', // Defaulted to match existing JS for edit
    'submitButtonText' => 'Simpan Perubahan',
])

<div id="{{ $modalId }}"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 transition-opacity duration-300 ease-in-out opacity-0">
    <div id="{{ $modalId }}Content"
        class="bg-white dark:bg-slate-800 p-6 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 ease-in-out scale-95 opacity-0">
        <div class="flex justify-between items-center pb-3 border-b dark:border-slate-700">
            <h3 class="text-xl font-semibold text-slate-800 dark:text-white">{{ $modalTitle }}</h3>
            {{-- ID is constructed to match existing JS expectations for editCategoryModal --}}
            <button id="close{{ Illuminate\Support\Str::studly(str_replace('Modal', '', $modalId)) }}ModalBtn"
                type="button" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <form id="{{ $formId }}" class="mt-4 space-y-4" method="POST" action="#"> {{-- Action is handled by JavaScript --}}
            @csrf
            @method('PUT') {{-- Standard for updates --}}

            {{-- Specific ID for JavaScript to populate category ID --}}
            <input type="hidden" name="id" id="edit_category_id">

            <div>
                <label for="edit_category_name"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nama Kategori</label>
                {{-- Specific ID for JavaScript to populate category name and for error display --}}
                <input type="text" name="name" id="edit_category_name"
                    class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-600 dark:bg-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                <span id="edit_category_name_error" class="text-red-500 text-xs mt-1 hidden"></span>
            </div>
            <div class="flex justify-end space-x-3 pt-3 border-t dark:border-slate-700">
                <button id="cancel{{ Illuminate\Support\Str::studly(str_replace('Modal', '', $modalId)) }}ModalBtn"
                    type="button"
                    class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-600 rounded-md hover:bg-slate-200 dark:hover:bg-slate-500">Batal</button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">{{ $submitButtonText }}</button>
            </div>
        </form>
    </div>
</div>
