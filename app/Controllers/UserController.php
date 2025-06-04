<?php

namespace App\Controllers;

use App\Models\User;
use Ilya\MyFrameworkProject\Database\Database;
use Ilya\MyFrameworkProject\Pagination\Pagination;
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

    public function dashboard(): void
    {
        view()->render('/users/dashboard', ['title' => 'Личный кабинет | My-Framework']);
    }

    public function index(): void
    {
        $usersCount = Database::getInstance()->query("SELECT COUNT(*) FROM `users`")->getColumn();
        $limit = PAGINATION_SETTINGS['perPage'];
        $pagination = new Pagination($usersCount);
        $users = (Database::getInstance())->query("SELECT * FROM `users` LIMIT {$limit} OFFSET {$pagination->getOffset()}")->getAll();
        view()->render('/users/index',
            [
                'title' => 'Пользователи | My-Framework',
                'users' => $users,
                'pagination' => $pagination
            ]);
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
