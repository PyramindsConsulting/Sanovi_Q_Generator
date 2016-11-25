<?php 
    session_start(); 
    ob_start();
    
    //SET ACTIVE PAGE
    $_SESSION["active_page"]="add_user";

    //BREADCRUMB DATA
    $root="Admin";
    $root_link="../admin/userlist.php";
    $active="User Roles";
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
                        <div class="row">
                            <div class="col-sm-12 main_content">
                                <!--DISPLAY SUCCESS MESSAGE-->
                                <?php
                                    $rows=no_of_rows_user_roles();
                                    for($i=1; $i<=$rows; $i++){
                                        if (!empty($_POST["UserDiscountsButton$i"])) {
                                            $result=update_userroles_values($i, $_POST["DiscPercentage$i"], $_POST["MinDiscPercentage$i"]);
                                            echo "<p style=\"color:GREEN;\">".$result."</p>";
//                                            echo "No Errors";
                                        }
                                    }
                                ?>
                                <h2>User Roles and Discounts</h2>
                                
                                <table>
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td>Role</td>
                                            <td>Min Discount Percentage</td>
                                            <td>Max Discount Percentage</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php for($i=1; $i<=$rows; $i++){ ?>
                                        <?php 
                                            $app_id=$i; 
                                            $details=gather_role_discounts_values($app_id);
                                        ?>
                                        <form id="form<?php echo $i; ?>" method="post" onsubmit="return confirm('Are you sure you want to make this change?');">
                                                <tr>
                                                    <td>
                                                        <input value="<?php echo $i; ?>" readonly size="1" style="text-align:center;">
                                                    </td>
                                                    <td>
                                                        <input name="DiscName<?php echo $i; ?>" value="<?php echo $details["UserRole"]; ?>" type="text" readonly="true" onblur="this.readOnly='true';" onchange="document.getElementById('GDB<?php echo $i ?>').removeAttribute('disabled'); document.getElementById('GDB<?php echo $i ?>').style.backgroundColor='#b7fcae'"  size="25" >
                                                    </td>
                                                    <td>
                                                        <input name="MinDiscPercentage<?php echo $i; ?>" value="<?php echo $details["MinDiscount"]; ?>" type="text" readonly="true" onblur="this.readOnly='true';" onchange="document.getElementById('GDB<?php echo $i ?>').removeAttribute('disabled'); document.getElementById('GDB<?php echo $i ?>').style.backgroundColor='#b7fcae'" ondblclick="this.readOnly='';">
                                                    </td>
                                                    <td>
                                                        <input name="DiscPercentage<?php echo $i; ?>" value="<?php echo $details["MaxDiscount"]; ?>" type="text" readonly="true" onblur="this.readOnly='true';" onchange="document.getElementById('GDB<?php echo $i ?>').removeAttribute('disabled'); document.getElementById('GDB<?php echo $i ?>').style.backgroundColor='#b7fcae'" ondblclick="this.readOnly='';">
                                                    </td>
                                                    <td>
                                                        <input id="GDB<?php echo $i; ?>" name="UserDiscountsButton<?php echo $i; ?>" type="submit" value="Save" disabled>
                                                    </td>
                                                </tr>
                                        </form>
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