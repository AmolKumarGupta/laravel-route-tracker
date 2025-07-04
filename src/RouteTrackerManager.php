<?php

namespace Amol\LaravelRouteTracker;

use Amol\LaravelRouteTracker\Contracts\Driver;
use Amol\LaravelRouteTracker\Drivers\DatabaseDriver;
use Amol\LaravelRouteTracker\Drivers\LogDriver;

class RouteTrackerManager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * @var array<string, class-string<\Amol\LaravelRouteTracker\Contracts\Driver>>
     */
    protected array $drivers = [];

    /**
     * Create a new Mail manager instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    public function __construct($app)
    {
        $this->app = $app;

        $this->setDriver('database', DatabaseDriver::class);
        $this->setDriver('log', LogDriver::class);
    }

    /**
     * @param  class-string<\Amol\LaravelRouteTracker\Contracts\Driver>  $driver
     */
    public function setDriver(string $name, string $driver): self
    {
        $this->drivers[$name] = $driver;
        return $this;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function resolve(string $name): Driver
    {
        if (!isset($this->drivers[$name])) {
            throw new \InvalidArgumentException("Driver [{$name}] is not defined.");
        }

        $className = $this->drivers[$name];
        return new $className();
    }
}
