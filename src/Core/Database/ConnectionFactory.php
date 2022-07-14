<?php

namespace Tekinaydogdu\Check24\Core\Database;

use InvalidArgumentException;

class ConnectionFactory
{
    public static function fromSettings(array $settings): ConnectionInterface
    {
        $driver = $settings['driver'];

        if (!$driver instanceof Drivers) {
            throw new InvalidArgumentException('Database driver is not supported');
        }

        $class = $driver->getClass();

        return new $class($settings);
    }
}
