<?php

namespace App\Controllers;

use App\Libraries\JwtHandler;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $jwt;

    public function __construct()
    {
        helper(['form', 'url']);
        session();
        $this->jwt = new JwtHandler();
    }

    public function login()
    {
        // Jika sudah login, langsung arahkan ke sensus
        if (session()->get('jwt_token')) {
            return redirect()->to('/sensus');
        }

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Login
            if ($username === 'admin' && $password === '12345') {
                $payload = [
                    'username' => $username,
                    'role' => 'admin'
                ];

                $token = $this->jwt->generateToken($payload);

                // Simpan token dan user ke session
                session()->set([
                    'jwt_token' => $token,
                    'username' => $username
                ]);

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
