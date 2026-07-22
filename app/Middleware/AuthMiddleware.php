<?php

namespace App\Middleware;

class AuthMiddleware
{

    public static function verificar()
    {

        if(!isset($_SESSION['usuario'])){

            header("Location:index.php?page=login");

            exit;

        }

    }

}