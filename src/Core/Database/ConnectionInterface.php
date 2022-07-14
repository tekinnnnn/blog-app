<?php

namespace Tekinaydogdu\Check24\Core\Database;

use PDO;
use PDOStatement;

interface ConnectionInterface
{
    public function __construct(array $settings);

    public function query(string $sql, array $params = []): PDOStatement;

    public static function instance(): PDO;
}
