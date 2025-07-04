<?php

namespace Amol\LaravelRouteTracker;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RouteTracker
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Create a new Mail manager instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Track the route.
     */
    public function track(Request $request, Response $response): void
    {
        /** @var RouteTrackerManager */
        $manager = $this->app->get('route-tracker.manager');

        $driverName = config()->get('route-tracker.driver', 'database');
        if (!is_string($driverName)) {
            throw new \InvalidArgumentException('The driver name must be a string.');
        }

        $manager->resolve($driverName)->track($request, $response);
    }
}
