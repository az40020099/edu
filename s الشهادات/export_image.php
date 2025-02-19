<?php
// exports/export_image.php
require_once '../functions.php';

if (!isset($_GET['card_id'])) {
    die("Card ID is missing.");
}

$card_id = intval($_GET['card_id']);
$conn = db_connect();

$sql = "SELECT * FROM cards WHERE id = $card_id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    die("Card not found.");
}
$card = $result->fetch_assoc();

// Define image dimensions
$width = 800;
$height = 600;
$image = imagecreatetruecolor($width, $height);

// Colors
$bg_color = imagecolorallocate($image, 255, 255, 255); // White
$text_color = imagecolorallocate($image, 0, 0, 0);       // Black

// Fill background
imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

// Set font parameters (adjust as needed)
// Make sure you have a TTF font file in assets/fonts (e.g., arial.ttf)
$font_size = $card['size'] ? intval($card['size']) : 20;
$font_file = __DIR__ . '/../assets/fonts/arial.ttf';  
if (!file_exists($font_file)) {
    // Fallback using built-in fonts
    imagestring($image, 5, 10, 10, $card['title'], $text_color);
} else {
    // Center the title text
    $bbox = imagettfbbox($font_size, 0, $font_file, $card['title']);
    $text_width = $bbox[2] - $bbox[0];
    $x = ($width - $text_width) / 2;
    $y = 100;
    imagettftext($image, $font_size, 0, $x, $y, $text_color, $font_file, $card['title']);
    
    // Add the content text
    $content_font_size = max($font_size - 4, 12);
    $bbox = imagettfbbox($content_font_size, 0, $font_file, $card['content']);
    $text_width = $bbox[2] - $bbox[0];
    $x = ($width - $text_width) / 2;
    $y = 200;
    imagettftext($image, $content_font_size, 0, $x, $y, $text_color, $font_file, $card['content']);
}

// Output as PNG
header("Content-Type: image/png");
imagepng($image);
imagedestroy($image);
?>
