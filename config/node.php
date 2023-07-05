<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Node
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'url' => env('NODE_URL', 'http://localhost'),

    'port' => env('NODE_PORT', 3000),

    'debug' => (bool) env('NODE_DEBUG', false),

];
