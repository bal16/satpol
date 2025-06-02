@props(['imageSrc', 'title'])

<div
    {{ $attributes->merge(['class' => 'flex flex-col shadow-lg rounded lg:w-81.5 w-51 lg:h-201 h-125.5 lg:border-t-5 border-t-3 border-[#E94B23]']) }}>
    <img src="{{ $imageSrc }}" alt="{{ $title }} Thumbnail" class="lg:max-h-54.5 max-h-34 object-cover">
    <span class="flex flex-col lg:p-5 p-3 lg:gap-8 gap-5">
        <h3 class="font-bold font-[DM_Serif_Text] lg:text-3xl text-lg text-[#E94B23] text-shadow-lg">{{ $title }}
        </h3>
        <hr class="lg:w-33.5 w-21 lg:border-2 border border-[#E94B23]">
        <div class="text-sm lg:text-lg">{{ $listItems }}</div>
    </span>
</div>
