<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DatatablesModel;

class DatatablesController extends BaseController
{
    protected $datatables_model;

    public function __construct()
    {
        // Inisialisasi model sekali saja
        $this->datatables_model = new DatatablesModel();
    }

    function ceking()
    {
        $model = new \App\Models\DatatablesModel();
        print_r(get_class_methods($model));
    }
    
    public function index()
    {
        return view('datatables/index');
    }

    public function getData()
    {
        $builder = $this->datatables_model->builder();

        $customColumns = [
            'action' => function ($row) {
                return '
                    <a href="' . site_url('datatables/edit/' . $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                    <a href="' . site_url('datatables/delete/' . $row->id) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin mau hapus data ini?\')">Hapus</a>
                ';
            },
        ];

        $output = datatable_response($builder, $this->request, $customColumns);
        return $this->response->setJSON($output);
    }

    public function create()
    {
        return view('datatables/form', [
            'title'  => 'Tambah Data',
            'action' => site_url('datatables/store'),
            'data'   => ['id' => '', 'nama' => '', 'email' => '', 'alamat' => ''],
        ]);
    }

    public function store()
    {
        $data = [
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $this->datatables_model->insert($data);

        return redirect()->to('datatables')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = $this->datatables_model->find($id);

        if (!$data) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data dengan ID $id tidak ditemukan");
        }

        return view('datatables/form', [
            'title'  => 'Edit Data',
            'action' => site_url('datatables/update/' . $id),
            'data'   => $data,
        ]);
    }

    public function update($id)
    {
        $data = [
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $this->datatables_model->update($id, $data);

        return redirect()->to('datatables')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->datatables_model->delete($id);

        return redirect()->to('datatables')->with('success', 'Data berhasil dihapus.');
    }
}
