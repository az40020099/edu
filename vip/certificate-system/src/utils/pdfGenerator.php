<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

function generateCertificatePDF($data, $templatePath) {
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf = new Dompdf($options);

    ob_start();
    include($templatePath);
    $html = ob_get_clean();

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    return $dompdf->output();
}

function savePDF($pdfContent, $filename) {
    file_put_contents($filename, $pdfContent);
}
?>