<?php

namespace App\Models;

use CodeIgniter\Model;

class SensusModel extends Model
{
    protected $table = 'sensus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_penduduk', 'umur', 'jenis_kelamin', 'provinsi_id'];

    public function getAllData()
    {
        return $this->select('sensus.*, provinsi.nama_provinsi')
                    ->join('provinsi', 'provinsi.id = sensus.provinsi_id', 'left')
                    ->findAll();
    }
}
