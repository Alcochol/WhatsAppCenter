<?php

use App\Core\BaseController;

class DashboardController extends BaseController
{

    public function index()
    {

        $dashboard = new Dashboard();

        return $dashboard->resumen();

    }

}

