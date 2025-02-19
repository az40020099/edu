<?php
// admin/index.php
require_once '../functions.php';
redirect_if_not_logged_in();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>مرحباً بكم في لوحة التحكم</h1>
    <nav>
        <a href="cards.php">إدارة البطاقات</a> | 
        <a href="categories.php">إدارة الفئات</a> | 
        <a href="logout.php">تسجيل الخروج</a>
    </nav>
</body>
</html>
