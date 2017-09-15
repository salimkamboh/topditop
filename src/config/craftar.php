<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Management API Key
    |--------------------------------------------------------------------------
    |
    | Api key must be setup in .env, used by Services/CraftarService
    | Visit https://my.craftar.net/api_access/
    |
    */

    'api_key' => env('CRAFTAR_MANAGEMENT_API_KEY', null),

    /*
    |--------------------------------------------------------------------------
    | Version of the CraftAR api
    |--------------------------------------------------------------------------
    |
    | Api key must be setup in .env, used by Services/CraftarService
    |
    */

    'collection_uuid' => env('CRAFTAR_COLLECTION_UUID', null),


];