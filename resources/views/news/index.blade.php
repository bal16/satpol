<x-layout :pageName="'News'">
    <x-header />
        <main class="static bg-cover lg:min-h-166 min-h-83"
        style="background-image:url(https://lh7-us.googleusercontent.com/A5DMTAlM3WhISDYMy0W7IsraNmSfBCJ2JLGokPftjz4i7fzxe6FXW2lAzs_s34AW58j4htCGAesYziXXxDm8gXh09IPEbY64CuW2OuliUWPMYw9SP4WlF2lamL41kKJkkCkSAe9KMBXVbHJ9xh45FX4)">
        <div class="static w-full h-full bg-gradient-to-b from-white-100/0 to-[#FDFDFD]">
            <div class="flex flex-col w-full mx-auto px-4 pt-16 pb-20 sm:px-6 lg:px-0 lg:max-w-6xl lg:pt-28 gap-5">
                <h1
                    class="lg:text-5xl text-5xl text-center lg:text-left font-[DM_Serif_Text] text-shadow-lg text-shadow-stone-900 text-[#FDFDFD]">
                    Berita</h1>
                <div class="flex justify-center {{-- For centering news content on small screens --}}
                            lg:grid lg:grid-cols-[minmax(0,1fr)_auto] {{-- For 2-column layout on large screens --}}
                            px-2 min-h-[50vh] pb-9 lg:px-8 rounded-sm lg:gap-10 bg-[#FDFDFD]">
                    <div id="news-content-area" class="flex flex-col max-w-160 lg:max-w-none lg:py-8 py-5 lg:gap-6 gap-3">
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
                    </div>
                    <div class="lg:flex flex-col hidden lg:max-w-84 gap-5 items-center lg:py-0 py-4">
                        <div class="hidden lg:block mt-8 w-84 border-b">
                            <span class="bg-[#2B2A29] text-[#FDFDFD] text-sm border-b py-1 px-4">
                                Berita Terbaru
                            </span>
                        </div>
                        @foreach ($latest as $item)
                            <x-news.secondary-list :category="'Berita'" :date="$item->created_at->format('d-m-Y')" :title="$item->title"
                                :image="asset('storage/' . $item->images->first()->path)" :href="route('news.show', $item->slug)" />
                        @endforeach
                        <div class="lg:hidden flex justify-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-footer />
    <script>
         document.addEventListener('DOMContentLoaded', function() {
            const newsContentArea = document.getElementById('news-content-area');
            const searchInput = document.getElementById('news-search-input');
            let searchTimeout;
            // Store the base URL for news index to handle searches correctly
            const baseNewsUrl = "{{ route('news') }}";

            function loadNews(endpointUrl, params = {}, pushState = true) {
                // Show a simple loading state
                newsContentArea.innerHTML = '<div class="text-center py-20">Memuat berita...</div>';

                const fetchUrl = new URL(endpointUrl);
                Object.keys(params).forEach(key => {
                    if (params[key] !== undefined && params[key] !== null) { // Ensure value is not undefined/null
                        fetchUrl.searchParams.set(key, params[key]);
                    }
                });

                console.log({fetchUrl, params})

                fetch(fetchUrl.toString(), {
                    method: 'GET', // Default, but good to be explicit
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', // Crucial for Laravel's $request->ajax()
                    }
                })
                    .then(async response => {
                        if (!response.ok) {
                            let errorDetail = `Status: ${response.status}`;
                            try {
                                const errorBody = await response.text();
                                errorDetail += `, Pesan Server: ${errorBody.substring(0, 300)}`; // Limit length
                            } catch (e) {
                                // ignore if can't read body
                            }
                            throw new Error(`Gagal mengambil data berita. ${errorDetail}`);
                        }
                        const sample = await response.text();
                        console.log({sample})
                        return sample;
                    })
                    .then(html => {
                        newsContentArea.innerHTML = html;

                        if (pushState) {
                            history.pushState({ path: fetchUrl.toString() }, '', fetchUrl.toString());
                        }
                        console.log({newsContentArea, html});
                    })
                    .catch(error => {
                        console.error("Error loading news:", error.message);
                        newsContentArea.innerHTML = `<div class="text-center py-10 text-red-500">Gagal memuat berita. Silakan coba lagi. Detail: ${error.message}</div>`;
                    });
            }

            // Handle pagination clicks
            newsContentArea.addEventListener('click', function(event) {
                const paginationLink = event.target.closest('.pagination a');
                if (!paginationLink) {
                    return; // Click was not on a pagination link or its child
                }
                event.preventDefault();

                const href = paginationLink.getAttribute('href');
                const linkUrl = new URL(href); // href from pagination is a full URL
                const currentSearchQuery = searchInput.value;
                let ajaxData = {}; // Data to be sent with AJAX

                // Extract query params from the pagination link itself
                linkUrl.searchParams.forEach((value, key) => {
                    ajaxData[key] = value;
                });

                if (currentSearchQuery) { // Ensure search query persists
                    ajaxData.search = currentSearchQuery;
                } else {
                    // If search input is empty, ensure 'search' param is not sent or is empty
                    // if it was part of the pagination link from a previous state.
                    delete ajaxData.search; // Or ajaxData.search = ''; depending on backend
                }
                // The 'url' for ajax should be the base path, and 'ajaxData' contains page and search
                loadNews(baseNewsUrl, ajaxData);
            });

            // Handle search input
            searchInput.addEventListener('keyup', function() {
                clearTimeout(searchTimeout);
                const query = this.value;
                console.log({query})
                searchTimeout = setTimeout(function() {
                    // When searching, always go to page 1
                    loadNews(baseNewsUrl, { search: query, page: 1 });
                }, 500); // 500ms delay
            });

            // Handle back/forward browser buttons
            window.addEventListener('popstate', function(event) {
                const statePath = event.state ? event.state.path : null;
                const targetUrl = statePath ? new URL(statePath) : new URL(window.location.href);
                
                // Ensure we are on a news page path before attempting to load
                if (targetUrl.pathname === new URL(baseNewsUrl).pathname) {
                    const params = {};
                    targetUrl.searchParams.forEach((value, key) => {
                        params[key] = value;
                    });
                    loadNews(baseNewsUrl, params, false); // Don't push state again
                }
            });
        });
    </script>
</x-layout>
