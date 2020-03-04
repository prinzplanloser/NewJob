<?php

namespace App\Controllers;


use App\Exceptions\InvalidArgumentException;
use App\Exceptions\UnauthorizedException;
use App\Models\Tasks\Tasks;
use App\Services\SessionWrapper\SessionWrapper;
use App\Services\UsersAuthService\UsersAuthService;


class TaskController extends AbstractController
{


    public function create():void
    {
        if (!empty($_POST)) {

            try {
                Tasks::create($_POST);
                SessionWrapper::addToSession('message', 'Ваша запись создана');
                header('Location: /');
                return;
            } catch (InvalidArgumentException $e) {
                SessionWrapper::addToSession('name',$_POST['name']);
                SessionWrapper::addToSession('email',$_POST['email']);
                SessionWrapper::addToSession('text',$_POST['text']);
                SessionWrapper::addToSession('error',$e->getMessage());
                header('Location: /');
                return;
            }
        }
    }

    public function edit(int $slug): void
    {
        try {
            UsersAuthService::userCheck($this->user);
        } catch (UnauthorizedException $e) {
            $this->view->renderHtml('loginPage.php');
            return;
        }

        $task = Tasks::getById($slug);

        if (!empty($_POST)) {
            try {
                $task->checkTextDiff($_POST['text']);

                $task->updateFromArray($_POST);

            } catch (InvalidArgumentException $e) {
                SessionWrapper::addToSession('error', $e->getMessage());
                $this->view->renderHtml('taskPage.php', ['task' => $task]);
                return;
            }
            header('Location:/');
        } else {
            $this->view->renderHtml('taskPage.php', ['task' => $task]);
            return;
        }


    }


    public function logOut()
    {
        UsersAuthService::deleteToken();
        header('Location: /');
    }
}
