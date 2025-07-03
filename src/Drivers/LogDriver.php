<?php

namespace Amol\LaravelRouteTracker\Drivers;

use Amol\LaravelRouteTracker\Contracts\Driver;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Symfony\Component\HttpFoundation\Response;

class LogDriver implements Driver
{
    public function track(Request $request, Response $response): void
    {
        logger()->info('Route tracked', [
            'method' => $request->method(),
            'route' => $request->route()->getName(),
            'uri' => $request->getRequestUri(),
            'payload' => json_encode($request->all()),
            'parameters' => $request->route()->parameters,
            'response_status' => $response->getStatusCode(),
            'auth_id' => $request->user() instanceof User ? $request->user()->getAuthIdentifier() : null,
            'ip_address' => $request->ip(),
        ]);
    }
}
