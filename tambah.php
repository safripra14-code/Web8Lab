<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama       = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori   = mysqli_real_escape_string($conn, $_POST['kategori']);
    $harga_jual = mysqli_real_escape_string($conn, $_POST['harga_jual']);
    $harga_beli = mysqli_real_escape_string($conn, $_POST['harga_beli']);
    $stok       = mysqli_real_escape_string($conn, $_POST['stok']);

    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;
    if ($file_gambar['error'] === 0) {
        $filename    = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = $filename;
        }
    }

    $sql  = "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) ";
    $sql .= "VALUES ('$nama', '$kategori', '$harga_jual', '$harga_beli', '$stok', '$gambar')";
    $result = mysqli_query($conn, $sql);

    header('location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
</head>
<body>
    <h1>Tambah Barang</h1>
    <form method="post" action="tambah.php" enctype="multipart/form-data">
        <p>
            <label>Nama Barang</label><br>
            <input type="text" name="nama" required>
        </p>
        <p>
            <label>Kategori</label><br>
            <select name="kategori">
                <option value="Komputer">Komputer</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Hand Phone">Hand Phone</option>
            </select>
        </p>
        <p>
            <label>Harga Jual</label><br>
            <input type="text" name="harga_jual" required>
        </p>
        <p>
            <label>Harga Beli</label><br>
            <input type="text" name="harga_beli" required>
        </p>
        <p>
            <label>Stok</label><br>
            <input type="text" name="stok" required>
        </p>
        <p>
            <label>File Gambar</label><br>
            <input type="file" name="file_gambar">
        </p>
        <p>
            <input type="submit" name="submit" value="Simpan">
            <a href="index.php">Batal</a>
        </p>
    </form>
</body>
</html>
