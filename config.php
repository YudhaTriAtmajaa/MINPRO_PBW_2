<?php
// ============================================================
//  config.php  —  Koneksi ke MySQL
//  Sesuaikan DB_USER dan DB_PASS dengan milik kamu
// ============================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');   // ganti sesuai user MySQL kamu
define('DB_PASS', '');       // ganti sesuai password MySQL kamu
define('DB_NAME', 'portofolio_db');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die('<p style="color:red;text-align:center;padding:40px;">
        Koneksi database gagal: ' . htmlspecialchars($conn->connect_error) . '
    </p>');
}