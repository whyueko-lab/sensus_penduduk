<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $table = 'provinsi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_provinsi'];
    protected $useTimestamps = true;

    public function addProvinsi($nama_provinsi)
    {
        $exists = $this->where('nama_provinsi', $nama_provinsi)->first();

        if ($exists) return $exists['id'];

        return $this->insert(['nama_provinsi' => $nama_provinsi]);
    }
}
