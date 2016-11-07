<?php 
    session_start();
    ob_start();

    //SET ACTIVE PAGE
    $_SESSION["active_page"]="list";
?>
    <!doctype html>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style-bg-other-pages.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/menu.js"></script>
        <script src="js/dashboard.js"></script>
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip(); 
            });
        </script>
    </head>

    <body onresize="change_menus()">
        <?php 
            include "../includes/config.php";
            include "../includes/php_functions.php";
        
            change_session_id();
            check_session_expiry();
        ?>
            <?php
            if($_SESSION["authentication"] == "passed"){ 
                include "../includes/header-dashboard.php";
                include "../includes/mainmenu-mobile.php";
                include "../includes/mainmenu.php";
                include "../includes/php_functions_dashboard.php";
                include "../includes/php_function_quote.php";
        ?>
        <div class="container">
            <!-- CAPTURING GET VALUES-->
            <?php
                $MyQuotes=$RecentQuotes=$AllQuotes=$QuotesApproval="";
                if(!$_GET) {
                    echo "<br><center><p style=\"color:RED;\">Invalid Request</p></center>";
                    die();
                }else{
                    if(!$_GET["refId"] || !$_GET["verId"]){   
                        echo "<br><center><p style=\"color:RED;\">Invalid Request</p></center>";
                        die();
                    }else{
                        $refId=$_GET["refId"];
                        $verId=$_GET["verId"];
                    }
                }
            ?>
            <!-- VIEW SELECTOR DROPDOWN-->
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-12">
                        <br>
                        <div class="pull-right">
                            <a href="dashboard.php"><button type="button" class="btn btn-default">Back to Quote List</button></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <h2>Quote History - <?php echo $refId; ?></h2>
            <!--            DISPLAY ALL QUOTES-->
            <?php
                    if($_SESSION["userrole"]=="Administrator" || $_SESSION["userrole"]=="Chief Executive Officer" || $_SESSION["userrole"]=="Chief Financial Officer"){
                        
                    }else{
                        //FINDING LOGIN USER NAME OF THE QUOTE CREATER 
                        $quote_creator=find_quote_created_user_to_delete($refId, $verId);
                        if($_SESSION["username"]!=$quote_creator){
                            echo "<center><br>";
                            echo "<img src=\"images/Access-Denied.jpg\" width=\"25%\">";
                            echo "<p style=\"color:red;\">You are not authorized to visit this page</p>";
                            echo "</center>";
                            die();
                        }
                    }
                    
                    include "../includes/dashboard-table-more-approval.php";
                    
            ?>
            
        </div>
        <?php 
            include "../includes/footer.php"; 
            }else {
                header('location:index.php');
            }
            ob_flush()
        ?>
    </body>
    
    </html>