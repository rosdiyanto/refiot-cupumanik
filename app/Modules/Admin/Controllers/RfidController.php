<?php

namespace App\Modules\Admin\Controllers;

use App\Controllers\BaseController;
use App\Modules\Admin\Models\RfidModel;

class RfidController extends BaseController
{
    protected $rfidModel;

    public function __construct()
    {
        $this->rfidModel = new RfidModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Daftar RFID',
            'content' => 'rfid',
        ];

        return module_view('main_view', 'Admin', $data);
    }

    public function getData()
    {
        $data = $this->rfidModel->getWithPegawai();

        $output = datatable_response_array($data, $this->request);
        
        return $this->response->setJSON($output);
    }
}
