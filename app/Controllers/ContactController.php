<?php

namespace App\Controllers;

use App\Core\BaseController;

class ContactController extends BaseController
{
    public function index()
    {
        $this->render('contacts/index', [], 'app');
    }
}