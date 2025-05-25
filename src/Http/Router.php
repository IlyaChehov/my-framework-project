<?php

namespace Ilya\MyFrameworkProject\Http;

use http\Exception\RuntimeException;

class Router
{
    private array $routes = [];
    private array $params = [];
    private Request $request;
    private Response $response;

    public function __construct(
        Request $request,
        Response $response
    )
    {
        $this->request = $request;
        $this->response = $response;
    }

    private function add(string $path, array|callable $action, string $method): self
    {
        $path = trim($path, '/');
        $this->routes[] = [
            'path' => "/{$path}",
            'action' => $action,
            'method' => $method,
            'middleware' => null
        ];
        return $this;
    }

    public function get(string $path, array|callable $action): self
    {
        return $this->add($path, $action, 'GET');
    }

    public function post(string $path, array|callable $action): self
    {
        return $this->add($path, $action, 'POST');
    }

    private function match(): array|false
    {
        $path = $this->request->getPath();
        foreach ($this->routes as $route) {
            if (
                preg_match("#^{$route['path']}$#", $path, $matches)
                &&
                $route['method'] === $this->request->getMethod()
            ) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $this->params[$key] = $value;
                    }
                }
                return $route;
            }
        }
        return false;
    }

    public function dispatch(): mixed
    {
        $route = $this->match();
        if ($route === false) {
            abort('mie');
        }

        if(is_array($route['action'])) {
            $route['action'][0] = new $route['action'][0];
        }

        return call_user_func($route['action']);
    }
}
