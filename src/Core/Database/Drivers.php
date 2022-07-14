<?php

namespace Tekinaydogdu\Check24\Core\Database;

enum Drivers: string
{
    case Mysql = \Tekinaydogdu\Check24\Core\Database\Mysql\Connection::class;

    public function getClass(): string
    {
        return $this->value;
    }
}
