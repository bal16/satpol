<?php

use App\Contracts\ImageStorage;
use App\Contracts\Repositories\ServiceRepository;
use App\Data\ServiceData;
use App\Data\ServiceItemData;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Services\ServiceService;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->repo = Mockery::mock(ServiceRepository::class);
    $this->images = Mockery::mock(ImageStorage::class);
    $this->service = new ServiceService($this->repo, $this->images);
});

test('create stores image and persists service', function () {
    $service = new Service(['title' => 'T']);
    $this->repo->shouldReceive('create')->once()->andReturn($service);

    $file = UploadedFile::fake()->create('a.jpg', 10, 'image/jpeg');
    $this->images->shouldReceive('store')->once()->with($file, 'services_images')->andReturn('services_images/a.jpg');

    $data = new ServiceData('T', 'card-1');
    $result = $this->service->create($data, $file);
    expect($result)->toBe($service);
});

test('update replaces image when provided', function () {
    $service = new Service(['title' => 'T', 'image_src' => 'services_images/old.jpg']);
    $this->repo->shouldReceive('update')->once()->andReturn($service);

    $file = UploadedFile::fake()->create('b.jpg', 10, 'image/jpeg');
    $this->images->shouldReceive('replace')->once()->with($file, 'services_images', 'services_images/old.jpg')->andReturn('services_images/b.jpg');

    $data = new ServiceData('T2', null);
    $this->service->update($service, $data, $file);
});

test('delete removes image and row', function () {
    $service = new Service(['title' => 'T', 'image_src' => 'services_images/x.jpg']);
    $this->images->shouldReceive('delete')->once()->with('services_images/x.jpg');
    $this->repo->shouldReceive('delete')->once()->with($service);

    $this->service->delete($service);
});

test('createItem delegates to relation', function () {
    $service = Mockery::mock(Service::class);
    $item = new ServiceItem(['text' => 'i']);
    $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    $relation->shouldReceive('create')->once()->with(['text' => 'i', 'href' => null])->andReturn($item);
    $service->shouldReceive('items')->andReturn($relation);

    $data = new ServiceItemData('i', null);
    expect($this->service->createItem($service, $data))->toBe($item);
});

test('updateItem and deleteItem work', function () {
    $item = new ServiceItem(['text' => 'i']);
    // update
    $mock = Mockery::mock(ServiceItem::class);
    $mock->shouldReceive('update')->once()->with(['text' => 'j', 'href' => null]);
    $mock->shouldReceive('fresh')->andReturnSelf(); // not used now? service returns $item after update without fresh? Actually we removed fresh, returns $item
    // Our service returns $item (the passed model) after update; no fresh call. So no need.
    $data = new ServiceItemData('j', null);
    $result = $this->service->updateItem($mock, $data);
    expect($result)->toBe($mock);

    // delete
    $mock2 = Mockery::mock(ServiceItem::class);
    $mock2->shouldReceive('delete')->once();
    $this->service->deleteItem($mock2);
});