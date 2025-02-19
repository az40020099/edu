<?php
// admin/add_card.php
require_once '../functions.php';
redirect_if_not_logged_in();
$conn = db_connect();

// Fetch categories for the dropdown
$categories_result = $conn->query("SELECT * FROM categories ORDER BY name ASC");

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title       = $conn->real_escape_string($_POST['title']);
    $content     = $conn->real_escape_string($_POST['content']);
    $category_id = intval($_POST['category_id']);
    $font        = $conn->real_escape_string($_POST['font']);
    $color       = $conn->real_escape_string($_POST['color']);
    $size        = intval($_POST['size']);

    // Handle image upload if provided
    $image_name = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $error = "فشل تحميل الصورة.";
        }
    }

    if (!$error) {
        $stmt = $conn->prepare("INSERT INTO cards (title, content, category_id, font, color, size, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissis", $title, $content, $category_id, $font, $color, $size, $image_name);
        if($stmt->execute()){
            header("Location: cards.php");
            exit;
        } else {
            $error = "خطأ في إضافة البطاقة.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة بطاقة جديدة</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>إضافة بطاقة جديدة</h1>
    <nav>
        <a href="index.php">لوحة التحكم</a> | 
        <a href="cards.php">إدارة البطاقات</a> | 
        <a href="logout.php">تسجيل الخروج</a>
    </nav>
    <?php if($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="" enctype="multipart/form-data">
        <label>العنوان:</label><br>
        <input type="text" name="title" required><br><br>
        
        <label>المحتوى:</label><br>
        <textarea name="content" rows="5" required></textarea><br><br>
        
        <label>الفئة:</label><br>
        <select name="category_id" required>
            <option value="">اختر فئة</option>
            <?php while($cat = $categories_result->fetch_assoc()): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
            <?php endwhile; ?>
        </select><br><br>
        
        <label>الخط:</label><br>
        <input type="text" name="font" value="Arial"><br><br>
        
        <label>اللون (مثال: #000000):</label><br>
        <input type="text" name="color" value="#000000"><br><br>
        
        <label>الحجم:</label><br>
        <input type="number" name="size" value="20"><br><br>
        
        <label>تحميل صورة أو شعار:</label><br>
        <input type="file" name="image" accept="image/*"><br><br>
        
        <input type="submit" value="إضافة البطاقة">
    </form>
</body>
</html>
