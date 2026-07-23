<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Session;
use App\Models\User;

class AuthController extends BaseController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $correo = trim($_POST['correo'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = new User();

            $usuario = $user->findByEmail($correo);

            if (!$usuario) {

                return $this->view('login/index', [
                    'error' => 'Correo o contraseña incorrectos.'
                ]);
            }

            if (!password_verify($password, $usuario['password'])) {

                return $this->view('login/index', [
                    'error' => 'Correo o contraseña incorrectos.'
                ]);
            }

            Session::set('usuario', $usuario);

            $user->actualizarUltimoAcceso($usuario['id']);

            $this->redirect('dashboard');
        }

        $this->view('login/index');
    }

    public function logout()
    {
        Session::destroy();

        $this->redirect('login');
    }
}