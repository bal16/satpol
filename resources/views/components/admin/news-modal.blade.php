@props(['modalId', 'modalTitle', 'formId', 'submitButtonText', 'isEdit' => false])

<div id="{{ $modalId }}"
    class="fixed inset-0 z-50 hidden flex items-center justify-center overflow-y-auto bg-black/70 transition-opacity duration-300 ease-in-out">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-stone-800 rounded-lg shadow-xl p-6 w-full min-w-lg transform transition-all duration-300 ease-in-out scale-95 opacity-0"
            id="{{ $modalId }}Content">
            <div class="flex justify-between items-center pb-3 border-b dark:border-stone-700">
                <h3 class="text-xl font-semibold text-slate-800 dark:text-white">{{ $modalTitle }}</h3>
                <button id="close{{ ucfirst(str_replace('-', '', Str::studly($modalId))) }}Btn"
                    class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form id="{{ $formId }}" class="mt-4 space-y-4">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                    <input type="hidden" name="id" id="{{ $isEdit ? 'edit' : 'create' }}_id">
                @endif
                <div>
                    <label for="{{ $isEdit ? 'edit' : 'create' }}_title"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Judul</label>
                    <input type="text" name="title" id="{{ $isEdit ? 'edit' : 'create' }}_title" required
                        class="mt-1 py-2 px-3 block w-full rounded-md border-slate-300 dark:border-stone-600 dark:bg-stone-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm">
                    <span class="text-xs text-red-500 hidden" id="{{ $isEdit ? 'edit' : 'create' }}_title_error"></span>
                </div>
                <div>
                    <label for="{{ $isEdit ? 'edit' : 'create' }}_body"
                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Isi Berita</label>
                    {{-- <textarea name="body" id="{{ $isEdit ? 'edit' : 'create' }}_body" rows="5" required
                        class="mt-1 px-3 py-2 block w-full rounded-md border-slate-300 dark:border-stone-600 dark:bg-stone-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm"></textarea> --}}

                    <x-trix-input id="{{ $isEdit ? 'edit' : 'create' }}_body" name="body" :attachment="true" />
                    <span class="text-xs text-red-500 hidden" id="{{ $isEdit ? 'edit' : 'create' }}_body_error"></span>
                </div>
                <div class="flex justify-end pt-4">
                    <button type="button" id="cancel{{ ucfirst(str_replace('-', '', Str::studly($modalId))) }}Btn"
                        class="mr-2 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-stone-700 rounded-md hover:bg-slate-200 dark:hover:bg-stone-600">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-stone-800">{{ $submitButtonText }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
