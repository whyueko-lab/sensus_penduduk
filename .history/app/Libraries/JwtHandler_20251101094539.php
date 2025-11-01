<?php namespace App\Libraries;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandler {
  protected $secretKey;
  public function __construct() 
  {
    $this->secretKey = getenv('JWT_SECRET') ?: 'rahasia_super_kuat_jangan_dibocorkan';
  }

  public function generateToken($payload, $expDays = 5) {
    $now = time();
    $exp = $now + ($expDays * 24 * 60 * 60); // 5 hari
    $token = [
      'iat' => $now,
      'exp' => $exp,
      'data' => $payload
    ];
    return JWT::encode($token, $this->secretKey, 'HS256');
  }

  public function validateToken($jwt) {
    try {
      $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));
      return $decoded;
    } catch (\Exception $e) {
      return null;
    }
  }
}
