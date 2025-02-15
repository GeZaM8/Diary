<?php
require "../app/Config/bootstrap.php";

$uri = trim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];

// Check if the route exists
if (isset($routes[$method][$uri])) {
    [$controller, $action] = $routes[$method][$uri];

    if (class_exists($controller) && method_exists($controller, $action)) {
        $controllerInstance = new $controller();
        echo $controllerInstance->$action();
    } else {
        http_response_code(404);
        echo "Controller or method not found";
    }
} else {
    http_response_code(404);
    echo "404 Not Found";
}
