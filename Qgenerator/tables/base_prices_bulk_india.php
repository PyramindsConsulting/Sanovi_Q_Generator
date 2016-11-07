<?php 
    session_start(); 
    ob_start();
    
    //SET ACTIVE PAGE
    $_SESSION["active_page"]="add_user";

    //BREADCRUMB DATA
    $root="Admin";
    $root_link="../admin/userlist.php";
    $active="Base Prices";
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
<!--
                    <div class="col-sm-4 col-md-3 sidemenu_div">
                        <?php //include "../../includes/sidemenu.php"; ?>
                    </div>
-->
<!--                    <div class="col-sm-12 breadcrumbs_div">-->
                        <div id="breadcrumbs_id">
                            <?php 
                            breadcrumb($root, $root_link, $active);
                        ?>
                        </div>
                        
                        <!--                        INCLUDE BASE PRICE NAV LINKS-->
                        <?php include "base_price_bulk_links.html"; ?>
                        
                        <div class="row">
                            <div class="col-sm-12 main_content">
                                <!--DISPLAY SUCCESS MESSAGE-->
                                <?php
                                    $rows=no_of_rows_base_prices("India");
                                    if(isset($_POST['BasePricesButton'])){
                                        for($i=1; $i<=$rows; $i++){
                                            $result=update_base_price_values($i, "INDIA", $_POST["BasePrice$i"]);
                                            if($result!="Update Successfull"){
                                                die("Unable to Update");
                                            }
                                        }
                                        echo "<p style=\"color:GREEN;\">".$result."</p>";
                                    }
                                ?>
                                <h2>Base Prices Table (India)</h2>
                                
                                <table style="font-size:12px;">
                                    <thead>
                                        <tr>
                                            <td>Part No</td>
                                            <td>Part Description</td>
                                            <td>Module</td>
                                            <td>Base Price</td>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form method="post" onsubmit="return confirm('Are you sure you want to make this change?');">
                                            <?php
                                                for($i=1; $i<=$rows; $i++){
                                                $details=gather_base_prices_values($i, "INDIA");
                                                if($details["product_module"]!=""){
                                            ?>
                                            <tr>
                                                <td>
                                                    <input name="PartNo<?php echo $i; ?>" value="<?php echo $details["part_number"]; ?>" type="text" readonly="true" size="30" >
                                                </td>
                                                <td>
                                                    <input name="PartDesc<?php echo $i; ?>" value="<?php echo $details["part_desc"]; ?>" type="text" readonly="true" size="115">
                                                </td>
                                                <td>
                                                    <input name="Module<?php echo $i; ?>" value="<?php echo $details["product_module"]; ?>" type="text" readonly="true" size="20">
                                                </td>
                                                <td>
                                                    <input name="BasePrice<?php echo $i; ?>" value="<?php echo $details["base_price"]; ?>" type="text" size="5" style="text-align:right;">
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                        
                                        <tr>
                                            <td>
                                                <input name="BasePricesButton" type="submit" value="Save">
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!--                    </div>-->
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