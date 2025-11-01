<!DOCTYPE html>
<html>
<head>
    <title>Edit Penduduk</title>
</head>
<body>
    <h2>Edit Penduduk</h2>
    <form method="post" action="/sensus/update/<?= $sensus['id'] ?>">
        <p>Nama: <input type="text" name="nama_penduduk" value="<?= $sensus['nama_penduduk'] ?>"></p>
        <p>NIK: <input type="text" name="nik" value="<?= $sensus['nik'] ?>"></p>
        <p>Alamat: <textarea name="alamat"><?= $sensus['alamat'] ?></textarea></p>
        <p>Kota:
            <select name="id_kota">
                <?php foreach ($kota as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= $k['id'] == $sensus['id_kota'] ? 'selected' : '' ?>>
                        <?= $k['nama_kota'] ?> (<?= $k['nama_provinsi'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>Tanggal Lahir: <input type="date" name="tanggal_lahir" value="<?= $sensus['tanggal_lahir'] ?>"></p>
        <p>Jenis Kelamin:
            <select name="jenis_kelamin">
                <option value="L" <?= $sensus['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= $sensus['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </p>
        <button type="submit">Update</button>
    </form>
</body>
</html>
