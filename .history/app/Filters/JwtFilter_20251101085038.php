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
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader) {
            return Services::response()
                ->setJSON(['error' => 'Token tidak ditemukan'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        $token = explode(' ', $authHeader)[1] ?? '';

        $jwt = new JwtHandler();
        $decoded = $jwt->validateToken($token);

        if (!$decoded) {
            return Services::response()
                ->setJSON(['error' => 'Token tidak valid atau kadaluarsa'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        // Jika valid, simpan data user ke request
        $request->userData = $decoded->data;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelahnya
    }
}
