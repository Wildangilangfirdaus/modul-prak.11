<?php
// Isi nama host, username MySQL, dan password MySQL Anda
$host = "localhost";
$username = "root";
$password = "";  // Biarkan kosong jika tidak ada kata sandi

// Membuat koneksi
$conn = new mysqli($host, $username, $password);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memilih database
$db_name = "unipma";
$db_selected = $conn->select_db($db_name);

// Memeriksa pemilihan database
if (!$db_selected) {
    die("Tidak bisa memilih database $db_name: " . $conn->error);
}

// Sekarang Anda telah berhasil terhubung ke MySQL dengan menggunakan MySQLi
?>
