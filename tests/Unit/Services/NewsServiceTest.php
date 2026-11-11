<?php

use App\Contracts\ImageStorage;
use App\Contracts\Repositories\NewsRepository;
use App\Contracts\RichTextRenderer;
use App\Data\NewsData;
use App\Models\News;
use App\Models\NewsImage;
use App\Services\NewsService;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->repo = Mockery::mock(NewsRepository::class);
    $this->images = Mockery::mock(ImageStorage::class);
    $this->richText = Mockery::mock(RichTextRenderer::class);
    $this->service = new NewsService($this->repo, $this->images, $this->richText);
});

test('latest delegates to repository', function () {
    $collection = collect([new News(['title' => 'a'])]);
    $this->repo->shouldReceive('latest')->once()->with(3)->andReturn($collection);

    expect($this->service->latest(3))->toBe($collection);
});

test('findBySlug throws 404 when missing', function () {
    $this->repo->shouldReceive('findBySlug')->once()->with('missing')->andReturn(null);

    expect(fn () => $this->service->findBySlug('missing'))->toThrow(\Symfony\Component\HttpKernel\Exception\HttpException::class);
});

test('findBySlug returns news', function () {
    $news = new News(['title' => 'a', 'slug' => 'a']);
    $this->repo->shouldReceive('findBySlug')->once()->with('a')->andReturn($news);

    expect($this->service->findBySlug('a'))->toBe($news);
});

test('create stores news and uploads images', function () {
    $news = Mockery::mock(News::class);
    $news->shouldReceive('getAttribute')->with('id')->andReturn(1);
    $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    $relation->shouldReceive('create')->once()->with(['path' => 'news_images/1/a.jpg']);
    $news->shouldReceive('images')->andReturn($relation);

    $this->repo->shouldReceive('create')->once()->with([
        'title' => 'T',
        'author' => 'A',
        'slug' => 't',
        'body' => '<p>x</p>',
    ])->andReturn($news);

    $file = UploadedFile::fake()->create('a.jpg', 10, 'image/jpeg');
    $this->images->shouldReceive('store')->once()->with($file, 'news_images/1')->andReturn('news_images/1/a.jpg');

    $data = new NewsData('T', 'A', 't', '<p>x</p>');
    $result = $this->service->create($data, [$file]);

    expect($result)->toBe($news);
});

test('create rolls back stored files on failure', function () {
    $news = Mockery::mock(News::class);
    $news->shouldReceive('getAttribute')->with('id')->andReturn(1);
    $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    $relation->shouldReceive('create')->once()->andThrow(new \RuntimeException('db error'));
    $news->shouldReceive('images')->andReturn($relation);

    $this->repo->shouldReceive('create')->once()->andReturn($news);

    $file = UploadedFile::fake()->create('a.jpg', 10, 'image/jpeg');
    $this->images->shouldReceive('store')->once()->andReturn('news_images/1/a.jpg');
    $this->images->shouldReceive('delete')->once()->with('news_images/1/a.jpg');

    $data = new NewsData('T', 'A', 't', null);

    expect(fn () => $this->service->create($data, [$file]))->toThrow(\RuntimeException::class);
});

test('update delegates to repository', function () {
    $news = new News(['title' => 'old']);
    $this->repo->shouldReceive('update')->once()->with($news, [
        'title' => 'new',
        'author' => 'a',
        'slug' => 's',
        'body' => null,
    ])->andReturn($news);

    $data = new NewsData('new', 'a', 's', null);
    expect($this->service->update($news, $data))->toBe($news);
});

test('delete removes images and repository row', function () {
    $image = new NewsImage(['path' => 'news_images/1/x.jpg']);
    $news = new News(['title' => 't']);
    $news->setRelation('images', collect([$image]));

    $this->images->shouldReceive('delete')->once()->with('news_images/1/x.jpg');
    $this->repo->shouldReceive('delete')->once()->with($news);

    $this->service->delete($news);
});

test('deleteImage deletes file and model', function () {
    $image = Mockery::mock(NewsImage::class);
    $image->shouldReceive('getAttribute')->with('path')->andReturn('news_images/1/y.jpg');
    $image->shouldReceive('delete')->once();

    $this->images->shouldReceive('delete')->once()->with('news_images/1/y.jpg');

    $this->service->deleteImage($image);
});

test('toTrixHtml delegates to renderer', function () {
    $this->richText->shouldReceive('toTrixHtml')->once()->with('raw')->andReturn('<p>raw</p>');

    expect($this->service->toTrixHtml('raw'))->toBe('<p>raw</p>');
});

test('stats builds subtext for last month zero', function () {
    $this->repo->shouldReceive('createdSince')->once()->with(Mockery::type(\DateTimeInterface::class))->andReturn(2);
    $this->repo->shouldReceive('createdBetween')->once()->andReturn(0);
    $this->repo->shouldReceive('count')->once()->andReturn(5);

    $stats = $this->service->stats();
    expect($stats['total'])->toBe(5);
    expect($stats['subtext'])->toBe('2 berita baru bulan ini');
});