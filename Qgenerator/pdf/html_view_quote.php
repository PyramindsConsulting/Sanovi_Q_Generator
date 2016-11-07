<?php

session_start(); 
ob_start();

if($_SESSION["authentication"] == "passed"){

//require('fpdf/fpdf.php');
include('../../includes/php_function_quote_edit.php');
include ("../../includes/config.php");
    
if(!isset($_GET)){
    die("Invalid");
}
$refId=$_GET["refId"]; 
$verId=$_GET["verId"];
//if(find_quote_status($refId, $verId)==="Finalized"){
//        $GLOBALS['watermark']="S A N O V I";
//    }else{
//        $GLOBALS['watermark']="D R A F T";
//}
    
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

//fetching values from license generation table
$lgt_details=fetch_lgt_data($refId, $verId);
    
$crt_id=$lgt_details["license_crt_id"];
$lht_id=$lgt_details["license_lht_id"];
$date=$lgt_details["license_generation_date"];

//fetching deatils of 2site and 3 site    
$qty_2s=fetch_crt_2s_data($crt_id);
$qty_3s=fetch_crt_3s_data($crt_id);
$bunker=$qty_3s[0][1];
$data_2s_3s=adding2s_3s($qty_2s,$qty_3s,$bunker);

// fetching value of licnese history table    
$lht_data=fetch_lht_data($lht_id);

//CUSTOMER DATA
//fetching details from customer requirement table    
$customer_details=fetch_crt_customer_data($crt_id);
   
$country=$customer_details["country"];
$OrgName=$customer_details["cust_org_name"];
$currency=$customer_details["cust_currency"];
$license=$customer_details["license_type"];
$product=$customer_details["product"];
$ModeOfSale=$customer_details["mode_of_sale"];
$ProdModule=$customer_details["product_module"];
?>
<html> 

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            margin-top: 40px;
        }
        
        .row {
             margin-right: 0px; 
             margin-left: 0px; 
        }
        .sanovi_img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        
        hr {
            height: 1px;
            border-top: 1px solid black;
        }
        
        #License_Item {
            background-color: lightgray;
            height: 7%;
            padding-top: 10px;
        }
        
        #Professional_service {
            background-color: lightgray;
            height: 7%;
            padding-top: 10px;
        }
        
        #Product_Support {
            background-color: lightgray;
            height: 7%;
            padding-top: 10px;
        }
        
        #Site2 {
            background-color: lightgray;
            height: 7%;
            padding-top: 10px;
        }
        
        #Site3 {
            background-color: lightgray;
            height: 7%;
            padding-top: 10px;
        }
        
        #prof_services {
            background-color: lightgray;
            height: 7%;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container"> <img class="sanovi_img" src="images/Sanovi-Logo-Mobile.png">
        <!--Quote Deatils  -->
        <div class="row">
                <div class="col-sm-2"><b>Ref No :</b></div>
                <div class="col-sm-2"><?php echo $refId; ?></div>
        </div> 
        <div class="row">
                <div class="col-sm-2"><b>Ver No :</b></div>
                <div class="col-sm-2"><?php echo $verId; ?></div>
        </div> 
        <div class="row">
                <div class="col-sm-2"><b>Date :</b></div>
                <div class="col-sm-2"><?php echo $date; ?></div>
        </div> 
        <div class="row">
                <div class="col-sm-2"><b>Customer Name :</b></div>
                <div class="col-sm-2"><?php echo $OrgName; ?></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-2">Dear,</div></div>
        <div class="row">
                <div class="col-sm-8">This is with reference to our discussion, we are pleased to offer the below detailed commercials.</div>
        </div>
        <hr>
        <!-- License Costings       -->
        <div class="row">
            <div class="col-sm-4"><b>Item</b></div>
            <div class="col-sm-2"><b>List Price (<?php echo $currency;?>)</b></div>
            <div class="col-sm-2"><b>Discount (%)</b></div>
            <div class="col-sm-2"><b>Discount Value <?php echo $currency;?></b></div>
            <div class="col-sm-2"><b>Final Price <?php echo $currency;?></b></div>
        </div>
        <hr>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6"> License fee for Prepetual Sanovi Cloud Continuity Module </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">- Licensing</div>
                <?php $licensing=currency_format($lht_data["licenseCost"],$currency);?>
                <div class="col-sm-2"><?php echo $licensing;?></div>
                <div class="col-sm-2"><?php echo $lht_data["discountPercentageOnLicense"];?></div>
                <div class="col-sm-2">-</div>
                <div class="col-sm-2"><?php echo currency_format($lht_data["finalLicenseCost"],$currency);?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">- Product Support</div>
                
                <div class="col-sm-2"><?php echo currency_format($lht_data["productSupportCost"],$currency);?></div>
                <div class="col-sm-2"><?php echo $lht_data["discountPercentageOnSupport"];?></div>
                <div class="col-sm-2">-</div>
                <div class="col-sm-2"><?php echo currency_format($lht_data["finalSupportCost"],$currency);?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">- Professional Services</div>
                <div class="col-sm-2"><?php echo currency_format($lht_data["PSCost"],$currency);?></div>
                <div class="col-sm-2"><?php echo $lht_data["discountPercentageOnPS"];?></div>
                <div class="col-sm-2">-</div>
                <div class="col-sm-2"><?php echo currency_format($lht_data["finalPSCost"],$currency);?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">- DRM Product Training</div>
                <div class="col-sm-2"><?php echo currency_format($lht_data["trainingCost"],$currency);?></div>
                <div class="col-sm-2"><?php echo $lht_data["discountPercentageOnTraining"];?></div>
                <div class="col-sm-2">-</div>
                <div class="col-sm-2"><?php echo currency_format($lht_data["finalTrainingCost"],$currency);?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6"><b>Total Price</b></div>
                <div class="col-sm-2"></div>
                <div class="col-sm-2"></div>
                <div class="col-sm-2"><b><?php echo currency_format($lht_data["totalValue"],$currency);?></b></div>
            </div>
        </div>
        <hr>
        
        <?php 
//    detail description of license items and quantity 
            $annexure1=displayAnnexure_1($refId,$verId);
                if($annexure1=="Yes"){
        ?>
        <div class="container">
            <div class="row" style="margin-left:2%;"><b>Annexure-1: Bill of Quantity
            </b> </div>
        </div> 
        <div class="form-group" id="License_Item">
            <div class="row">
                <div class="col-sm-4"><b>Part No/Licensing</b></div>
                <div class="col-sm-6"><b>License Item Description</b> </div>
                <div class="col-sm-2"><b>Qty</b></div>
            </div>
        </div>
        <!--  license billing quantity       -->
        <?php 
            $licensebilling=License_billing_quantity($data_2s_3s,$ProdModule,$country,$ModeOfSale,$currency);
            $licensecount=count($licensebilling);
            for($i=0;$i<$licensecount;$i++) {
                if($licensebilling[$i][0]!=""){
                  echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-4'>".$licensebilling[$i][0]."</div>
                                <div class='col-sm-5'>".$licensebilling[$i][1]."</div>
                                <div class='col-sm-1'>".$licensebilling[$i][2]."</div>
                                <div class='col-sm-1'>".currency_format($licensebilling[$i][3],$currency)."</div>
                            </div>
                        </div>";
                }
            }
            
            $master_server_license=masterServerLicense_view($ModeOfSale,$country);
            $master_server_license_count=count($master_server_license);
            for($i=0;$i<$master_server_license_count;$i++) {
                if($master_server_license[$i][0]!=""){
                    echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-4'>".$master_server_license[$i][0]."</div>
                                <div class='col-sm-5'>".$master_server_license[$i][1]."</div>
                                <div class='col-sm-1'>".$master_server_license[$i][2]."</div>
                                <div class='col-sm-1'>".currency_format($master_server_license[$i][3],$currency)."</div>
                            </div>
                        </div>";
                }
            }
        ?>
        <!-- Professional billing Quantity        -->
        <div class="form-group" id="Professional_service">
            <div class="row">
                <div class="col-sm-4"><b>Part No/Licensing</b></div>
                <div class="col-sm-6"><b>Professional service Description</b></div>
                <div class="col-sm-2"><b>Qty</b></div>
            </div>
        </div>
        <?php 
            $prof_qty=fetch_crt_prof_data($crt_id);
            $prof_services_all=$prof_qty[0][1];    
            $profbilling=Professional_billing_quantity($prof_qty,$data_2s_3s,$ProdModule,$country,$ModeOfSale,$currency,$Productsupport,$prof_services_all);
            $profcount=count($profbilling);
    
            for($i=0;$i<$profcount;$i++) {
                if($profbilling[$i][0]!=""){
                  echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-4'>".$profbilling[$i][0]."</div>
                                <div class='col-sm-5'>".$profbilling[$i][1]."</div>
                                <div class='col-sm-1'>".$profbilling[$i][2]."</div>
                                <div class='col-sm-1'>".currency_format($profbilling[$i][3],$currency)."</div>
                            </div>
                        </div>";
                }
            }
            
            $master_server_prof= masterServerProf_view($ModeOfSale,$country);
            $master_server_prof_count=count($master_server_prof);
            for($i=0;$i<$master_server_prof_count;$i++) {
                if($master_server_prof[$i][0]!=""){
                    echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-4'>".$master_server_prof[$i][0]."</div>
                                <div class='col-sm-5'>".$master_server_prof[$i][1]."</div>
                                <div class='col-sm-1'>".$master_server_prof[$i][2]."</div>
                                <div class='col-sm-1'>".currency_format($master_server_prof[$i][3],$currency)."</div>
                            </div>
                        </div>";
                }
            }
            
        ?>
        
         <!-- Product Support  billing Quantity        -->
        <div class="form-group" id="Professional_service">
            <div class="row">
                <div class="col-sm-4"><b>Part No/Licensing</b></div>
                <div class="col-sm-6"><b>Product Support Description</b></div>
                <div class="col-sm-2"><b>Qty</b></div>
            </div>
        </div>
        <!-- Product Training billing Quantity        -->
        <?php 
            $Productsupport=fetch_crt_prod_support_years($crt_id);
            $productbilling=Product_billing_quantity($qty_2s,$ProdModule,$country,$ModeOfSale,$currency,$Productsupport);
            $productcount=count($productbilling);
    
            for($i=0;$i<$productcount;$i++) {
                if($productbilling[$i][0]!=""){
                  echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-4'>".$productbilling[$i][0]."</div>
                                <div class='col-sm-5'>".$productbilling[$i][1]."</div>
                                <div class='col-sm-1'>".$productbilling[$i][2]."</div>
                                <div class='col-sm-1'>".currency_format($productbilling[$i][3],$currency)."</div>
                            </div>
                        </div>";
                }
            }
            
            $master_server_product=masterServerproduct_view($ModeOfSale,$country);
            $master_server_product_count=count($master_server_product);
            for($i=0;$i<$master_server_product_count;$i++) {
                if($master_server_product[$i][0]!=""){
                    echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-4'>".$master_server_product[$i][0]."</div>
                                <div class='col-sm-5'>".$master_server_product[$i][1]."</div>
                                <div class='col-sm-1'>".$master_server_product[$i][2]."</div>
                                <div class='col-sm-1'>".currency_format($master_server_product[$i][3],$currency)."</div>
                            </div>
                        </div>";
                }
            }
            
        ?>
       <?php  }//End of Annexure 1 If loop
            else{ ?>
        <div class="form-group">
            <div class="row"><b>Annexure-1: Bill of Quantity
            </b> </div>
        </div>
        <div class="form-group" id="License_Item">
            <div class="row">
                <div class="col-sm-3"><b>Part No/Licensing</b></div>
                <div class="col-sm-7"><b>License Item Description </b></div>
                <div class="col-sm-2"><b>Qty</b></div>
            </div>
        </div>
        <!--  license billing quantity       -->
        <?php 
            $licensebilling=License_billing_quantity($data_2s_3s,$ProdModule,$country,$ModeOfSale,$currency);
            $licensecount=count($licensebilling);
            for($i=0;$i<$licensecount;$i++) {
                if($licensebilling[$i][0]!=""){
                  echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-3'>".$licensebilling[$i][0]."</div>
                                <div class='col-sm-7'>".$licensebilling[$i][1]."</div>
                                <div class='col-sm-2'>".$licensebilling[$i][2]."</div>
                            </div>
                        </div>";
                }
            }
            
            $master_server_license=masterServerLicense_view($ModeOfSale,$country);
            $master_server_license_count=count($master_server_license);
            for($i=0;$i<$master_server_license_count;$i++) {
                if($master_server_license[$i][0]!=""){
                    echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-3'>".$master_server_license[$i][0]."</div>
                                <div class='col-sm-7'>".$master_server_license[$i][1]."</div>
                                <div class='col-sm-2'>".$master_server_license[$i][2]."</div>
                            </div>
                        </div>";
                }
            }
        ?>
        <!-- Professional billing Quantity        -->
        <div class="form-group" id="Professional_service">
            <div class="row">
                <div class="col-sm-3"><b>Part No/Licensing</b></div>
                <div class="col-sm-7"><b>Professional service Description</b></div>
                <div class="col-sm-2"><b>Qty</b></div>
            </div>
        </div>
        <?php 
            $prof_qty=fetch_crt_prof_data($crt_id);
            $prof_services_all=$prof_qty[0][1];    
            $profbilling=Professional_billing_quantity($prof_qty,$data_2s_3s,$ProdModule,$country,$ModeOfSale,$currency,$Productsupport,$prof_services_all);
            $profcount=count($profbilling);
    
            for($i=0;$i<$profcount;$i++) {
                if($profbilling[$i][0]!=""){
                  echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-3'>".$profbilling[$i][0]."</div>
                                <div class='col-sm-7'>".$profbilling[$i][1]."</div>
                                <div class='col-sm-2'>".$profbilling[$i][2]."</div>
                            </div>
                        </div>";
                }
            }
            
            $master_server_prof= masterServerProf_view($ModeOfSale,$country);
            $master_server_prof_count=count($master_server_prof);
            for($i=0;$i<$master_server_prof_count;$i++) {
                if($master_server_prof[$i][0]!=""){
                    echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-3'>".$master_server_prof[$i][0]."</div>
                                <div class='col-sm-7'>".$master_server_prof[$i][1]."</div>
                                <div class='col-sm-2'>".$master_server_prof[$i][2]."</div>
                            </div>
                        </div>";
                }
            }
            
        ?>
        
        <!-- Product Training billing Quantity        -->
        <div class="form-group" id="Professional_service">
            <div class="row">
                <div class="col-sm-3"><b>Part No/Licensing</b></div>
                <div class="col-sm-7"><b>Product Support Description</b></div>
                <div class="col-sm-2"><b>Qty</b></div>
            </div>
        </div>
        <?php 
            $Productsupport=fetch_crt_prod_support_years($crt_id);
            $productbilling=Product_billing_quantity($qty_2s,$ProdModule,$country,$ModeOfSale,$currency,$Productsupport);
            $productcount=count($productbilling);
    
            for($i=0;$i<$productcount;$i++) {
                if($productbilling[$i][0]!=""){
                  echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-3'>".$productbilling[$i][0]."</div>
                                <div class='col-sm-7'>".$productbilling[$i][1]."</div>
                                <div class='col-sm-2'>".$productbilling[$i][2]."</div>
                            </div>
                        </div>";
                }
            }
            
            $master_server_product=masterServerproduct_view($ModeOfSale,$country);
            $master_server_product_count=count($master_server_product);
            for($i=0;$i<$master_server_product_count;$i++) {
                if($master_server_product[$i][0]!=""){
                    echo   "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-3'>".$master_server_product[$i][0]."</div>
                                <div class='col-sm-7'>".$master_server_product[$i][1]."</div>
                                <div class='col-sm-2'>".$master_server_product[$i][2]."</div>
                            </div>
                        </div>";
                }
            }
         } ?>
        <!-- User entered data with individual quantity listing        -->
        <div class="form-group">
            <div class="row"><b>Annexure-2: Customer Requirements
                </b> </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2"><b>Product</b></div>
                <div class="col-sm-2"><?php echo $product; ?></div>
            </div>
            <div class="row">
                <div class="col-sm-2"><b>License Type </b></div>
                <div class="col-sm-2"><?php echo $license; ?></div>
            </div>
            <div class="row">
                <div class="col-sm-2"><b>Mode of Sale</b></div>
                <div class="col-sm-2"><?php echo $ModeOfSale; ?></div>
            </div>
            <div class="row">
                <div class="col-sm-2"><b>Product Module</b></div>
                <div class="col-sm-2"><?php echo $ProdModule; ?></div>
            </div>
        </div>
        <div class="form-group" id="Site2">
            <div class="row">
                <div class="col-sm-4"><b>License </b></div>
                <div class="col-sm-6"><b>2-Site Configuration</b></div>
                <div class="col-sm-2"><b>Qty</b></div>
            </div>
        </div>
        <?php
//            2-site license quantities
            $qty_and_questions_2s=fetch_crt_2s_data($crt_id);
            $qty_and_questions_count=count($qty_and_questions_2s);
            
            for($i=0;$i<$qty_and_questions_count;$i++) {
                if($qty_and_questions_2s[$i][1]!=0){
                    echo "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-4'></div>
                                <div class='col-sm-6'>".get_question($qty_and_questions_2s[$i][0])."</div>
                                <div class='col-sm-2'>".$qty_and_questions_2s[$i][1]."</div>
                            </div>
                        </div>";
                }
            }
        ?>
        <!--3-site quantity-->
        <div class="form-group" id="prof_services">
            <div class="row">
                <div class="col-sm-4"><b>License </b></div>
                <div class="col-sm-6"><b>3-Site Configuration</b></div>
                <div class="col-sm-2"><b>Qty</b></div>
            </div>
        </div>
        <?php   
            $qty_and_questions_3s=fetch_crt_3s_data($crt_id);
            $count_qty_and_questions_3s=count($qty_and_questions_3s);
            
            for($i=0;$i<$count_qty_and_questions_3s;$i++) {
                if($qty_and_questions_3s[$i][1]!=0){
                    echo "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-4'></div>
                                <div class='col-sm-6'>".get_question($qty_and_questions_3s[$i][0])."</div>
                                <div class='col-sm-2'>".$qty_and_questions_3s[$i][1]."</div>
                            </div>
                        </div>";
                }
            }
            
        ?>
<!--      ANNEXURE-3 - PROFESSIONAL SERVICES-->
        <div class="form-group">
            <div class="row"><b>Annexure-3: Professional Services Requirements
                </b> </div>
        </div>
        <div class="form-group" id="Site3">
            <div class="row">
                <div class="col-sm-4"><b>License </b></div>
                <div class="col-sm-6"><b>Professional Services Requirement 3 Site/Bunker Site Configuration</b></div>
                <div class="col-sm-2"><b>Qty</b></div>
            </div>
        </div>
        
        <?php
            $prof_services=fetch_crt_prof_data($crt_id);
            $profcount=count($prof_services);
        ?>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-6">Are Professional Services Required on All Purchases </div>
                <div class="col-sm-2"><?php echo ucfirst($prof_services[0][1]);?></div>
            </div>
        </div>
        <?php 
            for($i=0;$i<$profcount;$i++) {
                if($prof_services[$i][1]!=0){
                    if($prof_services[0][1]=='No'){
                         echo "<div class='form-group'>
                            <div class='row'>
                                <div class='col-sm-4'></div>
                                <div class='col-sm-6'>".get_question($prof_services[$i][0])."</div>
                                <div class='col-sm-2'>".$prof_services[$i][1]."</div>
                            </div>
                        </div>";  
                    }
                }
            }
        ?>
        
<!--       ANNEXURE-3 - PRODUCT SUPPORT-->
        <div class="form-group">
            <div class="row"><b>Annexure-3: Product Support Requirements
                </b> </div>
        </div>
        <div class="form-group" id="Site3">
            <div class="row">
                <div class="col-sm-4"> </div>
                <div class="col-sm-6"><b>Product Support Requirements</b></div>
                <div class="col-sm-2"><b>Qty</b></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-6">Year(s) of Sanovi Product Support required for the Purchase </div>
                <div class="col-sm-2"><?php echo fetch_crt_prod_support_years($crt_id);?></div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <!--        Terms and Conditions-->
        <div class="container">
            <p><b>TERMS AND CONDITIONS
</b></p>
            <p><b>Sanovi Cloud Continuity Commercial Enterprise Terms &amp; Conditions

</b></p>
            <p>This document provides details of commercial terms and conditions and licensing policy for Enterprise Customers who will deploy Sanovi Cloud Continuity software in their data centres. - The sale of Sanovi Cloud ContinuityTM software and Services is governed by the following commercial terms and conditions </p>
            <p><b>Product Support (Applicable Only for Perpetual licnese)
</b></p>
            <p>- Annual Product support charges will be 20% of the License value and must be paid in advance.)
                <br> - Product support will begin from the date of delivery of media or download of software with a validity of 12 months.)
                <br> - The payment for Product Support Charge is in no way linked to deployment or implementation sign-off or any other milestone. These charges are to be paid every year in advance to ensure regular technical support and bug fixes.)</p>
            <p><b>Payment Terms:
</b></p>
            <p>- Subscpriton Licnese: 100% of Annual subscprion fees in advance along with purchase order
                <br> - Implemenation Services: As per the milestones defined in the purchase order/contract.
                <br> - Pricing quoted in the accompanying spreadsheet in this mail is the pricing to Business Partner for Enterprise Customers only.
                <br> - The prices quoted are exclusive of all applicable taxes and duties. Any additional taxes will be borne by Business Partner/Customer.
                <br> - Perputal License:- 100% of the license fee and product support for 1st year will be payable in advance along with purchase order. </p>
            <p><b>Sizing of licenses required:</b></p>
            <p>- Prices quoted are applicable for two-way DR (1 DC site and 1 DR site) sites.
                <br> - For three-way DR (1 DC site and 2 DR Sites), prices will be 2 times of the quoted two-way DR price.
                <br> - Numbers and types of licenses has been determined based on the customer landscape details provided. During implementation, if more
                <br> Databases and Application Server instances are required to be protected by Sanovi DRMTM licenses, then customer/business partner need to procure additional licenses. </p>
            <p><b>Language Support:</b></p>
            <p>- All documentation, communication will be in English language only.</p>
            <p><b>Professional Services:</b></p>
            <p>- Professional services fee is applicable for
                <br> - Technical Support such as Implementation, Integration, DR Drill, Change Management. - Training.
                <br> - Professional services will be provided against customer approved Statement of Work and purchase order.
                <br> - Each request will be for a minimum of one day (8 hours) and continuous workdays.
                <br> - Remote Professional services will be provided during Sanovi normal working hours and require access to customer systems remotely
                <br> - Professinal Services requires two week lead time for resource mobilisation after receipt of purchase order along with payment
                <br>- For onsite visit â€“ visa, travel, lodging, boarding, out of pocket expenses will be charged extra.
                <br>- Sanovi will provide training on DRM software to customer at the time of delivery/implementation as per the schedule agreed in the purchase order and any additional training will be charged.
                <br>- Professional services fee is applicable for</p>
            <p><b>Customer Responsibilities:
</b></p>
            <p>- Customer must provide all necessary information and access within 2 working days. Any delay due to non-availability of resources/information solely attributable to the customer will entail additional charges as per the Professional Services rates.
                <br>- Customer to provide appropriate and required documentation like â€œinvitation letterâ€• etc., for obtaining visa as per the rules of any particular country.</p>
            <p><b>Sanovi Authorized Partner Responsibilities:</b></p>
            <p>- Participate in Sanovi DRMTM training for delivery and operations team. SANOVI TECHNOLOGIES
                <br> - Actively facilitate implementation by engaging with customer executives to ensure that project is successfully completed.
                <br> - Ensure that customer provides remote access to production and DR environment by opening necessary firewall ports/rules
                <br> - All other terms and conditions are as per Sanovi agreement with partner</p>
        </div> 
    
</body>

</html>

<?php 
    }else{
    header('location:logout.php');
}
ob_flush();
?>