<?php

namespace App\Controllers;

use App\Libraries\JwtHandler;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 🔐 Contoh login sederhana (kamu bisa ganti dengan model User)
        if ($username === 'admin' && $password === '12345') {
            $jwt = new JwtHandler();
            $payload = [
                'username' => $username,
                'role' => 'admin'
            ];
            $token = $jwt->generateToken($payload);

            return $this->response->setJSON([
                'message' => 'Login berhasil',
                'token' => $token
            ]);
        }

        return $this->response->setJSON([
            'message' => 'Username atau password salah'
        ])->setStatusCode(401);
    }
}
