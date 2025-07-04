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
            ->hasConfigFile()
            ->hasMigrations('create_route_log_table');

        $this->app->singleton('route-tracker.manager', function ($app) {
            return new RouteTrackerManager($app);
        });

        $this->app->bind('route-tracker', function ($app) {
            return new RouteTracker($app);
        });
    }
}
