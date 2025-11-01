<?php namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Libraries\JwtHandler;

class AuthFilter implements FilterInterface {
  public function before(RequestInterface $request, $arguments = null) {
    $header = $request->getServer('HTTP_AUTHORIZATION');
    if (!$header) {
      return service('response')->setStatusCode(401)->setJSON(['status'=>401,'error'=>'Unauthorized','message'=>'Missing Authorization Header']);
    }
    if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
      $token = $matches[1];
      $jwt = new JwtHandler();
      $decoded = $jwt->validateToken($token);
      if (!$decoded) {
        return service('response')->setStatusCode(401)->setJSON(['status'=>401,'error'=>'Unauthorized','message'=>'Invalid or expired token']);
      }
      // optionally set user data to request: $request->user = $decoded->data
      return;
    } else {
      return service('response')->setStatusCode(401)->setJSON(['status'=>401,'error'=>'Unauthorized','message'=>'Malformed Authorization Header']);
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
