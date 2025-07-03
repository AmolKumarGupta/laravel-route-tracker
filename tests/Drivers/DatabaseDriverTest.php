<?php

use Amol\LaravelRouteTracker\Drivers\DatabaseDriver;
use Amol\LaravelRouteTracker\Models\RouteLog;
use Amol\LaravelRouteTracker\Middleware\TrackRoute;

it('should resolve database driver', function () {
    $manager = app('route-tracker.manager');
    $driver = $manager->resolve('database');

    expect($driver)->toBeInstanceOf(DatabaseDriver::class);
});

it('should track using database driver', function () {
    $router = app('router');

    $router->get('/test', function () {
        return 'Test Route';
    })->middleware(TrackRoute::class)
        ->name('test.index');

    $this->get('/test');

    expect(RouteLog::first())->not->toBeNull();
});
