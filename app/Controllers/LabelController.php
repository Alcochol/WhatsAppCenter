<?php

namespace App\Controllers;

use App\Core\BaseController;

class LabelController extends BaseController
{
    public function index()
    {
        $this->render('labels/index', [], 'app');
    }
}