<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
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
        Route::group(['namespace' => $this->namespace], function () {
            Route::group(['namespace' => 'Web', 'middleware' => 'web'], function () {
                require base_path('routes/web/web.php');
                // require base_path('routes/web/admin.php');
            });
        });
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
        Route::group(['namespace' => $this->namespace], function () {
            Route::group(['prefix' => 'api', 'as' => 'api.', 'namespace' => 'Api', 'middleware' => 'api'], function () {
                Route::group(['prefix' => 'v1', 'as' => 'v1.', 'namespace' => 'V1'], function () {
                    require base_path('routes/api/v1/user.php');
                });
            });
        });
    }
}
