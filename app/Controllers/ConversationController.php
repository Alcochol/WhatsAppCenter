<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\Conversation;
use App\Models\Message;
use App\Services\WhatsAppClient;

class ConversationController extends BaseController
{
    protected Conversation $conversation;

    protected Message $message;

    protected WhatsAppClient $whatsapp;

    public function __construct()
    {
        $this->conversation = new Conversation();

        $this->message = new Message();

          $this->whatsapp = new WhatsAppClient();
    }

    public function index()
    {
        $this->render(
            'conversations/index',
            [],
            'app'
        );
    }

    public function list()
    {
        $data = $this->conversation->allWithContacts();

        return $this->json([
            'data' => $data
        ]);
    }

    public function messages()
    {
        $id = (int)($_GET['id'] ?? 0);

        if (!$id) {
            return $this->error(
                "Conversación inválida."
            );
        }

        $conversation =
            $this->conversation->findWithContact($id);

        if (!$conversation) {
            return $this->error(
                "La conversación no existe."
            );
        }

        $messages =
            $this->message->byConversation($id);

        return $this->json([
            'conversation' => $conversation,
            'messages' => $messages
        ]);
    }

    public function sendMessage()
{
    $conversationId = (int)($_POST['conversation_id'] ?? 0);

    $texto = trim($_POST['mensaje'] ?? '');

    if (!$conversationId) {
        return $this->error("Conversación inválida.");
    }

    if ($texto === '') {
        return $this->error("El mensaje no puede estar vacío.");
    }

    // Buscar conversación
    $conversation = $this->conversation
        ->findWithContact($conversationId);

    if (!$conversation) {
        return $this->error(
            "La conversación no existe."
        );
    }

    // Verificar que el contacto tenga teléfono
    $telefono = trim($conversation['telefono'] ?? '');

    if ($telefono === '') {
        return $this->error(
            "El contacto no tiene teléfono."
        );
    }

    // Enviar a WhatsApp
    $resultado = $this->whatsapp->sendText(
        $telefono,
        $texto
    );

    // Error CURL
    if (isset($resultado['curl_error'])) {
        return $this->error(
            "Error de conexión con WhatsApp: " .
            $resultado['curl_error']
        );
    }

    // Verificar respuesta de Meta
    if (($resultado['http_code'] ?? 0) < 200 ||
        ($resultado['http_code'] ?? 0) >= 300) {

        $mensajeError =
            $resultado['response']['error']['message']
            ?? 'No fue posible enviar el mensaje.';

        return $this->error(
            $mensajeError
        );
    }

    // Obtener ID del mensaje de WhatsApp
    $whatsappMessageId =
        $resultado['response']['messages'][0]['id']
        ?? null;

    // Guardar mensaje enviado
    $mensajeId = $this->message->createMensajes(
        $conversationId,
        $whatsappMessageId,
        $telefono,
        'Salida',
        'text',
        $texto,
        'enviado'
    );

    return $this->success(
        "Mensaje enviado correctamente.",
        [
            'id' => $mensajeId,
            'whatsapp_message_id' => $whatsappMessageId
        ]
    );
}
}