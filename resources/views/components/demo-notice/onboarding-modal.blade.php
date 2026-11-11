<div id="demo-onboarding-modal" class="hidden fixed inset-0 z-50 items-center justify-center p-4 bg-black/75 backdrop-blur-xs transition-opacity duration-300" role="dialog" aria-modal="true" aria-labelledby="demo-modal-title">
    <div class="bg-white dark:bg-[#1E1E1E] text-neutral-900 dark:text-neutral-100 rounded-2xl shadow-2xl max-w-lg w-full p-6 sm:p-7 relative border border-neutral-200 dark:border-neutral-800">
        <div class="flex items-center gap-3 mb-4">
            <div class="p-2.5 rounded-xl bg-amber-500/15 text-amber-600 dark:text-amber-400 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <div>
                <span class="text-xs uppercase tracking-wider font-bold text-amber-600 dark:text-amber-400">Pemberitahuan Proyek</span>
                <h3 id="demo-modal-title" class="text-lg sm:text-xl font-bold leading-tight">Situs Portofolio & Demo</h3>
            </div>
        </div>

        <div class="space-y-3 text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">
            <p>
                Selamat datang! Website ini dikembangkan sebagai <strong>proyek peragaan portofolio pengembangan web</strong>.
            </p>
            <p>
                Seluruh data, logo, artikel berita, galeri, dan layanan yang tercantum digunakan khusus untuk keperluan demonstrasi fungsionalitas teknis (Laravel, REST API, Tailwind CSS, dll) dan <strong>bukan merupakan situs resmi</strong> Satuan Polisi Pamong Praja.
            </p>
            <div class="bg-neutral-100 dark:bg-neutral-900/60 p-3 rounded-lg text-xs border border-neutral-200 dark:border-neutral-800">
                <p class="font-medium text-neutral-700 dark:text-neutral-300">
                    Situs resmi Pemerintah Kota Semarang dapat diakses melalui portal resmi <a href="https://semarangkota.go.id" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline font-semibold">semarangkota.go.id</a>.
                </p>
            </div>
        </div>

        <div class="mt-6 flex flex-col sm:flex-row gap-3">
            <button id="acknowledge-demo-modal-btn" type="button" class="w-full inline-flex justify-center items-center py-2.5 px-4 rounded-xl font-semibold text-sm text-white bg-[#DD1D23] hover:bg-red-700 transition-colors shadow-sm cursor-pointer">
                Saya Mengerti & Lanjutkan
            </button>
        </div>
    </div>
</div>

<script>
    (function () {
        const modalKey = 'satpol_demo_notice_seen';
        const modal = document.getElementById('demo-onboarding-modal');
        const ackBtn = document.getElementById('acknowledge-demo-modal-btn');

        if (!modal) return;

        function showModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            try {
                localStorage.setItem(modalKey, 'true');
            } catch (e) {
                // Handle browser private mode or quota exceptions
            }
        }

        try {
            if (localStorage.getItem(modalKey) !== 'true') {
                showModal();
            }
        } catch (e) {
            showModal();
        }

        if (ackBtn) {
            ackBtn.addEventListener('click', closeModal);
        }
    })();
</script>
