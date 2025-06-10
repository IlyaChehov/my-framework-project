<?php

namespace App\Models;

use Ilya\MyFrameworkProject\Core\Model;

class User extends Model
{
    protected array $allowedFields = ['name', 'email', 'password', 'confirmPassword'];
    protected array $fillable = ['name', 'email', 'password'];
    protected string $table = 'users';
    protected array $rules = [
        'name' => [
            'required' => true,
            'max' => 15,
            'unique' => 'users:name'
        ],
        'email' => [
            'required' => true,
            'email' => true,
            'unique' => 'users:email'
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
