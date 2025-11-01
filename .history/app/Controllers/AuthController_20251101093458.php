<?php

namespace App\Controllers;

use App\Libraries\JwtHandler;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        helper(['form']);

        // Jika POST
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            if ($username === 'admin' && $password === '12345') {
            $jwt = new JwtHandler();
            $payload = [
                'username' => $username,
                'role' => 'admin'
            ];
            $token = $jwt->generateToken($payload);

            session()->set('jwt_token', $token);
            session()->set('username', $username);
            session()->setFlashdata('success', 'Selamat datang, ' . ucfirst($username) . '!');

            // ✅ Balasan untuk Postman atau API
            if ($this->request->getHeaderLine('Accept') === 'application/json' ||
                $this->request->isAJAX() ||
                $this->request->getHeaderLine('Content-Type') === 'application/json') {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Login berhasil',
                    'token' => $token
                ]);
            }

    // ✅ Balasan untuk browser biasa
    return redirect()->to('/sensus');
}


            // Jika gagal login
            session()->setFlashdata('error', 'Username atau password salah!');
            return view('auth/login');
        }

        // Jika GET
        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
