<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penduduk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tambah Penduduk</h4>
            <div>
                <!-- Tombol untuk tambah kota dan provinsi -->
                <button type="button" class="btn btn-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalProvinsi">
                    + Provinsi
                </button>
                <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalKota">
                    + Kota
                </button>
            </div>
        </div>

        <div class="card-body">
            <form action="/sensus/store" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Penduduk</label>
                    <input type="text" name="nama_penduduk" class="form-control" required>
                </div>

                <div class="mb-3">
                <label class="form-label">NIK</label>
                    <input type="text" name="nik" class="form-control" 
                            required 
                            maxlength="16" 
                            pattern="\d{16}" 
                            title="NIK harus 16 digit angka saja"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>


                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required></textarea>
                </div>

                <!-- Dropdown Provinsi -->
                <div class="mb-3">
                    <label class="form-label">Provinsi</label>
                    <select name="id_provinsi" id="provinsi" class="form-select" required>
                        <option value="">-- Pilih Provinsi --</option>
                        <?php foreach ($provinsi as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['nama_provinsi'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Dropdown Kota -->
                <div class="mb-3">
                    <label class="form-label">Kota</label>
                    <select name="id_kota" id="kota" class="form-select" required>
                        <option value="">-- Pilih Kota --</option>
                        <?php foreach ($kota as $k): ?>
                            <option value="<?= $k['id'] ?>" data-provinsi="<?= $k['id_provinsi'] ?>">
                                <?= $k['nama_kota'] ?> (<?= $k['nama_provinsi'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/sensus" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Provinsi -->
<div class="modal fade" id="modalProvinsi" tabindex="-1" aria-labelledby="modalProvinsiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/provinsi/store" method="post" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalProvinsiLabel">Tambah Provinsi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Provinsi</label>
          <input type="text" name="nama_provinsi" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Tambah Kota -->
<div class="modal fade" id="modalKota" tabindex="-1" aria-labelledby="modalKotaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/kota/store" method="post" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalKotaLabel">Tambah Kota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Pilih Provinsi</label>
          <select name="id_provinsi" class="form-select" required>
              <option value="">-- Pilih Provinsi --</option>
              <?php foreach ($provinsi as $p): ?>
                  <option value="<?= $p['id'] ?>"><?= $p['nama_provinsi'] ?></option>
              <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Kota</label>
          <input type="text" name="nama_kota" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script untuk menyesuaikan kota sesuai provinsi -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const provinsiSelect = document.getElementById("provinsi");
    const kotaSelect = document.getElementById("kota");

    // Simpan semua opsi kota
    const semuaKota = Array.from(kotaSelect.options);

    provinsiSelect.addEventListener("change", function() {
        const idProvinsi = this.value;

        // Reset dropdown kota
        kotaSelect.innerHTML = '<option value="">-- Pilih Kota --</option>';

        // Filter kota berdasarkan provinsi yang dipilih
        semuaKota.forEach(opt => {
            if (opt.dataset.provinsi === idProvinsi) {
                kotaSelect.appendChild(opt);
            }
        });
    });
});
</script>

</body>
</html>
