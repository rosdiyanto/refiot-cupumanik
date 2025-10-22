<?php

namespace App\Modules\Admin\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'content' => 'dashboard'
        ];

        return module_view('main_view', 'Admin', $data);
    }
}
