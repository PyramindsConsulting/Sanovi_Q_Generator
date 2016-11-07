<?php 
    session_start(); 
    ob_start();

    //SET ACTIVE PAGE
    $_SESSION["active_page"]="profile";

    include "../includes/config.php";
    include "../includes/php_functions.php";

    change_session_id();
    check_session_expiry();

    //BREADCRUMB DATA
    $root="Profile";
    $root_link="myprofile.php";
    $active="Change Password";

    $PasswordError=""; 
    $ConfirmPasswordError="";
    $oldPasswordError="";
    $oldpassword="";
    $errorcode="";
    $final_error="";
    $result_note=""; 
    $reset_done="no"; 
    $error="yes"; 
    $password=$confirmpassword="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit'])){
            if (empty($_POST["oldpassword"])) {
                $oldPasswordError = "Old Password is mandatory"; 
                $error.="oldpassword"; 
                $final_error.="oldpassword";
            }else{
                if(check_old_password($_SESSION["emp_id"], $_POST["oldpassword"])){
                    $password=$_POST["password"];
                    $oldpassword_error_flat="passed";
                }else{
                    $oldPasswordError = "Old Password is did not match";
                    $error.="oldpassword"; 
                    $final_error.="oldpassword";
                    $password=$_POST["password"];
                }
            }
            
            if (empty($_POST["password"])) {
                $PasswordError = "Password is mandatory"; 
                $error.="password"; 
            }else{
                if(strlen($_POST["password"])<8){
                            $PasswordError = "Password Policy : Min 8 Characters";
                            $error.="Password";
                            $final_error.="password";
                    }
                $password=$_POST["password"]; 
            }
            
            if (empty($_POST["confirmpassword"])) {
                $ConfirmPasswordError = "Confirm Password is mandatory";
                $error.="confirmpassword"; 
                $final_error.="confirmpassword";
            }else{ 
                $confirmpassword=$_POST["confirmpassword"]; 
            } 
            
            if (!empty($_POST["password"]) && !empty($_POST["confirmpassword"])) {
                if($_POST["confirmpassword"] === $_POST["password"]){
                    
                }else{
                    $errorcode="Confirm Password did not match";
                    $error.="confirmpassword";
                    $final_error.="confirmpassword";
                }
            } 

            if($final_error==""){
                ChangeProfilePassword($_SESSION["emp_id"], $_POST["password"]);
                $error="";
            }
        } 
    }
?>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style-bg-other-pages.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/menu.js"></script>
    </head>

    <body onresize="change_menus()">
        <?php 
            if($_SESSION["authentication"] == "passed"){
                include "../includes/header.php";
                include "../includes/mainmenu-mobile.php";
                include "../includes/mainmenu.php";
        ?>
        
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-3 sidemenu_div">
                        <?php include "../includes/sidemenu.php"; ?>
                    </div>
                    <div class="col-sm-8 col-md-9 breadcrumbs_div">
                        <div id="breadcrumbs_id">
                            <?php 
                            breadcrumb($root, $root_link, $active);
                        ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 main_content">
                                <?php if($error!=""){ ?>
                                <form method="post">
                                    <h2>Change Profile Password</h2>
                                    <br>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label">Old Password :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="password" name="oldpassword" class="form-control" value="<?php if(isset($_POST['oldpassword'])){echo $_POST['oldpassword'];}else{ echo $oldpassword;} ?>"> <span style='color:red;font-size:15px' class="error"><?php echo $oldPasswordError;?></span> </div>
                                                <div class="col-sm-5"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label">New Password :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"> <span style='color:red;font-size:15px' class="error"><?php echo $PasswordError;?></span> </div>
                                                <div class="col-sm-5"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label">Confirm Password :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="password" name="confirmpassword" class="form-control" value="<?php echo $confirmpassword; ?>"> <span style='color:red;font-size:15px' class="error"><?php echo $ConfirmPasswordError;?></span> <span style='color:red;font-size:15px' class="error"><?php echo $errorcode;?></span> </div>
                                                <div class="col-sm-5"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button type="submit" name="submit" class="btn btn-default">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3"></div>
                                </form>
                                <?php 
                                    }else{
                                        echo "<center><p style=\"color:Green\">Password Changed Successfully</p></center>";
                                        header( "refresh:5;url=logout.php" ); 
                                        echo '<center>You\'ll be redirected to Login Page in 10 secs.</a>.</center>';
                                        session_unset();
                                        session_destroy();
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                include "../includes/footer.php";
                ob_flush(); }
            ?>
    </body>

    </html>