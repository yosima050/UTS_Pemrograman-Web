<?php
$host = 'localhost';
$port = '5432';
$dbname = 'photostock_db';
$user = 'postgres';
$password = '12345qwerty';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi database gagal: " . $e->getMessage();
    die();
}
?>