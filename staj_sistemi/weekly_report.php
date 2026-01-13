<?php 
require_once 'config.php';
if($_SESSION['role'] != 'ogrenci') redirect('dashboard.php'); 

if($_SERVER["REQUEST_METHOD"] == "POST") { 
    $db = dbConnect(); 
    $wnum = (int)$_POST['wnum']; 
    $cont = validateInput($_POST['content']); 
    $sid = $_SESSION['user_id']; 
    $stmt = $db->prepare("INSERT INTO weekly_reports (student_id, week_number, content) VALUES (?, ?, ?)"); 
    $stmt->bind_param("iis", $sid, $wnum, $cont);
    $stmt->execute(); 
    echo "Rapor kaydedildi."; 
}
?> 
<!DOCTYPE html>
<html>
<head>
    <title>Rapor Gir - Staj Takip Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Haftalık Rapor Gir</h2>
        
        <form method="POST">
            <div class="form-group">
                <label for="wnum">Hafta No</label>
                <input type="number" name="wnum" id="wnum" placeholder="Hafta No" required>
            </div>
            <div class="form-group">
                <label for="content">Rapor İçeriği</label>
                <textarea name="content" id="content" placeholder="Rapor içeriği" required></textarea>
            </div>
            <button type="submit" class="btn">Gönder</button>
        </form>
        
        <div class="link-group">
            <a href="dashboard.php" class="btn btn-secondary">Geri</a>
        </div>
    </div>
</body>
</html>