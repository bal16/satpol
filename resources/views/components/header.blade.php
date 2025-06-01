<header>
    <nav class="flex lg:max-h-12.5 max-h-9.5 justify-between items-center bg-[#2B2A29]">
        <div class="flex">
            <button class="flex border size-5.75 border-[#fdfdfd] ms-3.75 me-1.5 my-3.75">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="text-[#fdfdfd] size-4 m-auto">
                    <path fill="currentColor"
                        d="M3 7h18a1 1 0 0 0 0-2H3a1 1 0 0 0 0 2m18 10H3a1 1 0 0 0 0 2h18a1 1 0 0 0 0-2m0-4H3a1 1 0 0 0 0 2h18a1 1 0 0 0 0-2m0-4H3a1 1 0 0 0 0 2h18a1 1 0 0 0 0-2" />
                </svg>
            </button>
            <ul class="hidden lg:flex my-auto font-bold text-[#fdfdfd] divide-x">
                <li class="px-2 hover:bg-[#fdfdfd] hover:rounded hover:text-[#2B2A29] border-[#6A6968]">
                    <a href="{{ route('home') }}">BERANDA</a>
                </li>
                <li class="px-2 hover:bg-[#fdfdfd] hover:rounded hover:text-[#2B2A29] border-[#6A6968]">
                    <a href="{{ route('profile') }}">PROFIL</a>
                </li>
                <li class="px-2 hover:bg-[#fdfdfd] hover:rounded hover:text-[#2B2A29] border-[#6A6968]">
                    <a href="{{ route('news') }}">BERITA</a>
                </li>
                <li class="px-2 hover:bg-[#fdfdfd] hover:rounded hover:text-[#2B2A29] border-[#6A6968]">
                    <a href="{{ route('gallery') }}">GALERI</a>
                </li>
                <li class="px-2 hover:bg-[#fdfdfd] hover:rounded hover:text-[#2B2A29] border-[#6A6968]">
                    <a href="{{ route('services') }}">INFORMASI UMUM</a>
                </li>
            </ul>
        </div>
        <div class="flex border border-[#fdfdfd] text-[#fdfdfd] h-fit mx-3.25">
            <form class="flex h-full divide-x" action="{{ route('news') }}" id="search-form">
                <input class="border-[#6A6968] py-1 px-4 text-xs" type="text" name="search" id="search"
                    placeholder="Search" />
                <button class="flex px-1 hover:text-[#DD1D23]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="m-auto">
                        <path fill="currentColor"
                            d="m19.485 20.154l-6.262-6.262q-.75.639-1.725.989t-1.96.35q-2.402 0-4.066-1.663T3.808 9.503T5.47 5.436t4.064-1.667t4.068 1.664T15.268 9.5q0 1.042-.369 2.017t-.97 1.668l6.262 6.261zM9.539 14.23q1.99 0 3.36-1.37t1.37-3.361t-1.37-3.36t-3.36-1.37t-3.361 1.37t-1.37 3.36t1.37 3.36t3.36 1.37" />
                    </svg>
                </button>
            </form>
        </div>
    </nav>
    <div class="static bg-cover bg-center" style="background-image:url(image/red.jpg)">
        <div class="static flex bg-gradient-to-l from-[#E31E24]-0 to-[#30090A]">
            <div class="flex">
                <img class="lg:h-19.5 h-14.5 lg:my-6.5 my-4.5 lg:ms-7.5 ms-4.5 lg:me-4 me-2" src="image/logo.png"
                    alt="" />
            </div>
            <div class="flex flex-col text-[#fdfdfd] font-[Bebas_Neue] my-auto divide-y">
                <span class="font-black text-4xl">SATPOL PP</span>
                <span class="text-xs">SATUAN POLISI PAMONG PRAJA</span>
            </div>
        </div>
    </div>
</header>
