<?php

namespace Amol\LaravelRouteTracker\Models;

use Illuminate\Database\Eloquent\Model;

class RouteLog extends Model
{
    protected $fillable = [
        'method',
        'route',
        'uri',
        'payload',
        'parameters',
        'response_status',
        'auth_id',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'parameters' => 'json',
    ];
}
