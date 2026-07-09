<?php

namespace App\Services;

class WhatsAppClient
{

    private $token;
    private $phoneNumberId;

    public function __construct()
    {

        $config = require __DIR__ . '/../../config/config.php';

        $this->token = $config['token'];
        $this->phoneNumberId = $config['phone_number_id'];

    }

    public function sendText($to, $message)
    {

        $url = "https://graph.facebook.com/v23.0/{$this->phoneNumberId}/messages";

        $data = [

            "messaging_product" => "whatsapp",

            "to" => $to,

            "type" => "text",

            "text" => [

                "body" => $message

            ]

        ];

        $curl = curl_init($url);

        curl_setopt_array($curl, [

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,

            CURLOPT_HTTPHEADER => [

                "Authorization: Bearer {$this->token}",

                "Content-Type: application/json"

            ],

            CURLOPT_POSTFIELDS => json_encode($data)

        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response, true);

    }

    public function getPhoneNumber()
{
    $url = "https://graph.facebook.com/v23.0/{$this->phoneNumberId}";

    $curl = curl_init($url);

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer {$this->token}"
        ]
    ]);

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response, true);
}

}