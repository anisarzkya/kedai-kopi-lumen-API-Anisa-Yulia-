<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return response()->json([
        'app'     => 'Kedai Kopi REST API',
        'version' => $router->app->version()
    ]);
});

// Public Endpoints (GET)
$router->get('/outlets', 'OutletController@index');
$router->get('/outlets/{outletId}', 'OutletController@show');

$router->get('/menus', 'MenuController@index');
$router->get('/menus/{menuId}', 'MenuController@show');

// Protected Endpoints (Basic Auth untuk POST, PUT, DELETE)
$router->group(['middleware' => 'basic.auth'], function () use ($router) {
    $router->post('/outlets', 'OutletController@store');
    $router->put('/outlets/{outletId}', 'OutletController@update');
    $router->delete('/outlets/{outletId}', 'OutletController@destroy');

    $router->post('/menus', 'MenuController@store');
    $router->put('/menus/{menuId}', 'MenuController@update');
    $router->delete('/menus/{menuId}', 'MenuController@destroy');
});
