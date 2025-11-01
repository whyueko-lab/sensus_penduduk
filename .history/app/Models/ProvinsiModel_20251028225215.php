<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $table = 'provinsi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_provinsi'];

    // Cek apakah provinsi sudah ada
    public function exists($nama_provinsi)
    {
        return $this->where('nama_provinsi', $nama_provinsi)->first();
    }

    // Tambah provinsi baru jika belum ada
    public function addProvinsi($nama_provinsi)
    {
        if (!$this->exists($nama_provinsi)) {
            return $this->insert(['nama_provinsi' => $nama_provinsi]);
        }
        return false; // Sudah ada
    }
}
