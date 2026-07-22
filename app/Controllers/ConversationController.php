<?php

namespace App\Controllers;

use App\Models\Conversation;

class ConversationController
{
    public function index()
    {
        $model = new Conversation();

        return $model->getAll();
    }
}