<x-layout :pageName="'News'">
    <x-header />
    <main class="static bg-cover lg:min-h-166 min-h-83" style="background-image:url(image/slider.png)">
        <div class="static w-full h-full bg-gradient-to-b from-white-100/0 to-[#FDFDFD]">
            <div class="flex flex-col lg:max-w-242.5 max-w-94 mx-auto py-20 lg:pt-65 gap-5">
                <h1 class="lg:text-5xl text-3xl font-[DM_Serif_Text] text-[#FDFDFD]">Berita</h1>
                <div class="flex rounded-sm justify-center lg:gap-10 bg-[#FDFDFD]">
                    <div class="hidden lg:flex flex-col max-w-160 lg:py-8 py-5 lg:gap-6 gap-3">
                        <x-news.primary-list :category="'Berita'" :date="'22 April 2025'" :title="'Asegaf ipsum dolor sit amet consectetur adipisicing elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis cupiditate ut at, facere quod vel.'" />
                        <x-news.primary-list :category="'Berita'" :date="'22 April 2025'" :title="'Asegaf ipsum dolor sit amet consectetur adipisicing elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis cupiditate ut at, facere quod vel.'" />
                        <x-news.primary-list :category="'Berita'" :date="'22 April 2025'" :title="'Asegaf ipsum dolor sit amet consectetur adipisicing elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis cupiditate ut at, facere quod vel.'" />
                        <div class="flex justify-center p-5">
                            <ul class="flex gap-4 lg:text-xl text-sm">
                                <li class="opacity-25"><a href="">&lt;</a>
                                </li>
                                <li class="text-[#e93b23]"><a href="">1</a>
                                </li>
                                <li><a href="">2</a>
                                </li>
                                <li><a href="">3</a>
                                </li>
                                <li class="opacity-25">...</ </li>
                                <li><a href="">10</a>
                                </li>
                                <li><a href="">&gt;</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col lg:max-w-84 gap-5 items-center lg:py-0 py-4">
                        <div class="hidden lg:block mt-8 w-84 border-b">
                            <span class="bg-[#2B2A29] text-[#FDFDFD] text-sm border-b py-1 px-4">
                                Berita Terbaru
                            </span>
                        </div>
                        <x-news.secondary-list :category="'Berita'" :date="'22 April 2025'" :title="'Asegaf ipsum dolor sit amet consectetur adipisicing elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis cupiditate ut at, facere quod vel.'" />
                        <x-news.secondary-list :category="'Berita'" :date="'22 April 2025'" :title="'Asegaf ipsum dolor sit amet consectetur adipisicing elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis cupiditate ut at, facere quod vel.'" />
                        <x-news.secondary-list :category="'Berita'" :date="'22 April 2025'" :title="'Asegaf ipsum dolor sit amet consectetur adipisicing elit. Officia aliquam dignissimos voluptatum voluptatibus perspiciatis cupiditate ut at, facere quod vel.'" />
                        <div class="lg:hidden flex justify-center">
                            <ul class="flex gap-4 lg:text-xl text-sm">
                                <li class="opacity-25"><a href="">&lt;</a>
                                </li>
                                <li class="text-[#e93b23]"><a href="">1</a>
                                </li>
                                <li><a href="">2</a>
                                </li>
                                <li><a href="">3</a>
                                </li>
                                <li class="opacity-25">...</ </li>
                                <li><a href="">10</a>
                                </li>
                                <li><a href="">&gt;</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-footer />
</x-layout>
