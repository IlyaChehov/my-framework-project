<?php

namespace App\Controllers;

class HomeController
{
    public function index(): string
    {
        return view()->render('home', ['title' => 'Главная страница | My-Framework']);
    }

    public function about(): string
    {
        return 'about';
    }
}
