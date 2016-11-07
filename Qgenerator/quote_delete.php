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
                        <center>
                            <h2 id="top">Delete Quote</h2>
                            <?php
                                if(!isset($_GET["refId"]) || !isset($_GET["verId"])){
                                    die("Invalid Parameters Passed");
                                }else{
                                    $ref_id=$_GET["refId"];
                                    $ver_id=$_GET["verId"];
                                }
                                //FINDING LOGIN USER NAME OF THE QUOTE CREATER 
                                $quote_creator=find_quote_created_user_to_delete($ref_id, $ver_id);
                                if($_SESSION["userrole"]=="Administrator" || $_SESSION["userrole"]=="Chief Executive Officer" || $_SESSION["userrole"]=="Chief Financial Officer"){
                                
                                }else{
                                    if($_SESSION["username"]!=$quote_creator || $_SESSION["userrole"]=="Quote Requestor"){
                                        echo "<center><br>";
                                        echo "<img src=\"images/Access-Denied.jpg\" width=\"100%\">";
                                        echo "<p style=\"color:red;\">You are not authorized to perform this action</p>";
                                        echo "</center>";
                                        die();

                                    }
                                }
                
                                $quote_validity=is_valid_quote($ref_id, $ver_id); //CHECK THE EXISTANCE OF QUOTE
                                if($quote_validity=="Quote Not Found" || $quote_validity=="Unknown Database Error! Contact Administrator"){
                                    echo $quote_validity;
                                }else{
                                    $quote_status=find_quote_status_to_delete($ref_id, $ver_id);
                                    if($quote_status=="Finalized"){
                                        echo "<span style=\"color:red;\">Cannot Delete Finalized Quote. Contact Administrator</span>";
                                    }else{
                                        echo "<span style=\"color:red;\">Are you sure to delete the quote ?</span><br>";
                                        echo "<table class=\"table table-condensed\">";
                                        echo "<tbody>";
                                        echo "  <tr>";
                                        echo "    <td><b>Reference Id : </b></td>";
                                        echo "    <td>$ref_id</td>";
                                        echo "  </tr>";
                                        echo "  <tr>";
                                        echo "    <td><b>Version Id : </b></td>";
                                        echo "    <td>$ver_id</td>";
                                        echo "  </tr>";
                                        echo "  <tr>";
                                        echo "    <td><b>Generated On : </b></td>";
                                        echo "    <td>".find_quote_created_date($ref_id, $ver_id)."</td>";
                                        echo "    <td></td>";
                                        echo "  </tr>";
                                        echo "</tbody>";
                                        echo "</table>";
//                                            echo "<center>";
                                        echo "<form method=\"post\"><input name=\"submit\" type=\"submit\" class=\"btn btn-danger\" value=\"Delete\"></form>";
//                                            echo "</center>";
                                    }
                                }
                
                                if(isset($_POST["submit"])){
                                    echo "<span style=\"color:green;\">";
                                    echo delete_quote($ref_id, $ver_id);
                                    echo "<span><br>";
                                    header( "refresh:5;url=dashboard.php" ); 
                                    echo '<center>You\'ll be redirected to Dashboard in 5 secs.</a>.</center>';
                                }
                            ?>
                        </center>
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