<?php
require_once 'config.php';

if (!isLoggedIn() || $_SESSION['role'] !== 'firma') {
    redirect('dashboard.php');
}

$db = dbConnect();
$error = "";
$success = "";

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = validateInput($_POST['title']);
    $quota = (int)$_POST['quota'];
    $company_id = (int)$_POST['company_id']; // Seçilen şirketin ID'si

    if (empty($title) || $quota <= 0 || $company_id <= 0) {
        $error = "Lütfen tüm alanları doğru doldurun.";
    } else {
        // İlanı seçilen şirkete bağlayarak kaydet
        $stmt = $db->prepare("INSERT INTO internship_posts (company_id, title, quota) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $company_id, $title, $quota);

        if ($stmt->execute()) {
            $success = "Staj ilanı başarıyla yayınlandı!";
        } else {
            $error = "Hata: İlan eklenemedi.";
        }
    }
}

// Veritabanındaki TÜM şirketleri çek (Seçim kutusu için)
$companies = $db->query("SELECT id, company_name FROM companies");
?>

<!DOCTYPE html>
<html>
<head>
    <title>İlan Aç - Staj Takip Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Yeni Staj İlanı Oluştur</h2>
        
        <?php if($error) echo "<div class='alert alert-error'>$error</div>"; ?>
        <?php if($success) echo "<div class='alert alert-success'>$success</div>"; ?>

        <form method="POST">
            <div class="form-group">
                <label for="company_id">Şirket Seçin</label>
                <select name="company_id" id="company_id" required>
                    <option value="">-- Şirket Seçiniz --</option>
                    <?php while($row = $companies->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo htmlspecialchars($row['company_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="title">İlan Başlığı</label>
                <input type="text" name="title" id="title" required>
            </div>
            
            <div class="form-group">
                <label for="quota">Kontenjan</label>
                <input type="number" name="quota" id="quota" min="1" required>
            </div>
            
            <button type="submit" class="btn">İlanı Yayınla</button>
        </form>

        <div class="link-group">
            <a href="dashboard.php" class="btn btn-secondary">Geri Dön</a>
        </div>
    </div>
</body>
</html>