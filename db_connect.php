<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manav";

try {
    
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->exec($sql);
    
    
    $conn->exec("USE $dbname");
    
   
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
