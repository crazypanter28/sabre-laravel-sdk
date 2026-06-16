<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sabre API Credentials
    |--------------------------------------------------------------------------
    */
    'client_id'     => env('SABRE_CLIENT_ID', ''),
    'client_secret' => env('SABRE_CLIENT_SECRET', ''),
    'pcc'           => env('SABRE_PCC', ''),

    /*
    |--------------------------------------------------------------------------
    | Sabre Environment
    |--------------------------------------------------------------------------
    | Options: 'test' or 'production'
    */
    'environment' => env('SABRE_ENVIRONMENT', 'test'),

    /*
    |--------------------------------------------------------------------------
    | API Endpoints
    |--------------------------------------------------------------------------
    */
    'endpoints' => [
        'test'       => 'https://api.platform.sabre.com',
        'production' => 'https://api.sabre.com',
    ],

    /*
    |--------------------------------------------------------------------------
    | Token Cache
    |--------------------------------------------------------------------------
    | Sabre tokens last 7 days. We cache for 6 days to be safe.
    */
    'token_cache_minutes' => env('SABRE_TOKEN_CACHE_MINUTES', 8640), // 6 days
];
