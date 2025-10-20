<?php

namespace Modules\Admin\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
        ];

        return module_view('dashboard', 'Admin', $data);
    }
}
