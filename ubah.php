<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $id         = mysqli_real_escape_string($conn, $_POST['id']);
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

    $sql  = "UPDATE data_barang SET ";
    $sql .= "nama = '$nama', kategori = '$kategori', ";
    $sql .= "harga_jual = '$harga_jual', harga_beli = '$harga_beli', stok = '$stok' ";
    if (!empty($gambar)) {
        $sql .= ", gambar = '$gambar' ";
    }
    $sql .= "WHERE id_barang = '$id'";
    $result = mysqli_query($conn, $sql);

    header('location: index.php');
    exit;
}

$id     = mysqli_real_escape_string($conn, $_GET['id']);
$sql    = "SELECT * FROM data_barang WHERE id_barang = '$id'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    die('Error: Data tidak tersedia');
}
$data = mysqli_fetch_array($result);

function is_select($var, $val) {
    if ($var == $val) return 'selected="selected"';
    return false;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Barang</title>
</head>
<body>
    <h1>Ubah Barang</h1>
    <form method="post" action="ubah.php" enctype="multipart/form-data">
        <p>
            <label>Nama Barang</label><br>
            <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
        </p>
        <p>
            <label>Kategori</label><br>
            <select name="kategori">
                <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Komputer">Komputer</option>
                <option <?php echo is_select('Elektronik', $data['kategori']); ?> value="Elektronik">Elektronik</option>
                <option <?php echo is_select('Hand Phone', $data['kategori']); ?> value="Hand Phone">Hand Phone</option>
            </select>
        </p>
        <p>
            <label>Harga Jual</label><br>
            <input type="text" name="harga_jual" value="<?php echo $data['harga_jual']; ?>" required>
        </p>
        <p>
            <label>Harga Beli</label><br>
            <input type="text" name="harga_beli" value="<?php echo $data['harga_beli']; ?>" required>
        </p>
        <p>
            <label>Stok</label><br>
            <input type="text" name="stok" value="<?php echo $data['stok']; ?>" required>
        </p>
        <p>
            <label>File Gambar (kosongkan jika tidak diubah)</label><br>
            <input type="file" name="file_gambar">
        </p>
        <p>
            <input type="hidden" name="id" value="<?php echo $data['id_barang']; ?>">
            <input type="submit" name="submit" value="Simpan">
            <a href="index.php">Batal</a>
        </p>
    </form>
</body>
</html>
