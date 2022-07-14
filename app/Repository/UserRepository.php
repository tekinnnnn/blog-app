<?php

namespace App\Repository;

use ArrayObject;
use Laminas\Db\Sql\Where;
use Tekinaydogdu\Check24\Core\Repository;

class UserRepository extends Repository
{
    private array $secretFields = ['password'];

    public function __construct()
    {
        parent::__construct('users');
    }

    public function findOne(?Where $where = null): ?ArrayObject
    {
        $result = $this->get($where, 1);

        if ($result->count() === 0) {
            return null;
        }

        return $result->current();
    }

    public function hideSecrets(ArrayObject $user): array
    {
        foreach ($this->secretFields as $field) {
            unset($user[$field]);
        }

        return $user->getArrayCopy();
    }
}
