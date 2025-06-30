# Laravel Route Tracker

A Laravel package to track and log route usage in your application. Useful for analytics, debugging, and monitoring which routes are accessed and how often.

## Features

- Stores route, method, user, and timestamp
- Easy integration with Laravel middleware
- Configurable storage (database, log, etc.)

## Installation

Install via Composer:

```bash
composer require amol/laravel-route-tracker
```

Publish the configuration and migration files:

```bash
php artisan vendor:publish --provider="Amol\LaravelRouteTracker\RouteTrackerProvider"
```

Run the migrations:

```bash
php artisan migrate
```

## Usage

The package automatically tracks all route hits when the middleware is enabled.

### Middleware

Add the middleware to your `app/Http/Kernel.php`:

```php
protected $middleware = [
    // ...existing code...
    \Amol\LaravelRouteTracker\Middleware\TrackRoute::class,
];
```

Or use it on specific routes:

```php
// coming soon
Route::middleware(['track.route'])->group(function () {
    // ...your routes...
});
```

## Configuration

You can customize the package by editing the `config/route-tracker.php` file after publishing the config.

Options include:

- Enable/disable tracking
- Choose storage driver
- Exclude specific routes or methods

## Viewing Tracked Routes

Tracked route data is stored in the `route_logs` table by default. You can query this table or build custom dashboards.

## Testing

Run the package tests with:

```bash
composer run test
```

## Contributing

Contributions are welcome! Please submit issues or pull requests.

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).