<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include necessary files
require_once '../controllers/CertificateController.php';
require_once '../controllers/AuthController.php';

$certificateController = new CertificateController();
$certificates = $certificateController->getAllCertificates();

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>لوحة التحكم</title>
</head>
<body>
    <div class="container">
        <h1>لوحة التحكم لإدارة الشهادات</h1>
        <nav>
            <ul>
                <li><a href="create_certificate.php">إنشاء شهادة جديدة</a></li>
                <li><a href="manage_users.php">إدارة المستخدمين</a></li>
                <li><a href="export.php">تصدير الشهادات</a></li>
                <li><a href="logout.php">تسجيل الخروج</a></li>
            </ul>
        </nav>
        
        <h2>الشهادات الحالية</h2>
        <table>
            <thead>
                <tr>
                    <th>رقم الشهادة</th>
                    <th>اسم الطالب</th>
                    <th>تاريخ الإصدار</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($certificates as $certificate): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($certificate['id']); ?></td>
                        <td><?php echo htmlspecialchars($certificate['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($certificate['issue_date']); ?></td>
                        <td>
                            <a href="edit_certificate.php?id=<?php echo $certificate['id']; ?>">تعديل</a>
                            <a href="delete_certificate.php?id=<?php echo $certificate['id']; ?>">حذف</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>