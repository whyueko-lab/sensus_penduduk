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
        helper(['form', 'url']);
    }

    /**
     * Halaman utama menampilkan daftar sensus
     */
    public function index()
    {
        $data = [
            'title' => 'Data Sensus Penduduk',
            'sensus' => $this->sensusModel->getAllData(),
        ];
        return view('sensus/index', $data);
    }

    /**
     * Form tambah data sensus
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Sensus',
            'kota' => $this->kotaModel->getKotaWithProvinsi(),
            'provinsi' => $this->provinsiModel->findAll(),
        ];
        return view('sensus/create', $data);
    }

    /**
     * Simpan data sensus baru
     */
    public function store()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_penduduk' => 'required|min_length[3]',
            'nik' => 'required|numeric|min_length[8]|is_unique[sensus.nik]',
            'alamat' => 'required',
            'id_kota' => 'required|numeric',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->sensusModel->save([
            'nama_penduduk' => $this->request->getPost('nama_penduduk'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'id_kota' => $this->request->getPost('id_kota'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ]);

        return redirect()->to('/sensus')->with('success', 'Data sensus berhasil disimpan!');
    }

    /**
     * Form edit sensus
     */
    public function edit($id)
    {
        $sensus = $this->sensusModel->find($id);
        if (!$sensus) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data sensus dengan ID $id tidak ditemukan");
        }

        $data = [
            'title' => 'Edit Data Sensus',
            'sensus' => $sensus,
            'kota' => $this->kotaModel->getKotaWithProvinsi(),
        ];
        return view('sensus/edit', $data);
    }

    /**
     * Update data sensus
     */
    public function update($id)
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_penduduk' => 'required|min_length[3]',
            'nik' => "required|numeric|min_length[8]|is_unique[sensus.nik,id,{$id}]",
            'alamat' => 'required',
            'id_kota' => 'required|numeric',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->sensusModel->update($id, [
            'nama_penduduk' => $this->request->getPost('nama_penduduk'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'id_kota' => $this->request->getPost('id_kota'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ]);

        return redirect()->to('/sensus')->with('success', 'Data sensus berhasil diperbarui!');
    }

    /**
     * Hapus data sensus
     */
    public function delete($id)
    {
        $this->sensusModel->delete($id);
        return redirect()->to('/sensus')->with('success', 'Data sensus berhasil dihapus!');
    }

    /**
     * Tambah provinsi baru (opsional)
     */
    public function tambahProvinsi()
    {
        $nama = $this->request->getPost('nama_provinsi');
        if ($this->provinsiModel->addProvinsi($nama)) {
            return redirect()->back()->with('success', 'Provinsi baru berhasil ditambahkan');
        }
        return redirect()->back()->with('error', 'Provinsi sudah ada!');
    }

    /**
     * Tambah kota baru (opsional)
     */
    public function tambahKota()
    {
        $id_provinsi = $this->request->getPost('id_provinsi');
        $nama_kota = $this->request->getPost('nama_kota');
        if ($this->kotaModel->addKota($id_provinsi, $nama_kota)) {
            return redirect()->back()->with('success', 'Kota baru berhasil ditambahkan');
        }
        return redirect()->back()->with('error', 'Kota sudah ada di provinsi ini!');
    }
}
