{{-- d:\Bal\Collage\Project\satpol\resources\views\partial\news-list-section.blade.php --}}
{{-- Konten ini akan diperbarui oleh AJAX --}}
{{-- Termasuk daftar primer dan sekunder beserta paginasinya --}}
<div class="hidden lg:flex flex-col max-w-160 lg:py-8 py-5 lg:gap-6 gap-3">
    @forelse ($news as $item)
        <x-news.primary-list :category="'Berita'" :date="$item->created_at->format('d-m-Y') . ' (' . $item->created_at->diffForHumans() . ')'" :title="$item->title" :image="asset('storage/' . ($item->images->first()->path ?? 'images/default-news.jpg'))"
            {{-- Tambahkan gambar default jika perlu --}} :href="route('news.show', $item->slug)" />
    @empty
        <p class="text-center text-gray-500 py-10">Tidak ada berita ditemukan.</p>
    @endforelse
    <div class="flex justify-center p-5">
        {{ $news->links() }} {{-- Pastikan view paginasi default (Tailwind) sudah dikonfigurasi --}}
    </div>
</div>
<div class="flex flex-col lg:max-w-84 gap-5 items-center lg:py-0 py-4">
    <div class="hidden lg:block mt-8 w-84 border-b">
        <span class="bg-[#2B2A29] text-[#FDFDFD] text-sm border-b py-1 px-4">
            Berita Terbaru
        </span>
    </div>
    @forelse ($news as $item)
        <x-news.secondary-list :category="'Berita'" :date="$item->created_at->format('d-m-Y')" :title="$item->title" :image="asset('storage/' . ($item->images->first()->path ?? 'images/default-news.jpg'))"
            {{-- Tambahkan gambar default jika perlu --}} :href="route('news.show', $item->slug)" />
    @empty
        {{-- Pesan ini akan muncul jika daftar sekunder kosong. --}}
        {{-- Visibilitas dikontrol oleh class lg:hidden / hidden lg:block pada div induk. --}}
        <p class="text-center text-gray-500 py-4">Tidak ada berita untuk ditampilkan di sini.</p>
    @endforelse
    <div class="lg:hidden flex justify-center">
        {{ $news->links() }} {{-- Pastikan view paginasi default (Tailwind) sudah dikonfigurasi --}}
    </div>
</div>
