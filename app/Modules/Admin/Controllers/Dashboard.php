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

        // Panggil helper module_view sesuai urutan: view, module, data
        return module_view('dashboard', 'Admin', $data);
    }
}
