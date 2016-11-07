<?php 
    session_start(); 
    ob_start();
    
    //SET ACTIVE PAGE
    $_SESSION["active_page"]="add_user";

    //BREADCRUMB DATA
    $root="Admin";
    $root_link="../admin/userlist.php";
    $active="Modify Tables";
?>
    <!doctype html>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/style-admin.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="../js/menu.js"></script>
    </head>

    <body onresize="change_menus()">
        <!--        <p style="color:red;">You are not authorized to visit this page</p>-->
        <?php 
            include "../../includes/config.php";
            include "../../includes/php_functions.php";
            include ("../../includes/php_functions_tables.php");

            change_session_id();
            check_session_expiry();

            if($_SESSION["authentication"] == "passed"){
                $admin_check=authenticate_admin();
                include "../../includes/header_administrator.php";
                include "../../includes/mainmenu-mobile.php";
                include "../../includes/mainmenu.php";
                if($admin_check!="Passed"){
                    echo "<center><br>";
                    echo "<img src=\"../images/Access-Denied.jpg\" width=\"25%\">";
                    echo "<p style=\"color:red;\">You are not authorized to visit this page</p>";
                    echo "</center>";
                    die();
                }
            
        ?>
        <div class="font">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-3 sidemenu_div">
                        <?php include "../../includes/sidemenu.php"; ?>
                    </div>
                    <div class="col-sm-8 col-md-9 breadcrumbs_div">
                        <div id="breadcrumbs_id">
                            <?php 
                            breadcrumb($root, $root_link, $active);
                        ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 main_content">
                                
                                <h2>Modify Tables</h2>
                                
                                <p><b>Select the table to modify</b></p>
                                <p>1) <a href="base_prices_india.php">Base Prices</a></p>
                                <p>2) <a href="exchange_rates.php">Exchange Rates</a></p>
                                <p>3) <a href="general_discounts.php">General Discounts</a></p>
                                <p>4) <a href="learning_factor.php">Learning Factor</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            include "../../includes/footer.php"; 
            }else {
                header('location:../index.php');
            }
            ob_flush() 
        ?>
    </body>

    </html>