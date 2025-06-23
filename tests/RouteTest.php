<?php

it('should have route with middleware', function () {
    $router = app('router');

    $router->get('/test', function () {
        return 'Test Route';
    })->middleware(Amol\LaravelRouteTracker\Middleware\TrackRoute::class);

    $route = last($router->getRoutes()->get());

    expect($route->middleware())->toContain(Amol\LaravelRouteTracker\Middleware\TrackRoute::class);
});
