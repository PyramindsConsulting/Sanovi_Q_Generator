<?php 
    session_start();
    ob_start();

    //SET ACTIVE PAGE
    $_SESSION["active_page"]="list";
?>
    <!doctype html>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style-bg-other-pages.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/menu.js"></script>
    </head>

    <body onresize="change_menus()">
        <?php 
            include "../includes/config.php";
            include "../includes/php_functions.php";
        
            change_session_id();
            check_session_expiry();
        ?>
            <?php
            if($_SESSION["authentication"] == "passed"){ 
                include "../includes/header-dashboard.php";
                include "../includes/mainmenu-mobile.php";
                include "../includes/mainmenu.php";
                include "../includes/php_functions_dashboard.php";
                include "../includes/php_function_quote.php";
        ?>
        <?php 
            if($_SESSION["userrole"]=="Administrator" || $_SESSION["userrole"]=="Chief Executive Officer"){
            
        ?>
        <div class="container">
            <div class="pull-right">
                <br>
                <a href="dashboard-all-quotes.php">
                    <button type="button" class="btn btn-default">Display All Quotes</button>
                </a>
            </div>
        </div>
        <?php } ?>
<!--        FOR LARGE SCREEN DEVICES-->
                <div class="container hidden-xs hidden-sm">
                   <h2>Q - List</h2>(by <?php echo $_SESSION["emp_name"];?>)
                    
<!--                    QUOTE RECORDS-->
                        <div class="panel-group" id="accordion">
                            <?php
                                $ref_ids_created_by_users=find_all_ref_ids_from_lgt($_SESSION["username"]); //ARRAY of REF IDs
                                $no_of_ref_ids_created_by_user=count($ref_ids_created_by_users)-1;
                            ?>
                            
                            <?php
                                for($i=0;$i<=$no_of_ref_ids_created_by_user;$i++){
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">

                                        <a data-toggle="collapse" href="#company-<?php echo $i; ?>" data-parent="#accordion"><span class="glyphicon glyphicon-plus"> </span></a>
                                         <?php echo "<b>".find_company_name($ref_ids_created_by_users[$i])."</b>";
                                                echo "<span style=\"color:green; font-size:12px;\"> (Ref No. ".$ref_ids_created_by_users[$i].")</span>"; ?>
                                    </h4>
                                </div>
                                <div id="company-<?php echo $i; ?>" class="panel-collapse collapse">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="container">
                                                <div class="row">
                                                    <b>
                                                    <div class="col-sm-2" style="text-align:center;">Module</div>
                                                    <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                                        <div class="col-sm-2" style="text-align:center;">List Price</div>
                                                    <?php } ?>
                                                    <div class="col-sm-2" style="text-align:center;">Date</div>
                                                    <div class="col-sm-2" style="text-align:center;">Version</div>
                                                    <div class="col-sm-2" style="text-align:center;">Status</div>
                                                    <?php //if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                                        <div class="col-sm-2"></div>
                                                    <?php //} ?>
                                                    </b>
                                                </div>
                                                <?php 
                                                    $versions=find_all_version_ids($ref_ids_created_by_users[$i]);
                                                    $no_of_versions=count($versions);
//                                                    print_r($versions);
                                                    for($j=0;$j<$no_of_versions;$j++){
                                                        $quote_status=find_quote_status_from_lht($ref_ids_created_by_users[$i], $versions[$j]);
                                                        $crt_product_module=find_data_from_crt_for_dashboard($ref_ids_created_by_users[$i], $versions[$j]);
                                                        $lht_list_price=find_list_price_from_lht_for_dashboard($ref_ids_created_by_users[$i], $versions[$j]);
                                                        $lgt_details=find_data_from_lgt_for_dashboard($ref_ids_created_by_users[$i], $versions[$j]);
                                                        //echo $crt_data_dashboard;?>
                                                        <div class="row">
                                                            <div class="col-sm-2" style="text-align:center;"><?php echo $crt_product_module["product_module"]; ?></div>
                                                            <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                                                <div class="col-sm-2" style="text-align:right;">
    <!--                                                                <span >-->
                                                                        <?php echo currency_format($lht_list_price,$crt_product_module["cust_currency"]); ?>
    <!--                                                                </span>-->
                                                                </div>
                                                            <?php } ?>
                                                            <div class="col-sm-2" style="text-align:center;">
                                                                <?php echo $lgt_details["license_generation_date"];?>
                                                            </div>
                                                            <div class="col-sm-2" style="text-align:center;">
                                                                <?php echo $versions[$j]; ?>
                                                            </div>
                                                            <div class="col-sm-2" style="text-align:center;">
                                                                <?php echo $lgt_details["status"];?>
                                                            </div>
                                                            <div class="col-sm-2">
                                                            <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                                                <a href="pdf/view_quote.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$j];?>" target="_blank" ><span class="glyphicon glyphicon-eye-open"> </span></a>
                                                            <?php } ?>
                                                                <?php
                                                                    if($quote_status=="Finalized"){?>
                                                                        <a onclick="return confirm('Finalized Quote cannot be edited. New version will be created. Confirm to proceed');" href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_users[$i]."&verid=".$versions[$j];?>" target="_blank" ><span class="glyphicon glyphicon-edit"> </span></a>
                                                                <?php }else{ ?>
                                                                        <a href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_users[$i]."&verid=".$versions[$j];?>" target="_blank" ><span class="glyphicon glyphicon-edit"> </span></a>
                                                                <?php } ?>
                                                                <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                                                <a href="pdf/download_quote.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$j];?>"><span class="glyphicon glyphicon-save-file"> </span></a>
                                                                <?php
                                                                    if($quote_status=="Draft"){?>
                                                                        <span class="glyphicon glyphicon-envelope"> </span>
                                                                    <?php }else{?>
                                                                        <a href="pdf/generate_quote_attachment.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$j]."&emailid=".$_SESSION["emailid"];?>"><span class="glyphicon glyphicon-envelope"> </span></a>
                                                                    <?php }
                                                                ?>
                                                                <?php
                                                                    if($quote_status=="Finalized"){?>
                                                                        <span class="glyphicon glyphicon-trash"> </span>
                                                                    <?php }else{?>
                                                                        <a href="quote_delete.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$j];?>"><span class="glyphicon glyphicon-trash"> </span></a>
                                                                    <?php }
                                                                ?>
                                                            <?php } ?>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php } ?>
                            
                            
                            
                            
                        </div>
                </div>
        
<!--        FOR MOBILE DEVICES-->
        <div class="container visible-xs visible-sm">
                    <center>
                        <h2>Q - List</h2> </center>
                    
<!--                    QUOTE RECORDS-->
                        <div class="panel-group" id="accordion-mobile">
                            <?php
                                $ref_ids_created_by_users=find_all_ref_ids_from_lgt($_SESSION["username"]); //ARRAY of REF IDs
                                $no_of_ref_ids_created_by_user=count($ref_ids_created_by_users)-1;
                            ?>
                            
                            <?php
                                for($i=0;$i<=$no_of_ref_ids_created_by_user;$i++){
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">

                                        <a data-toggle="collapse" href="#company-mobile-<?php echo $i; ?>" data-parent="#accordion-mobile"><span class="glyphicon glyphicon-plus"> </span></a>
                                         <?php echo "<b>".find_company_name($ref_ids_created_by_users[$i])."</b>";
                                                echo "<span style=\"color:green; font-size:12px;\"> (Ref No. ".$ref_ids_created_by_users[$i].")</span>"; ?>
                                    </h4>
                                </div>
                                <div id="company-mobile-<?php echo $i; ?>" class="panel-collapse collapse">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="container">
                                                <?php 
                                                    $versions=find_all_version_ids($ref_ids_created_by_users[$i]);
                                                    $no_of_versions=count($versions);
                                                    for($j=0;$j<$no_of_versions;$j++){
                                                        $quote_status=find_quote_status_from_lht($ref_ids_created_by_users[$i], $versions[$j]);
                                                        $crt_product_module=find_data_from_crt_for_dashboard($ref_ids_created_by_users[$i], $versions[$j]);
                                                        $lht_list_price=find_list_price_from_lht_for_dashboard($ref_ids_created_by_users[$i], $versions[$j]);
                                                        $lgt_details=find_data_from_lgt_for_dashboard($ref_ids_created_by_users[$i], $versions[$j]);
                                                        //echo $crt_data_dashboard;?>
                                                        <div class="row">
                                                            <div class="col-md-2"><b>Module :</b><?php echo $crt_product_module["product_module"]; ?></div>
                                                            <div class="col-md-2"><b>List Price :</b>
<!--                                                                <span >-->
                                                                    <?php echo currency_format($lht_list_price,$crt_product_module["cust_currency"]); ?>
<!--                                                                </span>-->
                                                            </div>
                                                            <div class="col-md-2"><b>Date :</b>
                                                                <?php echo $lgt_details["license_generation_date"];?>
                                                            </div>
                                                            <div class="col-md-2"><b>Version :</b>
                                                                <?php echo $versions[$j]; ?>
                                                            </div>
                                                            <div class="col-md-2"><b>Status :</b>
                                                                <?php echo $lgt_details["status"];?>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                                                <a href="pdf/view_quote.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$j];?>" target="_blank" ><span class="glyphicon glyphicon-eye-open"> </span></a>
                                                                <?php } ?>
                                                                <a href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_users[$i]."&verid=".$versions[$j];?>" target="_blank" ><span class="glyphicon glyphicon-edit"> </span></a>
                                                                <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                                                <a href="pdf/download_quote.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$j];?>"><span class="glyphicon glyphicon-save-file"> </span></a>
                                                                <?php
                                                                    if($quote_status=="Draft"){?>
                                                                        <span class="glyphicon glyphicon-envelope"> </span>
                                                                    <?php }else{?>
                                                                        <a href="pdf/generate_quote_attachment.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$j]."&emailid=".$_SESSION["emailid"];?>"><span class="glyphicon glyphicon-envelope"> </span></a>
                                                                    <?php }
                                                                ?>
                                                                <?php
                                                                    if($quote_status=="Finalized"){?>
                                                                        <span class="glyphicon glyphicon-trash"> </span>
                                                                    <?php }else{?>
                                                                        <a href="#"><span class="glyphicon glyphicon-trash"> </span></a>
                                                                    <?php }
                                                                ?>
                                                                <?php } ?>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                </div>
<!--        QUOTES WAITING FOR APPROVAL-->
        <?php if($_SESSION["userrole"]=="Administrator" || $_SESSION["userrole"]=="Chief Executive Officer"){ ?>
        <!--        For Large Screens MD & LG Screens-->
            <div class="container hidden-xs hidden-sm">
                <h2>Quotes Awaiting for Approval</h2>
                <div class="panel-group" id="accordion_approval">
                    <?php
                        $ref_ids_created_by_quote_requestor=find_all_ref_ids_from_lgt_and_users(); //ARRAY of REF IDs
                        $no_of_ref_ids_created_by_quote_requestor=count($ref_ids_created_by_quote_requestor)-1;
                    ?>

                    <?php
                        for($i=0;$i<=$no_of_ref_ids_created_by_quote_requestor;$i++){
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">

                                <a data-toggle="collapse" href="#companyName-<?php echo $i; ?>" data-parent="#accordion_approval"><span class="glyphicon glyphicon-plus"> </span></a>
                                 <?php echo "<b>".find_company_name($ref_ids_created_by_quote_requestor[$i])."</b>";
                                        echo "<span style=\"color:green; font-size:12px;\"> (Ref No. ".$ref_ids_created_by_quote_requestor[$i].")</span>"; ?>
                            </h4>
                        </div>
                        <div id="companyName-<?php echo $i; ?>" class="panel-collapse collapse">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="container">
                                        <div class="row">
                                            <b>
                                            <div class="col-sm-2" style="text-align:center;">Module</div>
                                            <div class="col-sm-2" style="text-align:center;">List Price</div>
                                            <div class="col-sm-2" style="text-align:center;">Date</div>
                                            <div class="col-sm-2" style="text-align:center;">Version</div>
                                            <div class="col-sm-2" style="text-align:center;">Status</div>
                                            <div class="col-sm-2"></div>
                                            </b>
                                        </div>
                                        <?php 
                                            $versions_approval=find_all_version_ids($ref_ids_created_by_quote_requestor[$i]);
                                            $no_of_versions_approval=count($versions_approval);
    //                                                    print_r($versions);
                                            for($j=0;$j<$no_of_versions_approval;$j++){
                                                $quote_status=find_quote_status_from_lht($ref_ids_created_by_quote_requestor[$i], $versions_approval[$j]);
                                                $crt_product_module=find_data_from_crt_for_dashboard($ref_ids_created_by_quote_requestor[$i], $versions_approval[$j]);
                                                $lht_list_price=find_list_price_from_lht_for_dashboard($ref_ids_created_by_quote_requestor[$i], $versions_approval[$j]);
                                                $lgt_details=find_data_from_lgt_for_dashboard($ref_ids_created_by_quote_requestor[$i], $versions_approval[$j]);
                                                //echo $crt_data_dashboard;?>
                                                <div class="row">
                                                    <div class="col-sm-2" style="text-align:center;"><?php echo $crt_product_module["product_module"]; ?></div>
                                                    <div class="col-sm-2" style="text-align:right;">
    <!--                                                                <span >-->
                                                            <?php echo currency_format($lht_list_price,$crt_product_module["cust_currency"]); ?>
    <!--                                                                </span>-->
                                                    </div>
                                                    <div class="col-sm-2" style="text-align:center;">
                                                        <?php echo $lgt_details["license_generation_date"];?>
                                                    </div>
                                                    <div class="col-sm-2" style="text-align:center;">
                                                        <?php echo $versions_approval[$j]; ?>
                                                    </div>
                                                    <div class="col-sm-2" style="text-align:center;">
                                                        <?php echo $lgt_details["status"];?>
                                                    </div>
                                                    <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                                        <div class="col-sm-2">
                                                            <a onclick="return confirm('Are you sure to Finalize the Quote !');" href="quote_approve.php?refId=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verId=".$versions_approval[$j];?>"><span class="glyphicon glyphicon-ok"> </span></a>
                                                            <a href="pdf/view_quote.php?refId=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verId=".$versions_approval[$j];?>" target="_blank" ><span class="glyphicon glyphicon-eye-open"> </span></a>
                                                            <?php
                                                                if($quote_status=="Finalized"){?>
                                                                    <a onclick="return confirm('Finalized Quote cannot be edited. New version will be created. Confirm to proceed');" href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verid=".$versions_approval[$j];?>" target="_blank" ><span class="glyphicon glyphicon-edit"> </span></a>
                                                            <?php }else{ ?>
                                                                    <a href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verid=".$versions_approval[$j];?>" target="_blank" ><span class="glyphicon glyphicon-edit"> </span></a>
                                                            <?php } ?>

                                                            <a href="pdf/download_quote.php?refId=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verId=".$versions_approval[$j];?>"><span class="glyphicon glyphicon-save-file"> </span></a>
    <!--                                                                <a><span class="glyphicon glyphicon-envelope"> </span></a>-->
                                                            <?php
                                                                if($quote_status=="Draft"){?>
                                                                    <span class="glyphicon glyphicon-envelope"> </span>
                                                                <?php }else{?>
                                                                    <a href="pdf/generate_quote_attachment.php?refId=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verId=".$versions_approval[$j]."&emailid=".$_SESSION["emailid"];?>"><span class="glyphicon glyphicon-envelope"> </span></a>
                                                                <?php }
                                                            ?>
                                                            <?php
                                                                if($quote_status=="Finalized"){?>
                                                                    <span class="glyphicon glyphicon-trash"> </span>
                                                                <?php }else{?>
                                                                    <a href="quote_delete.php?refId=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verId=".$versions_approval[$j];?>"><span class="glyphicon glyphicon-trash"> </span></a>
                                                                <?php }
                                                            ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        
        <!--        For Small Screens SM & XS Screens-->
            <div class="container hidden-md hidden-lg">
                <h2>Quotes Awaiting for Approval</h2>
                <div class="panel-group" id="accordion_approval_mobile">
                    <?php
                        $ref_ids_created_by_quote_requestor=find_all_ref_ids_from_lgt_and_users(); //ARRAY of REF IDs
                        $no_of_ref_ids_created_by_quote_requestor=count($ref_ids_created_by_quote_requestor)-1;
                    ?>

                    <?php
                        for($i=0;$i<=$no_of_ref_ids_created_by_quote_requestor;$i++){
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">

                                <a data-toggle="collapse" href="#companyNameMobile-<?php echo $i; ?>" data-parent="#accordion_approval_mobile"><span class="glyphicon glyphicon-plus"> </span></a>
                                 <?php echo "<b>".find_company_name($ref_ids_created_by_quote_requestor[$i])."</b>";
                                        echo "<span style=\"color:green; font-size:12px;\"> (Ref No. ".$ref_ids_created_by_quote_requestor[$i].")</span>"; ?>
                            </h4>
                        </div>
                        <div id="companyNameMobile-<?php echo $i; ?>" class="panel-collapse collapse">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="container">
                                        <?php 
                                            $versions_approval=find_all_version_ids($ref_ids_created_by_quote_requestor[$i]);
                                            $no_of_versions_approval=count($versions_approval);
                                            for($j=0;$j<$no_of_versions_approval;$j++){
                                                $quote_status=find_quote_status_from_lht($ref_ids_created_by_quote_requestor[$i], $versions_approval[$j]);
                                                $crt_product_module=find_data_from_crt_for_dashboard($ref_ids_created_by_quote_requestor[$i], $versions_approval[$j]);
                                                $lht_list_price=find_list_price_from_lht_for_dashboard($ref_ids_created_by_quote_requestor[$i], $versions_approval[$j]);
                                                $lgt_details=find_data_from_lgt_for_dashboard($ref_ids_created_by_quote_requestor[$i], $versions_approval[$j]);
                                                //echo $crt_data_dashboard;?>
                                                <div class="row">
                                                    <div class="col-sm-2"><b>Product Module : </b><?php echo $crt_product_module["product_module"]; ?></div>
                                                    <div class="col-sm-2"><b>List Price : </b>
                                                            <?php echo currency_format($lht_list_price,$crt_product_module["cust_currency"]); ?>
                                                    </div>
                                                    <div class="col-sm-2"><b>Date : </b>
                                                        <?php echo $lgt_details["license_generation_date"];?>
                                                    </div>
                                                    <div class="col-sm-2"><b>Version : </b>
                                                        <?php echo $versions_approval[$j]; ?>
                                                    </div>
                                                    <div class="col-sm-2"><b>Status : </b>
                                                        <?php echo $lgt_details["status"];?>
                                                    </div>
                                                    <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                                        <div class="col-sm-2">
                                                            <a onclick="return confirm('Are you sure to Finalize the Quote !');" href="quote_approve.php?refId=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verId=".$versions_approval[$j];?>"><span class="glyphicon glyphicon-ok"> </span></a>
                                                            <a href="pdf/view_quote.php?refId=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verId=".$versions_approval[$j];?>" target="_blank" ><span class="glyphicon glyphicon-eye-open"> </span></a>
                                                            <?php
                                                                if($quote_status=="Finalized"){?>
                                                                    <a onclick="return confirm('Finalized Quote cannot be edited. New version will be created. Confirm to proceed');" href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verid=".$versions_approval[$j];?>" target="_blank" ><span class="glyphicon glyphicon-edit"> </span></a>
                                                            <?php }else{ ?>
                                                                    <a href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verid=".$versions_approval[$j];?>" target="_blank" ><span class="glyphicon glyphicon-edit"> </span></a>
                                                            <?php } ?>

                                                            <a href="pdf/download_quote.php?refId=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verId=".$versions_approval[$j];?>"><span class="glyphicon glyphicon-save-file"> </span></a>
    <!--                                                                <a><span class="glyphicon glyphicon-envelope"> </span></a>-->
                                                            <?php
                                                                if($quote_status=="Draft"){?>
                                                                    <span class="glyphicon glyphicon-envelope"> </span>
                                                                <?php }else{?>
                                                                    <a href="pdf/generate_quote_attachment.php?refId=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verId=".$versions_approval[$j]."&emailid=".$_SESSION["emailid"];?>"><span class="glyphicon glyphicon-envelope"> </span></a>
                                                                <?php }
                                                            ?>
                                                            <?php
                                                                if($quote_status=="Finalized"){?>
                                                                    <span class="glyphicon glyphicon-trash"> </span>
                                                                <?php }else{?>
                                                                    <a href="quote_delete.php?refId=<?php echo $ref_ids_created_by_quote_requestor[$i]."&verId=".$versions_approval[$j];?>"><span class="glyphicon glyphicon-trash"> </span></a>
                                                                <?php }
                                                            ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
                <?php 
            include "../includes/footer.php"; 
        }else {
            header('location:index.php');
        }
        ob_flush()
        ?>
    </body>

    </html>