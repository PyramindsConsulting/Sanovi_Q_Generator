    <?php 
    session_start(); 
    ob_start();

    $result_code="";
    $error_code="error";

    //SET ACTIVE PAGE
    $_SESSION["active_page"]="q_generator";
    
    //BREADCRUMB DATA
    $root="Q-Generator";
    $root_link="q_generator.php";
    $active="";
    
?>  

    <!doctype html>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/breadcrumbs.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/finalcrumb.js"></script>

    </head>

    <body onresize="change_menus()">
        <?php 
            include "../includes/php_functions.php";
            include "../includes/php_functions_q_gen.php";
            if($_SESSION["authentication"] == "passed"){
                include "../includes/header_administrator.php";
                include "../includes/mainmenu-mobile.php";
                include "../includes/mainmenu.php";
                if(!$_GET){
                    echo "<center><span style='color:RED;'>Access Denied</span></center>";
                }else if($_SESSION["mail_alert"]=="Yes"){
                    $refId=$_GET["refId"];
                    $verId=$_GET["verId"];
                    $emailid=$_GET["emailid"];
                    $approver_name=$_GET["appname"];
                }else {
                    echo "<center><span style='color:RED;'>Access Denied</span></center>";
                }
        ?>
        <center>
            <h3 style="color:green;"><b>QUOTE SAVED<br> S U C C E S S F U L L Y</b></h3>
            <div>Quote Ref.No : <?php echo $refId;?></div>
            <div>Quote Ver.No : <?php echo $verId;?></div>
            <div class="row">
                <div class="col-sm-12">
<!--
                    <h4 style="color:green;">We have sent Quote Approval request to <?php //echo $emailid; ?></h4>
                    <h5>Please check your email</h5>
-->
                    <h4 style="color:green;">Quote Sent to <?php echo $approver_name; ?> for Approval<br>Contact <?php echo $emailid; ?> for more details </h4>
                    <h5>Please check your email</h5>
                    <?php 
                        $_SESSION["mail_alert"]="No";
                        header('refresh:10;url=dashboard.php');
                        echo "Redirecting to Dashboard in 10sec";
                    ?>
                </div>
            </div>
        </center>
        <?php 
            }else {
                header('location:index.php');
            }
            ob_flush() 
        ?>
    </body>

    </html>