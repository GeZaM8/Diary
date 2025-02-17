<?php
$routes = [];

function route($method, $path, $controller, $action, $middleware = null)
{
    global $routes;
    $routes[$method][$path] = [$controller, $action, $middleware];
}

function group($middleware, $routesList)
{
    foreach ($routesList as $route) {
        route($route[0], $route[1], $route[2], $route[3], $middleware);
    }
}

// routes
group('guestFilter', [
    ['GET', 'login', 'Controllers\AuthController', 'login'],
    ['GET', 'register', 'Controllers\AuthController', 'register'],
    ['POST', 'login', 'Controllers\UserController', 'login'],
    ['POST', 'register', 'Controllers\UserController', 'register'],
]);

// Routes untuk user yang sudah login
group('authFilter', [
    ['GET', '', 'Controllers\NoteController', 'index'],
    ['POST', 'note/add', 'Controllers\NoteController', 'add'],
    ['POST', 'note/update', 'Controllers\NoteController', 'update'],
    ['POST', 'note/delete', 'Controllers\NoteController', 'delete'],
]);
