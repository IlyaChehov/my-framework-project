<?php

use Ilya\MyFrameworkProject\Http\Router;

return function(Router $router) {
    $router->get('/', [\App\Controllers\Test::class, 'index']);
    $router->get("/post/(?P<slug>[1-9a-z-]+)/?", function() {
        return 'www';
    });

};
