<?php

namespace Tekinaydogdu\Check24\Core\Security;

class CSRF
{
    public static function generate(): string
    {
        return bin2hex(random_bytes(32));
    }

    public static function validate(string $token): bool
    {
        return $token === $_SESSION['csrf_token'];
    }

    public static function get(): string
    {
        return $_SESSION['csrf_token'];
    }

    public static function refresh(): string
    {
        $token = self::generate();
        $_SESSION['csrf_token'] = $token;

        return $token;
    }
}
