<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): void
    {
        echo view()->render('home', ['title' => 'Главная страница | My-Framework']);
    }

    public function about(): void
    {
        echo 'about';
    }
}
