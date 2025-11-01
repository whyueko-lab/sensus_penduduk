<?php

namespace App\Controllers;

use App\Models\KotaModel;
use CodeIgniter\Controller;

class KotaController extends Controller
{
    public function index()
    {
    $model = new KotaModel();
    $data = $model->findAll();
    return $this->response->setJSON($data);
    }
    
    public function store()
    {
        $model = new KotaModel();
        $nama = $this->request->getPost('nama_kota');
        $id_provinsi = $this->request->getPost('id_provinsi');

        if ($nama && $id_provinsi) {
            $model->insert([
                'nama_kota' => $nama,
                'id_provinsi' => $id_provinsi
            ]);
            return $this->response->setJSON(['status' => 'success']);
        }
        return $this->response->setJSON(['status' => 'error']);
    }

    public function byProvinsi($id_provinsi)
    {
        $model = new KotaModel();
        $data = $model->where('id_provinsi', $id_provinsi)->findAll();
        return $this->response->setJSON($data);
    }
}
