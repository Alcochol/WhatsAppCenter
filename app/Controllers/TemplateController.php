<?php

namespace App\Controllers;

use App\Core\BaseController;

class TemplateController extends BaseController
{
    public function index()
    {
        $this->render('templates/index', [], 'app');
    }
}