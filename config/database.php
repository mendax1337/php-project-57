<?php

use Illuminate\Support\Str;

const LOCALHOST = '127.0.0.1';

return [

    'default' => env('DB_CONNECTION', 'sqlite'),

    'connections' => [

            'sqlite' => [
                'driver' => 'sqlite',
                'url' => env('DB_URL'),
                'database' => env('DB_DATABASE', database_path('database.sqlite')),
                'prefix' => '',
                'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
                'busy_timeout' => null,
                'journal_mode' => null,
                'synchronous' => null,
            ],

        ] + (function () {
            $host      = env('DB_HOST', LOCALHOST);
            $mysqlPort = env('DB_PORT', '3306');
            $pgPort    = env('DB_PORT', '5432');
            $database  = env('DB_DATABASE', 'laravel');
            $username  = env('DB_USERNAME', 'root');
            $password  = env('DB_PASSWORD', '');
            $charset   = env('DB_CHARSET', 'utf8mb4');
            $collation = env('DB_COLLATION', 'utf8mb4_unicode_ci');

            return [

                'mysql' => [
                    'driver' => 'mysql',
                    'url' => env('DB_URL'),
                    'host' => $host,
                    'port' => $mysqlPort,
                    'database' => $database,
                    'username' => $username,
                    'password' => $password,
                    'unix_socket' => env('DB_SOCKET', ''),
                    'charset' => $charset,
                    'collation' => $collation,
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'strict' => true,
                    'engine' => null,
                    'options' => extension_loaded('pdo_mysql') ? array_filter([
                        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                    ]) : [],
                ],

                'mariadb' => [
                    'driver' => 'mariadb',
                    'url' => env('DB_URL'),
                    'host' => $host,
                    'port' => $mysqlPort,
                    'database' => $database,
                    'username' => $username,
                    'password' => $password,
                    'unix_socket' => env('DB_SOCKET', ''),
                    'charset' => $charset,
                    'collation' => $collation,
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'strict' => true,
                    'engine' => null,
                    'options' => extension_loaded('pdo_mysql') ? array_filter([
                        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                    ]) : [],
                ],

                'pgsql' => [
                    'driver' => 'pgsql',
                    'url' => env('DATABASE_URL'),
                    'host' => $host,
                    'port' => $pgPort,
                    'database' => env('DB_DATABASE', 'forge'),
                    'username' => env('DB_USERNAME', 'forge'),
                    'password' => env('DB_PASSWORD', ''),
                    'charset' => 'utf8',
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'search_path' => 'public',
                    'sslmode' => 'prefer',
                ],

                'sqlsrv' => [
                    'driver' => 'sqlsrv',
                    'url' => env('DB_URL'),
                    'host' => env('DB_HOST', 'localhost'),
                    'port' => env('DB_PORT', '1433'),
                    'database' => $database,
                    'username' => $username,
                    'password' => $password,
                    'charset' => env('DB_CHARSET', 'utf8'),
                    'prefix' => '',
                    'prefix_indexes' => true,
                ],

            ];
        })(),

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')) . '-database-'),
            'persistent' => env('REDIS_PERSISTENT', false),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', LOCALHOST),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', LOCALHOST),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
