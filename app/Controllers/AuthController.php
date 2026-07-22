<?php

use App\Core\BaseController;

class AuthController extends BaseController
{
    public function login($correo,$password)
    {

        $userModel = new User();

        $usuario = $userModel->login($correo);

        if(!$usuario){

            return false;

        }

        if(!password_verify($password,$usuario['password'])){

            return false;

        }

        $userModel->actualizarUltimoAcceso($usuario['id']);

        $_SESSION['usuario']=$usuario;

        return true;

    }

    public function logout()
    {

        session_destroy();

        header("Location:index.php?page=login");

        exit;

    }

}



