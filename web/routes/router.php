<?php

$routes = [
    '/' => 'HomeController@index',

    '/connexion' => 'UserController@connexion',
    '/profil' => 'UserController@profile',
    '/deconnexion' => 'UserController@logout',
    '/user/addClef' => 'UserController@addKey',

    '/equipment' => 'EquipmentController@equipmentListAndTemplate',
    '/equipment/find' => 'EquipmentController@findEquipment',
];

function handleRequest($routes): void
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if (array_key_exists($uri, $routes)) {
        list($controller, $method) = explode('@', $routes[$uri]);
        require_once __DIR__ . "/../src/Controllers/$controller.php";
        $controllerInstance = new $controller();
        $controllerInstance->$method();
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }
}

handleRequest($routes);