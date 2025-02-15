<?php
$routes = [];

function route($method, $path, $controller, $action)
{
    global $routes;
    $routes[$method][$path] = [$controller, $action];
}

// routes
route('GET', 'login', 'Controllers\AuthController', 'login');
route('GET', 'register', 'Controllers\AuthController', 'register');
route('POST', 'login', 'Controllers\UserController', 'login');
route('POST', 'register', 'Controllers\UserController', 'register');

route('GET', '', 'Controllers\NoteController', 'index');
route('POST', 'note/add', 'Controllers\NoteController', 'add');
route('POST', 'note/update', 'Controllers\NoteController', 'update');
route('POST', 'note/delete', 'Controllers\NoteController', 'delete');
