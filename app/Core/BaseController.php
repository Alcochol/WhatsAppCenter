<?php

namespace App\Core;

class BaseController
{
    /**
     * Cargar una vista
     */
    protected function view(string $view, array $data = [])
    {
        extract($data);

        include __DIR__ . "/../Views/{$view}.php";
    }

    /**
     * Redireccionar
     */
    protected function redirect(string $page)
    {
        header("Location: index.php?page={$page}");
        exit;
    }

    /**
     * Respuesta JSON
     */
    protected function json(array $data, int $status = 200)
    {
        http_response_code($status);

        header("Content-Type: application/json");

        echo json_encode($data);

        exit;
    }

    /**
     * Respuesta exitosa
     */
    protected function success(string $message, array $extra = [])
    {
        $this->json(array_merge([
            "success" => true,
            "message" => $message
        ], $extra));
    }

    /**
     * Respuesta de error
     */
    protected function error(string $message, int $status = 400)
    {
        $this->json([
            "success" => false,
            "message" => $message
        ], $status);
    }
}