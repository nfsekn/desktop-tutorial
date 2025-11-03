<?php
require_once 'db_connect.php';


if (isset($_POST['ekle'])) {
    $meyve_adi = $_POST['meyve_adi'];
    $kilo_fiyati = $_POST['kilo_fiyati'];
    
    $sql = "INSERT INTO meyveler (meyve_adi, kilo_fiyati) VALUES (:meyve_adi, :kilo_fiyati)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['meyve_adi' => $meyve_adi, 'kilo_fiyati' => $kilo_fiyati]);
    
    header("Location: admin.php");
}


if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $sql = "DELETE FROM meyveler WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    
    header("Location: admin.php");
}


$sql = "SELECT * FROM meyveler ORDER BY meyve_adi";
$stmt = $conn->query($sql);
$meyveler = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Manav Yönetim Paneli</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f5f5f5; }
        .form-group { margin: 10px 0; }
        input[type="text"], input[type="number"] { padding: 5px; width: 200px; }
        input[type="submit"] { padding: 5px 15px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        .sil { color: red; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Manav Yönetim Paneli</h1>
    
    <h2>Yeni Meyve Ekle</h2>
    <form method="post">
        <div class="form-group">
            <label>Meyve Adı:</label>
            <input type="text" name="meyve_adi" required>
        </div>
        <div class="form-group">
            <label>Kilo Fiyatı (TL):</label>
            <input type="number" step="0.01" name="kilo_fiyati" required>
        </div>
        <div class="form-group">
            <input type="submit" name="ekle" value="Meyve Ekle">
        </div>
    </form>

    <h2>Mevcut Meyveler</h2>
    <table>
        <tr>
            <th>Meyve Adı</th>
            <th>Kilo Fiyatı (TL)</th>
            <th>İşlemler</th>
        </tr>
        <?php foreach ($meyveler as $meyve): ?>
        <tr>
            <td><?php echo htmlspecialchars($meyve['meyve_adi']); ?></td>
            <td><?php echo number_format($meyve['kilo_fiyati'], 2); ?> TL</td>
            <td>
                <a href="admin.php?sil=<?php echo $meyve['id']; ?>" class="sil" onclick="return confirm('Bu meyveyi silmek istediğinizden emin misiniz?')">Sil</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <p><a href="index.php">Kullanıcı Sayfasına Git</a></p>
</body>
</html>
