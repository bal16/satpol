{{-- File: resources/views/partial/gallery.blade.php --}}
{{-- This view is returned for AJAX requests and parsed by JavaScript --}}

<div id="gallery_image" class="grid grid-cols-3 lg:pl-16 gap-2">
    @forelse ($gallery as $gal)
        <a href="{{ asset('storage/'.$gal->path) }}"
           class="gallery-lightbox-item" {{-- Class for GLightbox selector --}}
           data-gallery="{{ $selectedCategoryId ? 'category-' . $selectedCategoryId : 'all-gallery' }}" {{-- For grouping --}}
           title="{{ $gal->title }}"> {{-- GLightbox uses this for captions --}}
            <img src="{{ asset('storage/'.$gal->path) }}"
                 class="lg:w-50 h-37.5 object-cover hover:scale-105 transition duration-300 ease-in-out"
                 alt="{{ $gal->title }}">
        </a>
    @empty
        <div class="col-span-3 flex items-center justify-center h-full">
            <p class="text-center">Tidak ada gambar yang ditemukan untuk kategori ini.</p>
        </div>
    @endforelse
</div>

<div id="pagination-container" class="py-3">
    {{ $gallery->links() }}
</div>
