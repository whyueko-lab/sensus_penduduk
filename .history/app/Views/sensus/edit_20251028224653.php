<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penduduk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <h4 class="mb-0">Edit Data Penduduk</h4>
        </div>
        <div class="card-body">
            <form action="/sensus/update/<?= $sensus['id'] ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Penduduk</label>
                    <input type="text" name="nama_penduduk" class="form-control" value="<?= $sensus['nama_penduduk'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" name="nik" class="form-control" value="<?= $sensus['nik'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required><?= $sensus['alamat'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kota</label>
                    <select name="id_kota" class="form-select" required>
                        <?php foreach ($kota as $k): ?>
                            <option value="<?= $k['id'] ?>" <?= $k['id'] == $sensus['id_kota'] ? 'selected' : '' ?>>
                                <?= $k['nama_kota'] ?> (<?= $k['nama_provinsi'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="<?= $sensus['tanggal_lahir'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="L" <?= $sensus['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $sensus['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/sensus" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
