<?php

define('DIR_ROOT', dirname(__DIR__));
define('HOST', 'http://' . $_SERVER['HTTP_HOST']);
const DIR_APP = DIR_ROOT . '/app';
const DIR_VIEWS = DIR_APP . '/Views';
const DIR_PUBLIC = DIR_ROOT . '/public';
const DIR_CONFIG = DIR_ROOT . '/config';

const DEBUG = 1;
const ERROR_LOGS = DIR_ROOT . '/tmp/error.log';

const MIDDLEWARE = [
    'auth' => \Ilya\MyFrameworkProject\Middleware\Auth::class,
    'guest' => \Ilya\MyFrameworkProject\Middleware\Guest::class
];

const PAGINATION_SETTINGS = [
    'perPage' => 1,
    'midSize' => 2,
    'maxPages' => 7,
    'tpl' => 'pagination/base'
];

const CACHE = DIR_ROOT . '/tmp/cache';
const MULTILANGUAGE = true;

const LANGUAGE = [
    'ru' => [
        'id' => 1,
        'code' => 'ru',
        'title' => 'Русский',
        'base' => true
    ],
    'en' => [
        'id' => 2,
        'code' => 'en',
        'title' => 'English',
        'base' => false
    ],
];
