<?php

Route::group(['as' => 'user.', 'namespace' => 'User'], function () {
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth/', 'as' => 'auth.'], function () {
        Route::get('login', 'SocialAccountController@showLoginForm')->name('login');
        Route::get('login/{provider}', 'SocialAccountController@redirectToProvider')->name('redirect.provider');
        Route::get('{provider}/callback', 'SocialAccountController@handleProviderCallback');
        Route::get('email', 'SocialAccountController@getEmail')->name('get.email');
        Route::post('email', 'SocialAccountController@storeEmail')->name('store.email');

        Route::post('logout', 'SocialAccountController@logout')->name('logout');

        if (\App::environment('local')) {
            Route::get('local/login', 'LocalLoginController@getLocalLogin')->name('get.localLogin');
            Route::post('local/register', 'LocalLoginController@postLocalRegister')->name('post.localRegister');
        }
    });

    // loginずみのみ
    Route::group(['middleware' => ['auth:user']], function () {

        // 仮のroute
        Route::get('/card', 'DashboardController@card')->name('card');
        Route::post('/card', 'DashboardController@cardStore')->name('card');

        Route::get('/card-change', 'DashboardController@cardChangeForm')->name('card.change');
        Route::post('/card-change', 'DashboardController@cardChange')->name('card.change');

        Route::group(['middleware' => []], function () {
            Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
            Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
                Route::get('/create', 'MessageController@create')->name('create');
                Route::get('/{uuid}', 'MessageController@show')->name('show');

                Route::post('/', 'MessageController@store')->name('store');
            });

            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                // Route::get('/me', 'UserController@me')->name('me');
                Route::get('/{slug}', 'UserController@show')->name('show');

                Route::get('/{slug}/edit', 'UserController@edit')->name('edit');
                Route::put('/{slug}', 'UserController@update')->name('update');

                // Route::group(['prefix' => 'subscriptions/', 'as' => 'subscriptions.'], function () {
              // });
            });
        });
    });
});
