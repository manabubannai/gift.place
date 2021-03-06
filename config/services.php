<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain'   => env('MAILGUN_DOMAIN'),
        'secret'   => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key'    => env('AWS_SES_ACCESS_KEY_ID'),
        'secret' => env('AWS_SES_SECRET_ACCESS_KEY'),
        'region' => env('AWS_SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'   => App\Models\User::class,
        'key'     => env('STRIPE_KEY'),
        'secret'  => env('STRIPE_SECRET'),
        'webhook' => [
            'secret'    => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
        'plan' => env('STRIPE_PLAN'),
    ],

    'twitter' => [
        'client_id'                => env('TWITTER_CLIENT_ID'),
        'client_secret'            => env('TWITTER_CLIENT_SECRET'),
        'redirect'                 => env('TWITTER_CLIENT_CALLBACK'),
        'access_token'             => env('TWITTER_ACCESS_TOKEN'),
        'access_token_secret'      => env('TWITTER_ACCESS_TOKEN_SECRET'),
    ],

];
