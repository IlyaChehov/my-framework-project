<?php

use Ilya\MyFrameworkProject\Http\Router;

return function(Router $router) {
    $router->get('/', [\App\Controllers\HomeController::class, 'index']);
    $router->get('/about', [\App\Controllers\HomeController::class, 'about']);
    $router->get('/register', [\App\Controllers\UserController::class, 'register']);
    $router->get('/login', [\App\Controllers\UserController::class, 'login']);

    $router->post('/register', [\App\Controllers\UserController::class, 'store']);

};
