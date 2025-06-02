{{-- File: resources/views/partial/gallery.blade.php --}}
{{-- This view is returned for AJAX requests and parsed by JavaScript --}}

<div id="gallery_image" class="lg:w-10/11 min-h-80 min-w-[300px]">
    @if ($gallery->isNotEmpty())
        @php $currentCategoryId = request()->input('category_id'); @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
            {{-- {/* Membuat grid responsif */} --}}
            @foreach ($gallery as $gal)
                <a href="{{ asset('storage/' . $gal->path) }}" class="gallery-lightbox-item" {{-- Class for GLightbox selector --}}
                    data-gallery="{{ $currentCategoryId ? 'category-' . $currentCategoryId : 'all-gallery' }}"
                    {{-- For grouping --}} title="{{ $gal->title }}"> {{-- GLightbox uses this for captions --}}
                    <img src="{{ asset('storage/' . $gal->path) }}"
                        class="w-full h-37.5 object-cover hover:scale-105 transition duration-300 ease-in-out" {/*
                        Mengubah lg:w-50 menjadi w-full */} alt="{{ $gal->title }}">
                </a>
            @endforeach
        </div>
    @else
        <div class="flex items-center justify-center h-full text-center">
            <p class="text-gray-500 text-lg">Tidak ada foto untuk ditampilkan.</p>
        </div>
    @endif
</div>

<div id="pagination-container" class="py-3">
    {{ $gallery->links() }}
</div>
