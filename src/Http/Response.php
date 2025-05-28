<?php

namespace Ilya\MyFrameworkProject\Http;

use JetBrains\PhpStorm\NoReturn;

class Response
{
    public function setResponseCode(int $code): void
    {
        http_response_code($code);
    }

    #[NoReturn] public function redirect(string $uri): void
    {
        header("Location:{$uri}");
        die;
    }
}
