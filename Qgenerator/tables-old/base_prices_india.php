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
                    <div class="col-sm-4 col-md-3 sidemenu_div">
                        <?php include "../../includes/sidemenu.php"; ?>
                    </div>
                    <div class="col-sm-8 col-md-9 breadcrumbs_div">
                        <div id="breadcrumbs_id">
                            <?php 
                            breadcrumb($root, $root_link, $active);
                        ?>
                        </div>
                        
                        <!--                        INCLUDE BASE PRICE NAV LINKS-->
                        <?php include "base_price_links.html"; ?>
                        
                        <div class="row">
                            <div class="col-sm-12 main_content">
                                <!--DISPLAY SUCCESS MESSAGE-->
                                <?php
                                    $rows=no_of_rows_base_prices("India");
                                    for($i=1; $i<=$rows; $i++){
                                        if (!empty($_POST["BasePricesButton$i"])) {
                                            $result=update_base_price_values($i, "INDIA", $_POST["BasePrice$i"]);
                                            echo "<p style=\"color:GREEN;\">".$result."</p>";
                                        }
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
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php for($i=1; $i<=$rows; $i++){ ?>
                                        <?php 
                                            $app_id=$i; 
                                            $details=gather_base_prices_values($i, "INDIA");
                                            if($details["product_module"]!=""){
                                        ?>
                                            <form id="form<?php echo $i; ?>" method="post" onsubmit="return confirm('Are you sure you want to make this change?');">

                                                <tr>
                                                    <td>
                                                        <input name="PartNo<?php echo $i; ?>" value="<?php echo $details["part_number"]; ?>" type="text" readonly="true" onblur="this.readOnly='true';" onchange="document.getElementById('BPB<?php echo $i ?>').removeAttribute('disabled'); document.getElementById('BPB<?php echo $i ?>').style.backgroundColor='#b7fcae'"  size="27" >
                                                    </td>
                                                    <td>
                                                        <input name="PartDesc<?php echo $i; ?>" value="<?php echo $details["part_desc"]; ?>" type="text" readonly="true" onblur="this.readOnly='true';" onchange="document.getElementById('BPB<?php echo $i ?>').removeAttribute('disabled'); document.getElementById('BPB<?php echo $i ?>').style.backgroundColor='#b7fcae'"  size="55" wrap="true">
                                                    </td>
                                                    <td>
                                                        <input name="Module<?php echo $i; ?>" value="<?php echo $details["product_module"]; ?>" type="text" readonly="true" onblur="this.readOnly='true';" onchange="document.getElementById('BPB<?php echo $i ?>').removeAttribute('disabled'); document.getElementById('BPB<?php echo $i ?>').style.backgroundColor='#b7fcae'" size="25">
                                                    </td>
                                                    <td>
                                                        <input name="BasePrice<?php echo $i; ?>" value="<?php echo $details["base_price"]; ?>" type="text" readonly="true" onblur="this.readOnly='true';" onchange="document.getElementById('BPB<?php echo $i ?>').removeAttribute('disabled'); document.getElementById('BPB<?php echo $i ?>').style.backgroundColor='#b7fcae'" ondblclick="this.readOnly='';" size="5" style="text-align:right;">
                                                    </td>
                                                    <td>
                                                        <input id="BPB<?php echo $i; ?>" name="BasePricesButton<?php echo $i; ?>" type="submit" value="Save" disabled>
                                                    </td>
                                                </tr>
                                            </form>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
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