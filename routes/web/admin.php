<?php

// Route::group([
//   'as'        => 'admin.',
//   'prefix'    => 'admin/',
//   'namespace' => 'Admin',
// ], function () {
//     Auth::routes(['register' => true, 'login' => true, 'confirm' => false, 'reset'=> false]);

//     // 認証ずみのみ
//     Route::group(['middleware' => ['auth:admin']], function () {
//         Route::get('/dashbord', 'HomeController@index')->name('index');

//         Route::group(['prefix' => 'fans', 'as' => 'fans.'], function () {
//             Route::get('/', 'FanController@index')->name('index');
//             Route::get('/{id}', 'FanController@show')->name('show');
//         });

//         Route::group(['prefix' => 'artists', 'as' => 'artists.'], function () {
//             Route::get('/', 'ArtistController@index')->name('index');
//             Route::get('/{slug_name}', 'ArtistController@show')->name('show');
//         });
//     });
// });
