<?php

use Ilya\MyFrameworkProject\Core\Application;

require_once '../vendor/autoload.php';

$whoops = new \Whoops\Run();
if (DEBUG) {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
} else {
    $whoops->pushHandler(new \Whoops\Handler\CallbackHandler(function (Throwable $e) {
        error_log("[" . date('Y-m-d H:i:s') . "] Error: {$e->getMessage()}" . PHP_EOL . "File: {$e->getFile()}" . PHP_EOL . "Line: {$e->getLine()}", 3, ERROR_LOGS);
        die('Error');
    }));
}
$whoops->register();

$app = new Application();
$routes = require_once '../config/routes.php';
$routes($app->getRouter());
$app->run();
