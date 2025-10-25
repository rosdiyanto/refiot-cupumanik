<?php

namespace App\Modules\Admin\Controllers;

use App\Controllers\BaseController;
use App\Models\DatatablesModel;

class UserController extends BaseController
{
    // public function __construct()
    // {
    //     // Inisialisasi model hanya sekali
    //     $this->datatables_model = new DatatablesModel();
    // }

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'content' => 'user'
        ];

        return module_view('main_view', 'Admin', $data);
    }

    public function getData()
    {
        $query = $this->db->query("
            SELECT id, nama, email, alamat
            FROM datatables
        ");
        $result = $query->getResultArray();

        // Struktur JSON untuk Simple-DataTables
        $headings = ['ID', 'Nama', 'Email', 'Alamat', 'Aksi'];
        $data = [];

        foreach ($result as $row) {
            $data[] = [
                esc($row['id']),
                esc($row['nama']),
                esc($row['email']),
                esc($row['alamat']),
                '<a href="' . site_url('admin/edit/' . $row['id']) . '" class="btn btn-sm btn-warning me-1">Edit</a>
                <a href="' . site_url('admin/delete/' . $row['id']) . '" class="btn btn-sm btn-danger">Hapus</a>'
            ];
        }

        return $this->response->setJSON([
            'headings' => $headings,
            'data' => $data
        ]);
    }
}
