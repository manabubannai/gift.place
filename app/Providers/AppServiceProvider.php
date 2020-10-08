<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
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

        if (config('app.env') === 'production') {
            // asset()やurl()がhttpsで生成される
            // URL::forceScheme('http');
            URL::forceScheme('https');
        }
    }
}
