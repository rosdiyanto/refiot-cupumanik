<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class SeedAllCommand extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:seedall';
    protected $description = 'Menjalankan semua seeder yang ada di folder app/Database/Seeds';

    public function run(array $params = [])
    {
        $seeder = \Config\Database::seeder();

        // Ambil semua file seeder di folder Seeds
        $files = glob(APPPATH . 'Database/Seeds/*.php');

        foreach ($files as $file) {
            $class = pathinfo($file, PATHINFO_FILENAME);

            // Lewati BaseSeeder atau MainSeeder jika ada
            if ($class === 'BaseSeeder' || $class === 'MainSeeder') {
                continue;
            }

            CLI::write("Menjalankan seeder: $class", 'yellow');
            $seeder->call($class);
        }

        CLI::write("Semua seeder selesai dijalankan!", 'green');
    }
}
