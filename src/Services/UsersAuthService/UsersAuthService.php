<?php


namespace App\Services\UsersAuthService;

use App\Exceptions\UnauthorizedException;
use App\Models\User\User;

class UsersAuthService
{
    public static function createToken(User $user): void
    {
        $token = $user->getId() . ':' . $user->getAuthToken();
        setcookie('token', $token, 0, '/', '', false, true);
    }

    public static function getUserByToken(): ?User
    {
        $token = $_COOKIE['token'] ?? '';

        if (empty($token)) {
            return null;
        }

        [$userId, $authToken] = explode(':', $token, 2);

        $user = User::getById((int)$userId);

        if ($user === null) {
            return null;
        }

        if ($user->getAuthToken() !== $authToken) {
            return null;
        }
        return $user;
    }

    public static function userCheck(User $user = null)
    {
        if ($user === null) {
            throw new UnauthorizedException('Вы не залогинены');
        }

    }

    public static function deleteToken()
    {
        setcookie('token', '', false, '/', '', false, true);
    }
}