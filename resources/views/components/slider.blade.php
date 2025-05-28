@props(['sliderData'])

@php
    $label = [
        'active' =>
            'block w-5 h-5 bg-stone-800 cursor-pointer opacity-50 z-10 transition-all duration-300 ease-in-out hover:scale-125 hover:opacity-100 rounded-full',
        'disabled' => '
                    block w-5 h-5 bg-stone-800 cursor-pointer opacity-50 z-10 transition-all duration-300 ease-in-out hover:scale-125 hover:opacity-100 rounded-full',
    ];
@endphp

<div id="imageSliderViewport"
    class="relative max-w-screen overflow-hidden h-[60vh] bg-linear-to-r from-[#2B2A29] via-[#fdfdfd] to-[#2B2A29]">
    @foreach ($sliderData as $slider)
        <input class="hidden peer/slider{{ $slider->slot_number }} checkbox" type="radio" name="slider"
            id="slider{{ $slider->slot_number }}" @if ($slider->slot_number == 1) checked @endif />
    @endforeach
    <div id="imageSliderTrack"
        class="relative w-[500vw] h-[100%] flex transition-all duration-500 ease-in-out peer-checked/slider1:-left-0 peer-checked/slider2:-left-[100vw] peer-checked/slider3:-left-[200vw] peer-checked/slider4:-left-[300vw] peer-checked/slider5:-left-[400vw]">
        @foreach ($sliderData as $slider)
            <div class="relative w-full h-[60vh] flex">
                @if ($slider->image_path == '')
                    <img class="w-full h-[60vh] object-contain" src="https://placehold.co/1600x900"
                        alt="Slider Image {{ $slider->slot_number }}" />
                @else
                    <img class="w-full h-[60vh] object-contain" src="{{ asset('storage/' . $slider->image_path) }}"
                        alt="Slider Image {{ $slider->slot_number }}" />
                @endif
            </div>
        @endforeach
    </div>
    <div
        class="absolute w-full flex justify-center gap-2 bottom-12 peer-checked/slider1:[&_label:nth-of-type(1)]:opacity-100 peer-checked/slider1:[&_label:nth-of-type(1)]:w-10 peer-checked/slider2:[&_label:nth-of-type(2)]:opacity-100 peer-checked/slider2:[&_label:nth-of-type(2)]:w-10 peer-checked/slider3:[&_label:nth-of-type(3)]:opacity-100 peer-checked/slider3:[&_label:nth-of-type(3)]:w-10 peer-checked/slider4:[&_label:nth-of-type(4)]:opacity-100 peer-checked/slider4:[&_label:nth-of-type(4)]:w-10 peer-checked/slider5:[&_label:nth-of-type(5)]:opacity-100 peer-checked/slider5:[&_label:nth-of-type(5)]:w-10 ">
        @foreach ($sliderData as $slider)
            <label
                class=@if ($slider->slot_number == 1) "{{ $label['active'] }}"
                @else "{{ $label['disabled'] }}" @endif
                for="slider{{ $slider->slot_number }}">
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
