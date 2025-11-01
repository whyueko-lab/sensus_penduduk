<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Sistem Sensus</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Background dari komputer */
body {
    background-image: url('assets/img/background.jpg'); /* ganti path sesuai lokasi gambarmu */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    position: relative;
}

/* Overlay semi-transparent */
body::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 0;
}

/* Container supaya form muncul di atas overlay */
.container {
    position: relative;
    z-index: 1;
}

/* Card dengan blur dan shadow */
.card {
    backdrop-filter: blur(10px); /* efek blur */
    background-color: rgba(255, 255, 255, 0.85);
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    animation: fadeIn 0.8s ease-in-out;
}

/* Animasi fade in */
@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* Judul */
.card h4 {
    font-weight: bold;
    letter-spacing: 1px;
}

/* Input efek */
input.form-control {
    border-radius: 10px;
    transition: all 0.3s;
}

input.form-control:focus {
    box-shadow: 0 0 10px rgba(13,110,253,0.5);
    border-color: #0d6efd;
}

/* Tombol efek hover */
.btn-primary:hover {
    transform: scale(1.05);
    transition: all 0.2s;
}
</style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card p-4">
        <h4 class="text-center mb-4">🔐 Login Sistem Sensus Penduduk</h4>

        <?php if(session()->getFlashdata('error')): ?>
          <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/login" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
