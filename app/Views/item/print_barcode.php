<?php
use App\Libraries\FpdfLib;
use App\Models\Commonmodel;
$this->Commonmodel = new Commonmodel();
ob_start(); // Start output buffering
error_reporting(0); // Disable error reporting
header_remove();
setlocale(LC_CTYPE, 'en_US');
$param = array('orientation' => 'L', 'unit' => 'mm', 'size' => 'labels');
$this->fpdf = new FpdfLib($param);

$url = base_url();
if (SITE == 'local') {
    define('WEBROOT', $_SERVER['DOCUMENT_ROOT'] . '/poslite');
} else {
    define('WEBROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
}

for ($x = 1; $x <= $qty; $x++) {
$this->fpdf->AddPage('L', [35, 50], 0);
$margin = 1.5;
// $this->fpdf->SetDrawColor(28, 167, 79);
// $this->fpdf->DashedRect( $margin, $margin , 53 - $margin , 53 - $margin,0.3);
// $this->fpdf->SetTextColor(35, 31, 32);
$this->fpdf->SetTitle('Barcode Label');
// $this->fpdf->SetAutoPageBreak(false);

$this->fpdf->SetFont('Calibrib', '', 6);
$this->fpdf->Cell(0,-5,$item->itemName,0,2,'C');

// $link = $this->Commonmodel->generateProductBarcode('7941GRN-100888');
$link = $this->Commonmodel->generateProductBarcode($barcode);
// $this->fpdf->Image($link, 4, 12, 45);	
$this->fpdf->Image($link, 4, 12, 45, 20);  // 45 width, 20 height

}

$this->fpdf->Output();

ob_end_flush(); // Flush the output buffer
exit;
?>

