<?php

namespace App\Services;

use App\Contracts\Repositories\GalleryRepository;
use App\Contracts\Repositories\NewsRepository;
use App\Models\Slider;

class DashboardService
{
    public function __construct(
        private NewsRepository $news,
        private GalleryRepository $gallery,
    ) {}

    public function home(): array
    {
        return [
            'sliders' => Slider::all(),
            'news' => $this->news->latest(5),
        ];
    }

    public function admin(): array
    {
        $newsThisMonth = $this->news->createdSince(now()->startOfMonth());
        $newsLastMonth = $this->news->createdBetween(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth());

        if ($newsLastMonth > 0) {
            $change = (($newsThisMonth - $newsLastMonth) / $newsLastMonth) * 100;
            $newsSubtext = sprintf('%s%.0f%% dari bulan lalu', $change >= 0 ? '+' : '', $change);
        } else {
            $newsSubtext = $newsThisMonth > 0 ? "{$newsThisMonth} berita baru bulan ini" : 'Tidak ada berita baru';
        }

        $galleryNewThisWeek = $this->gallery->createdSince(now()->startOfWeek());

        return [
            'totalNews' => $this->news->count(),
            'totalGalleryItems' => $this->gallery->count(),
            'newsSubtext' => $newsSubtext,
            'gallerySubtext' => sprintf('+%d baru minggu ini', $galleryNewThisWeek),
        ];
    }
}
