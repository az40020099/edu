<?php
// index.php
require_once 'functions.php';
$conn = db_connect();

// Fetch all cards along with their category names
$sql = "SELECT cards.*, categories.name AS category_name FROM cards 
        LEFT JOIN categories ON cards.category_id = categories.id 
        ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title><?php echo SITE_TITLE; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1><?php echo SITE_TITLE; ?></h1>
    <div class="cards-container">
        <?php while($card = $result->fetch_assoc()): ?>
            <div class="card">
                <?php if($card['image']): ?>
                    <img src="uploads/<?php echo htmlspecialchars($card['image']); ?>" alt="<?php echo htmlspecialchars($card['title']); ?>">
                <?php endif; ?>
                <h2><?php echo htmlspecialchars($card['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($card['content'])); ?></p>
                <?php if($card['category_name']): ?>
                    <p><strong>الفئة:</strong> <?php echo htmlspecialchars($card['category_name']); ?></p>
                <?php endif; ?>
                <!-- Share links -->
                <div class="share-links">
                    <a href="https://wa.me/?text=<?php echo urlencode(SITE_URL . 'index.php?card_id=' . $card['id']); ?>" target="_blank">مشاركة على واتساب</a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(SITE_URL . 'index.php?card_id=' . $card['id']); ?>" target="_blank">مشاركة على فيسبوك</a>
                </div>
                <!-- Export links -->
                <div class="export-links">
                    <a href="exports/export_image.php?card_id=<?php echo $card['id']; ?>" target="_blank">تصدير كصورة</a>
                    <a href="exports/export_pdf.php?card_id=<?php echo $card['id']; ?>" target="_blank">تصدير كـ PDF</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
