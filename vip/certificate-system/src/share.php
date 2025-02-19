<?php
session_start();

function shareCertificate($certificateId, $platform) {
    // Fetch certificate details from the database
    include_once 'config/database.php';
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT * FROM certificates WHERE id = :id");
    $stmt->bindParam(':id', $certificateId);
    $stmt->execute();
    $certificate = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$certificate) {
        return "Certificate not found.";
    }

    $message = "Check out this certificate: " . $certificate['name'];
    $url = "https://yourdomain.com/certificate/view.php?id=" . $certificateId;

    if ($platform === 'whatsapp') {
        $whatsappUrl = "https://api.whatsapp.com/send?text=" . urlencode($message . " " . $url);
        header("Location: $whatsappUrl");
    } elseif ($platform === 'facebook') {
        $facebookUrl = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($url);
        header("Location: $facebookUrl");
    } else {
        return "Invalid platform specified.";
    }

    exit();
}

// Example usage
if (isset($_GET['id']) && isset($_GET['platform'])) {
    shareCertificate($_GET['id'], $_GET['platform']);
}
?>