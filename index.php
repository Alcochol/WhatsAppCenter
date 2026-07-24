<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Core\Session;
use App\Core\Router;

Session::start();

$router = new Router();

require __DIR__.'/routes/web.php';

$router->dispatch();