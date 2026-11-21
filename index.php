<?php
include("koneksi.php");

// query untuk menampilkan data (READ)
$sql = "SELECT * FROM data_barang";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
</head>
<body>
    <h1>Data Barang</h1>
    <p><a href="tambah.php">Tambah Barang</a></p>

    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><img src="gambar/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>" width="80"></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['kategori']; ?></td>
                    <td><?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                    <td><?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                    <td><?= $row['stok']; ?></td>
                    <td>
                        <a href="ubah.php?id=<?= $row['id_barang']; ?>">Ubah</a>
                        <a href="hapus.php?id=<?= $row['id_barang']; ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Belum ada data</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
