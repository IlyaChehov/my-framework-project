<?php

namespace App\Controllers;

use App\Models\User;
use JetBrains\PhpStorm\NoReturn;

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

    #[NoReturn] public function store(): void
    {
        $model = new User();
        $data = request()->getData();
        $model->loadData($data);
        if ($model->validate()) {
            session()->setFlash('Error', 'Поля заполненны неверно, попробуйте еще раз');
            session()->set('formErrors', $model->getErrors());
            session()->set('formData', $data);
        } else {
            $model->validFields['password'] = password_hash($model->validFields['password'], PASSWORD_DEFAULT);
            if ($id = $model->save()) {
                session()->setFlash('Success', 'Регистрация прошла успешно.');
            } else {
                session()->setFlash('Error', 'Ошибка регистрации, попробуйте позже');
            }
        }
        response()->redirect('/register');
    }
}
