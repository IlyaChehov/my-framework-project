<?php

use Ilya\MyFrameworkProject\Http\Router;

return function(Router $router) {
    $router->get('/about', [\App\Controllers\HomeController::class, 'about']);
    $router->get('/register', [\App\Controllers\UserController::class, 'register'])->middleware(['guest']);
    $router->get('/login', [\App\Controllers\UserController::class, 'login'])->middleware(['guest']);
    $router->get('/dashboard', [\App\Controllers\UserController::class, 'dashboard'])->middleware(['auth']);
    $router->get('/users', [\App\Controllers\UserController::class, 'index']);
    $router->get("/post/(?P<slug>[a-z0-9-]+)", function () {
        echo 'post';
    });
    $router->get('/logout', [\App\Controllers\UserController::class, 'logout']);
    $router->get('/', [\App\Controllers\HomeController::class, 'index']);

    $router->post('/register', [\App\Controllers\UserController::class, 'store'])->middleware(['guest']);
    $router->post('/login', [\App\Controllers\UserController::class, 'auth'])->middleware(['guest']);

};
