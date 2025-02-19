<?php
// admin/edit_card.php
require_once '../functions.php';
redirect_if_not_logged_in();
$conn = db_connect();

if (!isset($_GET['id'])) {
    header("Location: cards.php");
    exit;
}
$id = intval($_GET['id']);

// Retrieve card data
$result = $conn->query("SELECT * FROM cards WHERE id = $id");
if ($result->num_rows == 0) {
    die("البطاقة غير موجودة.");
}
$card = $result->fetch_assoc();

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

    // Handle image upload
    $image_name = $card['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $error = "فشل تحميل الصورة.";
        } else {
            // Delete old image if exists
            if($card['image'] && file_exists("../uploads/" . $card['image'])) {
                unlink("../uploads/" . $card['image']);
            }
        }
    }

    if (!$error) {
        $stmt = $conn->prepare("UPDATE cards SET title=?, content=?, category_id=?, font=?, color=?, size=?, image=? WHERE id=?");
        $stmt->bind_param("ssissisi", $title, $content, $category_id, $font, $color, $size, $image_name, $id);
        if($stmt->execute()){
            header("Location: cards.php");
            exit;
        } else {
            $error = "خطأ في تحديث البطاقة.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل البطاقة</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>تعديل البطاقة</h1>
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
        <input type="text" name="title" value="<?php echo htmlspecialchars($card['title']); ?>" required><br><br>
        
        <label>المحتوى:</label><br>
        <textarea name="content" rows="5" required><?php echo htmlspecialchars($card['content']); ?></textarea><br><br>
        
        <label>الفئة:</label><br>
        <select name="category_id" required>
            <option value="">اختر فئة</option>
            <?php while($cat = $categories_result->fetch_assoc()): ?>
                <option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $card['category_id']) echo 'selected'; ?>><?php echo htmlspecialchars($cat['name']); ?></option>
            <?php endwhile; ?>
        </select><br><br>
        
        <label>الخط:</label><br>
        <input type="text" name="font" value="<?php echo htmlspecialchars($card['font']); ?>"><br><br>
        
        <label>اللون (مثال: #000000):</label><br>
        <input type="text" name="color" value="<?php echo htmlspecialchars($card['color']); ?>"><br><br>
        
        <label>الحجم:</label><br>
        <input type="number" name="size" value="<?php echo htmlspecialchars($card['size']); ?>"><br><br>
        
        <?php if($card['image']): ?>
            <p>الصورة الحالية:</p>
            <img src="../uploads/<?php echo htmlspecialchars($card['image']); ?>" alt="صورة البطاقة" style="max-width:200px;"><br><br>
        <?php endif; ?>
        
        <label>تغيير الصورة:</label><br>
        <input type="file" name="image" accept="image/*"><br><br>
        
        <input type="submit" value="تحديث البطاقة">
    </form>
</body>
</html>
