<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

test('real s3 roundtrip to silo object storage', function () {
    $endpoint = env('AWS_ENDPOINT', 'http://127.0.0.1:9000');

    // Quick socket check to verify Silo container is listening
    $host = parse_url($endpoint, PHP_URL_HOST) ?: '127.0.0.1';
    $port = parse_url($endpoint, PHP_URL_PORT) ?: 9000;
    $connection = @fsockopen($host, (int) $port, $errno, $errstr, 1.0);

    if (! is_resource($connection)) {
        $this->markTestSkipped("Silo S3 container is not running on {$host}:{$port}.");
    }

    fclose($connection);

    Config::set('filesystems.disks.s3.endpoint', $endpoint);
    Config::set('filesystems.disks.s3.use_path_style_endpoint', true);
    Config::set('filesystems.disks.s3.bucket', env('AWS_BUCKET', 'satpol-storage'));
    Config::set('filesystems.disks.s3.key', env('AWS_ACCESS_KEY_ID', 'minioadmin'));
    Config::set('filesystems.disks.s3.secret', env('AWS_SECRET_ACCESS_KEY', 'minioadmin'));

    $disk = Storage::disk('s3');
    $fileName = 'integration-test-'.uniqid().'.txt';
    $content = 'Real S3 upload integration payload at '.now()->toIso8601String();

    // 1. Put object
    $uploaded = $disk->put($fileName, $content);
    expect($uploaded)->toBeTrue();

    // 2. Check existence
    expect($disk->exists($fileName))->toBeTrue();

    // 3. Read object
    expect($disk->get($fileName))->toBe($content);

    // 4. URL generation
    $url = $disk->url($fileName);
    expect($url)->toBeString()->toContain($fileName);

    // 5. Cleanup
    $deleted = $disk->delete($fileName);
    expect($deleted)->toBeTrue();
    expect($disk->exists($fileName))->toBeFalse();
})->group('integration');
