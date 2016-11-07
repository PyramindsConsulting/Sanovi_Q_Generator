<?php
    include('../includes/php_functions.php');
    session_start();
    ob_start();
    $_SESSION['LAST_ACTIVITY']=time();
    $_SESSION["authentication"]="failed";
    $error_code="";

    //VALIDATING THE FORM & USER AUTHENTICATION
    if(empty($_POST)===false){ 
      if(empty($_POST["userid"]) || empty($_POST["password"])){ 
          $error_code="Enter User Id and Password to Login";
          $_SESSION["authentication"]="failed";
      }else{
          $error_code="";
          if(authenticate_user($_POST['userid'], $_POST['password'])){
              $loginstatus=$_SESSION["loginstatus"];
            //echo $loginstatus;
              if($loginstatus==0){
                  $_SESSION["authentication"]="passed";
                  header('Location: dashboard.php');
              }else{
                  $error_code="User id is Blocked. Contact Admin";
                  $_SESSION["authentication"]="failed";
                  echo $loginstatus;
              }
          }else{
              $loginstatus=$_SESSION["loginstatus"];
              if($loginstatus==0){
                  $error_code="Authentication Failed";
                  $_SESSION["authentication"]="failed";
              }else{
                  $error_code="User id is Blocked. Contact Admin";
                  $_SESSION["authentication"]="failed";
              }
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
<style>
    body{
        background-image: url(images/index_bg.jpg);
        background-repeat: no-repeat;
        background-position:center;
        background-size: cover;
        background-attachment: fixed;
        
    }
</style>
<body>
    <div class="login-page">
        <p style="text-align:center;"><img src="images/Sanovi-Logo.png"></p>
        <div class="form">
            <h4 style="text-align:left; margin-top:0px;"><b>Q-Generator</b></h4>
            <form class="login-form" method="post">
                <p style="text-align:left;">User Name</p>
                <input placeholder="Enter User Name" name="userid" id="userid" />
                <p style="text-align:left;">Password</p>
                <input type="password" name="password" id="password" placeholder="Enter Password" />
                <button>login</button> <span id="error_code"><?php echo $error_code ?></span> </form>
        </div>
        <a href="forget_password.php"><p style="text-align:center;">Forget password?</p></a>
    </div>
</body>
<?php ob_end_flush(); ?>

</html>