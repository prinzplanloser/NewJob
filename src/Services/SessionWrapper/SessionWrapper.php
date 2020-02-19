<?php


namespace App\Services\SessionWrapper;


class SessionWrapper
{
    public function handle(string $key): ?string
    {
        $sessionData = $_SESSION[$key];

        unset($_SESSION[$key]);

        return $sessionData;
    }


}