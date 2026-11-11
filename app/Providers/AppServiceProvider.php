<?php

namespace App\Providers;

use App\Contracts\ImageStorage;
use App\Contracts\Repositories\GalleryRepository;
use App\Contracts\Repositories\NewsRepository;
use App\Contracts\Repositories\ServiceRepository;
use App\Contracts\RichTextRenderer;
use App\Infrastructure\RichText\TonysmRichTextRenderer;
use App\Infrastructure\Storage\PublicImageStorage;
use App\Repositories\Eloquent\EloquentGalleryRepository;
use App\Repositories\Eloquent\EloquentNewsRepository;
use App\Repositories\Eloquent\EloquentServiceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, PublicImageStorage::class);
        $this->app->bind(RichTextRenderer::class, TonysmRichTextRenderer::class);
        $this->app->bind(NewsRepository::class, EloquentNewsRepository::class);
        $this->app->bind(GalleryRepository::class, EloquentGalleryRepository::class);
        $this->app->bind(ServiceRepository::class, EloquentServiceRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
