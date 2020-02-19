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
                $_SESSION['message'] = 'Ваша запись создана';
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $_SESSION['name'] = $_POST['name'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['text'] = $_POST['text'];
                $_SESSION['error'] = $e->getMessage();
                header('Location: /');
                exit();
            }
        }
    }

    public function edit($slug)
    {
        if ($this->user) {
            $task = Task::getById($slug);
            if (!empty($_POST)) {
                try {
                    if ($task->getText() !== $_POST['text']) {
                        $_POST['adminStatus'] = 'Отредактировано администратором';
                    }
                    $task->updateFromArray($_POST);

                } catch (InvalidArgumentException $e) {
                    $_SESSION['error'] = $e->getMessage();
                    $this->view->renderHtml('taskPage/edit.php', ['task' => $task]);
                    return;
                }
                header('Location:/');
                exit();

            }
            $this->view->renderHtml('taskPage.php', ['task' => $task]);
        } else {
            header('Location:/login');
        }
    }


    public function logOut()
    {
        UsersAuthService::deleteToken();
        header('Location: /');
    }
}
