<?php

namespace App\Controllers;

use App\Models\ProvinsiModel;
use CodeIgniter\Controller;

class ProvinsiController extends Controller
{
    public function index()
    {
        $model = new ProvinsiModel();
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }

    public function store()
    {
        $model = new ProvinsiModel();
        $nama = $this->request->getPost('nama_provinsi');

        if ($nama) {
            $model->insert(['nama_provinsi' => $nama]);
            return $this->response->setJSON(['status' => 'success']);
        }
        return $this->response->setJSON(['status' => 'error']);
    }

    public function update($id)
    {
        $model = new ProvinsiModel();

    // Jika pakai raw JSON:
        $input = json_decode($this->request->getBody(), true);
        $nama = $input['nama_provinsi'] ?? null;

    if($nama){
        $model->update($id, ['nama_provinsi' => $nama]);
        return $this->response->setJSON(['status' => 'success']);
    }

    return $this->response->setJSON(['status' => 'error', 'message' => 'Nama provinsi kosong']);
}
}
