<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;

$router->get('login', function () {

    (new AuthController())->login();

});

$router->post('login', function () {

    (new AuthController())->login();

});

$router->get('dashboard', function () {

    (new DashboardController())->index();

});