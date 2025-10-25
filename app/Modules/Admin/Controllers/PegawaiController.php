<?php

namespace App\Modules\Admin\Controllers;

use App\Controllers\BaseController;
use App\Modules\Admin\Models\PegawaiModel;

class PegawaiController extends BaseController
{
    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'content' => 'pegawai'
        ];

        return module_view('main_view', 'Admin', $data);
    }

    public function getData()
    {
        $data = $this->pegawaiModel->builder()
            ->select(['nip_baru', 'nik', 'nama_pegawai', 'status_kepegawaian', 'jab_type', 'jabatan'])->get()->getResultArray();

        $output = datatable_response_array($data, $this->request);

        return $this->response->setJSON($output);
    }
}
