<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSensusTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_penduduk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'id_kota' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM("L","P")',
                'null'       => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_kota', 'kota', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('sensus', true);
    }

    public function down()
    {
        $this->forge->dropTable('sensus', true);
    }
}
