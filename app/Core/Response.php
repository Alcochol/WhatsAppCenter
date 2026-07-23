<?php

namespace App\Core;

class Response
{
    public static function redirect(string $page): void
    {
        header("Location: index.php?page={$page}");
        exit;
    }

    public static function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}