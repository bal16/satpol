<x-admin-layout :pageTitle="'Kelola Slider'">
    @push('styles')
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @endpush

    <!-- Page Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-slate-800 dark:text-white">Kelola Gambar Slider</h2>
        <p class="text-slate-600 dark:text-white">Unggah dan ganti gambar untuk slider di halaman utama. Terdapat 5 slot
            gambar yang dapat Anda kelola.</p>
    </div>

    {{-- These divs are used to pass session messages to SweetAlert2 --}}
    @if (session('success'))
        <div id="swal-success" data-message="{{ session('success') }}"></div>
    @endif
    @if (session('error'))
        <div id="swal-error" data-message="{{ session('error') }}"></div>
    @endif

    <!-- Slider Images Management -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- ... bagian atas file ... --}}

        @foreach ($currentSlidersData as $sliderData)
            @php
                $slotNumber = $sliderData['slot_number'];
                // URL aksi form harus menunjuk ke route yang menangani update slider berdasarkan slot.
                // Pastikan nama route 'admin.sliders.update' sesuai dengan yang ada di file routes/admin.php Anda.
            @endphp

            <div
                class="bg-red-700 dark:bg-stone-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                <h3 class="text-lg font-semibold text-white dark:text-slate-100 mb-4">Slider Gambar #{{ $slotNumber }}
                </h3>

                {{-- Pratinjau Gambar --}}
                <div
                    class="mb-4 aspect-[16/9] bg-red-600 dark:bg-stone-600 rounded-md flex items-center justify-center overflow-hidden">
                    @if ($sliderData['image_path'] == '')
                        <img id="sliderPreview{{ $slotNumber }}" src="https://placehold.co/1600x900"
                            alt="Pratinjau Slider {{ $slotNumber }}" class="w-full h-full object-cover">
                    @else
                        <img id="sliderPreview{{ $slotNumber }}"
                            src="{{ asset('storage/' . $sliderData->image_path) }}"
                            alt="Pratinjau Slider {{ $slotNumber }}" class="w-full h-full object-cover">
                    @endif
                </div>

                {{-- Form untuk mengganti gambar --}}
                {{-- PASTIKAN ACTION INI BENAR --}}
                <form class="slider-update-form" action="{{ route('admin.sliders.update', ['slot_number' => $slotNumber]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH') {{-- Ini akan mengirimkan request sebagai PATCH --}}

                    <div class="mb-4">
                        <label for="sliderImageInput{{ $slotNumber }}" class="sr-only">Pilih Gambar untuk Slider
                            {{ $slotNumber }}</label>
                        <input type="file" name="slider_image" id="sliderImageInput{{ $slotNumber }}"
                            class="block w-full text-sm text-slate-200 dark:text-slate-300
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-lg file:border-0
                              file:text-sm file:font-semibold
                              file:bg-red-100 file:text-red-800
                              dark:file:bg-red-500 dark:file:text-white
                              hover:file:bg-red-200 dark:hover:file:bg-red-600
                              file:cursor-pointer cursor-pointer"
                            accept="image/png, image/jpeg, image/jpg, image/webp"
                            onchange="previewSliderImage(this, 'sliderPreview{{ $slotNumber }}')">

                        {{-- Contoh menampilkan error validasi (jika Anda mengimplementasikannya di controller) --}}
                        @php $errorKey = 'slider_slot_' . $slotNumber; @endphp
                        @if ($errors->hasBag($errorKey) && $errors->getBag($errorKey)->has('slider_image'))
                            <p class="mt-1 text-xs text-yellow-300">
                                {{ $errors->getBag($errorKey)->first('slider_image') }}</p>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full cursor-pointer inline-flex items-center justify-center px-4 py-2.5
                           bg-red-500 hover:bg-red-400 dark:bg-red-600 dark:hover:bg-red-500
                           text-white text-sm font-medium rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-red-300 dark:focus:ring-red-700
                           focus:ring-offset-2 focus:ring-offset-red-700 dark:focus:ring-offset-stone-500
                           transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Ganti Gambar {{ $slotNumber }}
                    </button>
                </form>
            </div>
        @endforeach

        {{-- ... sisa file ... --}}

    </div>

    @push('scripts')
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function previewSliderImage(input, previewId) {
                const file = input.files[0];
                const previewElement = document.getElementById(previewId);
                if (file && previewElement) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewElement.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Display session messages with SweetAlert2
                if (document.getElementById('swal-success')) {
                    Swal.fire({
                        background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b',
                        icon: 'success',
                        title: 'Berhasil!',
                        text: document.getElementById('swal-success').getAttribute('data-message'),
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
                if (document.getElementById('swal-error')) {
                    Swal.fire({
                        background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b',
                        icon: 'error',
                        title: 'Gagal!',
                        text: document.getElementById('swal-error').getAttribute('data-message'),
                        showConfirmButton: true,
                        timer: 3000
                    });
                }

                // Add confirmation to all slider update forms
                document.querySelectorAll('.slider-update-form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // Prevent default submission
                        const currentForm = this;
                        Swal.fire({
                            title: 'Simpan Perubahan?',
                            text: "Anda yakin ingin mengganti gambar slider ini?",
                            icon: 'question',
                            showCancelButton: true,
                            background: document.documentElement.classList.contains('dark') ? '#292524' : '#fff',
                            color: document.documentElement.classList.contains('dark') ? '#d6d3d1' : '#1e293b',
                            customClass: {
                                confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                                cancelButton: 'bg-slate-500 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded ml-2'
                            },
                            buttonsStyling: false,
                            confirmButtonText: 'Ya, ganti!',
                            cancelButtonText: 'Batal'
                        }).then((result) => result.isConfirmed && currentForm.submit());
                    });
                });
            });
        </script>
    @endpush

</x-admin-layout>
