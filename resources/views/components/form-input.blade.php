@props([
    'id',
    'name',
    'type' => 'text',
    'label',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'iconSvg' => null,
    'disabled' => false,
])

<div class="mb-5">
    <label for="{{ $id }}" class="mb-2.5 block font-medium text-black dark:text-white">
        {{ $label }}
    </label>
    <div class="relative">
        <input id="{{ $id }}" type="{{ $type }}" name="{{ $name }}"
            placeholder="{{ $placeholder }}" @if ($required) required @endif
            @if ($autofocus) autofocus @endif value="{{ $value }}"
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => 'w-full rounded-lg border border-stroke bg-transparent py-3 pl-6 pr-10 text-black outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary']) }} />
        @if ($iconSvg)
            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-black dark:text-white">
                {!! $iconSvg !!}
            </span>
        @endif
    </div>
    @error($name)
        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>
