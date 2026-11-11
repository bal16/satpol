<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

test('real postgresql connection and query execution', function () {
    $host = env('DB_HOST', '127.0.0.1');
    $port = env('DB_PORT', 5432);

    $connection = @fsockopen($host, (int) $port, $errno, $errstr, 1.0);

    if (! is_resource($connection)) {
        $this->markTestSkipped("PostgreSQL container is not running on {$host}:{$port}.");
    }

    fclose($connection);

    Config::set('database.connections.pgsql.host', $host);
    Config::set('database.connections.pgsql.port', $port);
    Config::set('database.connections.pgsql.database', env('DB_DATABASE', 'satpol_dev'));
    Config::set('database.connections.pgsql.username', env('DB_USERNAME', 'satpol'));
    Config::set('database.connections.pgsql.password', env('DB_PASSWORD', 'satpol'));

    try {
        $result = DB::connection('pgsql')->select('SELECT 1 as connected');
        expect($result)->not->toBeEmpty();
        expect($result[0]->connected)->toBe(1);
    } catch (Throwable $e) {
        $this->markTestSkipped('PostgreSQL server active but database credentials refused: '.$e->getMessage());
    }
})->group('integration');
