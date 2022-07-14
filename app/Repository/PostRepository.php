<?php

namespace App\Repository;

use Laminas\Db\Sql\Where;
use Tekinaydogdu\Check24\Core\Repository;

class PostRepository extends Repository
{
    public function __construct()
    {
        parent::__construct('posts');
    }

    public function find(?Where $where = null, $limit = 10, $offset = 0, $orderBy = 'created_at desc'): array
    {
        $result = $this->get($where, $limit, $offset, orderBy: $orderBy);

        return $result->toArray();
    }

    public function count(?Where $where = null): int
    {
        $result = $this->get($where, null, null);

        return $result->count();
    }
}
