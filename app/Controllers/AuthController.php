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

                return $this->render(
                    'login/index',
                    [
                        'error' => 'Correo o contraseña incorrectos.'
                    ],
                    'app'
                );
            }

            if (!password_verify($password, $usuario['password'])) {

                return $this->render(
                    'login/index',
                    [
                        'error' => 'Correo o contraseña incorrectos.'
                    ],
                    'app'
                );
            }

            Session::set('usuario', $usuario);

            $user->actualizarUltimoAcceso($usuario['id']);

            return $this->redirect('dashboard');
        }

        return $this->render('login/index', [], 'app');
    }

    public function logout()
    {
        Session::destroy();

        $this->redirect('login');
    }
}