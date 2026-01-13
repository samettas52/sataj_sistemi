<?php
require_once 'config.php';
if($_SESSION['role'] != 'koordinator') redirect('dashboard.php');
$db = dbConnect();

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $st = $_GET['st'];
    $db->query("UPDATE applications SET status = '$st' WHERE id = $id");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Başvuruları Onayla - Staj Takip Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Başvuruları Onayla</h2>
        
        <?php
        $apps = $db->query("SELECT a.id, u.name, p.title FROM applications a JOIN users u ON a.student_id = u.id JOIN internship_posts p ON a.post_id = p.id WHERE a.status = 'pending'");
        while($row = $apps->fetch_assoc()) {
            echo '<div class="application-item">';
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p><strong>İlan:</strong> ' . htmlspecialchars($row['title']) . '</p>';
            echo '<div class="action-links">';
            echo '<a href="?id=' . $row['id'] . '&st=approved" class="btn btn-success approve">Onayla</a>';
            echo '<a href="?id=' . $row['id'] . '&st=rejected" class="btn btn-danger reject">Reddet</a>';
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