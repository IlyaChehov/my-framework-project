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

function response(): \Ilya\MyFrameworkProject\Http\Response
{
    return app()->getResponse();
}

function baseUrl(string $path = ''): string
{
    return HOST . $path;
}

function showAlerts(): void
{
    if (isset($_SESSION['_flash_'])) {
        foreach ($_SESSION['_flash_'] as $key => $value) {
            echo view()->renderPartial("incs/alert{$key}", ["flash{$key}" => session()->getFlash($key)]);
        }
    }
}

function getErrors(string $fieldName): string
{
    $output = '';
    $errors = session()->get('formErrors');
    if (isset($errors[$fieldName])) {
        $output .= '<div class="invalid-feedback d-block"><ul class="list-unstyled">';
        foreach ($errors[$fieldName] as $error) {
            $output .= "<li>{$error}</li>";
        }
        $output .= '</ul></div>';
    }
    return $output;
}

function old($fieldName): string
{
    $data = session()->get('formData');
    return isset($data[$fieldName]) ? a($data[$fieldName]) : '';
}

function a(string $string): string
{
    return htmlspecialchars($string, ENT_QUOTES);
}

function getValidationClass($fieldName): string
{
    $errors = session()->get('formErrors');
    if (empty($errors)) {
        return '';
    }
    return isset($errors[$fieldName]) ? 'is-invalid' : 'is-valid';
}

function getCsrfField(): string
{
    $token = \session()->get('csrfToken');
    return "<input type='hidden' value='{$token}' name='csrfToken'>";
}

function checkAuth(): bool
{
    return false;
}
