<?php

namespace App\Controllers;


use App\Exceptions\InvalidArgumentException;
use App\Models\Tasks\Task;
use App\Services\UsersAuthService\UsersAuthService;

class TaskController extends AbstractController
{

    public function create()
    {
        if (!empty($_POST)) {
            try {
                $task = Task::create($_POST);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $page = $this->pagintaion->paginate('1', '3');
                $this->view->renderHtml('NewMainPage.php', ['error' => $e->getMessage(), 'pagination' => $page['pagination'], 'page' => 1, 'total' => $page['total']]);

            }
        }


    }

    public function logOut()
    {
        UsersAuthService::deleteToken();
        header('Location: /');
    }
}
