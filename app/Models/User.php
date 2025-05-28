<?php

namespace App\Models;

use Ilya\MyFrameworkProject\Core\Model;

class User extends Model
{
    protected array $allowedFields = ['name', 'email', 'password', 'confirmPassword'];
    protected array $rules = [
        'name' => [
            'required' => true,
            'max' => 15,
        ],
        'email' => [
            'required' => true,
            'email' => true
        ],
        'password' => [
            'required' => true,
            'min' => 8
        ],
        'confirmPassword' => [
            'match' => 'password',
            'required' => true
        ]
    ];


}
