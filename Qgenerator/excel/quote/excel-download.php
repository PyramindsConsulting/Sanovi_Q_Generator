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

$objPHPExcel->setActiveSheetIndex(0);
//$objPHPExcel->getActiveSheet()->fromArray($Array, NULL, 'A18');
// rename the sheet
$objSheet->setTitle('Sanovi-Summary');
 

// let's bold and size the header font and write the header
// as you can see, we can specify a range of cells, like here: cells from A1 to A4
$objSheet->getStyle('A8:E8')->getFont()->setBold(true)->setSize(12);
$objSheet->getStyle('A14:B14')->getFont()->setBold(true)->setSize(12);

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

$objSheet->getCell('A1')->setValue('Ref no : SAN/2016-17/50');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
$objSheet->getCell('A2')->setValue('Vef no : 1');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);
$objSheet->getCell('A3')->setValue('Date : 2016-10-19');
$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setWrapText(true);
$objSheet->getCell('A4')->setValue('Customer Name : Sanovi');
$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
$objSheet->getCell('A5')->setValue('Dear,');
$objSheet->getCell('A6')->setValue('This is with reference to our discussion, we are pleased to offer the below detailed commercials.');
$objPHPExcel->getActiveSheet()->getStyle('A6')->getAlignment()->setWrapText(true);
$objSheet->getCell('A7')->setValue('');

$objSheet->getCell('A8')->setValue('Item');
$objSheet->getCell('B8')->setValue('List Price(USD)');
$objSheet->getCell('C8')->setValue('Discount %');
$objSheet->getCell('D8')->setValue('Discount Value USD');
$objSheet->getCell('E8')->setValue('Final Price USD');

// we could get this data from database, but here we are writing for simplicity

$objSheet->getCell('A9')->setValue('License fee for Prepetual Sanovi Cloud');
$objPHPExcel->getActiveSheet()->getStyle('A9')->getAlignment()->setWrapText(true);
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



//$objPHPExcel->getActiveSheet()->unmergeCells('A18:E22');
$objWorkSheet = $objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
$objWorkSheet->setTitle('Sanovi-Details');

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


$objWorkSheet->getCell('A1')->setValue('Annexure-1: Bill of Quantity');
//
$objWorkSheet->getCell('A2')->setValue('Part No/Licensing');
$objWorkSheet->getCell('B2')->setValue('License Item Description');
$objWorkSheet->getCell('C2')->setValue('Qty');

//$array = array(
//array(license=>('CCM-6.0-LCL-001-LIC-VMI-EE')),
//array($objSheet->getCell('B18')->setValue('License fee for Sanovi Cloud Continuity 6.0 - Virtual Machine Image -- Lifecycle Bundle')),
//array($objSheet->getCell('C18')->setValue('6')),

//$objWriter->save('php://output');


//$objWorkSheet = $objPHPExcel->createSheet();
//$objPHPExcel->setActiveSheetIndex(1);
//$objWorkSheet->setTitle('Sanovi-Details');

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
$style = array(
    'alignment' => array(
//        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'wrap' => true
    )
);
$objPHPExcel->getActiveSheet()->fromArray($data, null, 'A3')->getStyle('B3:B15')->applyFromArray($style);
//$objPHPExcel->getActiveSheet()->getStyle('A18')->getAlignment()->setWrapText(true);


$objWorkSheet->getCell('A16')->setValue('');
$objWorkSheet->getCell('A17')->setValue('Part No/Licensing');
$objWorkSheet->getCell('B17')->setValue('Professional Service Description');
$objWorkSheet->getCell('C17')->setValue('Qty');

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
$style1 = array(
    'alignment' => array(
//        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'wrap' => true
    )
);
//$objPHPExcel->getActiveSheet()->fromArray($data1, null, 'A33');
$objPHPExcel->getActiveSheet()->fromArray($data1, null, 'A18')->getStyle('B18:B32')->applyFromArray($style1);

$objWorkSheet->getCell('A33')->setValue('');
$objWorkSheet->getCell('A34')->setValue('Part No/Licensing');
$objWorkSheet->getCell('B34')->setValue('Product Support Description');
$objWorkSheet->getCell('C34')->setValue('Qty');

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
$style2 = array(
    'alignment' => array(
//        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'wrap' => true
    )
);
//$objPHPExcel->getActiveSheet()->fromArray($data2, null, 'A50');
$objPHPExcel->getActiveSheet()->fromArray($data2, null, 'A35')->getStyle('B35:B49')->applyFromArray($style2);

$objWorkSheet->getCell('A50')->setValue('');
$objWorkSheet->getCell('A51')->setValue('Annexure-2: Customer Requirements');
$objPHPExcel->getActiveSheet()->getStyle('A66')->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('A52')->setValue('Product');
$objWorkSheet->getCell('B52')->setValue('Cloud Continuity');
$objWorkSheet->getCell('A53')->setValue('License Type');
$objWorkSheet->getCell('B53')->setValue('Perpetual');
$objWorkSheet->getCell('A54')->setValue('Mode of Sale');
$objWorkSheet->getCell('B54')->setValue('First Time Sale');
$objWorkSheet->getCell('A55')->setValue('Product Module');
$objWorkSheet->getCell('B55')->setValue('DR Lifecycle Bundle');

$objWorkSheet->getCell('A56')->setValue('');
$objWorkSheet->getCell('A57')->setValue('License');
$objWorkSheet->getCell('B57')->setValue('2-Site Configuration');
$objWorkSheet->getCell('C57')->setValue('Qty');

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
$style3 = array(
    'alignment' => array(
//        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'wrap' => true
    )
);
//$objPHPExcel->getActiveSheet()->fromArray($data3, null, 'A73');
$objPHPExcel->getActiveSheet()->fromArray($data3, null, 'A58')->getStyle('B58:B70')->applyFromArray($style3);

$objWorkSheet->getCell('A71')->setValue('');
$objWorkSheet->getCell('A72')->setValue('License');
$objWorkSheet->getCell('B72')->setValue('3-Site Configuration');
$objWorkSheet->getCell('C72')->setValue('Qty');

$data4 = array(
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
$style4 = array(
    'alignment' => array(
//        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'wrap' => true
    )
);
//$objPHPExcel->getActiveSheet()->fromArray($data3, null, 'A88');
$objPHPExcel->getActiveSheet()->fromArray($data4, null, 'A73')->getStyle('B73:B85')->applyFromArray($style4);

$objWorkSheet->getCell('A86')->setValue('');
$objWorkSheet->getCell('A87')->setValue('Annexure-3: Professional Service Requirements');
$objPHPExcel->getActiveSheet()->getStyle('A87')->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('A88')->setValue('Professional Service Requirements 3 Site/Bunker Site Configuration');
$objPHPExcel->getActiveSheet()->getStyle('A88')->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('B88')->setValue('Qty');
$objWorkSheet->getCell('A89')->setValue('Are Professional Service Required on All Purchases');
$objPHPExcel->getActiveSheet()->getStyle('A89')->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('B89')->setValue('Yes');

$objWorkSheet->getCell('A90')->setValue('');
$objWorkSheet->getCell('A91')->setValue('Annexure-3: Product Support Requirements');
$objPHPExcel->getActiveSheet()->getStyle('A91')->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('A92')->setValue('Product Support Requirements');
$objPHPExcel->getActiveSheet()->getStyle('A92')->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('B92')->setValue('Qty');
$objWorkSheet->getCell('A93')->setValue('Year(s) of Sanovi Product Support required for the Purchase');
$objPHPExcel->getActiveSheet()->getStyle('A93')->getAlignment()->setWrapText(true);
$objWorkSheet->getCell('B93')->setValue('1');



//Setting the header type
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Sanovi.xlsx"');
header('Cache-Control: max-age=0');

$objWriter->save('php://output');

/* If you want to save the file on the server instead of downloading, replace the last 4 lines by 
	$objWriter->save('test.xlsx');
*/

?>
