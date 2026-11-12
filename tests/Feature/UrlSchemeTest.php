<?php

use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\URL;

test('asset urls are forced to https in production', function () {
    $original = $this->app->environment();

    try {
        $this->app['env'] = 'production';

        (new AppServiceProvider($this->app))->boot();

        expect(asset('image/logo.png'))->toStartWith('https://');
    } finally {
        $this->app['env'] = $original;
        URL::forceScheme(null);
    }
});

test('asset urls keep the request scheme outside production', function () {
    (new AppServiceProvider($this->app))->boot();

    expect(asset('image/logo.png'))->toStartWith('http://');
});
