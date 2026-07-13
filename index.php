<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\WhatsAppController;

$controller = new WhatsAppController();

//use App\Services\WhatsAppClient;
//$whatsAppClient = new WhatsAppClient();

echo "<pre>";
print_r($controller->enviar());
echo "</pre>";