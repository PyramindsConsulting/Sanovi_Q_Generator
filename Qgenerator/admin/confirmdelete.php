<?php 
    session_start(); 
    ob_start();
    //echo $_SESSION["delete_emp_id"];
    $deleted="No";

    //SET ACTIVE PAGE
    $_SESSION["active_page"]="admin";

    //BREADCRUMB DATA
    $root="Admin";
    $root_link="adduser.php";
    $active="Delete User";
    $error_result="";

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
                
                //GET EMP ID FROM MODIFYUSER.PHP
                if(!$_GET){
                    if($_SESSION["delete_emp_id"]==""){
                        header('location:deleteuser.php');
                    }else{
                        $emp_id=$_SESSION["delete_emp_id"];
                    }
                }else{
                    if(!$_GET[emp_id]){
                        echo "<br><center><p style=\"color:RED;\">Invalid Request</p></center>";
                        die();
                    }
                    $emp_id=$_GET[emp_id];
                    $user_data=fetch_user_data($emp_id);
                    if($user_data["emp_name"]==""){
                        echo "<br><center><p style=\"color:RED;\">Invalid Request</p></center>";
                        die();
                    }
                }
                
                $details=fetch_user_data($emp_id);
                
                if(isset($_POST['submit']))
                {
                    $result = delete_user($emp_id);
                    if($result=="User Successfully Deleted"){
                        $deleted="Yes";
                        echo "<br><center><p style='color:GREEN;'>".$result."</p></center>";
                        if(!$_GET){
                            $_SESSION["delete_emp_id"]=="";
                        }else{
                            echo '<center>You\'ll be redirected to User List in 5 secs.</a>.</center>';
                            header( "refresh:5;url=userlist.php" ); 
                        }
                    }else{
//                        echo "<br><center><p style='color:RED;'>".$result."</p></center>";    
                        $error_result=$result;
                    }
                }
        ?>
            <?php if($deleted=="No"){ ?>
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
                                    <form method="post">
                                        <div class="form-group addPersonPanel">
                                            <div class="form-group">
                                                <?php echo "<br><center><p style='color:RED;'>".$error_result."</p></center>"; ?>
                                                <h2>Confirm to Delete</h2>
                                                <br>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label class="control-label">Employee id :</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="empid" class="form-control" value="<?php echo $details['emp_id']; ?>" readonly> </div>
                                                        <div class="col-sm-5"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label class="control-label">Emp Name :</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="emailid" class="form-control" value="<?php echo $details['emp_name']; ?>" readonly> </div>
                                                        <div class="col-sm-5"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label class="control-label">Email id :</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="emailid" class="form-control" value="<?php echo $details['email_id']; ?>" readonly> </div>
                                                        <div class="col-sm-5"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label class="control-label">Login Name :</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name" class="form-control" value="<?php echo $details['login_name']; ?>" readonly> </div>
                                                        <div class="col-sm-5"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label class="control-label">Role :</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="role" class="form-control" value="<?php echo $details['role']; ?>" readonly> </div>
                                                        <div class="col-sm-5"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label class="control-label">Department :</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="dept" class="form-control" value="<?php echo $details['department']; ?>" readonly> </div>
                                                        <div class="col-sm-5"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        
                                                        <div class="col-sm-12">
                                                            <button type="submit" name="submit" class="btn btn-default">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php 
                include "../../includes/footer.php"; 
                }else {
                    header('location:../../index.php');
                }
                ob_flush() 
            ?>
    </body>

    </html>