<?php

namespace Ilya\MyFrameworkProject\Core;

use Ilya\MyFrameworkProject\Http\Request;
use Ilya\MyFrameworkProject\Http\Response;
use Ilya\MyFrameworkProject\Http\Router;
use Ilya\MyFrameworkProject\Session\Session;

class Application
{
    private static Application $app;
    private Request $request;
    private Response $response;
    private Router $router;
    private FileTemplateLoad $load;
    private View $view;
    private Session $session;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router(
            $this->request,
            $this->response
        );
        $this->load = new FileTemplateLoad(DIR_VIEWS);
        $this->view = new View($this->load, 'main');
        $this->session = new Session();
        $this->generateCsrfToken();

        self::$app = $this;
    }

    public function run(): void
    {
        $this->router->dispatch();
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function getView(): View
    {
        return $this->view;
    }

    public static function getApp(): Application
    {
        return self::$app;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function getSession(): Session
    {
        return $this->session;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    private function generateCsrfToken(): void
    {
        if (!$this->session->has('csrfToken')) {
            $this->session->set('csrfToken', md5(uniqid(mt_rand(), true)));
        }
    }
}
