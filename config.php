<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');   
define('DB_PASS', '');      
define('DB_NAME', 'portofolio_yuda');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die('<p style="color:red;text-align:center;padding:40px;">
        Koneksi database gagal: ' . htmlspecialchars($conn->connect_error) . '
    </p>');
}