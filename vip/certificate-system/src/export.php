<?php
require_once 'config/database.php';
require_once 'models/Certificate.php';
require_once 'utils/pdfGenerator.php';
require_once 'utils/imageGenerator.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: views/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $certificateId = $_POST['certificate_id'];
    $format = $_POST['format'];

    $certificateModel = new Certificate();
    $certificateData = $certificateModel->getCertificateById($certificateId);

    if ($format === 'pdf') {
        $pdf = generatePDF($certificateData);
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="certificate.pdf"');
        echo $pdf;
    } elseif ($format === 'image') {
        $image = generateImage($certificateData);
        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename="certificate.png"');
        echo $image;
    } else {
        echo "Invalid format selected.";
    }
} else {
    echo "Invalid request method.";
}
?>