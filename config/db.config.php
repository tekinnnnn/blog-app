<?php

use Tekinaydogdu\Check24\Core\Database\Drivers;

return [
    'driver' => 'Pdo_Mysql',
    'database' => getenv('DB_NAME'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'hostname' => getenv('DB_HOST'),
    'port' => getenv('DB_PORT'),
    'charset' => 'utf8',
    'driver_options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]
];
