<?php

namespace App\Controllers;

use App\Models\User;
use Ilya\MyFrameworkProject\Validator\Validator;

class UserController extends BaseController
{
    public function register(): void
    {
        echo view()->render('users/register', ['title' => 'Регистрация']);
    }

    public function login(): void
    {
        echo 'login';
    }

    public function store(): void
    {
        $model = new User();
        $model->loadData();
        var_dump($model->validate());
        var_dump($model->getErrors());
    }
}
