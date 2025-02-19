<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../controllers/AuthController.php';
    $authController = new AuthController();
    $authController->login($_POST['username'], $_POST['password']);
}

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/styles.css">
    <title>تسجيل الدخول</title>
</head>
<body>
    <div class="login-container">
        <h2>تسجيل الدخول إلى النظام</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">اسم المستخدم:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">تسجيل الدخول</button>
        </form>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>