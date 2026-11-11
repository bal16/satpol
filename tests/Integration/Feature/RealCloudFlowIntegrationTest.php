<?php

use App\Models\News;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $pgHost = env('DB_HOST', '127.0.0.1');
    $pgPort = 5432;
    $siloEndpoint = env('AWS_ENDPOINT', 'http://127.0.0.1:9000');
    $siloHost = parse_url($siloEndpoint, PHP_URL_HOST) ?: '127.0.0.1';
    $siloPort = parse_url($siloEndpoint, PHP_URL_PORT) ?: 9000;

    // 1. Check PostgreSQL availability
    $pgConn = @fsockopen($pgHost, (int) $pgPort, $errno, $errstr, 1.0);
    if (! is_resource($pgConn)) {
        $this->markTestSkipped("PostgreSQL is not reachable on {$pgHost}:{$pgPort}.");
    }
    fclose($pgConn);

    // 2. Check Silo S3 availability
    $siloConn = @fsockopen($siloHost, (int) $siloPort, $errno, $errstr, 1.0);
    if (! is_resource($siloConn)) {
        $this->markTestSkipped("Silo S3 is not reachable on {$siloHost}:{$siloPort}.");
    }
    fclose($siloConn);

    // 3. Configure Database to PostgreSQL
    $database = (env('DB_DATABASE') && env('DB_DATABASE') !== ':memory:')
        ? env('DB_DATABASE')
        : env('POSTGRES_DB', 'satpol_dev');

    $username = (env('DB_USERNAME') && env('DB_USERNAME') !== 'root')
        ? env('DB_USERNAME')
        : env('POSTGRES_USER', 'satpol');

    $password = env('DB_PASSWORD') ?: env('POSTGRES_PASSWORD', 'satpol');

    Config::set('database.default', 'pgsql');
    Config::set('database.connections.pgsql.host', $pgHost);
    Config::set('database.connections.pgsql.port', $pgPort);
    Config::set('database.connections.pgsql.database', $database);
    Config::set('database.connections.pgsql.username', $username);
    Config::set('database.connections.pgsql.password', $password);
    DB::purge('pgsql');

    // 4. Configure Storage to real Silo S3
    Config::set('filesystems.default', 's3');
    Config::set('filesystems.media_disk', 's3');
    Config::set('filesystems.disks.s3.endpoint', $siloEndpoint);
    Config::set('filesystems.disks.s3.use_path_style_endpoint', true);
    Config::set('filesystems.disks.s3.bucket', env('AWS_BUCKET', 'satpol-storage'));
    Config::set('filesystems.disks.s3.key', env('AWS_ACCESS_KEY_ID', 'minioadmin'));
    Config::set('filesystems.disks.s3.secret', env('AWS_SECRET_ACCESS_KEY', 'minioadmin'));

    // Ensure database schema is migrated
    Artisan::call('migrate', ['--database' => 'pgsql', '--force' => true]);
});

afterEach(function () {
    // Reset to testing default to prevent state leakage
    Config::set('database.default', 'sqlite');
    Config::set('filesystems.default', 'local');
    Config::set('filesystems.media_disk', 'public');
});

test('admin can create, view, and delete news with real PostgreSQL and Silo S3', function () {
    $uniqueSuffix = uniqid();
    $admin = User::factory()->admin()->create([
        'username' => 'admin_'.$uniqueSuffix,
        'email' => 'admin_'.$uniqueSuffix.'@example.com',
    ]);

    $this->actingAs($admin);

    $newsTitle = 'Operasi Penertiban Lapangan '.$uniqueSuffix;
    $fakeImage = UploadedFile::fake()->create('real_cloud_image.jpg', 25, 'image/jpeg');

    // 1. Create News via Admin Feature Endpoint
    $response = $this->post(route('admin.news.store'), [
        'title' => $newsTitle,
        'author' => 'Satpol PP Team',
        'slug' => 'operasi-penertiban-'.$uniqueSuffix,
        'body' => '<p>Laporan kegiatan operasi penertiban gabungan.</p>',
        'images' => [$fakeImage],
    ]);

    $response->assertRedirect(route('admin.news'));

    // 2. Verify Persistence in PostgreSQL
    $news = News::where('slug', 'operasi-penertiban-'.$uniqueSuffix)->first();
    expect($news)->not->toBeNull();
    expect($news->title)->toBe($newsTitle);
    expect($news->images)->toHaveCount(1);

    $uploadedImagePath = $news->images->first()->path;

    // 3. Verify Real Persistence in Silo S3
    $s3Disk = Storage::disk('s3');
    expect($s3Disk->exists($uploadedImagePath))->toBeTrue();

    // 4. Verify Media URL Generation
    $generatedUrl = media_url($uploadedImagePath);
    expect($generatedUrl)->toContain('satpol-storage');
    expect($generatedUrl)->toContain($uploadedImagePath);

    // 5. Delete News & Verify Silo S3 and PostgreSQL Cleanup
    $deleteResponse = $this->delete(route('admin.news.destroy', $news));
    $deleteResponse->assertRedirect(route('admin.news'));

    expect(News::where('slug', 'operasi-penertiban-'.$uniqueSuffix)->first())->toBeNull();
    expect($s3Disk->exists($uploadedImagePath))->toBeFalse();

    // Clean up created admin user
    $admin->delete();
})->group('integration');
