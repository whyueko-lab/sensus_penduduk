<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $table = 'kota';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_provinsi', 'nama_kota'];

    // Cek apakah kota sudah ada di provinsi tertentu
    public function exists($id_provinsi, $nama_kota)
    {
        return $this->where(['id_provinsi' => $id_provinsi, 'nama_kota' => $nama_kota])->first();
    }

    // Tambah kota baru jika belum ada
    public function addKota($id_provinsi, $nama_kota)
    {
        if (!$this->exists($id_provinsi, $nama_kota)) {
            return $this->insert(['id_provinsi' => $id_provinsi, 'nama_kota' => $nama_kota]);
        }
        return false; // Sudah ada
    }
}
