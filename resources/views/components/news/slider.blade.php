@props(['sliderData'])

@php
    // Menggunakan is_countable untuk keamanan jika $sliderData mungkin bukan countable
    $sliderCount = is_countable($sliderData) ? count($sliderData) : ($sliderData ? $sliderData->count() : 0);
    $navButtonBaseClasses =
        'block h-5 bg-stone-800 cursor-pointer z-10 transition-all duration-300 ease-in-out hover:scale-125 rounded-full';
    $activeNavButtonSpecificClasses = 'w-10 opacity-100';
    $inactiveNavButtonSpecificClasses = 'w-5 opacity-50 hover:opacity-100';
@endphp

<div id="imageSliderViewport"
    class="relative max-w-screen overflow-hidden h-[60vh] bg-linear-to-r from-[#2B2A29] via-[#fdfdfd] to-[#2B2A29]">
    @if ($sliderCount > 0)
        <div id="imageSliderTrack" class="relative h-[100%] flex transition-transform duration-500 ease-in-out"
            style="width: {{ $sliderCount * 100 }}vw; transform: translateX(0vw);">
            @foreach ($sliderData as $sliderItem)
                {{-- Menggunakan $sliderItem untuk konsistensi --}}
                <div class="relative w-full h-[60vh] flex-shrink-0" style="width: 100vw;">
                    {{-- Menggunakan $sliderItem->path sesuai dengan struktur data file ini --}}
                    @if (empty($sliderItem->path))
                        <img class="w-full h-[60vh] object-contain"
                            src="https://placehold.co/1600x900?text=Placeholder+{{ $loop->iteration }}"
                            alt="Slider Image {{ $loop->iteration }}" />
                    @else
                        <img class="w-full h-[60vh] object-contain" src="{{ asset('storage/' . $sliderItem->path) }}"
                            alt="Slider Image {{ $loop->iteration }}" />
                    @endif
                </div>
            @endforeach
        </div>

        <div id="sliderNavigation" class="absolute w-full flex justify-center gap-2 bottom-12">
            @foreach ($sliderData as $index => $sliderItem)
                <button
                    class="{{ $navButtonBaseClasses }} {{ $loop->first ? $activeNavButtonSpecificClasses : $inactiveNavButtonSpecificClasses }}"
                    data-slide-to-index="{{ $index }}" aria-label="Go to slide {{ $loop->iteration }}">
                </button>
            @endforeach
        </div>
    @else
        <div class="w-full h-[60vh] flex items-center justify-center">
            <p class="text-white">No images to display in slider.</p>
        </div>
    @endif
</div>

@if ($sliderCount > 0)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sliderViewport = document.getElementById('imageSliderViewport');
            const imageSliderTrack = document.getElementById('imageSliderTrack');
            const navButtons = document.querySelectorAll('#sliderNavigation button[data-slide-to-index]');
            const numSlides = {{ $sliderCount }}; // Mengambil jumlah slide langsung dari PHP

            if (!sliderViewport || !imageSliderTrack || numSlides === 0) {
                console.warn('Slider elements not found. Drag functionality will not be enabled.');
                return;
            }

            let currentSlideIndex = 0; // Index berbasis 0
            const SWIPE_THRESHOLD = 75;
            const AUTO_SLIDE_INTERVAL = 5000;
            let autoSlideTimer;
            let isDragging = false;
            let startX;

            const navBtnBase = "{{ $navButtonBaseClasses }}";
            const navBtnActive = "{{ $activeNavButtonSpecificClasses }}";
            const navBtnInactive = "{{ $inactiveNavButtonSpecificClasses }}";

            function updateSliderPosition(newIndex, fromInteraction = true) {
                if (newIndex < 0 || newIndex >= numSlides) return;

                // Update track position
                imageSliderTrack.style.transform = `translateX(-${newIndex * 100}vw)`;

                // Update navigation buttons
                navButtons.forEach((button, idx) => {
                    button.className = `${navBtnBase} ${navBtnInactive}`;
                    if (idx === newIndex) {
                        button.className = `${navBtnBase} ${navBtnActive}`;
                    }
                });
                currentSlideIndex = newIndex;

                if (fromInteraction) resetAutoSlide();
            }

            function getEventX(e) {
                return e.type.startsWith('touch') ? e.touches[0].clientX : e.clientX;
            }

            function getEndEventX(e) {
                return e.type.startsWith('touch') ? e.changedTouches[0].clientX : e.clientX;
            }

            function advanceSlide(direction = 1) { // direction: 1 for next, -1 for prev
                let nextSlideIndex = (currentSlideIndex + direction + numSlides) % numSlides;
                updateSliderPosition(nextSlideIndex,
                    false); // false: not a direct user interaction, don't reset timer here
            }

            function startAutoSlide() {
                if (numSlides <= 1) return;
                clearInterval(autoSlideTimer);
                autoSlideTimer = setInterval(() => advanceSlide(1), AUTO_SLIDE_INTERVAL);
            }

            function resetAutoSlide() {
                if (numSlides <= 1) return;
                clearInterval(autoSlideTimer); // Clear existing timer
                startAutoSlide();
            }

            // Initialize first slide
            updateSliderPosition(0, false); // Initialize to first slide, not a user interaction

            function handleDragStart(e) {
                if (numSlides <= 1) return; // No dragging if only one or no slides
                if (e.type === 'mousedown' && e.button !== 0) {
                    return;
                }
                isDragging = true;
                startX = getEventX(e);
                imageSliderTrack.style.cursor = 'grabbing';
                clearInterval(autoSlideTimer); // Hentikan auto-slide saat drag dimulai

                if (e.type === 'mousedown') {
                    // Mencegah perilaku drag default pada gambar saat mouse ditekan
                    const images = imageSliderTrack.querySelectorAll('img');
                    images.forEach(img => img.ondragstart = () => false);
                }
            }

            function handleDragMove(e) {
                if (!isDragging || numSlides <= 1) return;
                // Mencegah scroll halaman saat melakukan swipe horizontal pada perangkat sentuh
                if (e.type === 'touchmove') {
                    e.preventDefault();
                }
            }

            function handleDragEnd(e) {
                if (!isDragging || numSlides <= 1) return;
                isDragging = false;
                imageSliderTrack.style.cursor = 'grab';

                if (e.type === 'mouseup' || e.type === 'mouseleave') {
                    const images = imageSliderTrack.querySelectorAll('img');
                    images.forEach(img => img.ondragstart = null); // Mengembalikan perilaku drag default
                }

                const endX = getEndEventX(e);
                const diffX = endX - startX;

                if (Math.abs(diffX) > SWIPE_THRESHOLD) {
                    if (diffX < 0) { // Swipe left (next slide)
                        advanceSlide(1);
                    } else { // Swipe right (previous slide)
                        advanceSlide(-1);
                    }
                } else {
                    resetAutoSlide(); // If not enough swipe, still reset timer
                }
            }

            sliderViewport.addEventListener('mousedown', handleDragStart);
            document.addEventListener('mousemove', handleDragMove); // Listen on document for wider drag area
            document.addEventListener('mouseup', handleDragEnd); // Listen on document
            sliderViewport.addEventListener('mouseleave', handleDragEnd); // End drag if mouse leaves viewport

            sliderViewport.addEventListener('touchstart', handleDragStart, {
                passive: true
            });
            document.addEventListener('touchmove', handleDragMove, {
                passive: false
            });
            document.addEventListener('touchend', handleDragEnd);

            // Event listener untuk klik tombol navigasi
            navButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const newIndex = parseInt(button.dataset.slideToIndex, 10);
                    updateSliderPosition(newIndex); // User interaction, will reset auto-slide
                });
            });

            imageSliderTrack.style.cursor = 'grab'; // Atur kursor awal
            if (numSlides > 1) startAutoSlide(); // Mulai auto-slide jika ada lebih dari 1 slide
        });
    </script>
@endif
