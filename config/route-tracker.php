<?php

return [

    'enabled' => env('ROUTE_TRACKER_ENABLED', true),

    /**
     * --------------------------------------------------------------------------
     * Driver
     * --------------------------------------------------------------------------
     * Here you can configure driver for route tracking.
     *
     * Available drivers: "database", "log"
     */
    'driver' => env('ROUTE_TRACKER_DRIVER', 'database'),

    'excluded_routes' => [
        // Add routes that should not be tracked
    ],

];
