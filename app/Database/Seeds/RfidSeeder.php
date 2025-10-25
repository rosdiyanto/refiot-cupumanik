<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Modules\Admin\Models\RfidModel;

class RfidSeeder extends Seeder
{
    public function run()
    {
        helper('text');
        $model = new RfidModel();

        // Loop untuk 100 data
        for ($i = 1; $i <= 100; $i++) {
            $status = ($i % 2 == 0) ? 'aktif' : 'nonaktif'; // selang-seling status
            $keterangan = ($status === 'aktif')
                ? 'Kartu RFID pegawai ke-' . $i
                : 'Kartu RFID tamu sementara ke-' . $i;

            $data = [
                'kode_rfid'      => 'RFID' . strtoupper(random_string('alnum', 8)),
                'status'         => $status,
                'tanggal_daftar' => date('Y-m-d', strtotime("-" . rand(0, 30) . " days")),
                'keterangan'     => $keterangan,
            ];

            $model->insert($data); // panggil satu per satu agar beforeInsert() tetap dijalankan
        }
    }
}
