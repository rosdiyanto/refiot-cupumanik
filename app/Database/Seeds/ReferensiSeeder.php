<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;

class ReferensiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id'         => Uuid::uuid4()->toString(),
            'code_reff'  => 'b20f8f6a-89f3-4d27-9b2d-123456789abc',
            'group_reff' => 'a10e7d5b-78e2-4c16-8a1c-abcdef123456',
            'nama_reff'  => 'Status Pegawai',
            'value_reff' => 'Aktif',
            'order'      => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('referensi')->insert($data);
    }
}
