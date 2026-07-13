<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Conversation;
use App\Models\Message;

class WebhookService
{
    public function process(array $payload)
        {

            file_put_contents(
                __DIR__.'/../../storage/logs/debug.log',
                "====================\n",
                FILE_APPEND
            );

            file_put_contents(
                __DIR__.'/../../storage/logs/debug.log',
                "Entró a process()\n",
                FILE_APPEND
            );

            file_put_contents(
                __DIR__.'/../../storage/logs/debug.log',
                print_r($payload,true),
                FILE_APPEND
            );

            if(
                !isset($payload['entry'][0]['changes'][0]['value']['messages'][0])
            ){

                file_put_contents(
                    __DIR__.'/../../storage/logs/debug.log',
                    "No existe messages\n",
                    FILE_APPEND
                );

                return;
            }

            $msg = $payload['entry'][0]['changes'][0]['value']['messages'][0];

            file_put_contents(
                __DIR__.'/../../storage/logs/debug.log',
                print_r($msg,true),
                FILE_APPEND
            );

            $telefono = $msg['from'] ?? '';
            $mensaje = $msg['text']['body'] ?? '';
            $whatsappId = $msg['id'] ?? '';

            $contactModel = new Contact();

            $contact = $contactModel->findByPhone($telefono);

            if(!$contact){

                $contactId = $contactModel->create($telefono,"Sin nombre");

            }else{

                $contactId = $contact['id'];

            }

            $conversationModel = new Conversation();

            $conversation = $conversationModel->findOpenConversation($contactId);

            if(!$conversation){

                $conversationId = $conversationModel->create($contactId);

            }else{

                $conversationId = $conversation['id'];

            }

            $messageModel = new Message();

            $messageModel->create(
                $conversationId,
                $whatsappId,
                $telefono,
                "Entrada",
                "text",
                $mensaje
            );

            file_put_contents(
                __DIR__.'/../../storage/logs/debug.log',
                "Mensaje guardado correctamente\n",
                FILE_APPEND
            );

        }
}