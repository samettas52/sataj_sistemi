<?php
require_once 'config.php';
if(!isLoggedIn()) redirect('login.php');

$db = dbConnect();
$uid = $_SESSION['user_id'];
$user_role = $_SESSION['role'];

if(isset($_FILES['pic'])) {
    $path = "uploads/" . time() . "_" . $_FILES['pic']['name'];
    if(move_uploaded_file($_FILES['pic']['tmp_name'], $path)) {
        $db->query("UPDATE users SET profile_pic = '$path' WHERE id = $uid");
    }
}

$user = $db->query("SELECT * FROM users WHERE id = $uid")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Staj Takip Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="profile-section">
            <img src="<?php echo $user['profile_pic']; ?>" width="100" alt="Profil Resmi">
            <div class="welcome-section">
                <h1>Hoş geldin, <?php echo $user['name']; ?></h1>
                <p>Staj Takip Sistemine Hoş Geldiniz</p>
            </div>
        </div>
        
        <form method="POST" enctype="multipart/form-data" class="profile-upload">
            <div class="form-group">
                <label for="pic">Profil Resmi Güncelle</label>
                <input type="file" name="pic" id="pic">
            </div>
            <button type="submit" class="btn btn-secondary">Resim Güncelle</button>
        </form>
        
        <hr>
        
        <ul class="nav-menu">
            <?php if($user_role == 'koordinator'): ?>
                <li><a href="add_company.php">Firma Ekle</a></li>
                <li><a href="approve_apps.php">Başvuruları Onayla</a></li>
                <li><a href="reports.php">Genel Rapor Al</a></li>
            <?php elseif($user_role == 'firma'): ?>
                <li><a href="create_post.php">İlan Aç</a></li>
                <li><a href="evaluate_students.php">Değerlendir</a></li>
            <?php else: ?>
                <li><a href="apply_staj.php">Başvuru Yap</a></li>
                <li><a href="weekly_report.php">Rapor Gir</a></li>
            <?php endif; ?>
        </ul>
        
        <a href="logout.php" class="logout-link">Çıkış Yap</a>
    </div>
</body>
</html>