<?php
// exports/export_pdf.php
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

// Include FPDF library (download from http://www.fpdf.org and place it in the fpdf folder)
require('../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10, $card['title'], 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,10, $card['content'], 0, 'C');
$pdf->Output();
?>
