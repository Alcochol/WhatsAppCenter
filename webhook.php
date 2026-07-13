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

    // Guardar el JSON para depuración
    file_put_contents(
        __DIR__ . '/storage/logs/webhook.log',
        date('Y-m-d H:i:s') . PHP_EOL .
        $input . PHP_EOL . PHP_EOL,
        FILE_APPEND
    );

    $payload = json_decode($input, true);


    file_put_contents(
    __DIR__ . '/storage/logs/prueba.txt',
    'ANTES DEL SERVICE' . PHP_EOL,
    FILE_APPEND
        );

    $service = new WebhookService();
    $service->process($payload);

    http_response_code(200);
    echo "EVENT_RECEIVED";
    exit;

}