<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKotaTable extends Migration
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
            'nama_kota' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_provinsi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_provinsi', 'provinsi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kota', true);
    }

    public function down()
    {
        $this->forge->dropTable('kota', true);
    }
}
