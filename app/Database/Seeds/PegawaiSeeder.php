<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Modules\Admin\Models\PegawaiModel;
use Ramsey\Uuid\Uuid;
use Faker\Factory;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');
        $pegawaiModel = new PegawaiModel();

        for ($i = 1; $i <= 100; $i++) {
            $pegawaiModel->insert([
                // biarkan hook generate UUID untuk 'id'
                'nama'          => $faker->name,
                'nip'           => $faker->unique()->numerify('1987########'),
                'id_group'      => Uuid::uuid4()->toString(), // unik tiap pegawai
                'jabatan'       => $faker->jobTitle,
                'golongan'      => $faker->randomElement(['I/a','II/b','III/c','IV/d']),
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'alamat'        => $faker->address,
            ]);
        }

        echo "Seeder 100 pegawai berhasil dijalankan.\n";
    }
}
