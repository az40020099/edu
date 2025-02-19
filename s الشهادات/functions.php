<?php
// functions.php
require_once 'config.php';

function db_connect() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Set charset for Arabic support
    $conn->set_charset("utf8");
    return $conn;
}

function is_logged_in() {
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    return isset($_SESSION['user_id']);
}

function redirect_if_not_logged_in() {
    if (!is_logged_in()) {
        header("Location: admin/login.php");
        exit;
    }
}
?>
