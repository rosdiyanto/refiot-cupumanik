<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SimasnUpsertPegawai extends Seeder
{
    public function run()
    {
        // PENTING: Load helper sebelum pakai fungsi
        helper('simasn'); // nama file helper tanpa _helper.php

        echo "===== Start Upsert Pegawai from SIMASN =====\n";

        $result = upsertPegawaiMassal(200); // tambahkan backslash untuk pakai global namespace

        echo "===== SIMASN Upsert Summary =====\n";
        echo "Total Insert: {$result['insert']}\n";
        echo "Total Update: {$result['update']}\n";
        echo "=================================\n";
    }
}
