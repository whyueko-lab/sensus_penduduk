<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $table = 'kota';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kota', 'id_provinsi'];

    public function getKotaWithProvinsi()
    {
        return $this->select('kota.*, provinsi.nama_provinsi')
                    ->join('provinsi', 'provinsi.id = kota.id_provinsi')
                    ->findAll();
    }
}
