<?php

namespace Ilya\MyFrameworkProject\Core;

use Ilya\MyFrameworkProject\Database\Database;

class Auth
{
    public static function login(array $credentials): bool
    {
        $password = $credentials['password'];
        unset($credentials['password']);
        $field = array_key_first($credentials);
        $value = $credentials[$field];
        $user = Database::getInstance()->findOne('users', $value, $field);

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user['password'])) {
            session()->set('user', [
                'id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name']
            ]);
            return true;
        } else {
            return false;
        }
    }

    public static function user(): array|null
    {
        return session()->get('user');
    }

    public static function isAuth(): bool
    {
        return session()->has('user');
    }

    public static function logout(): void
    {
        session()->remove('user');
    }

    public static function setUser(): void
    {
        if ($userData = self::user()) {
            $user = Database::getInstance()->findOne('users', $userData['id']);
            if ($user) {
                session()->set('user', [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'name' => $user['name']
                ]);
            }
        }
    }
}
