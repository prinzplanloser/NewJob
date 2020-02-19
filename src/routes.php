<?php

use App\Controllers\MainController;
use App\Controllers\TaskController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\Configurator\RouteConfigurator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Controllers\RegisterController;

try {

    $main = new Route('/', ['_controller' => MainController::class, 'method' => 'pag']);

    $login = new Route('/login', ['_controller' => RegisterController::class, 'method' => 'login']);
    $logout = new Route('/logout', ['_controller' => RegisterController::class, 'method' => 'logout']);
    $newTask = new Route('/newTask', ['_controller' => TaskController::class, 'method' => 'create']);
    $editTask = new Route('/task/{slug}', ['_controller' => TaskController::class, 'method' => 'edit']);

    $routes = new RouteCollection();
    $routes->add('page', $main);
    $routes->add('login', $login);
    $routes->add('logout', $logout);
    $routes->add('newTask', $newTask);
    $routes->add('edit', $editTask);


    $context = new RequestContext();
    $context->fromRequest(Request::createFromGlobals());
    $matcher = new UrlMatcher($routes, $context);
    $parameters = $matcher->match($context->getPathInfo());
} catch (ResourceNotFoundException $e) {
    $view = new \App\View\View(__DIR__ . '/../templates');
    $view->renderHtml('404.php');
}

if (isset($parameters)) {
    $controller = $parameters["_controller"];

    $action = $parameters["method"];


    $page = new $controller();

    $page->$action(...[$parameters['slug']]);
}
