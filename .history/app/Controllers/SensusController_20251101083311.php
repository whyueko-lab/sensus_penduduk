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
         $keyword = $this->request->getGet('keyword');
    if ($keyword) {
        $data['sensus'] = $this->sensusModel->search($keyword);
    } else {
        $data['sensus'] = $this->sensusModel->getAllData();
    }
    
        $data['sensus'] = $this->sensusModel->getAllData();
        return view('sensus/index', $data);
    }

    public function create()
    {
        $data['provinsi'] = $this->provinsiModel->findAll();
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
        $data['provinsi'] = $this->provinsiModel->findAll();
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

    // 🆕 Tambah provinsi baru
    public function addProvinsi()
    {
        $nama = $this->request->getPost('nama_provinsi');
        $this->provinsiModel->addProvinsi($nama);
        return redirect()->to('/sensus/create');
    }

    // 🆕 Tambah kota baru
    public function addKota()
    {
        $id_provinsi = $this->request->getPost('id_provinsi');
        $nama_kota = $this->request->getPost('nama_kota');
        $this->kotaModel->addKota($id_provinsi, $nama_kota);
        return redirect()->to('/sensus/create');
    }
}
