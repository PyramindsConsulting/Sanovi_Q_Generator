<?php
require 'PHPMailer-master/PHPMailerAutoload.php';
require('fpdf/fpdf.php');
//include('fpdf/word-wrap.php');

$pdf = new FPDF('P','mm','A4'); //P=PORTRAIT (& L=FOR LANDSCAPE );PAGE DIMENSIONS-MM(OR CM, IN); PAGE SIZE = A4(OR A3, A2)
$pdf->SetFillColor(179, 179, 179); //FILL COLOR = GREY
$pdf->AddPage(); //ADD A NEW PAGE
$pdf->SetFont('Arial','',10); //SET FONT, SIZE, STYLE

$pdf->Cell(40,10,'',0,0);
$pdf->Image('images/Sanovi-Logo-Mobile.png',80,10,0,0);
$pdf->ln();

//REFERENCE NUMBER, DATE, CUSTOMER NAME
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,5,'Ref No : ',0,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,5,'SAN/2016-17/001',0,1,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,5,'Ver No : ',0,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,5,'001',0,1,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,5,'Date :',0,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,5,'00/00/0000',0,1,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,5,'Customer Name : ',0,0,'L'); 
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,5,'Pyraminds Consulting Pvt Ltd.,',0,0,'L'); 

//INITIAL NOTE
$pdf->ln();
$pdf->ln();
$pdf->Cell(0,5,'Dear,',0,0);
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,'This is with reference to our discussion, we are pleased to offer the below detailed commercials.',0,'L');
$pdf->ln();

//TABLE HEADING
$pdf->Line(200,58,10,58);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,5,'Description',0,0);
$pdf->Cell(35,5,'Price(USD)',0,0);
$pdf->Cell(30,5,'Discount %',0,0);
$pdf->Cell(40,5,'Discount Value(USD)',0,0);
$pdf->Cell(40,5,'Final Price(USD)',0,0);
$pdf->Line(200,67,10,67);
$pdf->ln();

//QUOTE SUMMARY DESCRIPTION
$pdf->SetFont('Arial','',8);
$pdf->ln();

//$text=str_repeat('License fee for Prepetual Sanovi Cloud Continuity Module',20);
//$nb=$pdf->WordWrap($text,120);
//$pdf->MultiCell( 200, 40, $reportSubtitle, 1);
$pdf->MultiCell(60,5,'License fee for Prepetual Sanovi Cloud Continuity Module',0,'L');

//LICENSING PRICES & DISCOUNTS
$pdf->Cell(60,5,'- Licensing',0,0); //
$pdf->Cell(16,5,'Licensing $',0,0,'R');
$pdf->Cell(35,5,'Licensing $',0,0,'R');
$pdf->Cell(36,5,'Licensing $',0,0,'R');
$pdf->Cell(38,5,'Licensing $',0,0,'R');
$pdf->ln();
$pdf->Cell(60,5,'- Product Support',0,0);
$pdf->Cell(16,5,'Product Support $',0,0,'R');
$pdf->Cell(35,5,'Product Support $',0,0,'R');
$pdf->Cell(36,5,'Product Support $',0,0,'R');
$pdf->Cell(38,5,'Product Support $',0,0,'R');
$pdf->ln();
$pdf->Cell(60,5,'- Professional Services',0,0);
$pdf->Cell(16,5,'Professional Services $',0,0,'R');
$pdf->Cell(35,5,'Professional Services $',0,0,'R');
$pdf->Cell(36,5,'Professional Services $',0,0,'R');
$pdf->Cell(38,5,'Professional Services $',0,0,'R');
$pdf->ln();
$pdf->Cell(60,5,'- DRM Product Training',0,0);
$pdf->Cell(16,5,'DRM Product Training $',0,0,'R');
$pdf->Cell(35,5,'DRM Product Training $',0,0,'R');
$pdf->Cell(36,5,'DRM Product Training $',0,0,'R');
$pdf->Cell(38,5,'DRM Product Training $',0,0,'R');
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,5,'Total Price',0,0);
$pdf->Cell(16,5,'Total Price $',0,0,'R');
$pdf->ln();
$pdf->Line(200,113,10,113);


//PAGE - 2 ANNEXURE-1

$pdf->AddPage(); //ADD A NEW PAGE
$pdf->SetFont('Arial','B',10);
$pdf->ln();
$pdf->Cell(0,10,'Annexure-1: Bill of Quantity',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(92,10,'License Item Description',0,0,'',true);
$pdf->Cell(13,10,'Qty',0,0,'',true);
$pdf->Cell(30,10,'Total Price/USD',0,0,'',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();
$pdf->Cell(50,5,'CCM-6.0-LCL-001-LIC-VMI-EE',0,0);
//$pdf->MultiCell(86,5,'Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition',0,'L');
$test="Sanovi Cloud Continuity Module 6.0";
$pdf->Cell(86,5,$test,0,0,'L');
$pdf->Cell(13,5,'qty',0,0,'R');
$pdf->Cell(30,5,'COST $',0,0,'R');


//PAGE - 3 ANNEXURE-2
$pdf->AddPage(); //ADD A NEW PAGE
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,'Annexure-2: Customer Requirements',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,5,'Product',0,0);
$pdf->Cell(70,5,'<Cloud Continuity>',0,1);

$pdf->Cell(30,5,'License Type',0,0);
$pdf->Cell(70,5,'<Perpetual/Subscription>',0,1);

$pdf->Cell(30,5,'Mode of Sale',0,0);
$pdf->Cell(70,5,'<First Time Sale/Upgrade Sale/Support Only Sale>',0,1);

$pdf->Cell(30,5,'Product Module',0,0);
$pdf->Cell(70,5,'<DR Lifecycle/Recovery/Drill Manager>',0,1);


//2-SITE CONFIGURATION
$pdf->ln();
$pdf->Cell(40,10,'License',0,0,'L',true);
$pdf->Cell(130,10,'2-Site Configuration',0,0,'',true);
$pdf->Cell(20,10,'Qty',0,1,'',true);

$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,'',0,0,'L');
$pdf->Cell(130,5,'2-Site Configuration Question',0,0,'L');
$pdf->Cell(20,5,'Qty',0,0,'L');

//3-SITE CONFIGURATION
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(40,10,'License',0,0,'L',true);
$pdf->Cell(130,10,'3-Site Configuration',0,0,'',true);
$pdf->Cell(20,10,'Qty',0,1,'',true);

$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,'',0,0,'L');
$pdf->Cell(130,5,'3-Site Configuration Question',0,0,'L');
$pdf->Cell(20,5,'Qty',0,0,'L');


$pdf->ln();

//PAGE - 4 ANNEXURE-3
$pdf->AddPage(); //ADD A NEW PAGE
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,'Annexure-3: Professional Services Requirements',0,0);
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(40,10,'',0,0,'',true);
$pdf->Cell(130,10,'Professional Services Requirement 3 Site/Bunker Site Configuration',0,0,'',true);
$pdf->Cell(20,10,'Qty',0,1,'',true);

$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,'',0,0,'L');
$pdf->Cell(130,5,'Professional Service Questions',0,0,'L');
$pdf->Cell(20,5,'Qty',0,0,'L');


//PAGE - 5 ANNEXURE-3
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->ln();
$pdf->Cell(100,10,'Annexure-3: Product Support Requirements',0,0);
$pdf->ln();

$pdf->SetFont('Arial','',10);
$pdf->Cell(40,10,'',0,0,'',true);
$pdf->Cell(130,10,'Product Support Requirements',0,0,'',true);
$pdf->Cell(20,10,'Qty',0,1,'',true);

$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,'',0,0,'L');
$pdf->Cell(130,5,'Professional Service Questions',0,0,'L');
$pdf->Cell(20,5,'Qty',0,0,'L');



$pdfdoc = $pdf->Output('', 'S');

//open the file in preview(monitor)
$pdf->Output();
