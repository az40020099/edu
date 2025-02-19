<?php
// admin/edit_category.php
require_once '../functions.php';
redirect_if_not_logged_in();
$conn = db_connect();

if (!isset($_GET['id'])) {
    header("Location: categories.php");
    exit;
}
$id = intval($_GET['id']);

// Fetch category
$result = $conn->query("SELECT * FROM categories WHERE id = $id");
if ($result->num_rows == 0) {
    die("الفئة غير موجودة.");
}
$category = $result->fetch_assoc();

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    if($name != ''){
        $stmt = $conn->prepare("UPDATE categories SET name=? WHERE id=?");
        $stmt->bind_param("si", $name, $id);
        if($stmt->execute()){
            header("Location: categories.php");
            exit;
        } else {
            $error = "خطأ في تحديث الفئة.";
        }
    } else {
        $error = "يرجى إدخال اسم الفئة.";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل الفئة</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>تعديل الفئة</h1>
    <nav>
        <a href="index.php">لوحة التحكم</a> | 
        <a href="categories.php">إدارة الفئات</a> | 
        <a href="logout.php">تسجيل الخروج</a>
    </nav>
    <?php if($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label>اسم الفئة:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required><br><br>
        <input type="submit" value="تحديث الفئة">
    </form>
</body>
</html>
