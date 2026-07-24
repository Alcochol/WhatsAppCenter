<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get($page, $callback)
    {
        $this->routes['GET'][$page] = $callback;
    }

    public function post($page, $callback)
    {
        $this->routes['POST'][$page] = $callback;
    }

    public function dispatch()
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        $page = $_GET['page'] ?? 'dashboard';

        if (!isset($this->routes[$httpMethod][$page])) {

            http_response_code(404);

            echo "<h1>404 - Página no encontrada</h1>";

            return;
        }

        $callback = $this->routes[$httpMethod][$page];

        if (is_array($callback)) {

            $controller = new $callback[0];

            $method = $callback[1];

            $controller->$method();

            return;
        }

        $callback();
    }
}