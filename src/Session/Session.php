<?php

namespace Ilya\MyFrameworkProject\Session;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function remove(string $key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function setFlash(string $key, mixed $value): void
    {
        $_SESSION['_flash_'][$key] = $value;
    }

    public function getFlash(string $key, mixed $default = null): mixed
    {
        if (isset($_SESSION['_flash_'][$key])) {
            $value = $_SESSION['_flash_'][$key];
            unset($_SESSION['_flash_'][$key]);
        } else {
            $value = $default;
        }
        return $value;
    }
}
