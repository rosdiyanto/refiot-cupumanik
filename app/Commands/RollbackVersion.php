<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class RollbackVersion extends BaseCommand
{
    protected $group       = 'Migration';
    protected $name        = 'rollback:version';
    protected $description = 'Rollback migration berdasarkan version, langsung load class dari database dan jalankan down()';

    public function run(array $params = [])
    {
        $version = $params[0] ?? null;

        if (!$version) {
            CLI::error('Usage: php spark rollback:version <version>');
            return;
        }

        $db = Database::connect();

        // Ambil class migrasi dari version
        $row = $db->table('migrations')
            ->where('version', $version)
            ->get()
            ->getRowArray();

        if (!$row) {
            CLI::error("Version {$version} tidak ditemukan di tabel migrations.");
            return;
        }

        // Tentukan nama class full
        $classFull = $row['class'];

        // Tentukan path file migrasi (tambahkan versi di filename jika perlu)
        $pathParts = explode('\\', $classFull);
        $className = end($pathParts);
        $filePath  = APPPATH . 'Database/Migrations/' . $version . '_' . $className . '.php';

        if (!file_exists($filePath)) {
            CLI::error("File migrasi {$filePath} tidak ditemukan.");
            return;
        }

        include_once $filePath;

        if (!class_exists($classFull)) {
            CLI::error("Class {$classFull} tidak ditemukan.");
            return;
        }

        // Instansiasi migrasi
        $migration = new $classFull();

        // Jalankan down()
        if (!method_exists($migration, 'down')) {
            CLI::error("Method down() tidak ditemukan di class {$classFull}.");
            return;
        }

        $migration->down();
        CLI::write("Method down() dijalankan pada class {$classFull}.");

        // Hapus record migration
        $db->table('migrations')
            ->where('version', $version)
            ->delete();

        CLI::write("Record migration {$version} berhasil dihapus dari tabel migrations.");
        CLI::write("Rollback selesai.");
    }
}
