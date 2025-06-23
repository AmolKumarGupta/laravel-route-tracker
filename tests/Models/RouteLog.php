<?php

use Amol\LaravelRouteTracker\Models\RouteLog;

it('should have route_logs table', function () {
    $db = RouteLog::first();

    expect($db?->toArray())->toBe(null);
});
