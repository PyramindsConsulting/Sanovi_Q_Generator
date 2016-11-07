<?php 
//    session_start(); 
//    ob_start();
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
        <script src="js/app.js"></script>
        <!--    <script src="js/app2.js"></script>-->
    </head>

    <body>
        <?php
            
            include "../includes/header-plain.php";
            include "../includes/php_functions.php";

            $PasswordError="";
            $ConfirmPasswordError="";
            $errorcode="";
            $result_note="";
            $reset_done="no";
            $error="yes";
            $key=$_GET["key"];
            $password=$confirmpassword="";
            $Field1error="yes";
            $Field2error="yes";
        
            if(check_password_resetkey($key)=="Invalid"){
                echo "<center>Password Reset Link Expired</center>";
                die("");
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['submit'])){
                    if (empty($_POST["password"])) {
                        $PasswordError = "Password is mandatory";
                        $error.="password";
                    }else{
                        if(strlen($_POST["password"])<8){
                            $PasswordError = "Password Policy : Min 8 Characters";
                            $error.="passwordstrength";
                            $password=$_POST["password"];
                        }else{
                            $password=$_POST["password"];
                            $Field1error="";
                        }
                        $password=$_POST["password"];
                        
                    }
                
                
                    if (empty($_POST["confirmpassword"])) {
                        $ConfirmPasswordError = "Confirm Password is mandatory";
                        //$result_note="error";
                        $error.="confirmpassword";
                    }else{
                        if(($_POST["password"] != $_POST["confirmpassword"])){
                            $ConfirmPasswordError="Confirm Password didnot match";
                            $error.="password Not Match";
                        }else{
                        $confirmpassword=$_POST["confirmpassword"];
                        $Field2error="";
                        }
                        $confirmpassword=$_POST["confirmpassword"];
                    }
                    

                    if($Field1error=="" && $Field2error==""){
                        $error="";
                    }else{
                        $error="yes";
                    }
                    if($error==""){
                        ChangePassword_byUser($key, $_POST["password"]);
                    }
                }
            }
            
        ?>
        <?php if($error!=""){ ?>
        <form method="post">
            <div class="container">
                <div class="form-group addPersonPanel">
                    <div class="form-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <p>Reset Password</p>
                            </div>
                            <br>
                            <div class="container">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <label class="control-label">New Password :</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                                                <span style='color:red;font-size:15px' class="error"><?php echo $PasswordError;?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <label class="control-label">Confirm Password :</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="confirmpassword" class="form-control" value="<?php echo $confirmpassword; ?>"> 
                                                <span style='color:red;font-size:15px' class="error"><?php echo $ConfirmPasswordError;?></span>
                                                <span style='color:red;font-size:15px' class="error"><?php echo $errorcode;?></span>
                                            </div>
                                        </div>
                                    </div>     
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4 col-sm-offset-6">
                                                <button type="submit" name="submit" class="btn btn-default">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php 
            }else{
                echo "<center>Password Reset Done</center>";
        }?>
        <?php 
            include "../includes/footer.php";
//            ob_flush();
        ?>
    </body>

    </html>