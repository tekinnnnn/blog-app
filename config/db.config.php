<?php

use Tekinaydogdu\Check24\Core\Database\Drivers;

return [
    'driver' => Drivers::Mysql,
    'host' => getenv('DB_HOST'),
    'port' => getenv('DB_PORT'),
    'dbname' => getenv('DB_NAME'),
    'user' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',
];