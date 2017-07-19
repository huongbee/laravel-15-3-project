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
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],


    'facebook' => [
        'client_id' => '247655875732870',
        'client_secret' => 'a8b99af9c6b3b1c3522596375f95ce5e',
        'redirect' => 'http://localhost/laravel15_3/login/facebook/callback',
    ],



    'google' => [
        'client_id' => '696025184931-g6tutka4nciaoosbl3iq3qrbcc95ukj4.apps.googleusercontent.com',
        'client_secret' => 'q78-kUQ2AJK9XsUlEAIT71N_',
        'redirect' => 'http://localhost/laravel15_3/login/google/callback',
    ],

];
