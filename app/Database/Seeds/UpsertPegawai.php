<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Modules\Admin\Models\PegawaiModel;

class UpsertPegawai extends Seeder
{
    public function run()
    {
        $model = new PegawaiModel();

        // Contoh 5 data pegawai untuk di-upsert
        $pegawaiData = [
            [
                'nip_baru'           => '1238',
                'nik'                => '1234567890123460',
                'nama_pegawai'       => 'Rudi Hartono',
                'tempat_lahir'       => 'Medan',
                'tanggal_lahir'      => '1982-09-10',
                'status_kepegawaian' => 'PNS',
                'jab_type'           => 'jfu',
                'nama_golongan'      => 'III/b',
                'nama_pangkat'       => 'Penata',
                'kode_unor'          => '12349',
                'kode_uk'            => '12349',
                'nama_unor'          => 'Dinas Pendidikan',
                'unit_kerja'         => 'Sekolah Menengah',
                'jabatan'            => 'Guru',
                'nama_ese'           => 'Eselon III',
                'kelas_jabatan'      => 'III',
                'jenjang_pendidikan' => 'S2',
            ],
        ];

        $totalInsert = 0;
        $totalUpdate = 0;

        foreach ($pegawaiData as $pegawai) {
            $existing = $model->where('nip_baru', $pegawai['nip_baru'])->first();

            if ($existing) {
                // Update
                $model->update($existing['id'], $pegawai);
                $totalUpdate++;
            } else {
                // Insert baru
                $model->insert($pegawai); // UUID otomatis
                $totalInsert++;
            }
        }

        // Tampilkan total
        echo "Total Insert: $totalInsert\n";
        echo "Total Update: $totalUpdate\n";
    }
}
