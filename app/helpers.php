<?php

use Illuminate\Support\Facades\Storage;

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
        $mediaDisk = config('filesystems.media_disk', 'public');
        $driver = config("filesystems.disks.{$mediaDisk}.driver", 'local');

        if ($driver === 's3' || $mediaDisk === 's3') {
            return Storage::disk($mediaDisk)->url($path);
        }

        return '/storage/'.$path;
    }
}
