@props(['sliderData'])

@php
    $label = [
        'active' =>
            'block w-5 h-5 bg-stone-800 cursor-pointer opacity-50 z-10 transition-all duration-300 ease-in-out hover:scale-125 hover:opacity-100 rounded-full',
        'disabled' => '
                    block w-5 h-5 bg-stone-800 cursor-pointer opacity-50 z-10 transition-all duration-300 ease-in-out hover:scale-125 hover:opacity-100 rounded-full',
    ];

    $slideCount = $sliderData->count();
    $trackWidthClass = 'w-[' . ($slideCount > 0 ? $slideCount * 100 : 100) . 'vw]'; // Calculate total width

    // Prepare peer-checked classes for the track
    $trackPeerClasses = [];
    for ($i = 1; $i <= $slideCount; $i++) {
        $trackPeerClasses[] = "peer-checked/slider{$i}:-left-[" . (($i - 1) * 100) . 'vw]';
    }
    $trackPeerClassesString = implode(' ', $trackPeerClasses);

    // Prepare peer-checked classes for the navigation dots
    $navPeerClasses = [];
    for ($i = 1; $i <= $slideCount; $i++) {
        $navPeerClasses[] = "peer-checked/slider{$i}:[&_label:nth-of-type({$i})]:opacity-100";
        $navPeerClasses[] = "peer-checked/slider{$i}:[&_label:nth-of-type({$i})]:w-10";
    }
    $navPeerClassesString = implode(' ', $navPeerClasses);

@endphp

<div id="imageSliderViewport" class="relative max-w-screen overflow-hidden">
    @foreach ($sliderData as $index => $sliderItem)
        {{-- Renamed $slider to $sliderItem to avoid conflict with loop var --}}
        <input class="hidden peer/slider{{ $index + 1 }} checkbox" type="radio" name="slider"
            id="slider{{ $index + 1 }}" @if ($index + 1 == 1) checked @endif />
    @endforeach
    <div id="imageSliderTrack"
        class="relative {{ $trackWidthClass }} h-[100%] flex transition-all duration-500 ease-in-out {{ $trackPeerClassesString }}">
        @foreach ($sliderData as $index => $slider)
            <div class="relative w-full h-[60vh] flex items-center">
                @if ($slider->path == '')
                    <img class="w-full h-[60vh] object-contain" src="https://placehold.co/1600x900"
                        alt="Slider Image {{ $index + 1 }}" />
                @else
                    <img class="w-full h-[60vh] object-contain" src="{{ asset('storage/' . $slider->path) }}"
                        alt="Slider Image {{ $index + 1 }}" />
                @endif
            </div>
        @endforeach
    </div>
    <div class="absolute w-full flex justify-center gap-2 bottom-12 {{ $navPeerClassesString }}">
        @foreach ($sliderData as $index => $slider)
            <label
                class=@if ($index + 1 == 1) "{{ $label['active'] }}"
                @else "{{ $label['disabled'] }}" @endif
                for="slider{{ $index + 1 }}">
            </label>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sliderViewport = document.getElementById('imageSliderViewport');
        const imageSliderTrack = document.getElementById('imageSliderTrack');
        const radioButtons = document.querySelectorAll('input[name="slider"]');
        const numSlides = radioButtons.length;

        if (!sliderViewport || !imageSliderTrack || numSlides === 0) {
            console.warn('Slider elements not found. Drag functionality will not be enabled.');
            return;
        }

        let isDragging = false;
        let startX;
        let currentSlideIndex;
        const SWIPE_THRESHOLD = 75; // Minimal pergeseran (dalam pixel) untuk mengganti slide
        const AUTO_SLIDE_INTERVAL = 5000; // 5 detik
        let autoSlideTimer;

        function getEventX(e) {
            return e.type.startsWith('touch') ? e.touches[0].clientX : e.clientX;
        }

        function getEndEventX(e) {
            return e.type.startsWith('touch') ? e.changedTouches[0].clientX : e.clientX;
        }

        function advanceSlide() {
            currentSlideIndex = Array.from(radioButtons).findIndex(rb => rb.checked);
            let nextSlideIndex = (currentSlideIndex + 1) % numSlides;
            radioButtons[nextSlideIndex].checked = true;
        }

        function startAutoSlide() {
            clearInterval(autoSlideTimer); // Hapus interval sebelumnya jika ada
            autoSlideTimer = setInterval(advanceSlide, AUTO_SLIDE_INTERVAL);
        }

        function resetAutoSlide() {
            startAutoSlide();
        }

        function handleDragStart(e) {
            if (e.type === 'mousedown' && e.button !== 0) { // Hanya tombol kiri mouse
                return;
            }
            isDragging = true;
            startX = getEventX(e);
            currentSlideIndex = Array.from(radioButtons).findIndex(rb => rb.checked);
            imageSliderTrack.style.cursor = 'grabbing';
            clearInterval(autoSlideTimer); // Hentikan auto-slide saat drag dimulai

            if (e.type === 'mousedown') {
                // Mencegah perilaku drag default pada gambar saat mouse ditekan
                const images = imageSliderTrack.querySelectorAll('img');
                images.forEach(img => img.ondragstart = () => false);
            }
        }

        function handleDragMove(e) {
            if (!isDragging) return;
            // Mencegah scroll halaman saat melakukan swipe horizontal pada perangkat sentuh
            if (e.type === 'touchmove') {
                e.preventDefault();
            }
        }

        function handleDragEnd(e) {
            if (!isDragging) return;
            isDragging = false;
            imageSliderTrack.style.cursor = 'grab';

            if (e.type === 'mouseup' || e.type === 'mouseleave') {
                const images = imageSliderTrack.querySelectorAll('img');
                images.forEach(img => img.ondragstart = null); // Mengembalikan perilaku drag default
            }

            const endX = getEndEventX(e);
            const diffX = endX - startX;

            if (Math.abs(diffX) > SWIPE_THRESHOLD) {
                if (diffX < 0) { // Geser ke kiri
                    if (currentSlideIndex < numSlides - 1) {
                        radioButtons[currentSlideIndex + 1].checked = true;
                    } else {
                        radioButtons[0].checked = true; // Loop ke awal jika di slide terakhir
                    }
                } else { // Geser ke kanan
                    if (currentSlideIndex > 0) {
                        radioButtons[currentSlideIndex - 1].checked = true;
                    } else {
                        radioButtons[numSlides - 1].checked = true; // Loop ke akhir jika di slide pertama
                    }
                }
            }
            resetAutoSlide(); // Mulai ulang auto-slide setelah drag selesai
        }

        sliderViewport.addEventListener('mousedown', handleDragStart);
        document.addEventListener('mousemove', handleDragMove);
        document.addEventListener('mouseup', handleDragEnd);
        sliderViewport.addEventListener('touchstart', handleDragStart, {
            passive: true
        });
        document.addEventListener('touchmove', handleDragMove, {
            passive: false
        });
        document.addEventListener('touchend', handleDragEnd);

        // Reset auto-slide ketika radio button diubah (misalnya oleh klik pada label)
        radioButtons.forEach(radio => {
            radio.addEventListener('change', () => {
                resetAutoSlide();
            });
        });

        imageSliderTrack.style.cursor = 'grab'; // Atur kursor awal
        startAutoSlide(); // Mulai auto-slide saat halaman dimuat
    });
</script>
