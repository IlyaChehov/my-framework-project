<?php

namespace App\Controllers;

use App\Models\User;
use Ilya\MyFrameworkProject\Core\Auth;
use Ilya\MyFrameworkProject\Database\Database;
use Ilya\MyFrameworkProject\Pagination\Pagination;
use JetBrains\PhpStorm\NoReturn;

class UserController extends BaseController
{

    public function register(): void
    {
        echo view()->render('users/register', ['title' => 'Регистрация | My-Framework']);
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
        if (!$model->validate()) {
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

    public function login(): void
    {
//        $credentials = [
//            'name' => 'ilya',
//            'password' => '12345678'
//        ];
//
//        $password = $credentials['password'];
//        unset($credentials['password']);
//        $field = array_key_first($credentials);
//        $value = $credentials[$field];
//        var_dump($field);
//        var_dump($value);
//        var_dump($password);
//        $user = Database::getInstance()->findOne('users', $value, $field);
//        var_dump($user);
        echo view()->render('/users/login', ['title' => 'Войти | My-Framework']);
    }

    public function auth(): void
    {
        $model = new User();
        $data = request()->getData();
        $model->loadData($data);
        if(!$model->validate(rules: [
            'email' => [
                'required' => true
            ],
            'password' => [
                'required' => true
            ]
        ])) {
            session()->setFlash('Error', 'Поля заполненны неверно, попробуйте еще раз');
            session()->set('formErrors', $model->getErrors());
            session()->set('formData', $data);
            response()->redirect('/login');
        } else {
            if (Auth::login([
                'email' => $model->validFields['email'],
                'password' => $model->validFields['password']
            ])) {
                session()->setFlash('Success', 'Вы авторизованы');
                response()->redirect('/');
            } else {
                session()->setFlash('Error', 'Неправильный email или пароль');
                response()->redirect('/login');
            }
        }
    }

    public function logout(): void
    {
        Auth::logout();
        response()->redirect('/');
    }
}
