<?php

namespace App\Controllers;

use App\Models\Tasks\Tasks;

class MainController extends AbstractController
{

    public function index(): void
    {
        $page = Tasks::findAll();

        $this->view->renderHtml('mainPage.php', ['pagination' => $page]);
        return;
    }


}