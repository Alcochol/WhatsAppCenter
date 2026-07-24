<?php

namespace App\Controllers;

use App\Core\BaseController;

class BotController extends BaseController
{
    public function index()
    {
        $this->render('bot/index', [], 'app');
    }
}