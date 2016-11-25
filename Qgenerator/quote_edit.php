<?php 
    session_start(); 
    ob_start();
   
    //SET ACTIVE PAGE
    $_SESSION["active_page"]="q_generator";

    //BREADCRUMB DATA
    $root="Q-Generator";
    $root_link="q_generator.php";
    $active="";

    include "../includes/php_functions_q_gen_edit.php";
    include "../includes/php_functions.php";
    include "../includes/php_functions_edit_quote.php";

    change_session_id();
    check_session_expiry();
    
    include ("../includes/config.php");
    include ("../includes/post_value_array_edit.php");

    $_SESSION["status"]=find_status($_SESSION['ref_id_edit'], $_SESSION['ver_id_edit']);
?>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/crumbs.css">
        <link rel="stylesheet" href="css/style.css">
        <!--        <link rel="stylesheet" href="css/style-bg-other-pages.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/menu-q-gen.js"></script>
        <script src="js/quotecrumb.js"></script>
        <script src="js/annexure1.js"></script>
        <script src="js/discounts.js"></script>
        <style>
            .img-responsive {
                margin-left: auto;
                margin-right: auto;
                margin-top: 2%;
            }
            
            h3 {
                text-align: center;
            }
            
            #date {
                float: left;
            }
            
            #ref_no {
                float: right;
            }
            
            #text {
                float: left;
                width: 100%;
            }
            
            .styled {
                border: 1px solid grey;
            }
            
            #bg_clr1 {
                color: white;
                background-color: #33689C;
                vertical-align: middle;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            
            #bg_clr {
                color: white;
                background-color: #33689C;
                vertical-align: middle;
                padding-top: 10px;
                padding-bottom: 40px;
            }
            
            #background {
                background-color: #F5F5F5;
                vertical-align: middle;
                padding: 10px;
            }
            
            @media screen and (min-width: 770px) {
                .styled {
                    border: 1px solid grey;
                    vertical-align: middle;
                }
            }
            
            .row {
                line-height: 1em;
            }
            
            #license {
                border: 1px solid black;
            }
            
            #box {
                border: 1px solid grey;
            }
            
            .form-control[readonly] {
                background-color: #fff;
                border: none;
                box-shadow: none;
                padding-left: 0px;
                padding-right: 0px;
            }
        </style>
    </head>

    <body onload="checkdiscounts()" onresize="change_menus()" oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
        <?php
            if($_SESSION["authentication"] == "passed"){ 
                include "../includes/header.php";
                include "../includes/mainmenu-mobile.php";
                include "../includes/mainmenu.php";
                //license cost values
               $license_cost=get_exchange_rate()*(calculate_3site_licence_edit()+calculate_2site_licence_edit()+master_server_license_edit());
                $license_cost=round($license_cost);
                $licenseDiscountValue=round($license_cost*($Discount_license/100));
                $final_license_cost=round($license_cost-$licenseDiscountValue);
//                $3_site_bunker_discount=get_exchange_rate()*(calculate_3site_licence()*0.5);
//                $3_site_bunker_discount=round($3_site_bunker_discount);
                
                //professional services
                $professional_service_cost=round((calculate_prof_services_edit()+master_server_prof_edit())*get_exchange_rate());
                $discountValueOnPs= round($professional_service_cost* ($Discount_prof_serv/100));  
                $final_professional_cost=$professional_service_cost-$discountValueOnPs;
                
                //product support
                $product_cost=round((calculate_product_support_edit()+master_server_support_edit())*get_exchange_rate());
                $prodDiscountValue=round($product_cost*($Discount_product_support/100));
                $final_product_cost=$product_cost-$prodDiscountValue;
                
                //$product_training_cost
                $product_training_cost=round(calculate_product_training_edit());
                $product_training_discount_value=round($product_training_cost*($Discount_product_training/100));
                $final_product_training_cost=$product_training_cost-$product_training_discount_value;
                
                //total cost 
                $final_cost_without_discount=$license_cost+$professional_service_cost+$product_cost;
                $final_discount_cost=round($licenseDiscountValue+$discountValueOnPs+$prodDiscountValue);
                $final_cost_with_discount=round($final_cost_without_discount-$final_discount_cost);
                
                $totalValue=$final_cost_with_discount-round(get_exchange_rate()*(calculate_3site_licence_edit()*0.5));
//                $_SESSION['status_new']=$_SESSION["status"]."<br>";
                $discountdeatails=get_discount_percentage_value($_SESSION['ref_id_edit'], $_SESSION['ver_id_edit']); 
                if($_SESSION["status"]=="Finalized"){
                    saveLicenseGeneration_edit();       
                    saveLicenseHistory_edit($license_cost,$licenseDiscountValue,$final_license_cost,$product_cost,$prodDiscountValue,$final_product_cost,$professional_service_cost,$discountValueOnPs,$final_professional_cost,$product_training_cost,$product_training_discount_value,$final_product_training_cost,$totalValue);
                    saveCustomerDetails_edit();
                    updateReferenceVersionTable_edit($_SESSION['ref_id_edit'],$_SESSION['ver_id_edit']); 
                }else {
                    saveLicenseGeneration_edit_draft();       
                   saveLicenseHistory_edit_draft($license_cost,$licenseDiscountValue,$final_license_cost,$product_cost,$prodDiscountValue,$final_product_cost,$professional_service_cost,$discountValueOnPs,$final_professional_cost,$product_training_cost,$product_training_discount_value,$final_product_training_cost,$totalValue);
                    saveCustomerDetails_edit_draft();
                    
                
                }
            ?>
            <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
        <div id="crumbs" style="width:100%;margin-top:2%">
        <ul>
            <li><a href="#" id="quote_request" class="active">Quote Request</a></li>
            <li><a href="#" id="config_review">Config Review</a></li>
            <li><a href="#" id="review_and_discount">Review and Discounts</a></li>
            <li><a href="#" id="quote_finalize">Quote Finalize</a></li>
        </ul>
    </div>
            <div class="container">
                <center><img style="padding-top:20px;" src="images/Sanovi-Logo-Mobile.png"></center>
                <br>
                <br>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <center><b>Customer Quote For :</b>
                            <?php echo "$OrgName" ?>
                        </center>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <?php
                            date_default_timezone_set("Asia/Kolkata"); //SETTING INDIAN TIME ON SERVER
                            echo date('l,F j,Y'); ?>
                    </div>
                    <div class="col-sm-6"> </div>
                    <div class="col-sm-3"><b>Ref No :</b>
                        <?php echo $_SESSION['ref_id_edit']; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6"> </div>
                    <?php
            
                    if($_SESSION["status"]=="Finalized"){
                        $version=getMaxVersionId(substr($_SESSION['ref_id_edit'],12));
//                        echo substr($_SESSION['ref_id_edit'],12);
                    }else{
                        $version=($_SESSION['ver_id_edit']);
                    }
                    ?>
                        <div class="col-sm-3"><b>Ver No :</b>
                            <?php echo $version; ?>
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">Dear
                        <?php echo $CustomerName ;?>,</div>
                    <div class="col-sm-6"></div>
                    <div class="col-sm-3"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-10">This is with reference to our discussion, we are pleased to offer the below detailed commercials.</div>
                    <div class="col-sm-2"> </div>
                </div>
                <br> </div>
        
        <form method="post" action="http://quotedev.sanovi.com/finalize_edit.php">
            <div class="container" id="license">
                        <div class="row" id='bg_clr1'>
                            <div class="col-xs-5"><b>Item</b></div>
                            <div class="col-xs-2" style="text-align:right"><b>List Price<br><?php echo $Currency;?> </b></div>
                            <div class="col-xs-1" style="text-align:right"><b>Discount % </b></div>
                            <div class="col-xs-2" style="text-align:right"><b>Discount Value</b></div>
                            <div class="col-xs-2" style="text-align:right"><b>Final Price</b></div>
                        </div>
                        <div class="row" id="background">
                        <div class="row">
                            <div class="col-sm-5"><b>License fee for Perpetual Sanovi Cloud Continuity Module</b></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2"></div>
                        </div>
                        <br>
                            
                        <div class="row">
                            <div class="col-sm-5"><b>-Licensing</b></div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" type="number" id="license_cost" readonly value="<?php echo $license_cost; ?>">
                                <input type="hidden" id="max_discount" name="Max_Discount" value="<?php echo $_SESSION["Max_Discount"]; ?>">
                            </div>
                            <div class="col-sm-1" style="text-align:right">
                                <input class="form-control" type="text" id="discount_license" placeholder="%" onblur="calculate_license_cost()" tabindex="1" name="Discount_license" value="<?php echo $discountdeatails["Discount_license"]; ?>">
                            </div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" readonly type="text" id="discount_value"  name="Discount_license_value" value="<?php echo round($licenseDiscountValue) ; ?>">
                            </div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" type="text" id="final_license_value" name="Discount_license_final_value" readonly value=" <?php echo round($final_license_cost) ; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-5"><b>- Product Support</b></div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" type="number" id="product_support" readonly value="<?php echo $product_cost; ?>">
                            </div>
                            <div class="col-sm-1" style="text-align:right">
                                <input class="form-control" type="text" id="discount_product_support" placeholder="%" onblur="calculate_product_support_cost()" tabindex="2" name="Discount_product_support" value="<?php echo $discountdeatails["Discount_product_support"]; ?>">
                            </div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" readonly type="text" id="discount_product_support_value" name="Discount_product_support_value" value="<?php echo round($prodDiscountValue) ; ?>">
                            </div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" type="text" id="final_product_support_value" name="Final_product_support_value" readonly value=" <?php echo round($final_product_cost); ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-5"><b>- Professional Services for Implementation</b></div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" type="number" id="professional_service_cost" readonly value="<?php echo $professional_service_cost ;  ?>" >
                            </div>
                            <div class="col-sm-1" style="text-align:right">
                                <input class="form-control" type="text" tabindex="3" id="discount_prof_serv" name="Discount_prof_serv" placeholder="%" value="<?php echo $discountdeatails["Discount_prof_serv"];  ?>" onblur="calculate_professional_service_cost()">
                            </div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" readonly type="text" id="discount_value_ps" name="Discount_value_ps" value="<?php echo $discountValueOnPs;?>">
                            </div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" type="text" id="final_professional_value" name="Final_professional_value" readonly value="<?php echo $final_professional_cost ; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-5"><b>- DRM Product Training</b></div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" type="number" id="product_training" readonly value="<?php echo $product_training_cost; ?>">
                           </div>
                             <div class="col-sm-1" style="text-align:right">
                                <input class="form-control" type="text" tabindex="4" id="discount_product_training" name="Discount_product_training" placeholder="%" value="<?php echo $discountdeatails["Discount_product_training"]; ?>" onblur="calculate_product_training_cost()">
                            </div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" readonly type="text" id="product_training_discount_value" name="Product_training_discount_value" value="<?php echo $product_training_discount_value; ?>">
                            </div>
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" type="text" id="final_product_training_cost" name="Final_product_training_cost" readonly value="<?php echo $final_product_training_cost; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-5"><b>Total Price</b></div>
<!--
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" type="text" id="final_cost_without_discount" readonly value="<?php // echo $final_cost_without_discount; ?>">
                            </div>
-->
<!--
                            <div class="col-sm-1" style="text-align:right">
                                <input class="form-control" type="text" id="avg_discount" tabindex="5" readonly value="<?php //echo "-"; ?>">
                                
                            </div>
-->
<!--
                            <div class="col-sm-2" style="text-align:right">
                                <input class="form-control" type="text" id="final_discount_cost" name="Final_discount_cost" readonly value="<?php //echo $final_discount_cost; ?>">
                            </div>
-->
                            <div class="col-sm-2 col-sm-offset-5" style="text-align:right">
                                <input class="form-control" type="text" id="final_cost_with_discount" name="Final_cost_with_discount" readonly value="<?php echo $final_cost_with_discount ; ?>">
                                
                            </div>
                        </div>
                        </div>
                    </div>
            <?php 
               $admin_check=authenticate_admin(); 
               if($admin_check!="Passed"){
                ?>
                <br>
                <br>
                <div class="container form-group" style="padding-left:0px;padding-right:0px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
<!--                            <input type="checkbox" hidden class="license" id="annexure1" onclick="maskValues()">-->
                            <label class="radio-inline"> <b><div class='tool' data-toggle='tooltip' data-placement='bottom' title=''> Annexure-1: Bill of Quantity </div></b></label>
                        </div>
                        <div class="panel-body">
                            <?php include "../includes/annexure1_quote_edit_without_values.php"; ?>
                        </div>
                    </div>
                </div>
                <?php   }else{
            ?>
                    <br>
                    <br>
                    <div class="container form-group" style="padding-left:0px;padding-right:0px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <label class="radio-inline">
                                    <input type="checkbox" class="license" id="annexure1" onclick="maskValues()">&nbsp;&nbsp; <b><div class='tool' data-toggle='tooltip' data-placement='bottom' title='On Selecting, Annexure-1 will be printed in PDF too'> Annexure-1: Bill of Quantity </div></b></label>
                            </div>
                            <div class="panel-body collapse" id="billQuantity" style="display: none;">
                                <?php include "../includes/annexure1_quote_edit.php"; ?>
                            </div>
                            <div class="panel-body collapse" id="billQuantity1" style="display: block;">
                                <?php include "../includes/annexure1_quote_edit_without_values.php"; ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                        <br>
                        <br>
                        <div class="container">
                            <div class="col-sm-7"> <span style="font-size:12px;"><b>Note:</b><br>The Quote is already saved as Draft.<br>Editing is not possible once the finalize button is clicked</span> </div>
                            
                                <div class="col-sm-5">
                                    <input type="hidden" id="annexure_1" name="Annexure_1" value="No">
                                    <input type="hidden" id="approve" name="Approve">
<!--                                    <input type="SUBMIT" hidden id="onlysave" class="btn btn-lg btn-success pull-right" name="save" value="SAVE">-->
                                    <input type="submit" id="finalize" class="btn btn-lg btn-success pull-right" name="finalize" value="Finalize">
                                    <br> </div>
                        </div>
                            </form>  
   <?php 
                    }else{
               ?>
               <br>
               <center style="color:green;"><b>Quote Saved Successfully</b><br> Ref No : <?php echo $_SESSION['ref_id_edit']; ?><br><br>Contact Your Manager for Approval </center>
       <?php
           }
                        include "includes/footer.php";
                        ob_flush();
                        }         
                    ?>
    </body>

    </html>