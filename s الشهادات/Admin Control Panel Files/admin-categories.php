<?php
// admin/categories.php
require_once '../functions.php';
redirect_if_not_logged_in();
$conn = db_connect();

$sql = "SELECT * FROM categories ORDER BY name ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الفئات</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>إدارة الفئات</h1>
    <nav>
        <a href="index.php">لوحة التحكم</a> | 
        <a href="add_category.php">إضافة فئة جديدة</a> | 
        <a href="cards.php">إدارة البطاقات</a> | 
        <a href="logout.php">تسجيل الخروج</a>
    </nav>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>اسم الفئة</th>
            <th>الإجراءات</th>
        </tr>
        <?php while($cat = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($cat['name']); ?></td>
            <td>
                <a href="edit_category.php?id=<?php echo $cat['id']; ?>">تعديل</a> | 
                <a href="delete_category.php?id=<?php echo $cat['id']; ?>" onclick="return confirm('هل أنت متأكد من حذف هذه الفئة؟');">حذف</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
