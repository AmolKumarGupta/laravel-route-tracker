<?php

namespace Tests;

use Amol\LaravelRouteTracker\RouteTrackerProvider;
use Orchestra\Testbench\Attributes\WithMigration;
use Orchestra\Testbench\TestCase as Orchestra;

use function Orchestra\Testbench\artisan;

#[WithMigration]
abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            RouteTrackerProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    protected function defineDatabaseMigrations()
    {
        artisan($this, 'vendor:publish --tag=route-tracker-migrations');
        artisan($this, 'migrate');

        $this->beforeApplicationDestroyed(
            fn() => artisan($this, 'migrate:rollback')
        );
    }
}
