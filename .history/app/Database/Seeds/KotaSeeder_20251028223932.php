<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KotaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_kota' => 'Bandung', 'id_provinsi' => 1],
            ['nama_kota' => 'Semarang', 'id_provinsi' => 2],
            ['nama_kota' => 'Surabaya', 'id_provinsi' => 3],
        ];

        $this->db->table('kota')->insertBatch($data);
    }
}
