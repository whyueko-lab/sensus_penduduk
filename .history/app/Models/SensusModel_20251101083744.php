<?php

namespace App\Models;

use CodeIgniter\Model;

class SensusModel extends Model
{
    protected $table = 'sensus';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_penduduk',
        'nik',
        'alamat',
        'id_kota',
        'tanggal_lahir',
        'jenis_kelamin'
    ];

    public function getAllData()
    {
        return $this->select('sensus.*, kota.nama_kota, provinsi.nama_provinsi')
                    ->join('kota', 'kota.id = sensus.id_kota', 'left')
                    ->join('provinsi', 'provinsi.id = kota.id_provinsi', 'left')
                    ->findAll();
    }

    public function search($keyword)
    {
        return $this->select('sensus.*, kota.nama_kota, provinsi.nama_provinsi')
                    ->join('kota', 'kota.id = sensus.id_kota', 'left')
                    ->join('provinsi', 'provinsi.id = kota.id_provinsi', 'left')
                    ->groupStart() // 🔹 mulai grouping
                        ->like('sensus.nama_penduduk', $keyword)
                        ->orLike('sensus.nik', $keyword)
                        ->orLike('sensus.alamat', $keyword)
                        ->orLike('kota.nama_kota', $keyword)
                        ->orLike('provinsi.nama_provinsi', $keyword)
                    ->groupEnd()   // 🔹 akhiri grouping
                    ->findAll();
    }
}
