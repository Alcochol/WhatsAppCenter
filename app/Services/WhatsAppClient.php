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

    /*public function sendText($to, $message)
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

        if ($response === false) {
            die(curl_error($curl));
        }

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return [
            'http_code' => $httpCode,
            'request' => $data,
            'response' => json_decode($response, true)
        ];

    }*/

    public function sendText($to, $message)
    {
        $url = "https://graph.facebook.com/v23.0/{$this->phoneNumberId}/messages";

    $data = [

        "messaging_product" => "whatsapp",

        "recipient_type" => "individual",

        "to" => $to,

        "type" => "text",

        "text" => [
            "preview_url" => false,
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
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_TIMEOUT => 30,
            CURLOPT_VERBOSE => true
        ]);

        $response = curl_exec($curl);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($response === false) {
            return [
                'curl_error' => curl_error($curl)
            ];
        }

        curl_close($curl);

        return [
            'http_code' => $httpCode,
            'request' => $data,
            'response_raw' => $response,
            'response' => json_decode($response, true)
        ];
    }

    /*public function getPhoneNumber()
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
    }*/


}