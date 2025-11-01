<?php

namespace App\Controllers;

use App\Libraries\JwtHandler;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        helper(['form']);

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

                // simpan ke session
                session()->set([
                    'jwt_token' => $token,
                    'username'  => $username
                ]);

                session()->setFlashdata('success', 'Selamat datang, ' . ucfirst($username) . '!');

                return redirect()->to('/sensus');
            }

            session()->setFlashdata('error', 'Username atau password salah!');
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
