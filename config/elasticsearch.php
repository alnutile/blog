<?php
return [
    'hosts' => [
        [
            'host' => env('ES_HOST', 'localhost'),
            'port' => env('ES_PORT', 9200),
            'scheme' => env('ES_SCHEME', 'https'),
        ]
    ],
    'default_index' => env('ES_INDEX_DEFAULT', 'default'),
    'key' => env("ES_KEY"),
    'use_aws' => env("ES_USE_AWS", false),
    'secret' => env("ES_SECRET"),
    'region' => env('AWS_REGION', 'us-east-1'),
    'disable_boot' => env('ES_DISABLED', false)
];
