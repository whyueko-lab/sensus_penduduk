<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePendudukTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'kota_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kota_id', 'kota', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penduduk');
    }

    public function down()
    {
        $this->forge->dropTable('penduduk');
    }
}
