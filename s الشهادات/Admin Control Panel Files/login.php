<?php
// admin/login.php
session_start();
require_once '../functions.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = db_connect();
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $db_password);
        $stmt->fetch();
        // Simple MD5 check – for production use password_hash() and password_verify()
        if(md5($password) == $db_password) {
            $_SESSION['user_id'] = $user_id;
            header("Location: index.php");
            exit;
        } else {
            $error = "اسم المستخدم أو كلمة المرور غير صحيحة.";
        }
    } else {
        $error = "اسم المستخدم أو كلمة المرور غير صحيحة.";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول - لوحة التحكم</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>تسجيل الدخول - لوحة التحكم</h1>
    <?php if($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label>اسم المستخدم:</label><br>
        <input type="text" name="username" required><br><br>
        <label>كلمة المرور:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="تسجيل الدخول">
    </form>
</body>
</html>
