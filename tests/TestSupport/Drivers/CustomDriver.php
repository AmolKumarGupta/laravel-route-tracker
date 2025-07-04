<?php

namespace Tests\TestSupport\Drivers;

use Amol\LaravelRouteTracker\Contracts\Driver;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomDriver implements Driver
{
    public function track(Request $request, Response $response): void
    {
    }
}
