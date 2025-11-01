<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Penduduk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: 
        linear-gradient(rgba(224, 247, 250, 0.7), rgba(225, 245, 254, 0.7)),
        url('/assets/img/background.jpg') no-repeat center center fixed;
    background-size: cover;
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
}

/* Card animasi */
.card {
    animation: fadeIn 0.8s ease-in-out;
    border-radius: 15px;
    transition: transform 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* Input & textarea efek */
input.form-control, textarea.form-control, select.form-select {
    border-radius: 10px;
    transition: all 0.3s;
}

input.form-control:focus, textarea.form-control:focus, select.form-select:focus {
    box-shadow: 0 0 10px rgba(13,110,253,0.4);
    border-color: #0d6efd;
}

/* Tombol efek hover */
.btn-secondary:hover, .btn-warning:hover {
    transform: scale(1.05);
    transition: all 0.2s;
}

/* Header card gradient */
.card-header.bg-warning {
    background: linear-gradient(to right, #ffc107, #ff9800);
    color: white;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}
</style>
</head>
<body>

<div class="container py-5">
    <div class="card shadow-lg">
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
                    <input type="text" name="nik" class="form-control"
                        value="<?= $sensus['nik'] ?>" 
                        required 
                        maxlength="16" 
                        pattern="\d{16}" 
                        title="NIK harus 16 digit angka saja"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        placeholder="16 digit angka">
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
