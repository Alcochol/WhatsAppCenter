<?php

require 'vendor/autoload.php';

use App\Models\Message;

$message = new Message();

$id = $message->create(
    1,
    'wamid.prueba123',
    '5213117439200',
    'Entrada',
    'text',
    'Hola desde prueba'
);

echo $id;