<?php
session_start();

class AuthController {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function getUser() {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }
}
?>