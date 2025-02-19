<?php
// admin/cards.php
require_once '../functions.php';
redirect_if_not_logged_in();
$conn = db_connect();

$sql = "SELECT cards.*, categories.name AS category_name FROM cards 
        LEFT JOIN categories ON cards.category_id = categories.id 
        ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة البطاقات</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>إدارة البطاقات</h1>
    <nav>
        <a href="index.php">لوحة التحكم</a> | 
        <a href="add_card.php">إضافة بطاقة جديدة</a> | 
        <a href="categories.php">إدارة الفئات</a> | 
        <a href="logout.php">تسجيل الخروج</a>
    </nav>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>العنوان</th>
            <th>الفئة</th>
            <th>الإجراءات</th>
        </tr>
        <?php while($card = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($card['title']); ?></td>
            <td><?php echo htmlspecialchars($card['category_name']); ?></td>
            <td>
                <a href="edit_card.php?id=<?php echo $card['id']; ?>">تعديل</a> | 
                <a href="delete_card.php?id=<?php echo $card['id']; ?>" onclick="return confirm('هل أنت متأكد من حذف هذه البطاقة؟');">حذف</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
