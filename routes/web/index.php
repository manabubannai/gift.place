<?php

Route::group([], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/term', 'HomeController@term')->name('term');
    Route::get('/policy', 'HomeController@policy')->name('policy');
    // Route::get('/contact', 'HomeController@contact')->name('contact');

    Route::post('/stripe/webhook', 'WebhookController@handleWebhook');
});
