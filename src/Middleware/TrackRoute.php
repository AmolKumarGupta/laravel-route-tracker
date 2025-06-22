<?php

namespace Amol\LaravelRouteTracker\Middleware;

use Amol\LaravelRouteTracker\Models\RouteLog;
use Closure;
use Illuminate\Foundation\Auth\User;
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

        RouteLog::create([ // @phpstan-ignore staticMethod.notFound
            'method' => $request->method(),
            'route' => $request->route()->getName(),
            'uri' => $request->getRequestUri(),
            'payload' => json_encode($request->all()),
            'response_status' => $response->getStatusCode(),
            'auth_id' => $request->user() instanceof User ? $request->user()->getAuthIdentifierName() : null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return $response;
    }
}
