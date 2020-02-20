<?php


namespace App\Services\SessionWrapper;


class SessionWrapper
{
    public static function handle(string $key = ''): ?string
    {
        $sessionData = $_SESSION[$key];

        unset($_SESSION[$key]);

        return $sessionData;
    }

    public static function addToSession(string $key, string $value): array
    {
        $_SESSION[$key] = $value;

        return $_SESSION;
    }


}