<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\JwtHandler;

class AuthController extends Controller
{
    protected $jwt;

    public function __construct()
    {
        $this->jwt = new JwtHandler();
    }

    public function index()
    {
        // kalau sudah login langsung ke halaman sensus
        if (session()->get('jwt_token')) {
            return redirect()->to('/sensus');
        }
        return view('auth/login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // ✅ Validasi sederhana
        if ($username === 'admin' && $password === '12345') {

            // ✅ Buat payload JWT
            $payload = [
                'username' => $username,
                'role' => 'admin',
            ];

            // ✅ Generate token JWT
            $token = $this->jwt->generateToken($payload);

            // ✅ Simpan token dan username ke session
            session()->set('jwt_token', $token);
            session()->set('username', $username);
            session()->setFlashdata('success', 'Selamat datang, ' . ucfirst($username) . '!');

            // ✅ Redirect ke halaman sensus
            return redirect()->to('/sensus');
        } else {
            session()->setFlashdata('error', 'Username atau password salah!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        // Hapus semua session
    session()->remove(['jwt_token', 'username']);
    session()->destroy();

    // Hapus cookie CI agar tidak terbaca ulang
    setcookie('ci_session', '', time() - 3600, '/');

    // Redirect ke login dengan pesan
    return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }
}
