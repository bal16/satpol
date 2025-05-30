<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

<x-layout :pageName="'Gallery'">
    <x-header />
    <main class="bg-[#FDFDFD]">
        <div class="flex max-w-7xl justify-center mx-auto">
            <div class="flex flex-col p-25 ">
                <h1 class="lg:text-5xl text-3xl font-[DM_Serif_Text]">Galeri</h1>
                <div class="flex lg:flex-row flex-col p-6 rounded-sm shadow-xl justify-between lg:gap-0 gap-5">


                    <div class="flex flex-col lg:justify-start justify-between gap-4 lg:min-h-[50vh] lg:w-1/4">
                        <h2 class="lg:border-b-2 lg:w-76">
                            <span
                                class="lg:font-bold lg:text-lg text-xs text-[#FDFDFD] bg-black px-2 py-1">Kategori</span>
                        </h2>
                        {{-- Category List --}}
                        <ul id="category-list" class="flex lg:flex-col gap-2 py-1">
                            <li
                                class="{{ !request()->filled('category_id') ? 'font-bold lg:text-xl text-xs' : 'opacity-50 lg:text-sm text-xs' }}">
                                <a href="{{ route('gallery') }}" data-category-id="">Semua Foto</a>
                            </li>
                            @if (isset($categories) && $categories->count() > 0)
                                @foreach ($categories as $category)
                                    <li
                                        class="{{ request()->get('category_id') == $category->id ? 'font-bold lg:text-xl text-xs' : 'opacity-50 lg:text-sm text-xs' }}">
                                        <a href="{{ route('gallery', ['category_id' => $category->id]) }}"
                                            data-category-id="{{ $category->id }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div id="gallery_image" class="grid grid-cols-3 lg:pl-16 gap-2 lg:w-3/4 min-h-80">
                        @php $currentCategoryId = request()->input('category_id'); @endphp
                        @foreach ($gallery as $gal)
                            <a href="{{ asset('storage/' . $gal->path) }}"
                               class="gallery-lightbox-item" {{-- Class for GLightbox selector --}}
                               data-gallery="{{ $currentCategoryId ? 'category-' . $currentCategoryId : 'all-gallery' }}" {{-- For grouping --}}
                               title="{{ $gal->title }}"> {{-- GLightbox uses this for captions --}}
                                <img src="{{ asset('storage/' . $gal->path) }}"
                                    class="lg:w-50 h-37.5 object-cover hover:scale-105 transition duration-300 ease-in-out"
                                    alt="{{ $gal->title }}">
                            </a>
                        @endforeach
                    </div>


                </div> {{-- End of flex lg:flex-row --}}
                <div class="py-3" id="pagination-container"> {{-- This is where pagination links are rendered --}}
                    {{ $gallery->links() }}
                </div>

            </div>
        </div>

    </main>
    <x-footer />
</x-layout>

<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
    let lightboxInstance = null; // Keep track of the GLightbox instance

    function initializeLightbox() {
        if (lightboxInstance) {
            lightboxInstance.destroy(); // Destroy previous instance if it exists
        }
        lightboxInstance = window.GLightbox({ // Explicitly use window.GLightbox
            selector: '.gallery-lightbox-item', // Use the class we added to the <a> tags
            titlePosition: 'bottom', // 'bottom', 'top', 'left', 'right'
            // openEffect: 'zoom', // Example: 'zoom', 'fade', 'none'
            // closeEffect: 'fade', // Example: 'zoom', 'fade', 'none'
            // You can add more GLightbox options here: https://glightbox.mcstudios.com.mx/documentation.html
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const galleryImageContainer = document.getElementById('gallery_image');
        const categoryListContainer = document.getElementById('category-list');
        const paginationContainer = document.getElementById('pagination-container');
        initializeLightbox(); // Initial call to setup GLightbox
        if (paginationContainer) {
            paginationContainer.addEventListener('click', function(event) {
                // Find the closest ancestor anchor tag that was clicked
                const targetLink = event.target.closest('a[href]');

                // Ensure the clicked link is within this pagination container and is a valid link
                if (targetLink && this.contains(targetLink)) {
                    event.preventDefault(); // Prevent default link navigation
                    const url = targetLink.href;
                    fetchPageContent(url);
                }
            });
        }

        if (categoryListContainer) {
            categoryListContainer.addEventListener('click', function(event) {
                const targetLink = event.target.closest('a[data-category-id]');

                if (targetLink && this.contains(targetLink)) {
                    event.preventDefault(); // Prevent default link navigation
                    const url = targetLink.href;
                    fetchPageContent(url);

                    // Update active class for categories
                    categoryListContainer.querySelectorAll('li').forEach(liNode => {
                        liNode.classList.remove('font-bold', 'lg:text-xl');
                        liNode.classList.add('opacity-50', 'lg:text-sm');
                        // Ensure text-xs remains if it's a base class
                    });

                    const parentLi = targetLink.closest('li');
                    if (parentLi) {
                        parentLi.classList.remove('opacity-50', 'lg:text-sm');
                        parentLi.classList.add('font-bold', 'lg:text-xl');
                        // Ensure text-xs remains
                    }
                }
            });
        }

        // Function to update the active state of category links
        function updateActiveCategoryUI(currentUrl) {
            const url = new URL(currentUrl);
            const urlParams = new URLSearchParams(url.search);
            const activeCategoryId = urlParams.get('category_id');

            categoryListContainer.querySelectorAll('li').forEach(liNode => {
                const link = liNode.querySelector('a[data-category-id]');
                if (link) {
                    const linkCategoryId = link.getAttribute('data-category-id');
                    const isLinkActive = (activeCategoryId === linkCategoryId) || (!activeCategoryId && linkCategoryId === "");

                    if (isLinkActive) {
                        liNode.classList.remove('opacity-50', 'lg:text-sm');
                        liNode.classList.add('font-bold', 'lg:text-xl');
                    } else {
                        liNode.classList.remove('font-bold', 'lg:text-xl');
                        liNode.classList.add('opacity-50', 'lg:text-sm');
                    }
                    // 'text-xs' is a base class defined in the HTML, so it should remain.
                }
            });
        }


        function fetchPageContent(url) {
            // The 'X-Requested-With' header helps Laravel (and other frameworks)
            // identify this as an AJAX request.
            // Your controller should then return a partial view.
            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'text/html', // We expect HTML in response
                        'X-Requested-With': 'XMLHttpRequest' // Standard header for AJAX requests
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.text(); // Get the response body as HTML text
                })
                .then(html => {
                    // Parse the HTML string into a document fragment
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Update the gallery images:
                    // Assumes the response HTML contains an element with id="gallery_image"
                    const newGalleryHtml = doc.getElementById('gallery_image')?.innerHTML;
                    if (newGalleryHtml && galleryImageContainer) {
                        galleryImageContainer.innerHTML = newGalleryHtml;
                    }

                    // Update the pagination links:
                    // Assumes the response HTML contains an element with id="pagination-container"
                    const newPaginationHtml = doc.getElementById('pagination-container')?.innerHTML;
                    if (newPaginationHtml && paginationContainer) {
                        paginationContainer.innerHTML = newPaginationHtml;
                    }

                    // Update URL in browser history without reloading
                    // Check if the current URL is different to avoid pushing same state multiple times
                    if (window.location.href !== url) {
                        history.pushState({
                            path: url
                        }, document.title, url);
                    }
                    initializeLightbox(); // Re-initialize GLightbox after new content is loaded
                    updateActiveCategoryUI(url); // Update active category based on the new URL
                })
                .catch(error => {
                    console.error('Error fetching page content:', error);
                    // Optionally, display an error message to the user in the UI
                    if (galleryImageContainer) {
                        galleryImageContainer.innerHTML =
                            '<p class="text-red-500">Error loading content. Please try again.</p>';
                    }
                });
        }

        // Listen for browser back/forward navigation
        window.addEventListener('popstate', function(event) {
            // event.state is the state object we pushed earlier
            if (event.state && event.state.path) {
                fetchPageContent(event.state.path);
                // No need to call updateActiveCategoryUI here as fetchPageContent will do it
            } else {
                // Handle cases where state is null (e.g., initial page or navigation to a non-AJAX state)
                // For this app, reloading the content based on current location should be fine.
                fetchPageContent(location.pathname + location.search);
            }
        });
    });
</script>
