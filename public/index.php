<?php

use Ilya\MyFrameworkProject\Core\Application;

require_once '../vendor/autoload.php';

$app = new Application();
$routes = require_once '../config/routes.php';
$routes($app->getRouter());
$app->run();
