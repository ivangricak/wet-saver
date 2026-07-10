<?php

return [

    'paths' => ['api/*', 'categories', 'users/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'chrome-extension://onknhellkichadbomnpbmdkhfjhkgegk',
        'chrome-extension://clpnhfijbomcemhdaaoadkmjpppcfcip',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];