<?php

namespace App\Controllers;

use App\Services\Pagination\Pagination;
use App\View\View;
use App\Models\User\User;
use App\Services\UsersAuthService\UsersAuthService;


abstract class AbstractController
{
    /** @var View */
    protected $view;

    /** @var User|null */
    protected $user;
    /** @var Pagination */
    protected $pagintaion;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../templates/');
        $this->view->setVar('user', $this->user);
        $this->pagintaion = new Pagination();

    }
}