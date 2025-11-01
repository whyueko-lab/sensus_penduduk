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

    // Halaman login internal
    public function index()
    {
        $token = session()->get('jwt_token');

        if ($token) {
            $decoded = $this->jwt->validateToken($token);
            if ($decoded) {
                return redirect()->to('/sensus');
            } else {
                session()->destroy();
                setcookie('ci_session', '', time() - 3600, '/');
            }
        }

        return view('auth/login');
    }

    // Login internal (form login)
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username === 'admin' && $password === '12345') {

            $payload = [
                'username' => $username,
                'role' => 'admin'
            ];

            $token = $this->jwt->generateToken($payload);

            session()->set('jwt_token', $token);
            session()->set('username', $username);
            session()->setFlashdata('success', 'Selamat datang, ' . ucfirst($username) . '!');

            return redirect()->to('/sensus');
        } else {
            session()->setFlashdata('error', 'Username atau password salah!');
            return redirect()->to('/login');
        }
    }

    // Logout
    public function logout()
    {
        session()->remove(['jwt_token', 'username']);
        session()->destroy();
        setcookie('ci_session', '', time() - 3600, '/');
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }

    // API Login menggunakan JWT
    public function apiLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username === 'admin' && $password === '12345') {

            $payload = [
                'username' => $username,
                'role' => 'admin'
            ];

            // ✅ Generate JWT token
            $token = $this->jwt->generateToken($payload);

            // ✅ Simpan token ke session internal supaya bisa akses /sensus
            session()->set('jwt_token', $token);
            session()->set('username', $username);

            return $this->response->setJSON([
                'status' => 'success',
                'token' => $token
            ]);
        }

        return $this->response->setStatusCode(401)->setJSON([
            'status' => 'error',
            'message' => 'Username atau password salah'
        ]);
    }
}
