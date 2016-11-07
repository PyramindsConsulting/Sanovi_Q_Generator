<?php 
    session_start(); 
    ob_start();
    $result_code="";
    $error_code="error";
    
    //SET ACTIVE PAGE
    $_SESSION["active_page"]="reset_password";    

    //BREADCRUMB DATA
    $root="Admin";
    $root_link="adduser.php";
    $active="Reset Password";
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
        <script src="../js/admin.js"></script>
    </head>

    <body onresize="change_menus()">
        <?php 
        include "../../includes/config.php";
        include "../../includes/php_functions.php";
        
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
            
            //GET EMP ID FROM RESETPASSWORD.PHP
            if(!$_GET){
                if($_SESSION["reset_user_password"]==""){
                    header('location:resetpassword.php');
                }else{
                    $emp_id=$_SESSION["reset_user_password"];
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
            //print_r ($details);
            $passwordError="";
            $confirmpasswordError="";
            $error="";
            
            $password=$confirm_password="";
            
            $emp_name=$details["emp_name"];
            $email=$details["email_id"];
            $login_name=$details["login_name"];
            $role=$details["role"];
            $department=$details["department"];
            $status=$details["status"];
            
            if(isset($_POST['submit'])){
                if (empty($_POST["password"])) {
                    $passwordError = "Password is mandatory";
                    $error.="Password";
                }else{
                    if(strlen($_POST["password"])<8){
                        $passwordError = "Password Policy : Min 8 Characters";
                        $error.="Password";
                    }
                    $password=$_POST["password"];
                }
                if (empty($_POST["confirm_password"])) {
                    $confirmpasswordError = "Confirm Password is mandatory";
                    $error.="ConfirmPassword";
                }else{
                    $confirm_password=$_POST["confirm_password"];
                }
                if($error==""){
                    if($confirm_password===$password){
                        $result_code=reset_user_password($emp_id, $_POST["password"]);
                        if($result_code=="Password Reset Successfully"){
                            //echo $result_code;
                            $error_code="";
                        }else{
                            $error_code="error";
                        }
                    }else{
                        $error.="PasswordNotMatch";
                        $confirmpasswordError = "Passwords did not match";
                    }
                }
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
                                    <?php if($error_code=="error"){ ?>
                                    <h2>Reset User Password</h2>
                                        <form method="post" action="">
                                            <br>
                                            <center>
                                                <?php echo "<p  style='color:red;'>".$result_code."</p>"; ?>
                                            </center>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Employee Name * :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input id="modify_user_emp_name" type="text" name="emp_name" class="form-control" value="<?php echo $emp_name; ?>" readonly></div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">User Name *:</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input id="modify_user_user_name" type="text" name="loginname" class="form-control" value="<?php echo $login_name; ?>" readonly></div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Status :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select id='modify_user_status' class='form-control' name='status' disabled>
                                                            <option value='0' <?php if($status==0){echo "selected";} ?>>Active</option>
                                                            <option value='1' <?php if($status==1){echo "selected";} ?>>Disabled</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">New Password :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"><span style='color:red;font-size:15px' class="error"><?php echo $passwordError;?></span> 
                                                    </div>
                                                    <div class="col-sm-5">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Confirm Password :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>"> 
                                                        <span style='color:red;font-size:15px' class="error"><?php echo $confirmpasswordError;?></span> 
                                                    </div>
                                                    <div class="col-sm-5"> </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button id="modify_user_submit_btn" type="submit" name="submit" class="btn btn-default">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                            }else{
                                                echo "<br><center><p  style='color:green;'>".$result_code."</p></center>";
                                                if(!$_GET){
                                                    $_SESSION["reset_user_password"]=="";
                                                }else{
                                                    echo '<center>You\'ll be redirected to User List in 5 secs.</a>.</center>';
                                                    header( "refresh:5;url=userlist.php" ); 
                                                }
                                            }
                                        ?>
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