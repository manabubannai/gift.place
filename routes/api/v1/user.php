<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User'], function () {

    // 認証ずみ
    Route::group(['middleware' => 'auth:user-api'], function () {
        Route::group(['prefix' => 'message-likes', 'as' => 'likes.'], function () {
            Route::post('/', 'MessaegLikeController@store')->name('store');
            Route::delete('/{id}', 'MessaegLikeController@destroy')->name('destroy');
        });
    });
});
