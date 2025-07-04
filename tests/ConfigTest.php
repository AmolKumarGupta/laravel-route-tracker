<?php

it('should not track the route when disabled', function () {
    config(['route-tracker.enabled' => false]);

    $router = app('router');

    $router->get('/test', function () {
        return 'Test Route';
    })->middleware(Amol\LaravelRouteTracker\Middleware\TrackRoute::class)
        ->name('test.index');

    $response = $this->get('/test');

    $response->assertStatus(200);
    $response->assertSee('Test Route');

    $routeLog = \Amol\LaravelRouteTracker\Models\RouteLog::first();

    expect($routeLog)->toBeNull();
});
