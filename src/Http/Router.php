<?php

namespace Ilya\MyFrameworkProject\Http;

use http\Exception\RuntimeException;
use Ilya\MyFrameworkProject\Middleware\Auth;

class Router
{
    private array $routes = [];
    private array $params = [];
    private Request $request;
    private Response $response;

    public function __construct(
        Request $request,
        Response $response
    ) {
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
            'middleware' => null,
            'needCsrfToken' => true
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
                if (!empty($route['middleware'])) {
                    foreach ($route['middleware'] as $middleware) {
                        $middleware = MIDDLEWARE[$middleware] ?? false;
                        if ($middleware) {
                            (new $middleware)->handle();
                        }
                    }
                }

                if ($this->request->isPost()) {
                    if ($route['needCsrfToken'] && !$this->checkCsrfToken()) {
                        if ($this->request->isAjax()) {
                            echo json_encode([
                                'status' => 'error',
                                'data' => 'Security error'
                            ]);
                            die;
                        } else {
                            abort('419 - Security error', 419);
                        }
                    }
                }

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

    public function withoutCsrfToken(): self
    {
        $this->routes[array_key_last($this->routes)]['needCsrfToken'] = false;
        return $this;
    }

    public function dispatch(): mixed
    {
        $route = $this->match();
        if ($route === false) {
            abort('404 - Page not found');
        }

        if (is_array($route['action'])) {
            $route['action'][0] = new $route['action'][0];
        }

        return call_user_func($route['action']);
    }

    private function checkCsrfToken(): bool
    {
        return $this->request->post('csrfToken')
            && ($this->request->post('csrfToken') === session()->get('csrfToken'));
    }

    public function middleware(array $middleware): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
