<?php 
    session_start(); 
    ob_start();

    $result_code="";
    $error_code="error";

    //SET ACTIVE PAGE
    $_SESSION["active_page"]="delete_user";

    //BREADCRUMB DATA
    $root="Admin";
    $root_link="adduser.php";
    $active="Delete User";

    include "../../includes/config.php";
    include "../../includes/php_functions.php";

    change_session_id();
    check_session_expiry();
?>
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
            $Emp_id_Error="";
            $Redirect="No";
            $userstatus="";
            if(isset($_POST['submit'])){
                if (empty($_POST["emp_id"])) {
                    $Emp_id_Error = "Please enter Emp ID";
                    $Redirect=="No";
                }else{
                    $Emp_id_Error="";
                    $userstatus=check_user($_POST["emp_id"]);
                    if($userstatus=="Account exist"){
                        $Redirect="Yes";
                    }else{
                        $Redirect=="No";
                        $Emp_id_Error = "Emp ID doesnot exist";
                    }
                }

                if($Redirect=="Yes"){
                    $_SESSION["delete_emp_id"]=$_POST["emp_id"];
                    header('location:confirmdelete.php');    
                }

            } 
        
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
                                <form method="POST">
                                    <h2>Delete User</h2>
                                    <br>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="control-label">Enter Emp ID *:</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="emp_id" class="form-control"> <span style='color:red;font-size:15px' class="error"><?php echo $Emp_id_Error;?></span> </div>
                                            <div class="col-sm-5"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit" name="submit" class="btn btn-default">Fetch Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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