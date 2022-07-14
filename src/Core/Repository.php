<?php

namespace Tekinaydogdu\Check24\Core;

use ArrayObject;
use Exception;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\Adapter\Driver\StatementInterface;
use Laminas\Db\ResultSet\AbstractResultSet;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Where;

abstract class Repository
{
    private static Adapter $adapter;
    private Sql $sql;

    /**
     * @param string $table
     *
     * @throws Exception
     */
    public function __construct(private readonly string $table)
    {
        if (!self::$adapter instanceof Adapter) {
            throw new Exception('Database adapter is not set');
        }

        $this->sql = new Sql(self::$adapter);
    }

    public static function setAdapter(Adapter $adapter): void
    {
        self::$adapter = $adapter;
    }

    public static function getAdapter(): Adapter
    {
        return self::$adapter;
    }

    public function get(
        ?Where $where = null,
        $limit = null,
        $offset = 0,
        $orderBy = null
    ): StatementInterface|ResultSet|ResultSetInterface {
        $sqlObject = $this->sql->select($this->table);

        if ($where) {
            $sqlObject->where($where);
        }

        if ($limit) {
            $sqlObject->limit($limit);
        }

        if ($offset) {
            $sqlObject->offset($offset);
        }

        if ($orderBy) {
            $sqlObject->order($orderBy);
        }

        $sqlString = $this->sql->buildSqlString($sqlObject);

        return self::$adapter->query($sqlString, Adapter::QUERY_MODE_EXECUTE);
    }

    public function execute(string $query): ResultSetInterface|StatementInterface|ResultSet|AbstractResultSet
    {
        return $this::getAdapter()
            ->query($query, Adapter::QUERY_MODE_EXECUTE);
    }
}
