<?php

session_start(); 
ob_start();

if($_SESSION["authentication"] == "passed"){

require('fpdf/fpdf.php');
class PDF_Rotate extends FPDF {

var $angle = 0;

function Rotate($angle, $x = -1, $y = -1) {
    if ($x == -1)
        $x = $this->x;
    if ($y == -1)
        $y = $this->y;
    if ($this->angle != 0)
        $this->_out('Q');
    $this->angle = $angle;
    if ($angle != 0) {
        $angle*=M_PI / 180;
        $c = cos($angle);
        $s = sin($angle);
        $cx = $x * $this->k;
        $cy = ($this->h - $y) * $this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
    }
 }

function _endpage() {
    if ($this->angle != 0) {
        $this->angle = 0;
        $this->_out('Q');
    }
    parent::_endpage();
}

}

class PDF extends PDF_Rotate {

function Header() {
    //Put the watermark
//    $this->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World',40,100,100,0,'PNG');
    $this->SetFont('Arial', '', 50);
//    $this->SetTextColor(255, 192, 203);
    $this->SetTextColor(152,251,152);
//    $this->SetTextColor(84, 175, 58);
    $this->RotatedText(40, 245, 'SANOVI TECHNOLOGIES', 55);
}

function RotatedText($x, $y, $txt, $angle) {
    //Text rotated around its origin
    $this->Rotate($angle, $x, $y);
    $this->Text($x, $y, $txt);
    $this->Rotate(0);
 }

} 
include ("../../includes/config.php");
include('../../includes/php_function_quote.php');

//$print_r($_SESSION['prod_qty_ary']);
$refId=$_SESSION['ref_id'];
$verId="1";
$currency=$_SESSION['currency'];
//    echo $refId;
$lgt_data=NewQuote_lgt_values($refId,$verId);
$lht_data=NewQuote_lht_values($refId,$verId);



//general info
$OrgName=$_SESSION['OrgName'];
//echo $_SESSION['OrgName'];
$license=$_SESSION['license'];
$product=$_SESSION['product'];
$ModeOfSale=$_SESSION['modeofsale'];
$ProdModule=$_SESSION['productModule'];
//product support
$ProdSupport=$_SESSION['productSupport'];

$license_qty=$_SESSION['license_qty_ary'];
$licensecount=count($license_qty);

$prod_qty=$_SESSION['prod_qty_ary'];
$prodcount=count($prod_qty);
//
$prof_qty=$_SESSION['prof_qty_ary'];
$profcount=count($prof_qty);

//customer requirements license_2s qty
$license_2s_cust_qty=$_SESSION['license_2s_qty'];
$license_2s_cust_qty=remove_null($license_2s_cust_qty);
$license2scount=count($license_2s_cust_qty);

//customer requirements license_3s qty
$license_3s_cust_qty=$_SESSION['license_3s_qty'];
$license_3s_cust_qty=remove_null($license_3s_cust_qty);
$license3scount=count($license_3s_cust_qty);

//customer requirements prof qty
$Prof_cust_qty=$_SESSION['prof_qty'];
$Prof_cust_qty=remove_null($Prof_cust_qty);
$Profcustqty=count($Prof_cust_qty);

$master_license=masterServerLicense();
$master_license_count=count($master_license);
$master_product=masterServerproduct();
$master_product_count=count($master_product);
$master_prof=masterServerProf();
$master_prof_count=count($master_prof);
    
    
$pdf = new PDF();
//$pdf = new FPDF('P','mm','A4'); //P=PORTRAIT (& L=FOR LANDSCAPE );PAGE DIMENSIONS-MM(OR CM, IN); PAGE SIZE = A4(OR A3, A2)
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
$pdf->Cell(0,5,$refId,0,1,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,5,'Ver No : ',0,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,5,'1',0,1,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,5,'Date :',0,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,5,$lgt_data['date'],0,1,'L');
//$pdf->Cell(0,5,'date',0,1,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,5,'Customer Name : ',0,0,'L'); 
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,5,$OrgName,0,0,'L'); 

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
$pdf->Cell(155,5,'Item',0,0);
//$pdf->Cell(35,5,'List Price ('.$currency.')',0,0);
//$pdf->Cell(30,5,'Discount %',0,0);
//$pdf->Cell(40,5,'Discount Value '.$currency,0,0);
$pdf->Cell(40,5,'Final Price '.$currency,0,0);
$pdf->Line(200,67,10,67);
$pdf->ln();

//QUOTE SUMMARY DESCRIPTION
$pdf->SetFont('Arial','',8);
$pdf->ln();

//$text=str_repeat('License fee for Perpetual Sanovi Cloud Continuity Module',20);
//$nb=$pdf->WordWrap($text,120);
//$pdf->MultiCell( 200, 40, $reportSubtitle, 1);
if($license=="Perpetual"){    
$pdf->MultiCell(60,5,'License fee for Perpetual Sanovi Cloud Continuity Module',0,'L');
}else{
$pdf->MultiCell(80,5,'License fee for Subscription Sanovi Cloud Continuity Module',0,'L');
}
//LICENSING PRICES & DISCOUNTS
$pdf->Cell(103,5,'- Licensing',0,0); //
$licensing=currency_format($lht_data["licenseCost"],$currency);
//$pdf->Cell(23,5,$licensing,0,0,'R');
//$pdf->Cell(25,5,$lht_data["discountPercentageOnLicense"],0,0,'R');
$pdf->Cell(36,5,'-',0,0,'R');
//$finalLicenseCost=currency_format($lht_data["finalLicenseCost"],$currency);
$pdf->Cell(42,5,currency_format($lht_data["finalLicenseCost"],$currency),0,0,'R');
$pdf->ln();
if($license=="Perpetual"){    
$pdf->Cell(103,5,'- Product Support',0,0);
//$pdf->Cell(23,5,currency_format($lht_data["productSupportCost"],$currency),0,0,'R');
//$pdf->Cell(25,5,$lht_data["discountPercentageOnSupport"],0,0,'R');
$pdf->Cell(36,5,'-',0,0,'R');
$pdf->Cell(42,5,currency_format($lht_data["finalSupportCost"],$currency),0,0,'R');
$pdf->ln();
}else{
    
}
$pdf->Cell(103,5,'- Professional Services',0,0);
//$pdf->Cell(23,5,currency_format($lht_data["PSCost"],$currency),0,0,'R');
//$pdf->Cell(25,5,$lht_data["discountPercentageOnPS"],0,0,'R');
$pdf->Cell(36,5,'-',0,0,'R');
$pdf->Cell(42,5,currency_format($lht_data["finalPSCost"],$currency),0,0,'R');
$pdf->ln();
$pdf->Cell(103,5,'- DRM Product Training',0,0);
//$pdf->Cell(23,5,currency_format($lht_data["trainingCost"],$currency),0,0,'R');
//$pdf->Cell(25,5,$lht_data["discountPercentageOnTraining"],0,0,'R');
$pdf->Cell(36,5,'-',0,0,'R');
$pdf->Cell(42,5,currency_format($lht_data["finalTrainingCost"],$currency),0,0,'R');
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(160,5,'Total Price',0,0);
$pdf->Cell(23,5,currency_format($lht_data["totalValue"],$currency),0,0,'R');
//$pdf->Cell(16,5,currency_format($lht_data["totalValue"],$currency),0,0,'R');
$pdf->ln();
$pdf->Line(200,113,10,113);


//PAGE - 2 ANNEXURE-1
$annexure1=displayAnnexure_1($refId,$verId);
if($annexure1=="Yes"){
$pdf->AddPage('P','A4'); //ADD A NEW PAGE
$pdf->SetFont('Arial','B',10);
$pdf->ln();
$pdf->Cell(0,10,'Annexure-1: Bill of Quantity',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(70,10,'License Item Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'Total Price '.$currency,0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$licensecount;$i++) {
      if($license_qty[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$license_qty[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,6,$license_qty[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$license_qty[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,currency_format($license_qty[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_license_count;$i++) {
      if($master_license[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$master_license[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,6,$master_license[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$master_license[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,currency_format($master_license[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(70,10,'Professional service Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'Total Price '.$currency,0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$profcount;$i++) {
      if($prof_qty[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$prof_qty[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$prof_qty[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$prof_qty[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,currency_format($prof_qty[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_prof_count;$i++) {
      if($master_prof[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$master_prof[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$master_prof[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$master_prof[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,currency_format($master_prof[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
//$prof_premise_product_training=$prof_qty[16][1];
$nodeservers=count_node_servers($license_2s_cust_qty,$license_3s_cust_qty);
$premise_product_training= premiseProductTraining($ModeOfSale,$prof_premise_product_training,$nodeservers);
$premise_product_training_count=count($premise_product_training);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$premise_product_training_count;$i++) {
      if($premise_product_training[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$premise_product_training[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,6,$premise_product_training[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$premise_product_training[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,currency_format($premise_product_training[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
    
//PRODUCT BILLING QUANTITY 
if($license=="Perpetual"){    
$pdf->ln();
$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(70,10,'Product Support Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'Total Price '.$currency,0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$prodcount;$i++) {
      if($license_qty[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }
          $product_desc=$ProdSupport." year(s) of ".$prod_qty[$i][1];
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$prod_qty[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$product_desc,0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$prod_qty[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,currency_format($prod_qty[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_product_count;$i++) {
      if($master_product[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }
          $product_desc=$ProdSupport." year(s) of ".$master_product[$i][1];
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$master_product[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$product_desc,0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$master_product[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,currency_format($master_product[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
}else{
    
}
}//End of Annexure 1 If loop
else{
$pdf->AddPage('P','A4'); //ADD A NEW PAGE
$pdf->SetFont('Arial','B',10);
$pdf->ln();
$pdf->Cell(0,10,'Annexure-1: Bill of Quantity',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(80,10,'License Item Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'                ',0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$licensecount;$i++) {
      if($license_qty[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$license_qty[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$license_qty[$i][1],0,'L');
        $pdf->SetXY($x+80,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$license_qty[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_license_count;$i++) {
      if($master_license[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$master_license[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$master_license[$i][1],0,'L');
        $pdf->SetXY($x+80,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$master_license[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
    
//PROFESSIONAL BILLING QUANTITY    
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(80,10,'Professional service Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'                         ',0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$profcount;$i++) {
      if($prof_qty[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$prof_qty[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$prof_qty[$i][1],0,'L');
        $pdf->SetXY($x+80,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$prof_qty[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_prof_count;$i++) {
      if($master_prof[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$master_prof[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$master_prof[$i][1],0,'L');
        $pdf->SetXY($x+80,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$master_prof[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
//$prof_premise_product_training=$prof_qty[16][1];
$nodeservers=count_node_servers($license_2s_cust_qty,$license_3s_cust_qty);
$premise_product_training= premiseProductTraining($ModeOfSale,$prof_premise_product_training,$nodeservers);
$premise_product_training_count=count($premise_product_training);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$premise_product_training_count;$i++) {
      if($premise_product_training[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$premise_product_training[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$premise_product_training[$i][1],0,'L');
        $pdf->SetXY($x+80,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$premise_product_training[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
//PRODUCT BILLING QUANTITY
if($license=="Perpetual"){    
$pdf->ln();
$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(70,10,'Product Support Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'               ',0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$prodcount;$i++) {
      if($license_qty[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }
          $product_desc=$ProdSupport." year(s) of ".$prod_qty[$i][1];
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$prod_qty[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$product_desc,0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$prod_qty[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_product_count;$i++) {
      if($master_product[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }
          $product_desc=$ProdSupport." year(s) of ".$master_product[$i][1];
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$master_product[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(90,6,$product_desc,0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$master_product[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
}else{
    
}
}
//PAGE - 3 ANNEXURE-2
$pdf->AddPage('P','A4'); //ADD A NEW PAGE
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,'Annexure-2: Customer Requirements',0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,5,'Product',0,0);
$pdf->Cell(70,5,$product,0,1);

$pdf->Cell(30,5,'License Type',0,0);
$pdf->Cell(70,5,$license,0,1);

$pdf->Cell(30,5,'Mode of Sale',0,0);
$pdf->Cell(70,5,$ModeOfSale,0,1);

$pdf->Cell(30,5,'Product Module',0,0);
$pdf->Cell(70,5,$ProdModule,0,1);


//2-SITE CONFIGURATION
$pdf->ln();
$pdf->Cell(50,10,'License',0,0,'L',true);
$pdf->Cell(110,10,'2-Site Configuration',0,0,'L',true);
$pdf->Cell(35,10,'Qty',0,1,'C',true);

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$license2scount;$i++) {
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }
          
        $pdf->SetFont('Arial','',8);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(40,6,'',0,'L');
        $pdf->SetXY($x+40,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(120,6,$license_2s_cust_qty[$i][0],0,'L');
        $pdf->SetXY($x+120,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(20,6,$license_2s_cust_qty[$i][1],0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
  }
//3-SITE CONFIGURATION
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'License',0,0,'L',true);
$pdf->Cell(110,10,'3-Site Configuration',0,0,'L',true);
$pdf->Cell(35,10,'Qty',0,1,'C',true);

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$license3scount;$i++) {
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }
         
        $pdf->SetFont('Arial','',8);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(40,6,'',0,'L');
        $pdf->SetXY($x+40,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(120,6,$license_3s_cust_qty[$i][0],0,'L');
        $pdf->SetXY($x+120,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(20,6,$license_3s_cust_qty[$i][1],0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
  }

$pdf->ln();

//PAGE - 4 ANNEXURE-3
$pdf->AddPage('P','A4'); //ADD A NEW PAGE
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,'Annexure-3: Professional Services Requirements',0,0);
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'',0,0,'',true);
$pdf->Cell(110,10,'Professional Services Requirement 3 Site/Bunker Site Configuration',0,0,'L',true);
$pdf->Cell(35,10,'Qty',0,1,'C',true);

$pdf->SetFont('Arial','',8);
$pdf->Cell(40,6,'',0,0,'L');
$pdf->Cell(120,6,'Are Professional Services Required on All Purchases',0,0,'L');
$pdf->Cell(20,6,ucfirst($_SESSION['prof_service_required']),0,0,'R');

if($_SESSION['prof_service_required']=='No'){

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$Profcustqty;$i++) {
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }
          $product_desc=$ProdSupport." year(s) of ".$prod_qty[$i][1];
        $pdf->SetFont('Arial','',8);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(40,6,'',0,'L');
        $pdf->SetXY($x+40,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(120,6,$Prof_cust_qty[$i][0],0,'L');
        $pdf->SetXY($x+120,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(20,6,$Prof_cust_qty[$i][1],0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
  }
}

//PAGE - 5 ANNEXURE-3
$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','B',10);
$pdf->ln();
$pdf->Cell(100,10,'Annexure-3: Product Support Requirements',0,0);
$pdf->ln();

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,10,'',0,0,'',true);
$pdf->Cell(110,10,'Product Support Requirements',0,0,'L',true);
$pdf->Cell(35,10,'Qty',0,1,'C',true);

$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,'',0,0,'L');
$pdf->Cell(120,5,'Year(s) of Sanovi Product Support required for the Purchase',0,0,'L');
$pdf->Cell(20,5,$ProdSupport,0,0,'R');

//PAGE - 6 TERMS & CONDITIONS
$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','B',10);
$pdf->ln();
$pdf->Cell(100,10,'TERMS AND CONDITIONS',0,1);
$pdf->Cell(100,10,'Sanovi Cloud Continuity Commercial Enterprise Terms & Conditions',0,0);
$pdf->ln();

$pdf->SetFont('Arial','',10);
//$pdf->Cell(40,10,'',0,0,'',true);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(180,5,'This document provides details of commercial terms and conditions and licensing policy for Enterprise Customers who will deploy Sanovi Cloud Continuity software in their  data centres.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- The sale of Sanovi Cloud ContinuityTM software and Services is governed by the following commercial terms and conditions:',0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(180,5,'Product Support (Applicable Only for Perpetual licnese)',0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Annual Product support charges will be 20% of the License value and must be paid in advance.)',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Product support  will begin from the date of delivery of media or download of software with a validity of 12 months.)',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- The payment for Product Support Charge is in no way linked to deployment or implementation sign-off or any other milestone. These charges are to be paid every year in advance to ensure regular technical support and bug fixes.)',0,'L');

$pdf->ln();
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(180,5,'Payment Terms:',0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Subscpriton Licnese: 100% of Annual subscprion fees in advance along with purchase order',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Implemenation Services:  As per the milestones defined in the purchase order/contract.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Pricing quoted in the accompanying spreadsheet in this mail is the pricing to Business Partner for Enterprise Customers only.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- The prices quoted are exclusive of all applicable taxes and duties. Any additional taxes will be borne by Business Partner/Customer.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Perputal License:- 100% of the license fee and product support for 1st year will be payable in advance along with purchase order.',0,'L');

$pdf->ln();
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(180,5,'Sizing of licenses required:',0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Prices quoted are applicable for two-way DR (1 DC site and 1 DR site) sites.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- For three-way DR (1 DC site and 2 DR Sites), prices will be 2 times of the quoted two-way DR price.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Numbers and types of licenses has been determined based on the customer landscape details provided. During implementation, if more Databases and Application Server instances are required to be protected by Sanovi DRMTM licenses, then customer/business partner need to procure additional licenses.',0,'L');

$pdf->ln();
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(180,5,'Language Support:',0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- All documentation, communication will be in English language only.',0,'L');

$pdf->ln();
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(180,5,'Professional Services:',0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Professional services fee is applicable for',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Technical Support such as Implementation, Integration, DR Drill, Change Management.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Training.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Professional services will be provided against customer approved Statement of Work and purchase order.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Each request will be for a minimum of one day (8 hours) and continuous workdays.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Remote Professional services will be provided  during Sanovi normal working hours and require access to customer systems remotely',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Professinal Services requires two week lead time for resource mobilisation  after receipt of purchase order along with payment',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- For onsite visit – visa, travel, lodging, boarding, out of pocket expenses will be charged extra.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Sanovi will provide training on DRM software to customer at the time of delivery/implementation as per the schedule agreed in the purchase order and any additional training will be charged.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Professional services fee is applicable for',0,'L');

$pdf->ln();
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(180,5,'Customer Responsibilities:',0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Customer must provide all necessary information and access within 2 working days. Any delay due to non-availability of resources/information solely attributable to the customer will entail additional charges as per the Professional Services rates.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Customer to provide appropriate and required documentation like “invitation letter” etc., for obtaining visa as per the rules of any particular country.',0,'L');

$pdf->ln();
$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(180,5,'Sanovi Authorized Partner Responsibilities:',0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Participate in Sanovi DRMTM training for delivery and operations team.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Actively facilitate implementation by engaging with customer executives to ensure that project is successfully completed.',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- Ensure that customer provides remote access to production and DR environment by opening necessary firewall ports/rules',0,'L');
$pdf->Cell(5,5,'',0,0,'L');
$pdf->MultiCell(180,5,'- All other terms and conditions are as per Sanovi agreement with partner.',0,'L');

$pdfdoc = $pdf->Output('', 'S');

//open the file in preview(monitor)
$pdf->Output();
}else{
    header('location:logout.php');
}
ob_flush();

?>