<?php

namespace App\Controllers;

use App\Models\Tasks\Task;


class MainController extends AbstractController
{

    public function pag()
    {
        $page = Task::findAll();

        $this->view->renderHtml('mainPage.php', ['pagination' => $page]);
    }


}