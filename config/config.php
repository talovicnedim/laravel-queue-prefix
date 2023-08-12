<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Queue Prefixing
    |--------------------------------------------------------------------------
    |
    | Determines whether queue prefixing is enabled. Set to false to disable it.
    |
    */

    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Queue Prefix
    |--------------------------------------------------------------------------
    |
    | The prefix to add to queue names. For example, if the prefix is "prod" and a
    | job is dispatched to the "default" queue, it will be dispatched to the
    | "prod-default" queue.
    |
    */

    'prefix' => env('APP_ENV', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Allowed Queues
    |--------------------------------------------------------------------------
    |
    | An array of allowed queues. Only queues in this list will be prefixed. Use
    | ['*'] to prefix all queues.
    |
    */

    'allowed_queues' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Excluded Queues
    |--------------------------------------------------------------------------
    |
    | An array of excluded queues. Queues in the allowed_queues array will be
    | prefixed except those in this array.
    |
    */

    'excluded_queues' => [],
];
