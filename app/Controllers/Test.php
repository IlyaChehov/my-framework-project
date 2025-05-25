<?php

namespace App\Controllers;

class Test
{
    public function index(): string
    {
        return view()->render('index', [], 'test');
    }
}
