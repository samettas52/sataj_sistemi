<?php
require_once 'config.php';
if($_SESSION['role'] != 'koordinator') redirect('dashboard.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = dbConnect();
    $name = validateInput($_POST['c_name']);
    $sec = validateInput($_POST['sector']);
    $uid = $_SESSION['user_id'];
    $stmt = $db->prepare("INSERT INTO companies (company_name, sector, added_by) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $sec, $uid);
    $stmt->execute();
    echo "Firma eklendi.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Firma Ekle - Staj Takip Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Firma Ekle</h2>
        <form method="POST">
            <div class="form-group">
                <label for="c_name">Firma Adı</label>
                <input type="text" name="c_name" id="c_name" placeholder="Firma Adı" required>
            </div>
            <div class="form-group">
                <label for="sector">Sektör</label>
                <input type="text" name="sector" id="sector" placeholder="Sektör" required>
            </div>
            <button type="submit" class="btn">Kaydet</button>
        </form>
        <div class="link-group">
            <a href="dashboard.php" class="btn btn-secondary">Geri</a>
        </div>
    </div>
</body>
</html>