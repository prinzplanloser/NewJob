<?php

namespace App\Controllers;

use App\Models\Tasks\Task;
use App\Services\Db\Db;
use App\View\View;
use App\Exceptions\InvalidArgumentException;
use App\Models\User\User;
use App\Services\UsersAuthService\UsersAuthService;

class MainController extends AbstractController
{

    public function pag($slug = 1)
    {
        $page = $this->pagintaion->paginate($slug, 3);

        $this->view->renderHtml('NewMainPage.php', ['pagination' => $page['pagination'], 'page' => $slug, 'total' => $page['total']]);
    }


}