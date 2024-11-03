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

$link = LIVE_URL.'pdf/' . $barcode . '.png';

$price = 'Price: '.$item->salePrice.' Rs/-';


$headers = @get_headers($link);
if ($headers && strpos($headers[0], '200') !== false) {
	
} else {
	$this->Commonmodel->generateProductBarcode($barcode);
}

for ($x = 1; $x <= $qty; $x++) {
$this->fpdf->AddPage('P', [47, 50], 0); // left W, Right H
$margin = 1.5;
// $this->fpdf->SetDrawColor(28, 167, 79);
// $this->fpdf->DashedRect( $margin, $margin , 53 - $margin , 35 - $margin,0.3);
// $this->fpdf->SetTextColor(35, 31, 32);
$this->fpdf->SetTitle('Barcode Label');
// $this->fpdf->SetAutoPageBreak(false);

$this->fpdf->SetFont('Calibrib', '', 7);
$this->fpdf->Cell(0,-3,$item->itemName,0,5,'C');
$this->fpdf->Cell(0,-4,$price,0,5,'C');

// $link = $this->Commonmodel->generateProductBarcode('7941GRN-100888');

// echo $link; die;
// $this->fpdf->Image($link, 4, 12, 45);	
$this->fpdf->Image($link, 1, 12, 45, 20);  // 45 width, 20 height

}

$this->fpdf->Output();

ob_end_flush(); // Flush the output buffer
exit;
?>

