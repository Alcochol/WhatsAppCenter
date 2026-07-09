<?php

namespace App\Controllers;

use App\Services\WhatsAppClient;

class WhatsAppController
{
    private WhatsAppClient $client;

    public function __construct()
    {
        $this->client = new WhatsAppClient();
    }

    public function enviar()
    {
        $telefono = "5213117439200"; // Tu número para pruebas

        $mensaje = "Hola Ángel 👋\n\nEste mensaje fue enviado desde tu sistema PHP.";

        return $this->client->sendText($telefono, $mensaje);
    }
}