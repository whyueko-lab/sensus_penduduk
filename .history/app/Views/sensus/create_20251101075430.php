<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Sensus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

        <!-- Dropdown Provinsi + tombol -->
        <div class="mb-3">
            <label for="provinsi_id" class="form-label">Provinsi</label>
            <div class="d-flex gap-2">
                <select class="form-select" id="provinsi_id" name="provinsi_id" required>
                    <option value="">-- Pilih Provinsi --</option>
                    <?php foreach ($provinsi as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= esc($p['nama_provinsi']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalProvinsi">+ Provinsi</button>
            </div>
        </div>

        <!-- Dropdown Kota + tombol -->
        <div class="mb-3">
            <label for="kota_id" class="form-label">Kota</label>
            <div class="d-flex gap-2">
                <select class="form-select" id="kota_id" name="kota_id" required>
                    <option value="">-- Pilih Kota --</option>
                    <!-- nanti akan diisi otomatis -->
                </select>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalKota">+ Kota</button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('sensus') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<!-- Modal Tambah Provinsi -->
<div class="modal fade" id="modalProvinsi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formProvinsi">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Provinsi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label for="nama_provinsi" class="form-label">Nama Provinsi</label>
          <input type="text" class="form-control" id="nama_provinsi" name="nama_provinsi" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tambah Kota -->
<div class="modal fade" id="modalKota" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formKota">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kota</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label for="nama_kota" class="form-label">Nama Kota</label>
          <input type="text" class="form-control" id="nama_kota" name="nama_kota" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Tambah Provinsi via AJAX
    document.getElementById('formProvinsi').addEventListener('submit', async (e) => {
        e.preventDefault();
        const nama = document.getElementById('nama_provinsi').value;

        try {
            const res = await axios.post('<?= site_url("provinsi/store") ?>', { nama_provinsi: nama });
            if (res.data.status === 'success') {
                alert('Provinsi berhasil ditambahkan!');
                location.reload();
            }
        } catch (err) {
            alert('Gagal menambahkan provinsi');
        }
    });

    // Tambah Kota via AJAX (nanti disesuaikan endpoint-nya)
    document.getElementById('formKota').addEventListener('submit', async (e) => {
        e.preventDefault();
        const nama = document.getElementById('nama_kota').value;

        try {
            const res = await axios.post('<?= site_url("kota/store") ?>', { nama_kota: nama });
            if (res.data.status === 'success') {
                alert('Kota berhasil ditambahkan!');
                location.reload();
            }
        } catch (err) {
            alert('Gagal menambahkan kota');
        }
    });
</script>

</body>
</html>
