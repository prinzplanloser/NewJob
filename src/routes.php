<?php

use App\Controllers\MainController;
use App\Controllers\TaskController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Loader\Configurator\RouteConfigurator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Controllers\RegisterController;

$main = new Route('/', ['_controller' => MainController::class, 'method' => 'pag']);
$pages = new Route('/page/{slug}', ['_controller' => MainController::class, 'method' => 'pag']);
$login = new Route('/login', ['_controller' => RegisterController::class, 'method' => 'login']);
$logout = new Route('/logout', ['_controller' => RegisterController::class, 'method' => 'logout']);
$newTask = new Route('/newTask', ['_controller' => TaskController::class, 'method' => 'create']);

$routes = new RouteCollection();
$routes->add('page', $main);
$routes->add('login', $login);
$routes->add('logout', $logout);
$routes->add('newTask', $newTask);
$routes->add('pages', $pages);


$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());
$matcher = new UrlMatcher($routes, $context);
$parameters = $matcher->match($context->getPathInfo());


if (!$parameters) {
    // no route object was returned, You can also set error controller depending on your logic
    echo "No application route was found for that URI path.";
    exit();
}
// does the route indicate a controller?
if (isset($parameters["_controller"])) {
    // take the controller class directly from the route
    $controller = $parameters["_controller"];
} else {
    // use a default controller
    $controller = "MainController";
}
// does the route indicate an action?
if (isset($parameters["method"])) {
// take the action method directly from the route
    $action = $parameters["method"];
} else {
// use a default action
    $action = "main";
}
// instantiate the controller class
$page = new $controller();
// invoke the action method with the route values
$page->$action(...[$parameters['slug']]);

