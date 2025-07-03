<?php

use Amol\LaravelRouteTracker\Drivers\LogDriver;
use Amol\LaravelRouteTracker\Middleware\TrackRoute;
use Illuminate\Support\Facades\Log;
use Illuminate\Log\Events\MessageLogged;

it('should resolve log driver', function () {
    $manager = app('route-tracker.manager');
    $driver = $manager->resolve('log');

    expect($driver)->toBeInstanceOf(LogDriver::class);
});

it('should track using log driver', function () {
    config()->set('route-tracker.driver', 'log');

    $logMessages = [];
    Log::listen(function ($event) use (&$logMessages) {
        $logMessages[] = $event;
    });

    $router = app('router');

    $router->get('/test', function () {
        return 'Test Route';
    })->middleware(TrackRoute::class)
        ->name('test.index');

    $this->get('/test');

    /** @var MessageLogged */
    $event = $logMessages[0];

    expect($event->level)->toBe('info');

    expect($event->message)->toBe('Route tracked');

    expect($event->context)->toBeArray();

    expect($event->context)->toMatchArray([
        'method' => 'GET',
        'route' => 'test.index',
        'uri' => '/test',
        'payload' => "[]",
        'parameters' => [],
        'response_status' => 200,
        'auth_id' => null,
        'ip_address' => "127.0.0.1",
    ]);
});
