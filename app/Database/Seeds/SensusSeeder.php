<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SensusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_penduduk' => 'Wahyu Eko Suroso',
                'nik' => '3276012300010001',
                'alamat' => 'Jl. Merdeka No. 10, Bandung',
                'id_kota' => 1,
                'tanggal_lahir' => '1999-02-14',
                'jenis_kelamin' => 'L'
            ],
            [
                'nama_penduduk' => 'Dewi Lestari',
                'nik' => '3375014400020002',
                'alamat' => 'Jl. Pandanaran No. 25, Semarang',
                'id_kota' => 2,
                'tanggal_lahir' => '1998-05-22',
                'jenis_kelamin' => 'P'
            ],
        ];

        $this->db->table('sensus')->insertBatch($data);
    }
}
