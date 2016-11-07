<?php 
    session_start(); 
    ob_start();

    $result_code="";
    $error_code="error";

    //SET ACTIVE PAGE
    $_SESSION["active_page"]="q_generator";
    
    //BREADCRUMB DATA
    $root="Q-Generator";
    $root_link="q_generator.php";
    $active="";

    //finalize update variables
    
    //license
    $discountlicense=$_POST['Discount_license'];
    $discount_license_value=$_POST['Discount_license_value'];
    $final_license_value=$_POST['Discount_license_final_value'];
    $discount_3s=$_POST['discount_3s'];
    $finalDiscountValue=$final_license_value-$discount_3s;

    
    //product_support
    $product_support_discount=$_POST['Discount_product_support'];
    $product_support_discount_value=$_POST['Discount_product_support_value'];
    $product_support_value_after_discount=$_POST['Final_product_support_value'];
    
    //professional_services
    $professional_service_discount=$_POST['Discount_prof_serv'];
    $professional_service_discount_value=$_POST['Discount_value_ps'];
    $professional_service_value_after_discount=$_POST['Final_professional_value'];
    
    //product_training
    $product_training_discount=$_POST['Discount_product_training'];
    $product_training_discount_value=$_POST['Product_training_discount_value'];
    $product_training_value_after_discount=$_POST['Final_product_training_cost'];
    
    //final values
    $final_discount_value=$_POST['Final_discount_cost'];    
    $final_value_after_discount=$_POST['Final_cost_with_discount'];
    
    //EMAIL VALIDATIONS
    $emailError = "";
    $error="YES";
    if(isset($_POST['submit'])){
        if (empty($_POST["email"])) {
            $emailError = "Email is mandatory";
            $error.="email";
        }else {    
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid email format";
                $error.="InvalidEmail";
                $email=$_POST["email"];
            }else{
                $email=$_POST["email"];
                $error="";
                $refid=$_SESSION['ref_id'];
                header('location:pdf/generate_quote_attachment.php?refId='.$refid.'&verId=1&emailid='.$email);
            }
        }
    }
?>  

    <!doctype html>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/breadcrumbs.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/finalcrumb.js"></script>

    </head>

    <body onresize="change_menus()">
        <?php 
            include "../includes/php_functions.php";
            include "../includes/php_functions_q_gen.php";
            if($_SESSION["authentication"] == "passed"){
                include "../includes/header_administrator.php";
                include "../includes/mainmenu-mobile.php";
                include "../includes/mainmenu.php";
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <?php
                            finalize($_SESSION['ref_id'],$_POST['Annexure_1']);
//                updateDiscountValues($_SESSION['ref_id'],$discountlicense,$discount_license_value,$final_license_value,$discount_3s,$product_support_discount,$product_support_discount_value,$product_support_value_after_discount,$professional_service_discount,$professional_service_discount_value,$professional_service_value_after_discount,$product_training_discount,$product_training_discount_value,$product_training_value_after_discount,$final_discount_value,$final_value_after_discount);
                        ?><center>
                        <div id="crumbs" style="width:100%;margin-top:2%">
                        <ul>
                            <li><a href="#" id="quote_request" class="active">Quote Request</a></li>
                            <li><a href="#" id="config_review">Config Review</a></li>
                            <li><a href="#" id="review_and_discount">Review and Discounts</a></li>
                            <li><a href="#" id="quote_finalize">Quote Finalize</a></li>
                        </ul>
                    </div>
                        <h3 style="color:green;"><b>QUOTE FINALIZED<br> S U C C E S S F U L L Y</b></h3>
                        <div>Quote Ref.No : <?php echo $_SESSION['ref_id'];?></div>
                        <div>Quote Ver.No : <?php echo "1";?></div>
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <form method="post" action="finalize_email.php">
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email Id to Email Quote" value="<?php if (!empty($_POST["email"])) {echo $_POST["email"];} ?>">
                                        <span class="input-group-btn">
                                            <input  class="btn btn-success" type="submit" name="submit" value="Send">
<!--                                            <button  class="btn btn-success" type="button">send</button>-->
                                        </span>
                                    </div>
                                    <span style="color:red;"><?php echo $emailError; ?></span>
                                </form>
                                    <span style="font-size:11px;">Note:You can go back to List View &amp; And resend email again if needed</span>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <center>
                                    <p><a href="http://quotedev.sanovi.com/pdf/new_quote.php"><button type="button" class="btn btn-primary">Preview Quote</button></a>
                                    <a href="http://quotedev.sanovi.com/pdf/download_quote.php?refId=<?php echo $_SESSION['ref_id'];?>&verId=1"><button type="button" class="btn btn-success">Download Quote</button></a></p>
                                </center>
                            </div>
                        </div>
                        </center>
                    </div>
                </div>
            </div>
            <?php 
                }else {
                    header('location:index.php');
                }
                ob_flush() 
            ?>
    </body>

    </html>