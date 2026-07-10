<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config/config.php';

/*
|--------------------------------------------------------------------------
| Verificación del Webhook
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $verify_token = $_GET['hub_verify_token'] ?? '';
    $challenge = $_GET['hub_challenge'] ?? '';

    if ($verify_token === $config['verify_token']) {

        http_response_code(200);
        echo $challenge;
        exit;
    }

    http_response_code(403);
    exit("Token incorrecto");
}

/*
|--------------------------------------------------------------------------
| Recepción de mensajes
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = file_get_contents("php://input");

    file_put_contents(
        __DIR__ . "/storage/logs/webhook.log",
        date("Y-m-d H:i:s") . PHP_EOL .
        $input . PHP_EOL . PHP_EOL,
        FILE_APPEND
    );

    http_response_code(200);
    echo "EVENT_RECEIVED";
}