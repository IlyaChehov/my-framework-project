<?php

namespace Ilya\MyFrameworkProject\Middleware;

class Guest implements InterfaceMiddleware
{
    public function handle(): void
    {
        if (checkAuth()) {
            response()->redirect('/');
        }
    }
}
