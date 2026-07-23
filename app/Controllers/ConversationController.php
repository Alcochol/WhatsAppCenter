<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\Conversation;

class ConversationController  extends BaseController
{
    
    public function index()
    {
       
        $model = new Conversation();

        return $model->getAll();
    }
}