<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get($page, callable $callback)
    {
        $this->routes['GET'][$page] = $callback;
    }

    public function post($page, callable $callback)
    {
        $this->routes['POST'][$page] = $callback;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $page = $_GET['page'] ?? 'dashboard';

        if (isset($this->routes[$method][$page])) {

            $this->routes[$method][$page]();

            return;
        }

        http_response_code(404);

        echo "<h1>404 - Página no encontrada</h1>";
    }
}