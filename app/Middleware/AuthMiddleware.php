<?php

namespace App\Middleware;

use App\Core\Session;

class AuthMiddleware
{
    public static function handle()
    {
        if (!Session::has('usuario')) {

            header("Location: index.php?page=login");

            exit;
        }
    }
}