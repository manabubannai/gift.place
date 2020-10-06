<?php

Route::group([], function () {
    Route::get('/', 'HomeController@index')->name('home');
});
