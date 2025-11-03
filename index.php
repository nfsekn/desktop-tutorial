<?php
require_once 'db_connect.php';

// Meyveleri listele
$sql = "SELECT * FROM meyveler ORDER BY meyve_adi";
$stmt = $conn->query($sql);
$meyveler = $stmt->fetchAll();

// Sipariş hesaplama
$toplam = 0;
if (isset($_POST['hesapla'])) {
    foreach ($_POST['kilo'] as $id => $kilo) {
        if ($kilo > 0) {
            foreach ($meyveler as $meyve) {
                if ($meyve['id'] == $id) {
                    $toplam += $meyve['kilo_fiyati'] * $kilo;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Manav Sipariş Sistemi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .meyve-container { display: flex; flex-wrap: wrap; gap: 20px; }
        .meyve-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            width: 200px;
        }
        .meyve-card input { width: 60px; margin-top: 10px; }
        input[type="submit"] { 
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        .toplam {
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Manav Sipariş Sistemi</h1>
    
    <form method="post">
        <div class="meyve-container">
            <?php foreach ($meyveler as $meyve): ?>
            <div class="meyve-card">
                <h3><?php echo htmlspecialchars($meyve['meyve_adi']); ?></h3>
                <p>Kilo Fiyatı: <?php echo number_format($meyve['kilo_fiyati'], 2); ?> TL</p>
                <input type="number" name="kilo[<?php echo $meyve['id']; ?>]" value="0" min="0" step="0.1">
                <label>kg</label>
            </div>
            <?php endforeach; ?>
        </div>
        
        <input type="submit" name="hesapla" value="Sipariş Tutarını Hesapla">
    </form>

    <?php if (isset($_POST['hesapla']) && $toplam > 0): ?>
    <div class="toplam">
        Toplam Tutar: <?php echo number_format($toplam, 2); ?> TL
    </div>
    <?php endif; ?>
    
    <p><a href="admin.php">Yönetici Paneline Git</a></p>
</body>
</html>