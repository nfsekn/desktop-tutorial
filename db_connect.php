<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manav";

try {
    // Önce veritabanı bağlantısı olmadan bir PDO nesnesi oluştur
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Veritabanını oluştur (eğer yoksa)
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->exec($sql);
    
    // Veritabanını seç
    $conn->exec("USE $dbname");
    
    // Meyveler tablosunu oluştur (eğer yoksa)
    $sql = "CREATE TABLE IF NOT EXISTS meyveler (
        id INT AUTO_INCREMENT PRIMARY KEY,
        meyve_adi VARCHAR(100) NOT NULL,
        kilo_fiyati DECIMAL(10,2) NOT NULL
    )";
    $conn->exec($sql);
    
} catch(PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}
?>