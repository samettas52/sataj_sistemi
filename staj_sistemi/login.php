<?php
require_once 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = dbConnect();
    $email = validateInput($_POST['email']);
    $pass = $_POST['password'];

    $stmt = $db->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    if ($res && password_verify($pass, $res['password'])) {
        $_SESSION['user_id'] = $res['id'];
        $_SESSION['user_name'] = $res['name'];
        $_SESSION['role'] = $res['role'];
        redirect('dashboard.php');
    } else { echo "Hatalı bilgiler!"; }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap - Staj Takip Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Giriş Yap</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">E-posta</label>
                <input type="email" name="email" id="email" placeholder="E-postaniz" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" name="password" id="password" placeholder="Sifreniz" required>
            </div>
            <button type="submit" class="btn">Giris Yap</button>
        </form>
        <div class="link-group">
            <a href="register.php">Kayıt Ol</a>
        </div>
    </div>
</body>
</html>