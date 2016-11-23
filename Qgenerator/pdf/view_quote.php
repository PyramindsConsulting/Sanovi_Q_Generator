<?php

session_start(); 
ob_start();

if($_SESSION["authentication"] == "passed"){

require('fpdf/fpdf.php');
include('../../includes/php_function_quote_edit.php');
include ("../../includes/config.php");
    
if(!isset($_GET)){
    die("Invalid");
}
$refId=$_GET["refId"];
$verId=$_GET["verId"];
if(find_quote_status($refId, $verId)==="Finalized"){
        $GLOBALS['watermark']="S A N O V I";
    }else{
        $GLOBALS['watermark']="D R A F T";
}
    
$quote_created_user=find_quote_created_user($refId, $verId);
$logged_in_user=$_SESSION["username"];
if($_SESSION["userrole"]=="Administrator" || $_SESSION["userrole"]=="Chief Executive Officer" || $_SESSION["userrole"]=="Chief Financial Officer"){
    
}else{
    $approval_assigned_to=approval_assigned_to($refId, $verId);
    if($_SESSION["emp_id"]==$approval_assigned_to){
        
    }else{
        if(($logged_in_user!=$quote_created_user) || ($_SESSION["userrole"]=="Quote Requestor")){
            //die("Access Denied!");
            echo "<center><br>";
            echo "<img src=\"..\images/Access-Denied.jpg\" width=\"25%\">";
            echo "<p style=\"color:red;\">You are not authorized to visit this page</p>";
            echo "</center>";
            die();
        }
    }
}
    
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
    include("../includes/php_function_quote_edit.php");
    //Put the watermark
    $this->SetFont('Arial', '', 50);
    $this->SetTextColor(152,251,152);
    $this->RotatedText(80, 175, $GLOBALS['watermark'], 55);
}

function RotatedText($x, $y, $txt, $angle) {
    //Text rotated around its origin
    $this->Rotate($angle, $x, $y);
    $this->Text($x, $y, $txt);
    $this->Rotate(0);
 }

}

$lgt_details=fetch_lgt_data($refId, $verId);
    
$crt_id=$lgt_details["license_crt_id"];
$lht_id=$lgt_details["license_lht_id"];
$date=$lgt_details["license_generation_date"];

$qty_2s=fetch_crt_2s_data($crt_id);
$qty_3s=fetch_crt_3s_data($crt_id);
$bunker=$qty_3s[0][1];
$data_2s_3s=adding2s_3s($qty_2s,$qty_3s,$bunker);

$lht_data=fetch_lht_data($lht_id);

//CUSTOMER DATA
$customer_details=fetch_crt_customer_data($crt_id);
   
$country=$customer_details["country"];
$OrgName=$customer_details["cust_org_name"];
$currency=$customer_details["cust_currency"];
$license=$customer_details["license_type"];
$product=$customer_details["product"];
$ModeOfSale=$customer_details["mode_of_sale"];
$ProdModule=$customer_details["product_module"];
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
$pdf->Cell(0,5,$verId,0,1,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,5,'Date :',0,0,'L');
$pdf->SetFont('Arial','',10);
//$pdf->Cell(0,5,$lgt_data['date'],0,1,'L');
$pdf->Cell(0,5,$date,0,1,'L');

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
//
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
//

$pdf->MultiCell(60,5,'License fee for Perpetual Sanovi Cloud Continuity Module',0,'L');

//LICENSING PRICES & DISCOUNTS
$pdf->Cell(103,5,'- Licensing',0,0); //
$licensing=currency_format($lht_data["licenseCost"],$currency);
//$pdf->Cell(23,5,$licensing,0,0,'R');
//$pdf->Cell(25,5,$lht_data["discountPercentageOnLicense"],0,0,'R');
$pdf->Cell(36,5,'-',0,0,'R');
$finalLicenseCost=currency_format($lht_data["finalLicenseCost"],$currency);
$pdf->Cell(42,5,currency_format($lht_data["finalLicenseCost"],$currency),0,0,'R');
$pdf->ln();
$pdf->Cell(103,5,'- Product Support',0,0);
//$pdf->Cell(23,5,currency_format($lht_data["productSupportCost"],$currency),0,0,'R');
//$pdf->Cell(25,5,$lht_data["discountPercentageOnSupport"],0,0,'R');
$pdf->Cell(36,5,'-',0,0,'R');
$pdf->Cell(42,5,currency_format($lht_data["finalSupportCost"],$currency),0,0,'R');
$pdf->ln();
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


$licensebilling=License_billing_quantity($data_2s_3s,$ProdModule,$country,$ModeOfSale,$currency);
$licensecount=count($licensebilling);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$licensecount;$i++) {
      if($licensebilling[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,5,$licensebilling[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,5,$licensebilling[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,$licensebilling[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,5,currency_format($licensebilling[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
$master_server_license=masterServerLicense_view($ModeOfSale,$country);
$master_server_license_count=count($master_server_license);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_server_license_count;$i++) {
      if($master_server_license[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$master_server_license[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,6,$master_server_license[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$master_server_license[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,currency_format($master_server_license[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }

    
//Professional Service Billing

$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(70,10,'Professional Service Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'Total Price '.$currency,0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();


$prof_qty=fetch_crt_prof_data($crt_id);
$prof_services_all=$prof_qty[0][1];    
$profbilling=Professional_billing_quantity($prof_qty,$data_2s_3s,$ProdModule,$country,$ModeOfSale,$currency,$Productsupport,$prof_services_all);
$profcount=count($profbilling);

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$profcount;$i++) {
      if($profbilling[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,5,$profbilling[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,5,$profbilling[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,$profbilling[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,5,currency_format($profbilling[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
$master_server_prof= masterServerProf_view($ModeOfSale,$country);
$master_server_prof_count=count($master_server_prof);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_server_prof_count;$i++) {
      if($master_server_prof[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$master_server_prof[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,6,$master_server_prof[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$master_server_prof[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,currency_format($master_server_prof[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
//Product Support Billing Quantity 
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(70,10,'Product Support Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'Total Price '.$currency,0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();

$Productsupport=fetch_crt_prod_support_years($crt_id);
$productbilling=Product_billing_quantity($qty_2s,$ProdModule,$country,$ModeOfSale,$currency,$Productsupport);
$productcount=count($productbilling);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$productcount;$i++) {
      if($productbilling[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,5,$productbilling[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,5,$productbilling[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,$productbilling[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,5,currency_format($productbilling[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
$master_server_product=masterServerproduct_view($ModeOfSale,$country);
$master_server_product_count=count($master_server_product);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_server_product_count;$i++) {
      if($master_server_product[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,5,$master_server_product[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,5,$master_server_product[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,$master_server_product[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,5,currency_format($master_server_product[$i][3],$currency),0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
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
$pdf->Cell(70,10,'License Item Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'                   ',0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();


$licensebilling=License_billing_quantity($data_2s_3s,$ProdModule,$country,$ModeOfSale,$currency);
$licensecount=count($licensebilling);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$licensecount;$i++) {
      if($licensebilling[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,5,$licensebilling[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,5,$licensebilling[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,$licensebilling[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,5,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
$master_server_license=masterServerLicense_view($ModeOfSale,$country);
$master_server_license_count=count($master_server_license);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_server_license_count;$i++) {
      if($master_server_license[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$master_server_license[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,6,$master_server_license[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$master_server_license[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }

    
//Professional Service Billing

$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(70,10,'Professional Service Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'             ',0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();


$prof_qty=fetch_crt_prof_data($crt_id);
$profbilling=Professional_billing_quantity($prof_qty,$data_2s_3s,$ProdModule,$country,$ModeOfSale,$currency,$Productsupport);
$profcount=count($profbilling);

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$profcount;$i++) {
      if($profbilling[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,5,$profbilling[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,5,$profbilling[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,$profbilling[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,5,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
$master_server_prof= masterServerProf_view($ModeOfSale,$country);
$master_server_prof_count=count($master_server_prof);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_server_prof_count;$i++) {
      if($master_server_prof[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,6,$master_server_prof[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,6,$master_server_prof[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,6,$master_server_prof[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,6,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
//Product Support Billing Quantity 
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224, 224, 224);
$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
$pdf->Cell(70,10,'Product Support Description',0,0,'',true);
$pdf->Cell(30,10,'Qty',0,0,'R',true);
$pdf->Cell(35,10,'        ',0,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->ln();

$Productsupport=fetch_crt_prod_support_years($crt_id);
$productbilling=Product_billing_quantity($qty_2s,$ProdModule,$country,$ModeOfSale,$currency,$Productsupport);
$productcount=count($productbilling);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$productcount;$i++) {
      if($productbilling[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,5,$productbilling[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,5,$productbilling[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,$productbilling[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,5,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
$master_server_product=masterServerproduct_view($ModeOfSale,$country);
$master_server_product_count=count($master_server_product);
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$master_server_product_count;$i++) {
      if($master_server_product[$i][0]!=""){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(50,5,$master_server_product[$i][0],0,'L');
        $pdf->SetXY($x+50,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(80,5,$master_server_product[$i][1],0,'L');
        $pdf->SetXY($x+70,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,$master_server_product[$i][2],0,'R');
        $pdf->SetXY($x+25,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(35,5,'',0,'R');
        $pdf->SetXY($x,$y);
        $pdf->ln();
        $pdf->ln();
      }
  }
}
//for($i=0;$i<12;$i++){
//    if($license_qty[$i][0]!=""){
//        $pdf->Cell(50,5,$license_qty[$i][0],0,0);
//        //$pdf->MultiCell(86,5,'Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition',0,'L');
//        $test="Sanovi Cloud Continuity Module 6.0";
//        $pdf->Cell(86,5,$license_qty[$i][1],0,0,'L');
//        $pdf->Cell(80,5,$license_qty[$i][2],0,0,'R');
//        $pdf->Cell(36,5,currency_format($license_qty[$i][3],$currency),0,1,'R');
//    }
//}
//
//$pdf->ln();
//$pdf->SetFont('Arial','',10);
//$pdf->SetFillColor(224, 224, 224);
//$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
//$pdf->Cell(92,10,'Professional service Description',0,0,'',true);
//$pdf->Cell(75,10,'Qty',0,0,'R',true);
//$pdf->Cell(45,10,'Total Price '.$currency,0,0,'C',true);
//$pdf->SetFont('Arial','',8);
//$pdf->ln();
//
//for($i=0;$i<$profcount;$i++){
//    $pdf->Cell(50,5,$prof_qty[$i][0],0,0);
//    //$pdf->MultiCell(86,5,'Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition',0,'L');
//    $test="Sanovi Cloud Continuity Module 6.0";
//    $pdf->Cell(86,5,$prof_qty[$i][1],0,0,'L');
//    $pdf->Cell(80,5,$prof_qty[$i][2],0,0,'R');
//    $pdf->Cell(36,5,currency_format($prof_qty[$i][3],$currency),0,1,'R');
//}
//
//$pdf->ln();
//$pdf->SetFont('Arial','',10);
//$pdf->SetFillColor(224, 224, 224);
//$pdf->Cell(50,10,'Part No/Licensing',0,0,'L',true);
//$pdf->Cell(92,10,'Product Support Description',0,0,'',true);
//$pdf->Cell(75,10,'Qty',0,0,'R',true);
//$pdf->Cell(45,10,'Total Price '.$currency,0,0,'C',true);
//$pdf->SetFont('Arial','',8);
//$pdf->ln();
//
//for($i=0;$i<$prodcount;$i++){
//    if($prod_qty[$i][0]!=""){
//        $product_desc=$ProdSupport." year(s) of ".$prod_qty[$i][1];
//        $pdf->Cell(50,5,$prod_qty[$i][0],0,0);
//        //$pdf->MultiCell(86,5,'Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition',0,'L');
//        $test="Sanovi Cloud Continuity Module 6.0";
//        $pdf->Cell(86,5,$product_desc,0,0,'L');
//        $pdf->Cell(80,5,$prod_qty[$i][2],0,0,'R');
//        $pdf->Cell(36,5,currency_format($prod_qty[$i][3],$currency),0,1,'R');
//    }
//}
//
//
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
$pdf->Cell(30,10,'License',0,0,'L',true);
$pdf->Cell(135,10,'2-Site Configuration',0,0,'',true);
$pdf->Cell(20,10,'Qty',0,1,'',true);

$qty_and_questions_2s=fetch_crt_2s_data($crt_id);
$qty_and_questions_count=count($qty_and_questions_2s);

//for($i=0;$i<12;$i++){
//    if($data_2s_3s[$i][1]!=0){
//        $pdf->SetFont('Arial','',8);
//        $pdf->Cell(40,5,'',0,0,'L');
//        $pdf->Cell(120,5,get_question($qty_and_questions_2s[$i][0]),0,0,'L');
//        $pdf->Cell(20,5,$qty_and_questions_2s[$i][1],0,1,'L');
//    }
//}
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$qty_and_questions_count;$i++) {
      if($qty_and_questions_2s[$i][1]!=0){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }
        $pdf->SetFont('Arial','',8);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,'',0,'L');
        $pdf->SetXY($x+30,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(130,5,get_question($qty_and_questions_2s[$i][0]),0,'L');
        $pdf->SetXY($x+120,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(20,5,$qty_and_questions_2s[$i][1],0,'R');
        $pdf->SetXY($x,$y);
          if(strlen(get_question($qty_and_questions_2s[$i][0]))>95){
        $pdf->ln();
        }      
        $pdf->ln();
      }
  }
//3-SITE CONFIGURATION
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,10,'License',0,0,'L',true);
$pdf->Cell(135,10,'3-Site Configuration',0,0,'L',true);
$pdf->Cell(20,10,'Qty',0,1,'',true);

$qty_and_questions_3s=fetch_crt_3s_data($crt_id);
$count_qty_and_questions_3s=count($qty_and_questions_3s);

//for($i=0;$i<14;$i++){
//    if($qty_and_questions_3s[$i][1]!=0){
//        $pdf->SetFont('Arial','',8);
//        $pdf->Cell(40,5,'',0,0,'L');
//        $pdf->Cell(120,5,get_question($qty_and_questions_3s[$i][0]),0,0,'L');
//        $pdf->Cell(20,5,$qty_and_questions_3s[$i][1],0,1,'L');
//    }
//}
$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$count_qty_and_questions_3s;$i++) {
      if($qty_and_questions_3s[$i][1]!=0){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }
        $pdf->SetFont('Arial','',8);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,'',0,'L');
        $pdf->SetXY($x+30,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(130,5,get_question($qty_and_questions_3s[$i][0]),0,'L');
        $pdf->SetXY($x+120,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(20,5,$qty_and_questions_3s[$i][1],0,'R');
        $pdf->SetXY($x,$y);
        if(strlen(get_question($qty_and_questions_3s[$i][0]))>95){
        $pdf->ln();
        }  
        $pdf->ln();
      }
  }

$pdf->ln();

//PAGE - 4 ANNEXURE-3 - PROFESSIONAL SERVICES
$pdf->AddPage('P','A4'); //ADD A NEW PAGE
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,'Annexure-3: Professional Services Requirements',0,0);
$pdf->ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,10,'',0,0,'',true);
$pdf->Cell(135,10,'Professional Services Requirement 3 Site/Bunker Site Configuration',0,0,'',true);
$pdf->Cell(20,10,'Qty',0,1,'',true);

$prof_services=fetch_crt_prof_data($crt_id);
$profcount=count($prof_services);
$pdf->SetFont('Arial','',8);
$pdf->Cell(30,5,'',0,0,'L');
$pdf->Cell(135,5,'Are Professional Services Required on All Purchases',0,0,'L');
$pdf->Cell(20,5,ucfirst($prof_services[0][1]),0,0,'');

$height_of_cell = 30; // mm
$page_height = 286.93; // mm (portrait letter)
$bottom_margin = 0; // mm
  for($i=0;$i<$profcount;$i++) {
      if($prof_services[$i][1]!=0){
    $block=floor($i/1);
    $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
      if ($i/1==floor($i/1) && $height_of_cell > $space_left) {
        $pdf->AddPage(); // page break
      }
        if($prof_services[0][1]=='No'){  
        $pdf->SetFont('Arial','',8);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(30,5,'',0,'L');
        $pdf->SetXY($x+30,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(130,5,get_question($prof_services[$i][0]),0,'L');
        $pdf->SetXY($x+120,$y);
        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $pdf->MultiCell(20,5,$prof_services[$i][1],0,'R');
        $pdf->SetXY($x,$y);
        if(strlen(get_question($prof_services[$i][0]))>95){
        $pdf->ln();
        }  
        $pdf->ln();
      }
    }
  }
//if($prof_services[0][1]=='no'){
//for($i=0;$i<15;$i++){
//    $pdf->SetFont('Arial','',8);
//    $pdf->Cell(40,5,'',0,0,'L');
//    $pdf->Cell(120,5,get_question($prof_services[$i][0],0,0,'L'));
//    $pdf->Cell(20,5,$prof_services[$i][1],0,1,'L');
//    }
//}

//PAGE - 5 ANNEXURE-3 - PRODUCT SUPPORT
$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','B',10);
$pdf->ln();
$pdf->Cell(100,10,'Annexure-3: Product Support Requirements',0,0);
$pdf->ln();

$pdf->SetFont('Arial','',10);
$pdf->Cell(40,10,'',0,0,'',true);
$pdf->Cell(135,10,'Product Support Requirements',0,0,'',true);
$pdf->Cell(20,10,'Qty',0,1,'',true);

$pdf->SetFont('Arial','',8);
$pdf->Cell(40,5,'',0,0,'L');
$pdf->Cell(135,5,'Year(s) of Sanovi Product Support required for the Purchase',0,0,'L');
$pdf->Cell(20,5,fetch_crt_prod_support_years($crt_id),0,0,'L');

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