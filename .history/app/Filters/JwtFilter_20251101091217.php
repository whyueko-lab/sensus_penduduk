<?php

namespace App\Filters;

use App\Libraries\JwtHandler;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class JwtFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $jwt = session()->get('jwt_token');

        if (!$jwt) {
            return redirect()->to('/login');
        }

        $jwtLib = new JwtHandler();
        $decoded = $jwtLib->validateToken($jwt);

        if (!$decoded) {
            session()->remove('jwt_token');
            return redirect()->to('/login');
        }

        // Simpan data user ke request agar bisa diakses controller lain
        $request->userData = (array)$decoded->data;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu diisi
    }
}
  