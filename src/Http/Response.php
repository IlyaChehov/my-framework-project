<?php

namespace Ilya\MyFrameworkProject\Http;

class Response
{
    public function setResponseCode(int $code): void
    {
        http_response_code($code);
    }
}
