<?php

/** Set default timezone (will throw a notice otherwise) */
date_default_timezone_set('Asia/Kolkata');

// include PHPExcel
require('../PHPExcel.php');

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

//$objPHPExcel->getActiveSheet()->fromArray($Array, NULL, 'A18');
// rename the sheet
$objSheet->setTitle('Sanovi');

 

// let's bold and size the header font and write the header
// as you can see, we can specify a range of cells, like here: cells from A1 to A4
$objSheet->getStyle('A1:A4')->getFont()->setBold(true)->setSize(12);
$objSheet->getStyle('A8:E8')->getFont()->setBold(true)->setSize(12);
$objSheet->getStyle('A14:B14')->getFont()->setBold(true)->setSize(12);
$objSheet->getStyle('A16')->getFont()->setBold(true)->setSize(12);
$objSheet->getStyle('A66')->getFont()->setBold(true)->setSize(12);
$objSheet->getStyle('A90')->getFont()->setBold(true)->setSize(12);
$objSheet->getStyle('A94')->getFont()->setBold(true)->setSize(12);

// write header
$objSheet->getCell('A1')->setValue('Ref no : SAN/2016-17/50');
$objSheet->getCell('A2')->setValue('Vef no : 1');
$objSheet->getCell('A3')->setValue('Date : 2016-10-19');
$objSheet->getCell('A4')->setValue('Customer Name : Sanovi');
$objSheet->getCell('A7')->setValue('');

$objSheet->getCell('A8')->setValue('Item');
$objSheet->getCell('B8')->setValue('List Price(USD)');
$objSheet->getCell('C8')->setValue('Discount %');
$objSheet->getCell('D8')->setValue('Discount Value USD');
$objSheet->getCell('E8')->setValue('Final Price USD');

// we could get this data from database, but here we are writing for simplicity

$objSheet->getCell('A9')->setValue('License fee for Prepetual Sanovi Cloud');
$objSheet->getCell('B9')->setValue();
$objSheet->getCell('C9')->setValue();
$objSheet->getCell('D9')->setValue();

$objSheet->getCell('A10')->setValue('-Licensing');
$objSheet->getCell('B10')->setValue('USD****421,500');
$objSheet->getCell('C10')->setValue(0);
$objSheet->getCell('D10')->setValue("-");
$objSheet->getCell('E10')->setValue('USD ******0');

$objSheet->getCell('A11')->setValue('-Product Support');
$objSheet->getCell('B11')->setValue('USD****26,190');
$objSheet->getCell('C11')->setValue(0);
$objSheet->getCell('D11')->setValue('-');
$objSheet->getCell('E11')->setValue('USD ******0');

$objSheet->getCell('A12')->setValue('-Professional Services');
$objSheet->getCell('B12')->setValue('USD****46,324');
$objSheet->getCell('C12')->setValue('0');
$objSheet->getCell('D12')->setValue('-');
$objSheet->getCell('E12')->setValue('USD ******0');

$objSheet->getCell('A13')->setValue('-DRM Product Training');
$objSheet->getCell('B13')->setValue('7200');
$objSheet->getCell('C13')->setValue('0');
$objSheet->getCell('D13')->setValue('-');
$objSheet->getCell('E13')->setValue('USD ******0');

$objSheet->getCell('A14')->setValue('Total Price');
$objSheet->getCell('B14')->setValue('USD ******0');

// autosize the columns
//$objSheet->getColumnDimension('A')->setAutoSize(true);
//$objSheet->getColumnDimension('B')->setAutoSize(true);
//$objSheet->getColumnDimension('C')->setAutoSize(true);
//$objSheet->getColumnDimension('D')->setAutoSize(true);

$objSheet->getCell('A15')->setValue('');

$objSheet->getCell('A16')->setValue('Annexure-1: Bill of Quantity');
//
$objSheet->getCell('A17')->setValue('Part No/Licensing');
$objSheet->getCell('B17')->setValue('License Item Description');
$objSheet->getCell('C17')->setValue('Qty');

//$array = array(
//array(license=>('CCM-6.0-LCL-001-LIC-VMI-EE')),
//array($objSheet->getCell('B18')->setValue('License fee for Sanovi Cloud Continuity 6.0 - Virtual Machine Image -- Lifecycle Bundle')),
//array($objSheet->getCell('C18')->setValue('6')),

$data = array(
		array("Part No/Licensing" => "CCM-6.0-LCL-001-LIC-VMI-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Machine Image -- Lifecycle Bundle", "Qty" => ""),
		array("Part No/Licensing" => "CCM-6.0-LCL-002-LIC-VMD-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Machine Database -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-003-LIC-BWS-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Windows/Linux Data -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-004-LIC-BWD-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Windows/Linux Database -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-005-LIC-BUS-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Unix Data -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-006-LIC-BUD-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Unix Database -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-007-LIC-BUD-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Sharepoint Server - - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-008-LIC-BUD-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Sharepoint Server - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-009-LIC-BUD-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Node Production Exchange DAG - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-010-LIC-BUD-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Production Exchange DAG - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-011-LIC-BUD-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Node Advanced Replication -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-012-LIC-BUD-EE", "License Item Description" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Advanced Replication -- Lifecycle Bundle", "Qty" => "6"),
		array("Part No/Licensing" => "CCM 6.0-MAS-001-LIC-HIA-EE", "License Item Description" => "Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition", "Qty" => "1")
	);
$objPHPExcel->getActiveSheet()->fromArray($data, null, 'A18');

$objSheet->getCell('A31')->setValue('');
$objSheet->getCell('A32')->setValue('Part No/Licensing');
$objSheet->getCell('B32')->setValue('Professional Service Description');
$objSheet->getCell('C32')->setValue('Qty');

$data1 = array(
		array("Part No/Licensing" => "CCM 6.0-LCL-001-PSS-VMI-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 Virtual Machine Image -- Lifecycle Bundle", "Qty" => ""),
		array("Part No/Licensing" => "CCM 6.0-LCL-002-PSS-VMD-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 Virtual Machine Database -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-003-PSS-BWS-EE", "Professional Service Description" => "rofessional Services fee for Sanovi Cloud Continuity 6.0 Baremetal Windows/Linux Data -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-004-PSS-BWD-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 Baremetal Windows/Linux Database -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-005-PSS-BUS-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 Baremetal Unix Data -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-006-PSS-BUD-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 Baremetal Unix Database -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-007-PSS-BUD-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 - Sharepoint Server - - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-013-PSS-BUD-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 - Sharepoint Database - - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-009-LIC-BUD-EE", "Professional Service Description" => "License fee for Sanovi Cloud Continuity 6.0 - Node Production Exchange DAG - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-010-LIC-BUD-EE", "Professional Service Description" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Production Exchange DAG - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-011-LIC-BUD-EE", "Professional Service Description" => "License fee for Sanovi Cloud Continuity 6.0 - Node Advanced Replication -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-012-LIC-BUD-EE", "Professional Service Description" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Advanced Replication -- Lifecycle Bundle", "Qty" => "6"),
		array("Part No/Licensing" => "CCM 6.0-MAS-001-LIC-HIA-EE", "Professional Service Description" => "Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition", "Qty" => "1"),
        array("Part No/Licensing" => "CCM 6.0-MAS-001-LIC-HIA-EE", "Professional Service Description" => "Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition", "Qty" => "1"),
        array("Part No/Licensing" => "CCM 6.0-MAS-001-LIC-HIA-EE", "Professional Service Description" => "Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition", "Qty" => "1")
	);
$objPHPExcel->getActiveSheet()->fromArray($data1, null, 'A33');

$objSheet->getCell('A48')->setValue('');
$objSheet->getCell('A49')->setValue('Part No/Licensing');
$objSheet->getCell('B49')->setValue('Product Support Description');
$objSheet->getCell('C49')->setValue('Qty');

$data2 = array(
		array("Part No/Licensing" => "CCM 6.0-LCL-001-PSS-VMI-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 Virtual Machine Image -- Lifecycle Bundle", "Qty" => ""),
		array("Part No/Licensing" => "CCM 6.0-LCL-002-PSS-VMD-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 Virtual Machine Database -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-003-PSS-BWS-EE", "Professional Service Description" => "rofessional Services fee for Sanovi Cloud Continuity 6.0 Baremetal Windows/Linux Data -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-004-PSS-BWD-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 Baremetal Windows/Linux Database -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-005-PSS-BUS-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 Baremetal Unix Data -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-006-PSS-BUD-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 Baremetal Unix Database -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-007-PSS-BUD-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 - Sharepoint Server - - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM 6.0-LCL-013-PSS-BUD-EE", "Professional Service Description" => "Professional Services fee for Sanovi Cloud Continuity 6.0 - Sharepoint Database - - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-009-LIC-BUD-EE", "Professional Service Description" => "License fee for Sanovi Cloud Continuity 6.0 - Node Production Exchange DAG - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-010-LIC-BUD-EE", "Professional Service Description" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Production Exchange DAG - Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-011-LIC-BUD-EE", "Professional Service Description" => "License fee for Sanovi Cloud Continuity 6.0 - Node Advanced Replication -- Lifecycle Bundle", "Qty" => "0"),
		array("Part No/Licensing" => "CCM-6.0-LCL-012-LIC-BUD-EE", "Professional Service Description" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Advanced Replication -- Lifecycle Bundle", "Qty" => "6"),
		array("Part No/Licensing" => "CCM 6.0-MAS-001-LIC-HIA-EE", "Professional Service Description" => "Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition", "Qty" => "1"),
        array("Part No/Licensing" => "CCM 6.0-MAS-001-LIC-HIA-EE", "Professional Service Description" => "Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition", "Qty" => "1"),
        array("Part No/Licensing" => "CCM 6.0-MAS-001-LIC-HIA-EE", "Professional Service Description" => "Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition", "Qty" => "1")
	);
$objPHPExcel->getActiveSheet()->fromArray($data2, null, 'A50');

$objSheet->getCell('A65')->setValue('');
$objSheet->getCell('A66')->setValue('Annexure-2: Customer Requirements');
$objSheet->getCell('A67')->setValue('Product');
$objSheet->getCell('B67')->setValue('Cloud Continuity');
$objSheet->getCell('A68')->setValue('License Type');
$objSheet->getCell('B68')->setValue('Perpetual');
$objSheet->getCell('A69')->setValue('Mode of Sale');
$objSheet->getCell('B69')->setValue('First Time Sale');
$objSheet->getCell('A70')->setValue('Product Module');
$objSheet->getCell('B70')->setValue('DR Lifecycle Bundle');

$objSheet->getCell('A71')->setValue('');
$objSheet->getCell('A72')->setValue('License');
$objSheet->getCell('B72')->setValue('2-Site Configuration');
$objSheet->getCell('C72')->setValue('Qty');

$data3 = array(
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Machine Image -- Lifecycle Bundle", "Qty" => ""),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Machine Database -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Windows/Linux Data -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Windows/Linux Database -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Unix Data -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Unix Database -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Sharepoint Server - - Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Sharepoint Server - Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Node Production Exchange DAG - Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Production Exchange DAG - Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Node Advanced Replication -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "2-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Advanced Replication -- Lifecycle Bundle", "Qty" => "6"),
		array("License" => "", "2-Site Configuration" => "Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition", "Qty" => "1")
	);
$objPHPExcel->getActiveSheet()->fromArray($data3, null, 'A73');

$objSheet->getCell('A74')->setValue('');
$objSheet->getCell('A75')->setValue('License');
$objSheet->getCell('B75')->setValue('3-Site Configuration');
$objSheet->getCell('C75')->setValue('Qty');

$data3 = array(
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Machine Image -- Lifecycle Bundle", "Qty" => ""),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Machine Database -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Windows/Linux Data -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Windows/Linux Database -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Unix Data -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Baremetal Unix Database -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Sharepoint Server - - Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Sharepoint Server - Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Node Production Exchange DAG - Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Production Exchange DAG - Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Node Advanced Replication -- Lifecycle Bundle", "Qty" => "0"),
		array("License" => "", "3-Site Configuration" => "License fee for Sanovi Cloud Continuity 6.0 - Virtual Advanced Replication -- Lifecycle Bundle", "Qty" => "6"),
		array("License" => "", "3-Site Configuration" => "Sanovi Cloud Continuity Module 6.0 License for CCM Master Server in Hi-availability Mode, Enterprise Edition", "Qty" => "1")
	);
$objPHPExcel->getActiveSheet()->fromArray($data3, null, 'A76');

$objSheet->getCell('A89')->setValue('');
$objSheet->getCell('A90')->setValue('Annexure-3: Professional Service Requirements');
$objSheet->getCell('A91')->setValue('Professional Service Requirements 3 Site/Bunker Site Configuration');
$objSheet->getCell('B91')->setValue('Qty');
$objSheet->getCell('A92')->setValue('Are Professional Service Required on All Purchases');
$objSheet->getCell('B92')->setValue('Yes');

$objSheet->getCell('A93')->setValue('');
$objSheet->getCell('A94')->setValue('Annexure-3: Product Support Requirements');
$objSheet->getCell('A95')->setValue('Product Support Requirements');
$objSheet->getCell('B95')->setValue('Qty');
$objSheet->getCell('A96')->setValue('Year(s) of Sanovi Product Support required for the Purchase');
$objSheet->getCell('B96')->setValue('1');



//Setting the header type
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="file.xlsx"');
header('Cache-Control: max-age=0');

$objWriter->save('php://output');

/* If you want to save the file on the server instead of downloading, replace the last 4 lines by 
	$objWriter->save('test.xlsx');
*/

?>
