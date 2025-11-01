<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Sensus Penduduk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    /* Background gradasi lembut */
    body {
    background: 
        linear-gradient(rgba(224, 247, 250, 0.7), rgba(225, 245, 254, 0.7)),
        url('/assets/img/background.jpg') no-repeat center center fixed;
    background-size: cover;
    height: 60vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    }

    /* Animasi fade-in untuk card */
    .card {
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px);}
        100% { opacity: 1; transform: translateY(0);}
    }

    /* Hover efek pada baris tabel */
    table tbody tr:hover {
        background-color: #d1e7ff;
        transition: background-color 0.3s;
        cursor: pointer;
    }

    /* Tombol efek hover */
    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
        transition: all 0.2s;
    }

    .btn-warning:hover {
        transform: scale(1.05);
        transition: all 0.2s;
    }

    .btn-danger:hover {
        transform: scale(1.05);
        transition: all 0.2s;
    }

    /* Gradient pada header tabel */
    thead.table-dark {
        background: linear-gradient(to right, #0d6efd, #6610f2);
        color: white;
    }

    /* Style flash message */
    .alert {
        border-left: 5px solid #0d6efd;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        0% { opacity: 0; transform: translateY(-20px);}
        100% { opacity: 1; transform: translateY(0);}
    }
</style>
</head>
<body>

<div class="container py-5">

    <!-- Pesan flash sukses / error -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📋 Data Penduduk</h2>
        <div>
            <a href="/sensus/create" class="btn btn-primary">+ Tambah Penduduk</a>
            <span class="me-3">👤 <?= esc($username) ?></span>
            <a href="/logout" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </div>

    <form method="get" action="/sensus" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Cari nama, kota, provinsi..." 
                   value="<?= esc($keyword ?? '') ?>">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
            <a href="/sensus" class="btn btn-outline-danger">Reset</a>
        </div>
    </form>

    <div class="card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Provinsi</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($sensus)) : ?>
                        <?php foreach ($sensus as $index => $s) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($s['nama_penduduk']) ?></td>
                            <td><?= esc($s['nik']) ?></td>
                            <td><?= esc($s['alamat']) ?></td>
                            <td><?= esc($s['nama_kota']) ?></td>
                            <td><?= esc($s['nama_provinsi']) ?></td>
                            <td><?= $s['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                            <td>
                                <a href="/sensus/edit/<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="/sensus/delete/<?= $s['id'] ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="8" class="text-center text-muted">Belum ada data penduduk.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
