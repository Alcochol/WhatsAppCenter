<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Session;
use App\Core\Router;

Session::start();

$router = new Router();

require __DIR__ . '/routes/web.php';

include 'app/Views/layouts/header.php';
include 'app/Views/layouts/navbar.php';
include 'app/Views/layouts/sidebar.php';

$router->dispatch();

include 'app/Views/layouts/footer.php';
include 'app/Views/layouts/scripts.php';