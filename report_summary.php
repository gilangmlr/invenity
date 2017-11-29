<?php
session_start();

/**
*   Required Class
*/
require_once(__DIR__ . '/lib/db.class.php');
require_once(__DIR__ . '/class/user.class.php');
require_once(__DIR__ . '/class/inventory.class.php');
require_once(__DIR__ . '/class/location.class.php');
require_once(__DIR__ . '/class/device.class.php');
require_once(__DIR__ . '/class/loan.class.php');
require('assets/plugins/fpdf181/fpdf.php');

// Get Datas
$by       = $_GET['by'];
$criteria = '';

// If criteria is set
if (isset($_GET['criteria']) && $_GET['criteria']!='') {
    $criteria = $_GET['criteria'];
}

class PDF extends FPDF
{

    // Page header
    function Header()
    {
        global $by;
        $this->invClass  = new Inventory();
        $report_name = ucwords(str_replace("_", " ", $_GET['name']));
        // Logo
        if ($this->invClass->setting_data("inventory_logo")!="") { 
            $logo_image = "assets/images/".$this->invClass->setting_data("inventory_logo"); } 
        else {
            $logo_image = "assets/images/logo.png";
        }
        $this->Image($logo_image,10,6,50);

        // Arial bold 15
        // Move to the right
        // Title
        $this->SetFont('Arial','B',15);
        $this->Cell(120);
        $this->Cell(30,10,$this->invClass->setting_data("inventory_name"),0,1,'C');

        $this->SetFont('Arial','',12);
        $this->Cell(120);
        $this->Cell(30,5,'Report '.$report_name,0,0,'C');
        // Line break
        $this->Ln(10);

        $this->SetFont('Times','',8);
        $this->Cell(14, 5, "Printed by: ", 0, 0);
        $this->Cell(24, 5, trippleDot($_SESSION['username'], 28), 0, 0);
        $this->Ln(5);
        $this->Cell(16, 5, "Created date: ", 0, 0);
        $this->Cell(20, 5, date('Y-m-d'), 0, 0);
        // Line break
        $this->Ln(10);


        // Table header
        $this->SetFont('Arial','B',9);
        $this->Cell(12, 10, "No", 1, 0);
        if ($by === 'loan') {
            $this->Cell(20, 10, "Date", 1, 0);
            $this->Cell(16, 10, "Name", 1, 0);
        }
        $this->Cell(28, 10, "Code", 1, 0);
        $this->Cell(25, 10, "Type", 1, 0);
        $this->Cell(25, 10, "Brand", 1, 0);
        $this->Cell(25, 10, "Model", 1, 0);
        $this->Cell(35, 10, "Serial Number", 1, 0);
        $this->Cell(48, 10, "Location", 1, 0);
        $this->Cell(15, 10, "Status", 1, 0);
        $this->Cell(20, 10, "Return Date", 1, 1);

    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation of inherited class
$invClass      = new Inventory();
$deviceClass   = new DeviceClass();
$locationClass = new LocationClass();
$pdf           = new PDF('L');
$report_name   = ucwords(str_replace("_", " ", $_GET['name']));
$pdf->AliasNbPages();
$pdf->SetTitle($invClass->setting_data("inventory_name")." Report " . $report_name);
$pdf->SetCreator("anoerman");
$pdf->SetAuthor("anoerman");
$pdf->SetSubject($invClass->setting_data("inventory_name")." Report " . $report_name);
$pdf->AddPage();
$pdf->SetFont('Times','',8);

function trippleDot($str, $width) {
    $w = intval($width / 2) + 5;
    $trimmed = $str;
    // var_dump($w, $str, count($str));
    if (strlen($str) > $w) {
        $trimmed = substr($str, 0, $w) . '...';
    }
    // var_dump($trimmed);
    // echo nl2br ("\n");
    return $trimmed;
}

$no = 0;
if ($by === 'loan') {
    $datas = (new LoanClass())->show_loans();
} else {
    $datas = $deviceClass->show_device_report($by, $criteria);
}
foreach ($datas as $data) {
    $no++;

    // if location details enabled
    if ($invClass->setting_data("location_details")=="enable") {
        $locationdetail = $data['place_name'].", ".$data['building_name'].", ".$data['floor_name'].", ".$data['location_name'];
    }
    else {
        $locationdetail = $data['location_name'];
    }

    $pdf->Cell(12, 10, $no, 1, 0);
    if ($by === 'loan') {
        $pdf->Cell(20, 10, $data['loan_date_formatted'], 1, 0);
        $pdf->Cell(16, 10, trippleDot($data['loan_name'], 16), 1, 0);
    }
    $pdf->Cell(28, 10, $data['device_code'], 1, 0);
    $pdf->Cell(25, 10, trippleDot($data['type_name'], 25), 1, 0);
    $pdf->Cell(25, 10, trippleDot($data['device_brand'], 25), 1, 0);
    $pdf->Cell(25, 10, trippleDot($data['device_model'], 25), 1, 0);
    $pdf->Cell(35, 10, trippleDot($data['device_serial'], 35), 1, 0);
    $pdf->Cell(48, 10, trippleDot($locationdetail, 48), 1, 0);
    $pdf->Cell(15, 10, ucfirst($data['device_status']), 1, 0);
    $pdf->Cell(20, 10, $data['real_return_date_formatted'], 1, 1);
    // die();
}

$pdf->Output();
?>