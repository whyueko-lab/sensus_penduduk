<?php namespace App\Models;
use CodeIgniter\Model;

class SensusModel extends Model {
  protected $table = 'sensus';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'nama_penduduk','nik','alamat','id_kota','tanggal_lahir','jenis_kelamin'
  ];
  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
}
