<?php namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Libraries\JwtHandler;

class AuthController extends ResourceController {
  public function login() {
    $json = $this->request->getJSON();
    $username = $json->username ?? null;
    $password = $json->password ?? null;
    if (!$username || !$password) {
      return $this->respond(['status'=>400,'message'=>'username and password required'],400);
    }
    $um = new UserModel();
    $user = $um->where('username',$username)->first();
    if (!$user || !password_verify($password,$user['password'])) {
      return $this->respond(['status'=>401,'message'=>'Username atau password salah'],401);
    }
    $jwt = new JwtHandler();
    $payload = ['id'=>$user['id'],'username'=>$user['username'],'role'=>$user['role']];
    $token = $jwt->generateToken($payload, 5); // 5 hari
    return $this->respond(['status'=>200,'token'=>$token,'user'=>$payload]);
  }

  public function register() {
    // opsional: untuk testing
    $json = $this->request->getJSON();
    $um = new UserModel();
    $data = [
      'username'=>$json->username,
      'email'=>$json->email ?? null,
      'password'=>password_hash($json->password, PASSWORD_DEFAULT)
    ];
    $um->insert($data);
    return $this->respondCreated(['status'=>201,'message'=>'user created']);
  }
}
