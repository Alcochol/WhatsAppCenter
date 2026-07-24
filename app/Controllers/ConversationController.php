<?php

namespace App\Controllers;

use App\Core\BaseController;

class ConversationController extends BaseController
{
    public function index()
    {
        $this->render('conversations/index', [], 'app');
    }
}