<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Libraries\JwtHandler;

class JwtFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $jwt = new JwtHandler();

        // Ambil token dari Header Authorization atau dari session
        $authHeader = $request->getHeaderLine('Authorization');
        $token = null;

        if ($authHeader && strpos($authHeader, 'Bearer ') === 0) {
            $token = substr($authHeader, 7);
        } elseif ($session->has('jwt_token')) {
            $token = $session->get('jwt_token');
        }

        // Kalau token kosong → tidak boleh lanjut
        if (!$token) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi khusus setelah
    }
}
