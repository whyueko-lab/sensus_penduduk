<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Sistem Sensus</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
/* Background gambar + gradient overlay */
body {
    background: 
        linear-gradient(rgba(224, 247, 250, 0.7), rgba(225, 245, 254, 0.7)),
        url('/assets/img/background.jpg') no-repeat center center fixed;
    background-size: cover;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
}

/* Card animasi */
.card {
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    animation: fadeIn 0.8s ease-in-out;
    backdrop-filter: blur(10px);
    background-color: rgba(255,255,255,0.85);
}

/* Animasi masuk */
@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(-20px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* Input dengan icon */
.input-group-text {
    background: #0d6efd;
    color: #fff;
    border-radius: 10px 0 0 10px;
    border: none;
}
.input-group .form-control {
    border-radius: 0 10px 10px 0;
}

/* Input efek focus */
input.form-control:focus {
    box-shadow: 0 0 10px rgba(13,110,253,0.4);
    border-color: #0d6efd;
}

/* Tombol efek hover */
.btn-primary {
    border-radius: 10px;
    transition: all 0.2s;
}
.btn-primary:hover {
    transform: scale(1.05);
    background: linear-gradient(to right, #0d6efd, #6610f2);
    border-color: #6610f2;
}

/* Alert smooth & shake */
.alert {
    border-radius: 10px;
    animation: fadeIn 0.5s ease-in-out;
}
.alert.shake {
    animation: shake 0.5s;
}
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    20%, 60% { transform: translateX(-10px); }
    40%, 80% { transform: translateX(10px); }
}

/* Show password toggle */
#showPassword {
    cursor: pointer;
}
</style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow-lg">
        <div class="card-body p-4">
          <h4 class="text-center mb-4">🔐 Login Sistem Sensus Penduduk</h4>

          <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger shake"><?= session()->getFlashdata('error') ?></div>
          <?php endif; ?>

          <form action="/login" method="post">
            <div class="mb-3 input-group">
              <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
              <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="mb-3 input-group">
              <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
              <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
              <span class="input-group-text" id="showPassword">👁️</span>
            </div>

            <button type="submit" class="btn btn-primary w-100">Masuk</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Toggle show password
document.getElementById('showPassword').addEventListener('click', function() {
    const pass = document.getElementById('password');
    pass.type = pass.type === "password" ? "text" : "password";
});
</script>

</body>
</html>
