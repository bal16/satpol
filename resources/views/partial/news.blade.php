@if ($news->isEmpty())
    <div class="text-center py-10 text-gray-600">
        <p class="text-xl font-semibold">Tidak ada berita</p>
    </div>
@else
    @foreach ($news as $item)
        <x-news.primary-list :category="'Berita'" :date="$item->created_at->format('d-m-Y') .
            ' (' .
            $item->created_at->diffForHumans() .
            ')'" :title="$item->title" :image="asset('storage/' . $item->images->first()->path)"
            :href="route('news.show', $item->slug)" />
    @endforeach
    <div class="flex justify-center p-5">
        {{ $news->links() }}
    </div>
@endif