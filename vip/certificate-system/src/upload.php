<?php
// This file handles the uploading of Excel files for batch name entry.

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file'];

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Upload failed with error code " . $file['error']);
    }

    // Validate file type
    $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
    if ($fileType !== 'xls' && $fileType !== 'xlsx') {
        die("Invalid file type. Please upload an Excel file.");
    }

    // Move the uploaded file to a designated directory
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $filePath = $uploadDir . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Process the Excel file (e.g., read names and save to database)
        // You can use a library like PhpSpreadsheet to read the Excel file
        require_once 'vendor/autoload.php';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // Assuming the first column contains names
        foreach ($sheetData as $row) {
            $name = $row[0];
            // Save the name to the database (implement your database logic here)
        }

        echo "File uploaded and names processed successfully.";
    } else {
        die("Failed to move uploaded file.");
    }
} else {
    echo "No file uploaded.";
}
?>