<?php

namespace Ilya\MyFrameworkProject\Http;

class Request
{
    private string $uri;

    public function __construct(string $uri = null)
    {
        $uri = $uri ?? $_SERVER['REQUEST_URI'];
        $this->uri = urldecode($uri);
    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool
    {
        return $this->getMethod() === 'GET';
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'POST';
    }

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    private function removeQueryString(): string
    {
        if (!$this->uri) {
            return '/';
        }
        $path = explode('?', $this->uri)[0];
        $path = trim($path, '/');
        return "/{$path}";
    }

    public function getPath(): string
    {
        return $this->removeQueryString();
    }

}
