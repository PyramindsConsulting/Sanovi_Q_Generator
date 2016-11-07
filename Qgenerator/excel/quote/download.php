<?php

// include PHPExcel
require('../PHPExcel.php');

session_start(); 
ob_start();

if($_SESSION["authentication"] == "passed"){
//include('../../../includes/php_function_quote_edit.php');
include('../../../includes/php_functions_excel.php');
include ('../../../includes/config.php');   
}else{
die("Unauthorized Access");
}

if(!$_GET){
die("Invalid Parameters");
}else{
$refId=$_GET["refId"];
$verId=$_GET["verId"];
}

$quote_created_user=find_quote_created_user($refId, $verId);
$logged_in_user=$_SESSION["username"];
if($_SESSION["userrole"]=="Administrator" || $_SESSION["userrole"]=="Chief Executive Officer" || $_SESSION["userrole"]=="Chief Financial Officer"){

}else{
if(($logged_in_user!=$quote_created_user) || ($_SESSION["userrole"]=="Quote Requestor")){
//die("Access Denied!");
echo "<center><br>";
echo "<img src=\"..\..\images/Access-Denied.jpg\" width=\"25%\">";
echo "<p style=\"color:red;\">You are not authorized to visit this page</p>";
echo "</center>";
die();
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

/** Set default timezone (will throw a notice otherwise) */
date_default_timezone_set('Asia/Kolkata');

// create new PHPExcel object
$objPHPExcel = new PHPExcel;

// set default font
$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');

// set default font size
$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);

// create the writer
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");



/**

 * Define currency and number format.

 */

//// currency format, € with < 0 being in red color
//$currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';
//
//// number format, with thousands separator and two decimal points.
//$numberFormat = '#,#0.##;[Red]-#,#0.##';

 

// writer already created the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();

$objPHPExcel->setActiveSheetIndex(0);
//$objPHPExcel->getActiveSheet()->fromArray($Array, NULL, 'A18');
// rename the sheet
$objSheet->setTitle('Summary');
 

// let's bold and size the header font and write the header
// as you can see, we can specify a range of cells, like here: cells from A1 to A4
$objSheet->getStyle('A8:E8')->getFont()->setBold(true)->setSize(12);
$objSheet->getStyle('A14:E14')->getFont()->setBold(true)->setSize(12);

////setting row height
//$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(20);

// setting width for column
//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('30');
//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('B')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('35');
//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('C')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth('20');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth('20');

// write header
//$objPHPExcel->getActiveSheet()->setCellValue('A1', "Ref no : SAN/2016-17/50");

$objSheet->getCell('A1')->setValue('Ref No : ');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
$objSheet->getCell('B1')->setValue($refId);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setWrapText(true);
$objSheet->getCell('A2')->setValue('Vef no :');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);
$objSheet->getCell('B2')->setValue($verId);
$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setWrapText(true);
$objSheet->getCell('A3')->setValue('Date :');
$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setWrapText(true);
$objSheet->getCell('B3')->setValue($date);
$objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->setWrapText(true);
$objSheet->getCell('A4')->setValue('Customer Name :');
$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
$objSheet->getCell('B4')->setValue($OrgName);
$objPHPExcel->getActiveSheet()->getStyle('B4')->getAlignment()->setWrapText(true);
$objSheet->getCell('A5')->setValue('Dear Sir,');
$objSheet->getCell('A6')->setValue('This is with reference to our discussion, we are pleased to offer the below detailed commercials.');
$objPHPExcel->getActiveSheet()->getStyle('A6');
$objSheet->getCell('A7')->setValue('');

$objSheet->getCell('A8')->setValue('Item');
$objSheet->getCell('B8')->setValue('List Price '.$currency);
$objSheet->getCell('C8')->setValue('Discount %');
$objSheet->getCell('D8')->setValue('Discount Value '.$currency);
$objSheet->getCell('E8')->setValue('Final Price '.$currency);

// we could get this data from database, but here we are writing for simplicity

$objSheet->getCell('A9')->setValue('License fee for Prepetual Sanovi Cloud');
$objPHPExcel->getActiveSheet()->getStyle('A9')->getAlignment()->setWrapText(true);
$objSheet->getCell('B9')->setValue();
$objSheet->getCell('C9')->setValue();
$objSheet->getCell('D9')->setValue();

//$licensing=currency_format($lht_data["licenseCost"],$currency);

$objSheet->getCell('A10')->setValue('-Licensing');
$objSheet->getCell('B10')->setValue($lht_data["licenseCost"]);
$objSheet->getCell('C10')->setValue($lht_data["discountPercentageOnLicense"]);
$objSheet->getCell('D10')->setValue("-");
$objSheet->getCell('E10')->setValue($lht_data["finalLicenseCost"]);

$objSheet->getCell('A11')->setValue('-Product Support');
$objSheet->getCell('B11')->setValue($lht_data["productSupportCost"]);
$objSheet->getCell('C11')->setValue($lht_data["discountPercentageOnSupport"]);
$objSheet->getCell('D11')->setValue('-');
$objSheet->getCell('E11')->setValue($lht_data["finalSupportCost"]);

$objSheet->getCell('A12')->setValue('-Professional Services');
$objSheet->getCell('B12')->setValue($lht_data["PSCost"]);
$objSheet->getCell('C12')->setValue($lht_data["discountPercentageOnPS"]);
$objSheet->getCell('D12')->setValue('-');
$objSheet->getCell('E12')->setValue($lht_data["finalPSCost"]);

$objSheet->getCell('A13')->setValue('-DRM Product Training');
$objSheet->getCell('B13')->setValue($lht_data["trainingCost"]);
$objSheet->getCell('C13')->setValue($lht_data["discountPercentageOnTraining"]);
$objSheet->getCell('D13')->setValue('-');
$objSheet->getCell('E13')->setValue($lht_data["finalTrainingCost"]);

$objSheet->getCell('A14')->setValue('Total Price');
$objSheet->getCell('E14')->setValue($lht_data["totalValue"]);

// autosize the columns
//$objSheet->getColumnDimension('A')->setAutoSize(true);
//$objSheet->getColumnDimension('B')->setAutoSize(true);
//$objSheet->getColumnDimension('C')->setAutoSize(true);
//$objSheet->getColumnDimension('D')->setAutoSize(true);



//$objPHPExcel->getActiveSheet()->unmergeCells('A18:E22');
$objWorkSheet = $objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
$objWorkSheet->setTitle('Details');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('30');
//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('B')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('35');
//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('C')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth('20');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth('20');

$objWorkSheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
$objWorkSheet->getStyle('A51')->getFont()->setBold(true)->setSize(12);
$objWorkSheet->getStyle('A87')->getFont()->setBold(true)->setSize(12);
$objWorkSheet->getStyle('A91')->getFont()->setBold(true)->setSize(12);


$sheetindex=1;
$objWorkSheet->getCell('A'.$sheetindex)->setValue('Annexure-1: Bill of Quantity');
$sheetindex++;
$objWorkSheet->getStyle('A'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('A'.$sheetindex)->setValue('Part No/Licensing');
$objWorkSheet->getStyle('B'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('B'.$sheetindex)->setValue('License Item Description');
$objWorkSheet->getStyle('C'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue('Qty');
$objWorkSheet->getStyle('D'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('D'.$sheetindex)->setValue('Price');

//$array = array(
//array(license=>('CCM-6.0-LCL-001-LIC-VMI-EE')),
//array($objSheet->getCell('B18')->setValue('License fee for Sanovi Cloud Continuity 6.0 - Virtual Machine Image -- Lifecycle Bundle')),
//array($objSheet->getCell('C18')->setValue('6')),

//$objWriter->save('php://output');


//$objWorkSheet = $objPHPExcel->createSheet();
//$objPHPExcel->setActiveSheetIndex(1);
//$objWorkSheet->setTitle('Sanovi-Details');
//$annexure1=displayAnnexure_1($refId,$verId);
$licensebilling=License_billing_quantity($data_2s_3s,$ProdModule,$country,$ModeOfSale,$currency);
$licensecount=count($licensebilling);
$sheetindex++;
for($i=0;$i<$licensecount;$i++){
if($licensebilling[$i][0]!=""){
$objWorkSheet->getCell('A'.$sheetindex)->setValue($licensebilling[$i][0]);
$objWorkSheet->getCell('B'.$sheetindex)->setValue($licensebilling[$i][1]);
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue($licensebilling[$i][2]);
$objWorkSheet->getCell('D'.$sheetindex)->setValue($licensebilling[$i][3]);
$sheetindex++;
}
}

$master_server_license=masterServerLicense_view($ModeOfSale,$country);
$master_server_license_count=count($master_server_license);
if($ModeOfSale=="First Time Sale"){
for($i=0;$i<$master_server_license_count; $i++){
$objWorkSheet->getCell('A'.$sheetindex)->setValue($master_server_license[$i][0]);
$objWorkSheet->getCell('B'.$sheetindex)->setValue($master_server_license[$i][1]);
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue($master_server_license[$i][2]);
$objWorkSheet->getCell('D'.$sheetindex)->setValue($master_server_license[$i][3]);
$sheetindex++;
}
}
//PROFESSIONAL BILLING QUANTITY
$sheetindex++;
$objWorkSheet->getCell('A'.$sheetindex)->setValue('');
$sheetindex++;
$objWorkSheet->getStyle('A'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('A'.$sheetindex)->setValue('Part No/Licensing');
$objWorkSheet->getStyle('B'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('B'.$sheetindex)->setValue('Professional Service Description');
$objWorkSheet->getStyle('C'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue('Qty');
$objWorkSheet->getStyle('D'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('D'.$sheetindex)->setValue('Price');

$prof_qty=fetch_crt_prof_data($crt_id);
$prof_services_all=$prof_qty[0][1];    
$profbilling=Professional_billing_quantity($prof_qty,$data_2s_3s,$ProdModule,$country,$ModeOfSale,$currency,$Productsupport,$prof_services_all);
$profcount=count($profbilling);
$sheetindex++;
for($i=0;$i<$profcount;$i++){
if($profbilling[$i][0]!=""){
$objWorkSheet->getCell('A'.$sheetindex)->setValue($profbilling[$i][0]);
$objWorkSheet->getCell('B'.$sheetindex)->setValue($profbilling[$i][1]);
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue($profbilling[$i][2]);
$objWorkSheet->getCell('D'.$sheetindex)->setValue($profbilling[$i][3]);
$sheetindex++;
}
}

$master_server_prof= masterServerProf_view($ModeOfSale,$country);
$master_server_prof_count=count($master_server_prof);
if($ModeOfSale=="First Time Sale"){
for($i=0;$i<$master_server_prof_count; $i++){
$objWorkSheet->getCell('A'.$sheetindex)->setValue($master_server_prof[$i][0]);
$objWorkSheet->getCell('B'.$sheetindex)->setValue($master_server_prof[$i][1]);
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue($master_server_prof[$i][2]);
$objWorkSheet->getCell('D'.$sheetindex)->setValue($master_server_prof[$i][3]);
$sheetindex++;
}
}


//PRODUCT BILLING QUANTITY
$sheetindex++;
$objWorkSheet->getCell('A'.$sheetindex)->setValue('');
$sheetindex++;
$objWorkSheet->getStyle('A'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('A'.$sheetindex)->setValue('Part No/Licensing');
$objWorkSheet->getStyle('B'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('B'.$sheetindex)->setValue('Product Support Description');
$objWorkSheet->getStyle('C'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue('Qty');
$objWorkSheet->getStyle('D'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('D'.$sheetindex)->setValue('Price');

$sheetindex++;
$Productsupport=fetch_crt_prod_support_years($crt_id);
$productbilling=Product_billing_quantity($qty_2s,$ProdModule,$country,$ModeOfSale,$currency,$Productsupport);
$productcount=count($productbilling);

for($i=0;$i<$productcount;$i++){
if($productbilling[$i][0]!=""){
$objWorkSheet->getCell('A'.$sheetindex)->setValue($productbilling[$i][0]);
$objWorkSheet->getCell('B'.$sheetindex)->setValue($productbilling[$i][1]);
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue($productbilling[$i][2]);
$objWorkSheet->getCell('D'.$sheetindex)->setValue($productbilling[$i][3]);
$sheetindex++;
}
}

$master_server_product=masterServerproduct_view($ModeOfSale,$country);
$master_server_product_count=count($master_server_product);

if($ModeOfSale=="First Time Sale"){
for($i=0;$i<$master_server_product_count; $i++){
$objWorkSheet->getCell('A'.$sheetindex)->setValue($master_server_product[$i][0]);
$objWorkSheet->getCell('B'.$sheetindex)->setValue($master_server_product[$i][1]);
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue($master_server_product[$i][2]);
$objWorkSheet->getCell('D'.$sheetindex)->setValue($master_server_product[$i][3]);
$sheetindex++;
}
}
$sheetindex++;


//CUSTOMER REQUIREMENTS - ANNEXURE-2
$objWorkSheet->getCell('A'.$sheetindex)->setValue('');
$sheetindex++;
$objWorkSheet->getCell('A'.$sheetindex)->setValue('Annexure-2: Customer Requirements');
$objPHPExcel->getActiveSheet()->getStyle('A'.$sheetindex)->getFont()->setBold(true);
$sheetindex++;
$objWorkSheet->getCell('A'.$sheetindex)->setValue('Product');
$objWorkSheet->getCell('B'.$sheetindex)->setValue($product);
$sheetindex++;
$objWorkSheet->getCell('A'.$sheetindex)->setValue('License Type');
$objWorkSheet->getCell('B'.$sheetindex)->setValue($license);
$sheetindex++;
$objWorkSheet->getCell('A'.$sheetindex)->setValue('Mode of Sale');
$objWorkSheet->getCell('B'.$sheetindex)->setValue($ModeOfSale);
$sheetindex++;
$objWorkSheet->getCell('A'.$sheetindex)->setValue('Product Module');
$objWorkSheet->getCell('B'.$sheetindex)->setValue($ProdModule);
$sheetindex++;

$objWorkSheet->getCell('A'.$sheetindex)->setValue('');
$sheetindex++;

//2-SITE LICENSE
$objPHPExcel->getActiveSheet()->getStyle('A'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('A'.$sheetindex)->setValue('License');
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('B'.$sheetindex)->setValue('2-Site Configuration');
$objPHPExcel->getActiveSheet()->getStyle('C'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue('Qty');
$sheetindex++;


$qty_and_questions_2s=fetch_crt_2s_data($crt_id);
$qty_and_questions_count=count($qty_and_questions_2s);
for($i=0;$i<$qty_and_questions_count;$i++){
if($qty_and_questions_2s[$i][1]!=0){
//$objWorkSheet->getCell('A'.$sheetindex)->setValue($qty_and_questions_2s[$i][0]);
$objWorkSheet->getCell('B'.$sheetindex)->setValue(get_question($qty_and_questions_2s[$i][0]));
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue($qty_and_questions_2s[$i][1]);
$sheetindex++;
}
}
$sheetindex++;

//3-SITE LICENSE
$objWorkSheet->getCell('A'.$sheetindex)->setValue('');
$sheetindex++;
$objPHPExcel->getActiveSheet()->getStyle('A'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('A'.$sheetindex)->setValue('License');
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('B'.$sheetindex)->setValue('3-Site Configuration');
$objPHPExcel->getActiveSheet()->getStyle('C'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue('Qty');
$sheetindex++;

$qty_and_questions_3s=fetch_crt_3s_data($crt_id);
$count_qty_and_questions_3s=count($qty_and_questions_3s);
for($i=0;$i<$count_qty_and_questions_3s;$i++){
if($qty_and_questions_3s[$i][1]!=0){
//$objWorkSheet->getCell('A'.$sheetindex)->setValue($qty_and_questions_2s[$i][0]);
$objWorkSheet->getCell('B'.$sheetindex)->setValue(get_question($qty_and_questions_3s[$i][0]));
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue($qty_and_questions_3s[$i][1]);
$sheetindex++;
}
}
$sheetindex++;


$objWorkSheet->getCell('A'.$sheetindex)->setValue('');
$sheetindex++;
$objPHPExcel->getActiveSheet()->getStyle('A'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('A'.$sheetindex)->setValue('Annexure-3: Professional Service Requirements');
$objPHPExcel->getActiveSheet()->getStyle('A'.$sheetindex)->getAlignment()->setWrapText(true);
$sheetindex++;
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('B'.$sheetindex)->setValue('Professional Service Requirements 3 Site/Bunker Site Configuration');
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('C'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue('Qty');
$sheetindex++;

$prof_services=fetch_crt_prof_data($crt_id);
$profcount=count($prof_services);
$objWorkSheet->getCell('B'.$sheetindex)->setValue('Are Professional Service Required on All Purchases');
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue($prof_services[0][1]);
if($prof_services[0][1]=='No'){
for($i=0;$i<$profcount;$i++) {
if($prof_services[$i][1]!=0){
$objWorkSheet->getCell('B'.$sheetindex)->setValue(get_question($prof_services[$i][0]));
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue($prof_services[$i][1]);
$sheetindex++;   
}
}
}
$sheetindex++;

$objWorkSheet->getCell('A'.$sheetindex)->setValue('');
$sheetindex++;

$objPHPExcel->getActiveSheet()->getStyle('A'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('A'.$sheetindex)->setValue('Annexure-3: Product Support Requirements');
$objPHPExcel->getActiveSheet()->getStyle('A'.$sheetindex)->getAlignment()->setWrapText(true);
$sheetindex++;
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('B'.$sheetindex)->setValue('Product Support Requirements');
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('C'.$sheetindex)->getFont()->setBold(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue('Qty');
$sheetindex++;
$objWorkSheet->getCell('B'.$sheetindex)->setValue('Year(s) of Sanovi Product Support required for the Purchase');
$objPHPExcel->getActiveSheet()->getStyle('B'.$sheetindex)->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('C'.$sheetindex)->setValue(fetch_crt_prod_support_years($crt_id));



//Setting the header type
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Sanovi.xlsx"');
header('Cache-Control: max-age=0');

$objWriter->save('php://output');

/* If you want to save the file on the server instead of downloading, replace the last 4 lines by 
	$objWriter->save('test.xlsx');
*/

?>
