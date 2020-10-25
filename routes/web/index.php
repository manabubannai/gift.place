<?php

Route::group([], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/stripe/webhook', 'WebhookController@handleWebhook');
});
