<?php

namespace Amol\LaravelRouteTracker\Drivers;

use Amol\LaravelRouteTracker\Contracts\Driver;
use Amol\LaravelRouteTracker\Models\RouteLog;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Symfony\Component\HttpFoundation\Response;

class DatabaseDriver implements Driver
{
    public function track(Request $request, Response $response): void
    {
        RouteLog::create([ // @phpstan-ignore staticMethod.notFound
            'method' => $request->method(),
            'route' => $request->route()->getName(),
            'uri' => $request->getRequestUri(),
            'payload' => json_encode($request->all()),
            'parameters' => $request->route()->parameters,
            'response_status' => $response->getStatusCode(),
            'auth_id' => $request->user() instanceof User ? $request->user()->getAuthIdentifier() : null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);
    }
}
