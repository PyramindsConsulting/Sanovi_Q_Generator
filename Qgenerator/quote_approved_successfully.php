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
                                    $emailaddress=$_GET["emailid"];
                                }
                                //FINDING LOGIN USER NAME OF THE QUOTE CREATER 
                                $quote_creator=find_quote_created_user_for_approval($ref_id, $ver_id);
                                 
                                if($_SESSION["userrole"]!="Quote Requestor"){
                                    //WRITE CODE FOR FINALIZING THE QUOTE
                                    echo "<center><span style=\"color:Green;\"><br><b>Quote Approved Successfully</b></span><br></center>";
                                    echo "<center><span>Quote Ref No : ".$ref_id."</span><br></center>";
                                    echo "<center><span>Quote Ver No : ".$ver_id."</span><br></center>";
                                    echo "<center><span>Email Alert Sent to - ".$emailaddress."</span><br><br></center>";
                                    header("refresh:10;url=dashboard.php"); 
                                    echo '<center>You\'ll be redirected to Dashboard in 10 secs.<br></center>';
                                    echo '<center><a href="dashboard.php?View=QuotesApproval">Click to redirect immediately</a><br></center>';
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