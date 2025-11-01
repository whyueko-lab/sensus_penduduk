<?php

namespace App\Controllers;

use App\Models\SensusModel;
use App\Models\KotaModel;
use App\Models\ProvinsiModel;
use CodeIgniter\Controller;

class SensusController extends Controller
{
    protected $sensusModel;
    protected $kotaModel;
    protected $provinsiModel;

    public function __construct()
    {
        $this->sensusModel = new SensusModel();
        $this->kotaModel = new KotaModel();
        $this->provinsiModel = new ProvinsiModel();
    }

    public function index()
    {
        $data['sensus'] = $this->sensusModel->getAllData();
        return view('sensus/index', $data);
    }

    public function create()
    {
        $data['kota'] = $this->kotaModel->getKotaWithProvinsi();
        return view('sensus/create', $data);
    }

    public function store()
    {
        $this->sensusModel->save([
            'nama_penduduk' => $this->request->getPost('nama_penduduk'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'id_kota' => $this->request->getPost('id_kota'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ]);
        return redirect()->to('/sensus');
    }

    public function edit($id)
    {
        $data['sensus'] = $this->sensusModel->find($id);
        $data['kota'] = $this->kotaModel->getKotaWithProvinsi();
        return view('sensus/edit', $data);
    }

    public function update($id)
    {
        $this->sensusModel->update($id, [
            'nama_penduduk' => $this->request->getPost('nama_penduduk'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'id_kota' => $this->request->getPost('id_kota'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ]);
        return redirect()->to('/sensus');
    }

    public function delete($id)
    {
        $this->sensusModel->delete($id);
        return redirect()->to('/sensus');
    }
}
