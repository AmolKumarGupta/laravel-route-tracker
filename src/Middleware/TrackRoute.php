<?php

namespace Amol\LaravelRouteTracker\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        /**
         * Checks if tracking is enabled in the configuration or not,
         * if not enabled, it will skip the process.
         */
        if (config('route-tracker.enabled') === false) {
            return $response;
        }

        /** @var \Amol\LaravelRouteTracker\RouteTracker */
        $instance = app('route-tracker');
        $instance->track($request, $response);

        return $response;
    }
}
