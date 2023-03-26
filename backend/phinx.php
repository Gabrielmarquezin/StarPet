<?php

require_once('global.php');

return
[
    'paths' => [
        'migrations' => ['%%PHINX_CONFIG_DIR%%/src/db/migrations'],
        'seeds' => ['%%PHINX_CONFIG_DIR%%/src/db/seeds']
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => getenv('ADAPTER'),
            'host' => getenv('HOST'),
            'name' => getenv('DBNAME'),
            'user' => getenv('USER'),
            'pass' => getenv('PASSWORD'),
            'port' => getenv('PORT'),
            'charset' => getenv('CHARSET'),
        ],
        'development' => [
            'adapter' => getenv('ADAPTER'),
            'host' => getenv('HOST'),
            'name' => getenv('DBNAME'),
            'user' => 'root',
            'pass' => getenv('PASSWORD'),
            'port' => getenv('PORT'),
            'charset' => getenv('CHARSET'),
        ],
        'testing' => [
            'adapter' => getenv('ADAPTER'),
            'host' => getenv('HOST'),
            'name' => getenv('DBNAME'),
            'user' => getenv('USER'),
            'pass' => getenv('PASSWORD'),
            'port' => getenv('PORT'),
            'charset' => getenv('CHARSET'),
        ]
    ],
    'version_order' => 'creation'
];