<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;
use Tekinaydogdu\Check24\Core\Database\ConnectionFactory;
use Tekinaydogdu\Check24\Core\Repository;

require_once __DIR__ . '/../vendor/autoload.php';

// logger instance to log errors
$logger = new Logger('app');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/error.log', LogLevel::ERROR));

// create a db connection
$databaseSettings = require __DIR__ . '/../config/db.config.php';
$databaseAdapter = new \Laminas\Db\Adapter\Adapter($databaseSettings);

// warming up...
Repository::setAdapter($databaseAdapter);
