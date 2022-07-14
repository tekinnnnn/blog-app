<?php

namespace Tekinaydogdu\Check24\Core\Database\Mysql;

use PDO;
use PDOStatement;
use Tekinaydogdu\Check24\Core\Database\ConnectionInterface;

class Connection implements ConnectionInterface
{
    protected static PDO $pdo;

    public function __construct(protected readonly array $settings)
    {
        $this->connect();
    }

    private function connect(): void
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s;port=%s',
            $this->settings['host'],
            $this->settings['dbname'],
            $this->settings['charset'],
            $this->settings['port']
        );

        static::$pdo = new PDO($dsn, $this->settings['user'], $this->settings['password']);
    }

    public function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->instance()->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    public static function instance(): PDO
    {
        return static::$pdo;
    }
}
