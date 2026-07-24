<?php

namespace App\Controllers;

use App\Core\BaseController;

class SettingController extends BaseController
{
    public function index()
    {
        $this->render('settings/index', [], 'app');
    }
}