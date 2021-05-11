<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('*', 'App\Http\ViewComposers\UserComposer');

        URL::forceRootUrl(config('app.url'));

        if (config('app.env') === 'production' || config('app.env') === 'development') {
            // asset()やurl()がhttpsで生成される
            // URL::forceScheme('http');
            URL::forceScheme('https');
        }
    }
}
