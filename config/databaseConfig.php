<?php

return [
    'host' => 'database',
    'dbname' => 'my-framework',
    'username' => 'root',
    'password' => 'tiger',
    'charset' => 'utf8mb4',
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
];
