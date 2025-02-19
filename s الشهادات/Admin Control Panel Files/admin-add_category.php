<?php
// admin/add_category.php
require_once '../functions.php';
redirect_if_not_logged_in();
$conn = db_connect();

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    if($name != ''){
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        if($stmt->execute()){
            header("Location: categories.php");
            exit;
        } else {
            $error = "خطأ في إضافة الفئة.";
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
    <title>إضافة فئة جديدة</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>إضافة فئة جديدة</h1>
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
        <input type="text" name="name" required><br><br>
        <input type="submit" value="إضافة الفئة">
    </form>
</body>
</html>
