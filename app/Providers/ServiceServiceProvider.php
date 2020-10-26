<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // User
        $this->app->singleton(
            \App\Services\User\UserServiceInterface::class,
            \App\Services\User\UserService::class
        );

        $this->app->bind(
            \App\Services\SocialAccount\SocialAccountServiceInterface::class,
            \App\Services\SocialAccount\SocialAccountService::class
        );

        $this->app->bind(
            \App\Services\Message\MessageServiceInterface::class,
            \App\Services\Message\MessageService::class
        );

        $this->app->bind(
            \App\Services\Payment\PaymentServiceInterface::class,
            \App\Services\Payment\PaymentService::class
        );
    }
}
