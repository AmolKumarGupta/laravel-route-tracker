<?php

namespace Amol\LaravelRouteTracker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RouteTrackerProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('route-tracker')
            ->hasMigrations('create_route_log_table');
    }
}
