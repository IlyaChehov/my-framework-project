<?php

use JetBrains\PhpStorm\NoReturn;

function app(): \Ilya\MyFrameworkProject\Core\Application
{
    return \Ilya\MyFrameworkProject\Core\Application::getApp();
}

function view(): \Ilya\MyFrameworkProject\Core\View
{
    return app()->getView();
}

#[NoReturn] function abort($error = '', $code = 404): void
{
    app()->getResponse()->setResponseCode($code);
    echo view()->render("errors/{$code}", ['error' => $error], 'error');
    die;
}
