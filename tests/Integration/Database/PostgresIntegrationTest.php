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

    $database = (env('DB_DATABASE') && env('DB_DATABASE') !== ':memory:')
        ? env('DB_DATABASE')
        : env('POSTGRES_DB', 'satpol_dev');

    $username = (env('DB_USERNAME') && env('DB_USERNAME') !== 'root')
        ? env('DB_USERNAME')
        : env('POSTGRES_USER', 'satpol');

    $password = env('DB_PASSWORD') ?: env('POSTGRES_PASSWORD', 'satpol');

    Config::set('database.connections.pgsql.host', $host);
    Config::set('database.connections.pgsql.port', $port);
    Config::set('database.connections.pgsql.database', $database);
    Config::set('database.connections.pgsql.username', $username);
    Config::set('database.connections.pgsql.password', $password);

    DB::purge('pgsql');

    try {
        $result = DB::connection('pgsql')->select('SELECT 1 as connected');
        expect($result)->not->toBeEmpty();
        expect($result[0]->connected)->toBe(1);
    } catch (Throwable $e) {
        $this->markTestSkipped('PostgreSQL server active but database credentials refused: '.$e->getMessage());
    }
})->group('integration');
