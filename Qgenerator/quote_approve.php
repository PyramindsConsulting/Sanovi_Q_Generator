<?php 
    session_start(); 
    ob_start();
    $result_code="";
    $error_code="error";

    //SET ACTIVE PAGE
    $_SESSION["active_page"]="list";
?>
    <!doctype html>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style-bg-other-pages.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/menu-q-gen.js"></script>
        <script src="js/app.js"></script>
    </head>

    <body onresize="change_menus()">
        <?php 
            include "../includes/config.php";
            include "../includes/php_functions.php";
            include "../includes/php_function_quote.php";
            include "../includes/php_functions_dashboard.php";
        
            change_session_id();
            check_session_expiry();
        
            if($_SESSION["authentication"] == "passed"){
                include "../includes/header.php";
                include "../includes/mainmenu-mobile.php";
                include "../includes/mainmenu.php";
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                            <?php
                                if(!isset($_GET["refId"]) || !isset($_GET["verId"])){
                                    die("Invalid Parameters Passed");
                                }else{
                                    $ref_id=$_GET["refId"];
                                    $ver_id=$_GET["verId"];
                                    $qgenemailid=$_GET["qgenemailid"];
									$qgename=find_emp_name_from_users_with_email_id($qgenemailid);
                                }
                                //FINDING LOGIN USER NAME OF THE QUOTE CREATER 
                                $quote_creator=find_quote_created_user_for_approval($ref_id, $ver_id);
                                 
                                if($_SESSION["userrole"]!="Quote Requestor"){
                                    if($_SESSION["userrole"]!="Sales Manager"){
                                        $quote_validity=is_valid_quote($ref_id, $ver_id); //CHECK THE EXISTANCE OF QUOTE
                                        if($quote_validity=="Quote Not Found" || $quote_validity=="Unknown Database Error! Contact Administrator"){
                                            echo "<center><p style=\"color:red;\"><br>$quote_validity</p></center>";
                                        }else{
                                            $quote_status=find_quote_status_to_delete($ref_id, $ver_id); //USING SAME FUNCTION USED TO DELETE QUOTE
                                            if($quote_status=="Finalized"){
                                                echo "<center><p style=\"color:red;\"><br>Quote is already Finalized</p></center>";
                                                //REDIRECT TO DASHBOARD
                                                header( "refresh:5;url=dashboard.php" );
                                                echo '<center>You\'ll be redirected to Dashboard in 5 secs.</center>';
                                                echo '<center><a href="dashboard.php">Click to redirect immediately</a><br></center>';
                                            }else{
                                                //WRITE CODE FOR FINALIZING THE QUOTE
                                                if(finalize_quote_generated_by_QR($ref_id, $ver_id)=="Successful"){
                                                    echo "<center><span style=\"color:Green;\">Quote Approved Successfully</span></center>";
                                                    header('location:pdf/mail_alert_for_approval_confirmation.php?refId='.$ref_id.'&verId='.$ver_id.'&qgenemailid='.$qgenemailid.'&qgename='.$qgename);
    //                                                header( "refresh:5;url=dashboard.php" ); 
    //                                                echo '<center>You\'ll be redirected to Dashboard in 5 secs.<br></center>';
    //                                                echo '<center><a href="dashboard.php">Click to redirect immediately</a><br></center>';
                                                }else{
                                                    echo "<center><span style=\"color:red;\">Unknown Error Occured! Please contact Administrator</span></center>";
                                                }
                                            }
                                        }
                                    }
                                }
                                else{
                                    echo "<center><br>";
                                    echo "<img src=\"images/Access-Denied.jpg\" width=\"100%\">";
                                    echo "<p style=\"color:red;\">You are not authorized to visit this page</p>";
                                    echo "</center>";
                                    die();
                                }
                            ?>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        <?php  
            include "../includes/footer.php"; 
        }else{
            header('location:index.php');
            ob_flush();
        }
        ?>
    </body>
</html>