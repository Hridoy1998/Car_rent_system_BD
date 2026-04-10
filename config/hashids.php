<?php

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application.
    |
    | Salts: We use distinct salts to ensure the same ID (e.g. 1)
    | results in different obfuscated values across models.
    |
    */

    'connections' => [

        'main' => [
            'salt' => env('HASHIDS_SALT', 'neon_monolith_primary_security_node'),
            'length' => 8,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        ],

        Car::class => [
            'salt' => 'asset_node_'.env('APP_KEY'),
            'length' => 12,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        ],

        Booking::class => [
            'salt' => 'operation_node_'.env('APP_KEY'),
            'length' => 16,
            'alphabet' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        ],

        User::class => [
            'salt' => 'identity_node_'.env('APP_KEY'),
            'length' => 10,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        ],

    ],

];
