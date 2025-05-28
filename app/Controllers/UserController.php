<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{

    public function register(): void
    {
        echo view()->render('users/register', ['title' => 'Регистрация | My-Framework']);
    }

    public function login(): void
    {
        echo 'login';
    }

    public function store(): void
    {
        $model = new User();
        $data = request()->getData();
        $model->loadData($data);
        if ($model->validate()) {
            session()->setFlash('Error', 'Поля заполненны неверно, попробуйте еще раз');
            session()->set('formErrors', $model->getErrors());
            session()->set('formData', $data);
        } else {
            session()->setFlash('Success', 'Регистрация прошла успешно');
        }

        response()->redirect('/register');
    }
}
