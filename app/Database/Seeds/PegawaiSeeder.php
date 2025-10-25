<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Modules\Admin\Models\PegawaiModel;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Faker untuk Indonesia
        $model = new PegawaiModel();

        for ($i = 1; $i <= 100; $i++) {
            $data = [
                'nip_baru'           => '19876543' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nik'                => $faker->nik(),
                'nama_pegawai'       => $faker->name(),
                'tempat_lahir'       => $faker->city(),
                'tanggal_lahir'      => $faker->date('Y-m-d', '2000-12-31'),
                'status_kepegawaian' => $faker->randomElement(['PNS', 'PPP', 'HONOR']),
                'jab_type'           => $faker->randomElement(['js', 'jfu', 'jft']),
                'nama_golongan'      => $faker->randomElement(['III/a', 'III/b', 'III/c']),
                'nama_pangkat'       => $faker->randomElement(['Penata Muda', 'Penata', 'Penata Tingkat I']),
                'kode_unor'          => str_pad($faker->numberBetween(10000, 99999), 5, '0', STR_PAD_LEFT),
                'kode_uk'            => str_pad($faker->numberBetween(10000, 99999), 5, '0', STR_PAD_LEFT),
                'nama_unor'          => $faker->company(),
                'unit_kerja'         => $faker->word(),
                'jabatan'            => $faker->jobTitle(),
                'nama_ese'           => $faker->randomElement(['Eselon I', 'Eselon II', 'Eselon III']),
                'kelas_jabatan'      => $faker->randomElement(['I', 'II', 'III']),
                'jenjang_pendidikan' => $faker->randomElement(['S1', 'S2', 'S3']),
            ];

            $model->upsert($data);
        }

        echo "100 data pegawai berhasil ditambahkan.\n";
    }
}
