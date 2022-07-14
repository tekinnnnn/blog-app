<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;
use Tekinaydogdu\Check24\Core\Database\ConnectionFactory;

require_once __DIR__ . '/../vendor/autoload.php';

// create a db connection
$connectionSettings = require __DIR__ . '/../config/db.config.php';
$connection = ConnectionFactory::fromSettings($connectionSettings);

// logger instance to log errors
$logger = new Logger('app');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/error.log', LogLevel::ERROR));
