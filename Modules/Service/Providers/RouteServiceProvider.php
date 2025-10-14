<?php

namespace Modules\Service\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Service\Http\Middleware\EnsureBiddingIsActive;
use Modules\Service\Http\Middleware\MultiAuth;
use Modules\Service\Http\Middleware\ServiceProviderTokenIsValid;
use Modules\Service\Http\Middleware\ServiceServiceManTokenIsValid;
use Modules\Service\Http\Middleware\Subscription;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Service\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        app('router')->aliasMiddleware('service.provider.token', ServiceProviderTokenIsValid::class);
        app('router')->aliasMiddleware('service.serviceman.token', ServiceServiceManTokenIsValid::class);
        app('router')->aliasMiddleware('ensureBiddingIsActive', EnsureBiddingIsActive::class);
        app('router')->aliasMiddleware('service_subscription', Subscription::class);
        app('router')->aliasMiddleware('multi_auth', MultiAuth::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->prefix('admin')
            ->as('admin.')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Service', 'Routes/web/admin.php'));

        Route::middleware('web')
            ->prefix('provider')
            ->as('provider.')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Service', 'Routes/web/provider.php'));

        Route::middleware('web')
            ->prefix('service')
            ->as('service.')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Service', 'Routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api/v1')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Service', '/Routes/api.php'));

        Route::prefix('api/v1/service/customer')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Service', '/Routes/api/v1/customer.php'));
        Route::prefix('api/v1/service/provider')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Service', '/Routes/api/v1/provider.php'));
        Route::prefix('api/v1/service/serviceman')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Service', '/Routes/api/v1/serviceman.php'));
    }
}
