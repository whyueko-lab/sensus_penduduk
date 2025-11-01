<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Sensus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2>Tambah Data Sensus</h2>
    <form action="<?= site_url('sensus/store') ?>" method="post" class="mt-4">

        <div class="mb-3">
            <label for="nama_penduduk" class="form-label">Nama Penduduk</label>
            <input type="text" class="form-control" id="nama_penduduk" name="nama_penduduk" required>
        </div>

        <div class="mb-3">
            <label for="umur" class="form-label">Umur</label>
            <input type="number" class="form-control" id="umur" name="umur" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="provinsi_id" class="form-label">Provinsi</label>
            <select class="form-select" id="provinsi_id" name="provinsi_id" required>
                <option value="">-- Pilih Provinsi --</option>
                <?php foreach ($provinsi as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= esc($p['nama_provinsi']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('sensus') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
