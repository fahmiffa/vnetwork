<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '388504785437-jagab5hsg2pqkrjt7hsopbbs93qrqdk8.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://vi-network.com/auth/google/callback',
    ],
    

    'facebook' => [
        'client_id' => '516106070021575', 
        'client_secret' => '74c3ee51ac39ae3c9c0a9af10c6185f2', 
        'redirect' => 'https://vi-network.com/auth/facebook/callback/'
    ],

];
