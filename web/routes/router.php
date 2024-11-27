<?php

$routes = [
    __SITE_REPOSITORY__.'/' => 'HomeController@index',

    __SITE_REPOSITORY__.'/connexion'    => 'UserController@connexion',
    __SITE_REPOSITORY__.'/profil'       => 'UserController@profile',
    __SITE_REPOSITORY__.'/deconnexion'  => 'UserController@logout',
    __SITE_REPOSITORY__.'/user/addClef' => 'UserController@addKey',

    __SITE_REPOSITORY__.'/equipment'                => 'EquipmentController@equipmentListAndTemplate',
    __SITE_REPOSITORY__.'/equipment/find'           => 'EquipmentController@findEquipment',
    __SITE_REPOSITORY__.'/equipment/showOne'        => 'EquipmentController@showOne',
    __SITE_REPOSITORY__.'/equipment/addPannier'     => 'EquipmentController@addPannier',
    __SITE_REPOSITORY__.'/equipment/listPannier'    => 'EquipmentController@listPannier',
    __SITE_REPOSITORY__.'/equipment/deleteFromCart' => 'EquipmentController@deletePannier',
    __SITE_REPOSITORY__.'/equipment/validateCart'   => 'EquipmentController@validateCart',

    __SITE_REPOSITORY__.'/admin/equipment/add'    => 'AdminController@addEquipment',
    __SITE_REPOSITORY__.'/admin/equipment/edit'   => 'AdminController@editEquipment',
    __SITE_REPOSITORY__.'/admin/equipment/list'   => 'AdminController@listEquipment',
    __SITE_REPOSITORY__.'/admin/equipment/delete' => 'AdminController@deleteEquipment',
    __SITE_REPOSITORY__.'/admin/user/list'        => 'AdminController@listUser',
    __SITE_REPOSITORY__.'/admin/user/add'         => 'AdminController@addUser',

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