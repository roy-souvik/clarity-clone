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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
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
        'client_id' =>      env('FACEBOOK_CLIENT_ID', '354119661378897'),
        'client_secret' =>  env('FACEBOOK_CLIENT_SECRET', '1425aa518d4941625ecfc4104e7b50b4'),
        'redirect' =>       env('FACEBOOK_REDIRECT_URL', 'http://dev.monstercall.preptest.in/auth/facebook/callback'),
    ],
    
    'linkedin' => [
        'client_id' =>      env('LINKEDIN_CLIENT_ID', '75likvkqr3lv0z'),
        'client_secret' =>  env('LINKEDIN_CLIENT_SECRET', 'K3DRvlcDrXmekS55'),
        'redirect' =>       env('LINKEDIN_REDIRECT_URL', 'http://dev.monstercall.preptest.in/auth/linkedin/callback'),
    ],

    'twitter' => [
        'client_id' =>      env('TWITTER_CLIENT_ID', 'YqrDuwZj0piikpy43rza317cF'),
        'client_secret' =>  env('TWITTER_CLIENT_SECRET', 'pXNfFhP4ufZQkUOVdqxo3Ai22rk858FzUzP8zeDmuM20wr91SL'),
        'redirect' =>       env('TWITTER_REDIRECT_URL', 'http://dev.monstercall.preptest.in/auth/twitter/callback'),
    ],
];
