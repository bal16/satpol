<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Gallery;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Data Statistik ---
        $totalNews = News::count();
        $totalGalleryItems = Gallery::count();

        // --- Logika Subtext untuk Berita (Perubahan dari bulan lalu) ---
        $newsThisMonthCount = News::where('created_at', '>=', now()->startOfMonth())->count();
        $newsLastMonthCount = News::whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])->count();

        if ($newsLastMonthCount > 0) {
            $newsPercentageChange = (($newsThisMonthCount - $newsLastMonthCount) / $newsLastMonthCount) * 100;
            $newsSubtext = sprintf('%s%.0f%% dari bulan lalu', $newsPercentageChange >= 0 ? '+' : '', $newsPercentageChange);
        } else {
            $newsSubtext = $newsThisMonthCount > 0 ? "{$newsThisMonthCount} berita baru bulan ini" : 'Tidak ada berita baru';
        }

        // --- Logika Subtext untuk Galeri (Item baru minggu ini) ---
        $galleryNewThisWeek = Gallery::where('created_at', '>=', now()->startOfWeek())->count();
        $gallerySubtext = sprintf('+%d baru minggu ini', $galleryNewThisWeek);

        return view('admin.dashboard', [
            'totalNews' => $totalNews,
            'totalGalleryItems' => $totalGalleryItems,
            'newsSubtext' => $newsSubtext,
            'gallerySubtext' => $gallerySubtext,
        ]);
    }
}
