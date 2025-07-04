<?php

namespace Amol\LaravelRouteTracker\Contracts;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

interface Driver
{
    public function track(Request $request, Response $response): void;
}
