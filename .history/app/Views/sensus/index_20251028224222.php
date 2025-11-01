<!DOCTYPE html>
<html>
<head>
    <title>Data Sensus Penduduk</title>
</head>
<body>
    <h2>Data Penduduk</h2>
    <a href="/sensus/create">+ Tambah Penduduk</a>
    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Provinsi</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($sensus as $s): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= $s['nama_penduduk'] ?></td>
            <td><?= $s['nik'] ?></td>
            <td><?= $s['alamat'] ?></td>
            <td><?= $s['nama_kota'] ?></td>
            <td><?= $s['nama_provinsi'] ?></td>
            <td><?= $s['jenis_kelamin'] ?></td>
            <td>
                <a href="/sensus/edit/<?= $s['id'] ?>">Edit</a> |
                <a href="/sensus/delete/<?= $s['id'] ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
