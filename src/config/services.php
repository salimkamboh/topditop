<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */
    //user: mojemail pass: elefant11

    'mailgun' => [
        'domain' => 'sandbox2746491db7e346b8b639318def16930f.mailgun.org',
        'secret' => 'key-754215cd4f2ed457d525115bd11ab17f',
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

    'soap' => [
        'mage_url' => env('MAGE_URL'),
        'mage_user' => env('MAGE_USER'),
        'mage_api_key' => env('MAGE_API_KEY'),
    ],

    'google_maps' => [
        'api_key' => env('GOOGLE_MAPS_API_KEY'),
    ]

];
