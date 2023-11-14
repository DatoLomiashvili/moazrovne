<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    protected $apiNamespace ='App\Http\Controllers\Api';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(300)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/' . $this->getApiVersion())
                ->namespace($this->apiNamespace . $this->getApiNamespaceVersion())
                ->group(base_path('routes/' . $this->getApiRouteVersion() . '.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * @return string
     */
    private function getApiVersion(): string
    {
        return 'v' . config('app.api_version');
    }

    /**
     * @return string
     */
    private function getApiNamespaceVersion(): string
    {
        return strtoupper($this->getApiVersion());
    }

    /**
     * @return string
     */
    private function getApiRouteVersion(): string
    {
        return 'api_' . $this->getApiVersion();
    }
}
