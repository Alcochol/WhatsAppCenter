<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\Dashboard;

class DashboardController extends BaseController
{
    public function index()
    {
        $dashboard = new Dashboard();

        $data = $dashboard->resumen();

    $this->render(
        'dashboard/index',
        [
            'data'=>$data
        ],
        'app'
        );
    }
}