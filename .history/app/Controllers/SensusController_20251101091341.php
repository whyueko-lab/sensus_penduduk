<?php

namespace App\Controllers;

use App\Models\SensusModel;
use App\Models\KotaModel;
use App\Models\ProvinsiModel;
use App\Libraries\JwtHandler;
use CodeIgniter\Controller;

class SensusController extends Controller
{
    protected $sensusModel;
    protected $kotaModel;
    protected $provinsiModel;
    protected $jwt;

    public function __construct()
    {
        $this->sensusModel = new SensusModel();
        $this->kotaModel = new KotaModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->jwt = new JwtHandler();
    }

    public function index()
    {
        // ✅ Cek apakah sudah login (ada token JWT)
        $token = session()->get('jwt_token');
        if (!$token) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // ✅ Validasi token JWT (opsional tapi disarankan)
        $decoded = $this->jwt->validateToken($token);
        if (!$decoded) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Sesi Anda telah berakhir, silakan login kembali.');
        }

        // ✅ Ambil data pengguna dari session
        $data['username'] = session()->get('username');
        $data['success'] = session()->getFlashdata('success') ?? null;

        // ✅ Fitur pencarian berdasarkan keyword (nama/nik/kota)
        $keyword = $this->request->getGet('keyword');
        if ($keyword) {
            $data['sensus'] = $this->sensusModel->search($keyword);
        } else {
            $data['sensus'] = $this->sensusModel->getAllData();
        }

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
            'nik'           => $this->request->getPost('nik'),
            'alamat'        => $this->request->getPost('alamat'),
            'id_kota'       => $this->request->getPost('id_kota'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ]);

        session()->setFlashdata('success', 'Data penduduk berhasil ditambahkan!');
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
            'nik'           => $this->request->getPost('nik'),
            'alamat'        => $this->request->getPost('alamat'),
            'id_kota'       => $this->request->getPost('id_kota'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ]);

        session()->setFlashdata('success', 'Data penduduk berhasil diperbarui!');
        return redirect()->to('/sensus');
    }

    public function delete($id)
    {
        $this->sensusModel->delete($id);
        session()->setFlashdata('success', 'Data penduduk berhasil dihapus!');
        return redirect()->to('/sensus');
    }

    // 🆕 Tambah provinsi baru
    public function addProvinsi()
    {
        $nama = $this->request->getPost('nama_provinsi');
        $this->provinsiModel->addProvinsi($nama);
        session()->setFlashdata('success', 'Provinsi baru berhasil ditambahkan!');
        return redirect()->to('/sensus/create');
    }

    // 🆕 Tambah kota baru
    public function addKota()
    {
        $id_provinsi = $this->request->getPost('id_provinsi');
        $nama_kota = $this->request->getPost('nama_kota');
        $this->kotaModel->addKota($id_provinsi, $nama_kota);
        session()->setFlashdata('success', 'Kota baru berhasil ditambahkan!');
        return redirect()->to('/sensus/create');
    }
}
