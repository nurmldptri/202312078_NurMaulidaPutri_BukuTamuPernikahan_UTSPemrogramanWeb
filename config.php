<?php
$host = "localhost";
$user = "root";
$password = ""; // Ganti jika password MySQL kamu tidak kosong
$database = "buku_tamu";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
