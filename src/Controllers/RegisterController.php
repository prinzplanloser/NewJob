<?php

namespace App\Controllers;


use App\Exceptions\InvalidArgumentException;
use App\Models\User\User;
use App\Services\SessionWrapper\SessionWrapper;
use App\Services\UsersAuthService\UsersAuthService;

class RegisterController extends AbstractController
{


    public function login(): void
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                return;
            } catch (InvalidArgumentException $e) {
                SessionWrapper::addToSession('error', $e->getMessage());
                $this->view->renderHtml('loginPage.php');
                return;
            }
        }

        $this->view->renderHtml('loginPage.php');
        return;
    }

    public function logOut()
    {
        UsersAuthService::deleteToken();
        header('Location: /');
    }

}