<?php

namespace App\Model;

use DateTime;

class User
{
    public string $id;
    public string $name;
    public string $email;
    protected string $password;
    public string $login_at;
    public string $created_at;
    public string $updated_at;

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        var_dump($this->password);
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password ?? '');
    }
}
