<?php

$routes = [
    '/' => 'HomeController@index',
    '/connexion' => 'ConnectionController@connection',
    //'/registration' => 'UserController@registration',
    //'/edition' => 'UserController@edition',
    '/profil' => 'UserController@profile',
];

function handleRequest($routes): void
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if (array_key_exists($uri, $routes)) {
        list($controller, $method) = explode('@', $routes[$uri]);
        require_once "src/app/Controllers/$controller.php";
        $controllerInstance = new $controller();
        $controllerInstance->$method();
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }
}

handleRequest($routes);