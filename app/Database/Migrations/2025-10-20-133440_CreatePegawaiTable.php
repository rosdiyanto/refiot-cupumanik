<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePegawaiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36, // UUID string
                'null'       => false,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'unique'     => true,
            ],
            'id_group' => [
                'type'       => 'CHAR',
                'constraint' => 36, // UUID string
                'null'       => true,
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'golongan' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'alamat' => [
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

        $this->forge->addKey('id', true); // primary key → otomatis unik
        $this->forge->addKey('id_group'); // index tambahan jika sering query berdasarkan group
        $this->forge->createTable('pegawai');
    }

    public function down()
    {
        $this->forge->dropTable('pegawai');
    }
}
