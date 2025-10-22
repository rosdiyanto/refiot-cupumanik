<?php

namespace App\Modules\Admin\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'content' => 'user'
        ];

        return module_view('main_view', 'Admin', $data);
    }
}
