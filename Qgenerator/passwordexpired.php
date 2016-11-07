<?php 
    session_start(); 
    ob_start();
?>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/app.js"></script>
        <!--    <script src="js/app2.js"></script>-->
    </head>

    <body>
        <?php
            $emp_id=$_SESSION["pass_expired_emp_id"];
            //$_SESSION["pass_expired_emp_id"]="";
            
            $expired_password=$_SESSION["expired_password"];
            //$_SESSION["expired_password"]="";
        
            include "../includes/header-plain.php";
            include "../includes/php_functions.php";

            $PasswordError="";
            $OldPasswordError="";
            $ConfirmPasswordError="";
            $errorcode="";
            $result_note="";
            $reset_done="no";
            $error="yes";
            
            $password=$confirmpassword=$oldpassword="";
        
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['submit'])){
                    if (empty($_POST["oldpassword"])) {
                        $OldPasswordError = "Old Password is mandatory";
                        $error.="oldPass";
                    }else{
                        $oldpassword=$_POST["oldpassword"];
                    }
                    if (empty($_POST["password"])) {
                        $PasswordError = "Password is mandatory";
                        //$result_note="error";
                        //echo "im in password";
                        $error.="password";
                    }else{
                        $password=$_POST["password"];
                    }
                    if (empty($_POST["confirmpassword"])) {
                        $ConfirmPasswordError = "Confirm Password is mandatory";
                        $error.="confirmPass";
                    }else{
                        $ConfirmPasswordError ="";
                        $confirmpassword=$_POST["confirmpassword"];
                    }
                    
                    if(md5($_POST["oldpassword"])===$expired_password){
                        if (empty($_POST["password"]) || empty($_POST["confirmpassword"])) {
                        $error="yes";
                    }else if(($_POST["password"] != $_POST["confirmpassword"])){
                        $errorcode="Confirm Password didnot match";
                        $error="yes";
                    }else{
                        $error="";
                        $PasswordError = "";
                        $ConfirmPasswordError = "";
                    }

                    }else{
                        $OldPasswordError="Old Password didnot match";
                        $error.="OldPasswordMatchFailed";
                    }

                    if($error==""){
                        $result_note=ChangeExpiredPassword($emp_id, $password);
                        //$result_note=ChangePassword_byUser($key, $_POST["password"]);
                        //echo $result_note;
                        //echo ("No Errors");
                    }
                }
            }
        ?>
            <?php if($error!=""){ ?>
                <form method="post">
                    <div class="container">
                        <div class="form-group addPersonPanel">
                            <div class="form-group">
                                <div class="panel-heading">
                                    <h2>Password Expired</h2>
                                </div>
                                <br>
                                <div class="container">
<!--                                    <div class="col-sm-3"></div>-->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label">Old Password :</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="password" name="oldpassword" class="form-control" value="<?php echo $oldpassword; ?>"> <span style='color:red;font-size:15px' class="error"><?php echo $OldPasswordError;?></span>
                                                </div>
                                                <div class="col-sm-2"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label">New Password :</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"> <span style='color:red;font-size:15px' class="error"><?php echo $PasswordError;?></span>
                                                    </div>
                                                    <div class="col-sm-2"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label">Confirm Password :</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="password" name="confirmpassword" class="form-control" value="<?php echo $confirmpassword; ?>"> <span style='color:red;font-size:15px' class="error"><?php echo $ConfirmPasswordError;?></span> <span style='color:red;font-size:15px' class="error"><?php echo $errorcode;?></span>
                                                </div>
                                                <div class="col-sm-2"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button type="submit" name="submit" class="btn btn-default">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php 
            }else{
                echo "<center><p style=\"color:Green;\">".$result_note."</p><p>Login Again</p></center>";
                session_unset();
                session_destroy();
                header( "refresh:5;url=logout.php" ); 
                echo '<center>You\'ll be redirected to Login Page in 10 secs.</a>.</center>';
        }?>
                    <?php 
            include "../includes/footer.php";
            ob_flush();
        ?>
    </body>

    </html>