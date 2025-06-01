<?php

namespace Ilya\MyFrameworkProject\Middleware;

class Auth implements InterfaceMiddleware
{
    public function handle(): void
    {
        if (!checkAuth()) {
            response()->redirect('/login');
        }
    }
}
