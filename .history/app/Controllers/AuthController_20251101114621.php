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

        // Jika session ada dan token valid, redirect ke /sensus
        if ($token && $this->jwt->validateToken($token)) {
            return redirect()->to('/sensus');
        }

        // Cek jika ada JWT dari query parameter (API login)
        $getToken = $this->request->getGet('token');
        if ($getToken && $this->jwt->validateToken($getToken)) {
            $decoded = $this->jwt->validateToken($getToken);

            // Buat session internal untuk browser
            session()->set('jwt_token', $getToken);
            session()->set('username', $decoded->username ?? 'admin');

            return redirect()->to('/sensus');
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
        }

        session()->setFlashdata('error', 'Username atau password salah!');
        return redirect()->to('/login');
    }

    // Logout
    public function logout()
    {
        session()->remove(['jwt_token', 'username']);
        session()->destroy();
        setcookie('ci_session', '', time() - 3600, '/');

        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }

    // API Login
    public function apiLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username === 'admin' && $password === '12345') {
            $payload = [
                'username' => $username,
                'role' => 'admin'
            ];

            $token = $this->jwt->generateToken($payload);

            // session browser otomatis dibuat via /login?token=xxx
            $redirectUrl = base_url('/login?token=' . $token);

            return $this->response->setJSON([
                'status' => 'success',
                'token' => $token,
                'login_browser_url' => $redirectUrl
            ]);
        }

        return $this->response->setStatusCode(401)->setJSON([
            'status' => 'error',
            'message' => 'Username atau password salah'
        ]);
    }
}
