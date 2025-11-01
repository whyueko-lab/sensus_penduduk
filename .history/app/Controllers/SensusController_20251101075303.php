<?php

namespace App\Controllers;

use App\Models\SensusModel;
use App\Models\ProvinsiModel;
use CodeIgniter\Controller;

class SensusController extends Controller
{
    protected $sensusModel;
    protected $provinsiModel;

    public function __construct()
    {
        $this->sensusModel = new SensusModel();
        $this->provinsiModel = new ProvinsiModel();
    }

    public function index()
    {
        $data['sensus'] = $this->sensusModel->getAllData();
        return view('sensus/index', $data);
    }

    public function create()
    {
        // ambil semua provinsi untuk dropdown
        $data['provinsi'] = $this->provinsiModel->findAll();
        return view('sensus/create', $data);
    }

    public function store()
    {
        $this->sensusModel->insert([
            'nama_penduduk' => $this->request->getPost('nama_penduduk'),
            'umur' => $this->request->getPost('umur'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'provinsi_id' => $this->request->getPost('provinsi_id')
        ]);

        return redirect()->to('/sensus');
    }
}
