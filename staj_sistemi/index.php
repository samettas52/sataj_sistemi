<?php
require_once 'config.php';
$db = dbConnect();

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('koordinator', 'firma', 'ogrenci'),
    profile_pic VARCHAR(255) DEFAULT 'default.png'
)";
$db->query($sql);

if(isLoggedIn()) { redirect('dashboard.php'); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Staj Takip Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Staj Takip Sistemine Hoş Geldiniz</h1>
        <div class="link-group">
            <a href="login.php" class="btn">Giriş Yap</a>
            <a href="register.php" class="btn btn-secondary">Kayıt Ol</a>
        </div>
    </div>
</body>
</html>