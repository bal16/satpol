<?php

if (! function_exists('media_url')) {
    /**
     * Build a URL for a stored media file.
     *
     * Uses a relative path for local disks (works with any host/port in dev)
     * and the disk's absolute URL for remote disks such as S3.
     */
    function media_url(?string $path): string
    {
        if (empty($path)) {
            return '';
        }

        $path = ltrim($path, '/');

        if (config('filesystems.disks.public.driver') === 's3') {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        }

        return '/storage/'.$path;
    }
}