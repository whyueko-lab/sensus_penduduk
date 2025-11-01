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
        $keyword = strtolower(trim($keyword));

        $results = $this->select('sensus.*, kota.nama_kota, provinsi.nama_provinsi')
                        ->join('kota', 'kota.id = sensus.id_kota', 'left')
                        ->join('provinsi', 'provinsi.id = kota.id_provinsi', 'left')
                        ->findAll();

        // Filter manual hasil pencarian supaya lebih akurat
        return array_values(array_filter($results, function ($row) use ($keyword) {
            return strpos(strtolower($row['nama_penduduk']), $keyword) !== false ||
                strpos(strtolower($row['nik']), $keyword) !== false ||
                strpos(strtolower($row['alamat']), $keyword) !== false ||
                strpos(strtolower($row['nama_kota']), $keyword) !== false ||
                strpos(strtolower($row['nama_provinsi']), $keyword) !== false;
        }));
    }
}
