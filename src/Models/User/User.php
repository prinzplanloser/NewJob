<?php

namespace App\Models\User;

use App\Exceptions\InvalidArgumentException;
use App\Exceptions\UnauthorizedException;
use App\Models\ActiveRecordEntity;


class User extends ActiveRecordEntity
{


    /** @var string */
    public $nickname;

    /** @var string */
    public $passwordHash;

    /** @var string */
    public $authToken;


    public function getNickname()
    {
        return $this->nickname;
    }

    public function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    protected static function getTableName(): string
    {
        return 'users';
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getAuthToken()
    {
        return $this->authToken;
    }




    public static function login(array $loginData): User
    {
        if (empty($loginData['login'])) {
            throw new InvalidArgumentException('Не передан логин');
        }

        if (empty($loginData['password'])) {
            throw new InvalidArgumentException('Не передан пароль');
        }

        $user = User::findOneByColumn('nickname', $loginData['login']);
        if ($user === null) {
            throw new InvalidArgumentException('Нет пользователя с таким Логином');
        }

        if (!password_verify($loginData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Неправильный пароль');
        }
        $user->refreshAuthToken();
        $user->save();
        return $user;
    }


}