<?php
require_once 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = dbConnect();
    $name = validateInput($_POST['name']);
    $email = validateInput($_POST['email']);
    $pass = $_POST['password'];
    $role = $_POST['role'];

    if(!empty($name) && !empty($email) && !empty($pass)) {
        $hashed = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashed, $role);
        if($stmt->execute()) { redirect('login.php'); }
    } else { echo "Tüm alanları doldurun!"; }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Ol - Staj Takip Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Kayıt Ol</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Ad Soyad</label>
                <input type="text" name="name" id="name" placeholder="Ad Soyad" required>
            </div>
            <div class="form-group">
                <label for="email">E-posta</label>
                <input type="email" name="email" id="email" placeholder="E-posta" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" name="password" id="password" placeholder="Şifre" required>
            </div>
            <div class="form-group">
                <label for="role">Rol</label>
                <select name="role" id="role" required>
                    <option value="ogrenci">Öğrenci</option>
                    <option value="firma">Firma</option>
                    <option value="koordinator">Koordinatör</option>
                </select>
            </div>
            <button type="submit" class="btn">Kayıt Ol</button>
        </form>
        <div class="link-group">
            <a href="login.php">Giriş Yap</a>
        </div>
    </div>
</body>
</html>