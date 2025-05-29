{{-- File: resources/views/partial/gallery.blade.php --}}
{{-- This view is returned for AJAX requests and parsed by JavaScript --}}

<div id="gallery_image" class="grid grid-cols-3 lg:pl-16 gap-2">
    @forelse ($gallery as $gal)
        <a href="{{-- Consider linking to a detail page or use for a lightbox --}}">
            <img src="{{ asset('storage/'.$gal->path) }}" class="lg:w-50 h-37.5 object-cover"
                 alt="{{ $gal->title }}">
        </a>
    @empty
        <p class="col-span-3 text-center py-10">Tidak ada gambar yang ditemukan untuk kategori ini.</p>
    @endforelse
</div>

<div id="pagination-container" class="py-3">
    {{ $gallery->links() }}
</div>
