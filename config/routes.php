<?php

use Ilya\MyFrameworkProject\Http\Router;

return function(Router $router) {
    $router->get('/', [\App\Controllers\HomeController::class, 'index']);
    $router->get('/about', [\App\Controllers\HomeController::class, 'about']);
    $router->get('/register', [\App\Controllers\UserController::class, 'register'])->middleware(['guest']);
    $router->get('/login', [\App\Controllers\UserController::class, 'login'])->middleware(['guest']);
    $router->get('/dashboard', [\App\Controllers\UserController::class, 'dashboard'])->middleware(['auth']);

    $router->post('/register', [\App\Controllers\UserController::class, 'store'])->middleware(['guest']);

};
