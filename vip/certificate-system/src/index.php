<?php
require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/CertificateController.php';

session_start();

$authController = new AuthController();
$certificateController = new CertificateController();

if (isset($_SESSION['user_id'])) {
    // User is logged in, redirect to dashboard
    header("Location: views/dashboard.php");
    exit();
} else {
    // User is not logged in, redirect to login page
    header("Location: views/login.php");
    exit();
}
?>