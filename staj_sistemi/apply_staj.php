<?php
require_once 'config.php';
if($_SESSION['role'] != 'ogrenci') redirect('dashboard.php');
$db = dbConnect();

if(isset($_GET['aid'])) {
    $sid = $_SESSION['user_id'];
    $pid = (int)$_GET['aid'];
    $db->query("INSERT INTO applications (student_id, post_id) VALUES ($sid, $pid)");
    echo "Başvuru yapıldı.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Başvuru Yap - Staj Takip Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Staj Başvurusu Yap</h2>
        
        <?php
        $posts = $db->query("SELECT p.*, c.company_name FROM internship_posts p JOIN companies c ON p.company_id = c.id");
        while($row = $posts->fetch_assoc()) {
            echo '<div class="post-item">';
            echo '<h3>' . htmlspecialchars($row['company_name']) . '</h3>';
            echo '<p><strong>İlan:</strong> ' . htmlspecialchars($row['title']) . '</p>';
            echo '<p><strong>Kontenjan:</strong> ' . htmlspecialchars($row['quota']) . '</p>';
            echo '<div class="action-links">';
            echo '<a href="?aid=' . $row['id'] . '" class="btn apply">Başvur</a>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        
        <div class="link-group">
            <a href="dashboard.php" class="btn btn-secondary">Geri</a>
        </div>
    </div>
</body>
</html>