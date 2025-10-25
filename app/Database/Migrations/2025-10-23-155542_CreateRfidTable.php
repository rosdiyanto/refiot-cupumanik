<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRfidTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => false,
            ],
            'kode_rfid' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
                'null'       => false,
                'comment'    => 'Kode unik tag RFID (serial number)',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'nonaktif', 'hilang', 'rusak'],
                'default'    => 'aktif',
                'null'       => false,
            ],
            'id_pegawai' => [
                'type'       => 'CHAR',
                'constraint' => 36,
                'null'       => true,
                'comment'    => 'Relasi ke pegawai jika ada',
            ],
            'tanggal_daftar' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true); // PRIMARY KEY
        $this->forge->createTable('rfid', true);
    }

    public function down()
    {
        $this->forge->dropTable('rfid', true);
    }
}
