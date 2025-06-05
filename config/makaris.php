<?php

return [
    'api_key' => env('MAKARIS_API_KEY'),
    'endpoint' => env('MAKARIS_API_ENDPOINT'),

    /*
    |--------------------------------------------------------------------------
    | Per page limitation
    |--------------------------------------------------------------------------
    |
    | The call of a resource list like products are limited per page.
    | Here is the definition of the limit from api and the package will call multiple times
    | to read all items of a resource if necessary.
    |
    */
    'per_page_limit' => 100,

    'shop_url' => env('MAKARIS_SHOP_URL'),
    'makaris_url' => env('MAKARIS_URL',),
];
