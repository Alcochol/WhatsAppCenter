<?php

namespace App\Controllers;

use App\Core\BaseController;

class ReportController extends BaseController
{
    public function index()
    {
        $this->render('reports/index', [], 'app');
    }
}