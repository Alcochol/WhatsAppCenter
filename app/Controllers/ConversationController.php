<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\Conversation;
use App\Models\Message;


class ConversationController extends BaseController
{
    protected Conversation $conversation;

    protected Message $message;

    public function __construct()
    {
        $this->conversation = new Conversation();

        $this->message = new Message();
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
}