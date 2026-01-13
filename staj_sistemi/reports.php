<?php 
require_once 'config.php'; 
if($_SESSION['role'] != 'koordinator') redirect('dashboard.php'); 
$db = dbConnect(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Raporlar - Staj Takip Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Genel Rapor</h2>
        
        <?php
        $res = $db->query("SELECT u.name, c.company_name, a.status FROM users u LEFT JOIN applications a ON u.id = a.student_id LEFT JOIN internship_posts p ON a.post_id = p.id LEFT JOIN companies c ON p.company_id = c.id WHERE u.role = 'ogrenci'");
        while($row = $res->fetch_assoc()) {
            echo '<div class="report-section">';
            echo '<h4>Öğrenci: ' . htmlspecialchars($row['name']) . '</h4>';
            echo '<p><strong>Firma:</strong> ' . htmlspecialchars($row['company_name'] ?? '-') . '</p>';
            echo '<p><strong>Durum:</strong> ' . htmlspecialchars($row['status'] ?? '-') . '</p>';
            echo '</div>';
        }
        ?>
        
        <div class="link-group">
            <a href="dashboard.php" class="btn btn-secondary">Geri</a>
        </div>
    </div>
</body>
</html>