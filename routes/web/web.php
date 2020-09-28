<?php

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

// Route::group(['namespace' => 'Auth'], function () {
//     Route::get('/login', 'SocialAccountController@showLoginForm')->name('login');
//     Route::get('login/{provider}', 'SocialAccountController@redirectToProvider')->name('redirect.provider');
//     Route::get('{provider}/callback', 'SocialAccountController@handleProviderCallback');
//     Route::get('email', 'SocialAccountController@getEmail')->name('get.email');
//     Route::post('email', 'SocialAccountController@storeEmail')->name('store.email');
// });

Route::group(['as' => 'web.'], function () {

  // loginずみのみ
    Route::group(['middleware' => ['auth:user']], function () {
        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

        // email認証ずみのみ
        Route::group(['middleware' => ['verified']], function () {
            Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
                Route::get('/{id}', 'MessageController@show')->name('show');
                Route::get('/create', 'MessageController@create')->name('create');

                Route::post('/', 'MessageController@store')->name('store');
            });

            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                Route::get('/me', 'UserController@me')->name('me');

                Route::group(['prefix' => '/me', 'as' => 'me.'], function () {

                  // Route::group(['prefix' => 'subscriptions/', 'as' => 'subscriptions.'], function () {
                  // });
                });
            });
        });
    });
});
