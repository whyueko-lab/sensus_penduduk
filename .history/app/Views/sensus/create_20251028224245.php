<!DOCTYPE html>
<html>
<head>
    <title>Tambah Penduduk</title>
</head>
<body>
    <h2>Tambah Penduduk</h2>
    <form method="post" action="/sensus/store">
        <p>Nama: <input type="text" name="nama_penduduk"></p>
        <p>NIK: <input type="text" name="nik"></p>
        <p>Alamat: <textarea name="alamat"></textarea></p>
        <p>Kota:
            <select name="id_kota">
                <?php foreach ($kota as $k): ?>
                    <option value="<?= $k['id'] ?>">
                        <?= $k['nama_kota'] ?> (<?= $k['nama_provinsi'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>Tanggal Lahir: <input type="date" name="tanggal_lahir"></p>
        <p>Jenis Kelamin:
            <select name="jenis_kelamin">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </p>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
