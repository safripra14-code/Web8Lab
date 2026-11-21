<?php
// koneksi.php — koneksi ke database MySQL (MariaDB)
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan1";

$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn == false) {
    echo "Koneksi ke server gagal.";
    die();
}
// echo "Koneksi berhasil"; // uncomment untuk menguji koneksi
?>
