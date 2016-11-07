<?php
    include('../includes/php_functions.php');
    session_start();
    ob_start();
    $_SESSION["authentication"]="failed";
    $error_code="";

    //VALIDATING THE FORM & USER AUTHENTICATION
    if(empty($_POST)===false){ 
      if(empty($_POST["userid"])){ 
          $error_code="Enter User Name";
      }else{
          $error_code="";
//          $ResetPasswordResult = ResetPassword($_POST["userid"]);
//          if($ResetPasswordResult == "Invalid Username"){
//              $error_code="Invalid Username";
//          }
          
          switch (ResetPassword($_POST["userid"])) {
            case "Invalid Username":
                $error_code="Invalid Username";
            break;
            case "Username is blocked. Please contace Administrator":
                $error_code="Username is blocked.<br> Please contace Administrator";
            break;
            case "Password reset link is sent to your registered email id":
                $error_code="Password reset link is sent to your registered email id";
            break;
          }
      }
    }
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.ico" />
    <title>Login Page - Sanovi Q-Generator</title>
    <?php 
      include '../includes/bootstrap-and-styles.php';
    ?>
        <!-- LINKING STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="css/login-style.css" />
        <!--  <script src="js/javascript.js"></script>-->
</head>

<body>
    <div class="login-page">
        <p style="text-align:center;"><img src="images/Sanovi-Logo.png"></p>
        <div class="form">
            <p style="text-align:center;">Please enter your user id to reset password</p>
            <form class="login-form" method="post">
                <input placeholder="username" name="userid" id="userid" />
                <button>reset password</button> <span id="error_code"><?php echo $error_code ?></span> </form>
        </div>
        <a href="index.php"><p style="text-align:center;">Return to Sanovi Q-Generator</p></a>
    </div>
</body>
<?php ob_end_flush(); ?>

</html>