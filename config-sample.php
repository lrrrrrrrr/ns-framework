<?php

return [
    \framework\Component\MySqlConnection::class => [
        'host' => 'localhost',
        'dbName' => 'simpleBlog',
        'dbUser' => 'root',
        'dbPassword' => '',
    ],
    \framework\Component\UrlManager::class => [
        'rewrite' => false,
        'baseUrl' => 'http://localhost/ns_framework/',
        'routes' => [
            'index' => 'front/index'
        ],
    ],
    \framework\Component\Imprint::class => [
        'text' => '&copy Nikolai Sleta 2017'
    ],
];