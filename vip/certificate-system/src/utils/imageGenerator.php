<?php
function generateImage($data, $templatePath, $outputPath) {
    // Load the template
    $image = imagecreatefrompng($templatePath);
    
    // Set the colors
    $textColor = imagecolorallocate($image, 0, 0, 0); // Black color for text

    // Add the text to the image
    $fontPath = __DIR__ . '/fonts/arial.ttf'; // Path to the font file
    $fontSize = 20; // Font size
    $x = 100; // X position
    $y = 150; // Y position

    // Assuming $data contains 'name' and 'date' fields
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $data['name']);
    imagettftext($image, $fontSize, 0, $x, $y + 30, $textColor, $fontPath, $data['date']);

    // Save the image
    imagepng($image, $outputPath);
    imagedestroy($image);
}

function createCertificateImage($name, $date, $templateId) {
    $templatePath = __DIR__ . "/templates/template{$templateId}.png"; // Path to the selected template
    $outputPath = __DIR__ . "/output/certificate_{$name}.png"; // Output path for the generated image

    $data = [
        'name' => $name,
        'date' => $date
    ];

    generateImage($data, $templatePath, $outputPath);
    return $outputPath;
}
?>