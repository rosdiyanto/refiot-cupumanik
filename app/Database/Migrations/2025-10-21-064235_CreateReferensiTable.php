<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReferensiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'CHAR',
                'constraint'     => 36,
                'null'           => false,
            ],
            'group_reff' => [
                'type'           => 'CHAR',
                'constraint'     => 36,
                'null'           => false,
            ],
            'id_value' => [
                'type'           => 'CHAR',
                'constraint'     => 36,
                'null'           => false,
            ],
            'name_reff' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => false,
            ],
            'value_reff' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'order' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default'        => 0,
            ],
            'keterangan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true,
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary key
        $this->forge->createTable('referensi');

        // // Panggil seeder dengan instance database
        // $seeder = \Config\Database::seeder();
        // $seeder->call('ReferensiSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('referensi');
    }
}
