<?php

it('should track the route', function () {
    $router = app('router');

    $router->get('/test', function () {
        return 'Test Route';
    })->middleware(Amol\LaravelRouteTracker\Middleware\TrackRoute::class)
        ->name('test.index');

    $response = $this->get('/test');

    $response->assertStatus(200);
    $response->assertSee('Test Route');

    $routeLog = \Amol\LaravelRouteTracker\Models\RouteLog::first();

    expect($routeLog)->not->toBeNull();
    expect($routeLog->method)->toBe('GET');
    expect($routeLog->route)->toBe('test.index');
    expect($routeLog->uri)->toBe('/test');
    expect($routeLog->payload)->toBe('[]');
    expect($routeLog->parameters)->toBe([]);
    expect($routeLog->response_status)->toBe(200);
    expect($routeLog->auth_id)->toBeNull();
});


it('should track the route with parameters', function () {
    $router = app('router');

    $router->get('/{service}/webhook/', function ($service) {
        return 'Service Route';
    })->middleware(Amol\LaravelRouteTracker\Middleware\TrackRoute::class)
        ->name('service.webhook');

    $response = $this->get('/email/webhook');

    $response->assertStatus(200);
    $response->assertSee('Service Route');

    $routeLog = \Amol\LaravelRouteTracker\Models\RouteLog::first();

    expect($routeLog)->not->toBeNull();
    expect($routeLog->method)->toBe('GET');
    expect($routeLog->route)->toBe('service.webhook');
    expect($routeLog->uri)->toBe('/email/webhook');
    expect($routeLog->payload)->toBe('[]');
    expect($routeLog->parameters)->toBe(["service" => "email"]);
    expect($routeLog->response_status)->toBe(200);
    expect($routeLog->auth_id)->toBeNull();
});


it('should track with middleware alias', function () {
    $router = app('router');

    $router->get('/test', function () {
        return 'Test Route';
    })->middleware(['track.route'])
        ->name('test.index');

    $response = $this->get('/test');

    $response->assertStatus(200);
    $response->assertSee('Test Route');

    $routeLog = \Amol\LaravelRouteTracker\Models\RouteLog::first();

    expect($routeLog)->not->toBeNull();
    expect($routeLog->method)->toBe('GET');
    expect($routeLog->route)->toBe('test.index');
    expect($routeLog->uri)->toBe('/test');
    expect($routeLog->payload)->toBe('[]');
    expect($routeLog->parameters)->toBe([]);
    expect($routeLog->response_status)->toBe(200);
    expect($routeLog->auth_id)->toBeNull();
});
