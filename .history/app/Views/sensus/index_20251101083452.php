<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sensus Penduduk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📋 Data Penduduk</h2>
        <a href="/sensus/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Penduduk
        </a>
    </div>

     <form method="get" action="/sensus" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Cari nama, kota, provinsi..." 
                   value="<?= esc($keyword ?? '') ?>">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
            <a href="/sensus" class="btn btn-outline-danger">Reset</a>
        </div>
    </form>

    <div class="card shadow-sm">
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

</body>
</html>
