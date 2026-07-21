<?php

require_once __DIR__ . '/vendor/autoload.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$config = require __DIR__ . '/config/config.php';


use App\Services\WebhookService;

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

    $input = file_get_contents('php://input');

    file_put_contents(
    __DIR__.'/storage/logs/'.date('His').'.json',
        date('Y-m-d H:i:s').PHP_EOL.
        $input.PHP_EOL.
        "================================".PHP_EOL,
        FILE_APPEND
    );

    $payload = json_decode($input, true);

    try {

        $service = new WebhookService();

        $service->process($payload);

    } catch (Throwable $e) {

        file_put_contents(
    __DIR__.'/storage/logs/PAYLOAD.log',
    print_r($payload, true).PHP_EOL.
    "========================".PHP_EOL,
    FILE_APPEND
);

if (!isset($payload['entry'][0]['changes'][0]['value']['messages'])) {

    file_put_contents(
        __DIR__.'/storage/logs/PAYLOAD.log',
        "NO HAY MENSAJES".PHP_EOL,
        FILE_APPEND
    );

} else {

    file_put_contents(
        __DIR__.'/storage/logs/PAYLOAD.log',
        "SI HAY MENSAJES".PHP_EOL,
        FILE_APPEND
    );

}

    }

    http_response_code(200);
    echo "EVENT_RECEIVED";
    exit;
}