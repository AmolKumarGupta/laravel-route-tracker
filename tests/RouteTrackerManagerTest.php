<?php

use Tests\TestSupport\Drivers\CustomDriver;
use Tests\TestSupport\Drivers\InValidDriver;

it('should resolve to correct bindings', function () {
    $manager = app('route-tracker.manager');
    $instance = app('route-tracker');

    expect($manager)
        ->toBeInstanceOf(\Amol\LaravelRouteTracker\RouteTrackerManager::class);

    expect($instance)
        ->toBeInstanceOf(\Amol\LaravelRouteTracker\RouteTracker::class);
});

it('should resolve the default driver', function () {
    $manager = app('route-tracker.manager');

    expect($manager->resolve('database'))
        ->toBeInstanceOf(\Amol\LaravelRouteTracker\Drivers\DatabaseDriver::class);
});

it('should throw an exception for an undefined driver', function () {
    $manager = app('route-tracker.manager');

    expect(fn () => $manager->resolve('undefined'))
        ->toThrow(\InvalidArgumentException::class, 'Driver [undefined] is not defined.');
});

it('should resolve a custom driver', function () {
    $manager = app('route-tracker.manager');

    $customDriver = CustomDriver::class;
    $manager->setDriver('custom', $customDriver);

    expect($manager->resolve('custom'))->toBeInstanceOf($customDriver);
    expect($customDriver)->toHaveMethod(['track']);
});

it('should not resolve', function () {
    $manager = app('route-tracker.manager');

    $manager->setDriver('invalid', InValidDriver::class);

    expect(fn () => $manager->resolve('invalid'))
        ->toThrow(\TypeError::class, 'Amol\LaravelRouteTracker\RouteTrackerManager::resolve(): Return value must be of type Amol\LaravelRouteTracker\Contracts\Driver');
});
