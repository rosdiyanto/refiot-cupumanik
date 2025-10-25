<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DatatablesModel;
use CodeIgniter\HTTP\ResponseInterface;

class DatatablesController extends BaseController
{
    protected DatatablesModel $datatablesModel;

    public function __construct()
    {
        // Inisialisasi model
        $this->datatablesModel = new DatatablesModel();
    }

    public function index(): string
    {
        return view('datatables/index');
    }

    public function getData(): ResponseInterface
    {
        // Gunakan builder tapi pilih kolom spesifik agar tidak kena SELECT *
        $builder = $this->datatablesModel->builder()
            ->select(['id', 'nama', 'email', 'alamat']);

        // Kolom custom (misalnya kolom action di DataTables)
        $customColumns = [
            'action' => function ($row) {
                return '
                    <a href="' . site_url('datatables/edit/' . $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                    <a href="' . site_url('datatables/delete/' . $row->id) . '" class="btn btn-sm btn-danger" 
                    onclick="return confirm(\'Yakin mau hapus data ini?\')">Hapus</a>
                ';
            },
        ];

        /**
         * 🔧 Gunakan helper versi array agar query tidak diubah oleh helper.
         * Ini mencegah helper melakukan SELECT * ulang.
         */
        $data = $builder->get()->getResultArray();
        $output = datatable_response_array($data, $this->request, $customColumns);

        return $this->response->setJSON($output);
    }

    public function create(): string
    {
        return view('datatables/form', [
            'title'  => 'Tambah Data',
            'action' => site_url('datatables/store'),
            'data'   => ['id' => '', 'nama' => '', 'email' => '', 'alamat' => ''],
        ]);
    }

    public function store(): ResponseInterface
    {
        $data = [
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        // Validasi sederhana
        if (empty($data['nama']) || empty($data['email'])) {
            return redirect()->back()->with('error', 'Nama dan Email wajib diisi.');
        }

        $this->datatablesModel->insert($data);
        return redirect()->to('datatables')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id): string
    {
        $data = $this->datatablesModel->find($id);

        if (!$data) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data dengan ID $id tidak ditemukan");
        }

        return view('datatables/form', [
            'title'  => 'Edit Data',
            'action' => site_url('datatables/update/' . $id),
            'data'   => $data,
        ]);
    }

    public function update($id): ResponseInterface
    {
        $data = [
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        if (empty($data['nama']) || empty($data['email'])) {
            return redirect()->back()->with('error', 'Nama dan Email wajib diisi.');
        }

        $this->datatablesModel->update($id, $data);
        return redirect()->to('datatables')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id): ResponseInterface
    {
        if (!$this->datatablesModel->find($id)) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $this->datatablesModel->delete($id);
        return redirect()->to('datatables')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Debugging (opsional)
     */
    public function ceking(): void
    {
        $model = new DatatablesModel();
        echo '<pre>';
        print_r(get_class_methods($model));
        echo '</pre>';
    }
}
