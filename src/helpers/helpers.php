<?php

use Ilya\MyFrameworkProject\Core\Application;
use Ilya\MyFrameworkProject\Core\View;
use Ilya\MyFrameworkProject\Http\Request;
use Ilya\MyFrameworkProject\Session\Session;
use JetBrains\PhpStorm\NoReturn;

function app(): Application
{
    return Application::getApp();
}

function view(): View
{
    return app()->getView();
}

#[NoReturn] function abort($error = '', $code = 404): void
{
    app()->getResponse()->setResponseCode($code);
    echo view()->render("errors/{$code}", ['error' => $error], 'error');
    die;
}

function session(): Session
{
    return app()->getSession();
}

function request(): Request
{
    return app()->getRequest();
}

function baseUrl(string $path = ''): string
{
    return HOST . "$path";
}
