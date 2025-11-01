<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $table = 'kota';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_provinsi', 'nama_kota'];
    protected $useTimestamps = true;

    public function getKotaWithProvinsi()
    {
        return $this->select('kota.*, provinsi.nama_provinsi')
                    ->join('provinsi', 'provinsi.id = kota.id_provinsi', 'left')
                    ->orderBy('provinsi.nama_provinsi', 'ASC')
                    ->orderBy('kota.nama_kota', 'ASC')
                    ->findAll();
    }

    public function addKota($id_provinsi, $nama_kota)
    {
        $exists = $this->where([
            'id_provinsi' => $id_provinsi,
            'nama_kota' => $nama_kota
        ])->first();

        if ($exists) return $exists['id'];

        return $this->insert([
            'id_provinsi' => $id_provinsi,
            'nama_kota' => $nama_kota
        ]);
    }
}
