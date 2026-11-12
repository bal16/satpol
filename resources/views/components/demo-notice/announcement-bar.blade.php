<div id="demo-announcement-bar" class="bg-amber-500 text-neutral-950 px-4 py-2 text-xs sm:text-sm font-medium relative z-40 transition-all duration-300">
    <div class="container mx-auto flex items-center justify-between gap-3">
        <div class="flex items-center gap-2 flex-1">
            <span class="inline-flex items-center justify-center p-1 rounded-full bg-neutral-950 text-amber-400 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
            </span>
            <div class="leading-snug">
                <span class="font-bold uppercase tracking-wider text-[10px] bg-neutral-950/10 px-1.5 py-0.5 rounded mr-1">Demo Portofolio</span>
                <span>Website ini merupakan proyek peragaan portofolio pengembangan web dan <strong>bukan</strong> situs resmi pemerintah.</span>
            </div>
        </div>
        <button id="dismiss-demo-banner-btn" type="button" aria-label="Tutup banner demo" class="p-1 rounded hover:bg-black/10 transition-colors text-neutral-900 cursor-pointer shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
</div>

<script>
    (function () {
        const bannerKey = 'satpol_demo_banner_dismissed';
        const banner = document.getElementById('demo-announcement-bar');
        const dismissBtn = document.getElementById('dismiss-demo-banner-btn');

        if (banner && sessionStorage.getItem(bannerKey) === 'true') {
            banner.classList.add('hidden');
        }

        if (dismissBtn && banner) {
            dismissBtn.addEventListener('click', function () {
                banner.classList.add('hidden');
                sessionStorage.setItem(bannerKey, 'true');
            });
        }
    })();
</script>
