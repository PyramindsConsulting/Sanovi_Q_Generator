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
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style-bg-other-pages.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <!--JS FILES-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--        <script src="js/menu.js"></script>-->
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
                include "../includes/dashboard-jquery.php";
        ?>
        <div class="container">
            <br>
            <h2>Quote List</h2>
            <!-- CAPTURING GET VALUES-->
            <?php
                $MyQuotes=$RecentQuotes=$AllQuotes=$QuotesApproval=$ApprovedQuotes=$SearchQuotes="";
                $SelectedView=$_GET["View"];
                $SearchOn=$_GET["SearchOn"];
                $Key=$_GET["Key"];
                switch ($SelectedView){
                    case "MyQuotes":
                        $MyQuotes="selected";
                        break;
                    case "RecentQuotes":
                        $RecentQuotes="selected";
                        break;
                    case "AllQuotes":
                        $AllQuotes="selected";
                        break;
                    case "QuotesApproval":
                        $QuotesApproval="selected";
                        break;
					case "ApprovedQuotes":
						$ApprovedQuotes="selected";
						break;
                    case "SearchQuotes":
						$SearchQuotes="selected";
						break; 
                    default:
                        $RecentQuotes="selected";
                        $SelectedView="RecentQuotes";
                        break;
                }
                
                
            ?>
            <!-- VIEW SELECTOR DROPDOWN-->
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2">
                        <label class="control-label">Select the View :</label>
                    </div>
                    <div class="col-sm-3">
                        <div class='dropdown' name="drop">
                            <select id='view_selector' class='form-control' name='view_selector' onchange="SelectView()">
                            	<option value='RecentQuotes' <?php echo $RecentQuotes ?>>Recent Quotes</option>
                                <option value='MyQuotes' <?php echo $MyQuotes ?>>My Quotes</option>
                                <?php 
                                    if($_SESSION["userrole"]=="Administrator" || $_SESSION["userrole"]=="Chief Executive Officer" || $_SESSION["userrole"]=="Chief Financial Officer"){
                                ?>
                                    <option value='AllQuotes' <?php echo $AllQuotes ?>>All Quotes</option>
                                <?php } ?>
                                <?php 
                                    if($_SESSION["userrole"]!="Quote Requestor"){
                                ?>
                                <option value='QuotesApproval' <?php echo $QuotesApproval ?>>Quotes for Approval</option>
                                <?php } ?>
                                <?php 
                                    if($_SESSION["userrole"]!="Quote Requestor"){
                                        if($_SESSION["userrole"]!="Sales Manager"){
                                ?>
                                <option value='ApprovedQuotes' <?php echo $ApprovedQuotes ?>>Approved Quotes</option>
                                <?php }} ?>
                                
                                <option value='SearchQuotes' <?php echo $SearchQuotes ?>>Search Quotes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-7">
						<?php 
							if($QuotesApproval=="selected"){ ?>
                            	<button type="button" class="btn btn-success  pull-right" onClick="RefreshApprovals()">Refresh</button>
							<?php } ?>
                    </div>
                </div>
                <br>
            </div>
            
            <!--            DISPLAY ALL QUOTES-->
            <?php
                if($SelectedView=="AllQuotes"){
                    if($_SESSION["userrole"]=="Administrator" || $_SESSION["userrole"]=="Chief Executive Officer" || $_SESSION["userrole"]=="Chief Financial Officer"){
                        include "../includes/dashboard_table_allquotes.php";
                    }else{
                        echo "<center><br>";
                        echo "<img src=\"images/Access-Denied.jpg\" width=\"25%\">";
                        echo "<p style=\"color:red;\">You are not authorized to visit this page</p>";
                        echo "</center>";
                        die();
                    }
                    
                }
            ?>
            
            <!--            DISPLAY MY QUOTES-->
            <?php
                if($SelectedView=="MyQuotes"){
                    include "../includes/dashboard-table-myquotes.php";
                }
            ?>
            
            <!--            DISPLAY MY RECENT QUOTES-->
            <?php
                if($SelectedView=="RecentQuotes"){
                    include "../includes/dashboard-table-myrecentquotes.php";
                }
            ?>
            
            <!--            DISPLAY QUOTES FOR APPROVAL-->
            <?php
                if($SelectedView=="QuotesApproval"){
                    if($_SESSION["userrole"]=="Quote Requestor"){
                        echo "<center><br>";
                        echo "<img src=\"images/Access-Denied.jpg\" width=\"25%\">";
                        echo "<p style=\"color:red;\">You are not authorized to visit this page</p>";
                        echo "</center>";
                    }else{
                        include "../includes/dashboard-table-quotesforapproval.php";
                    }
                }
            ?>
            
            <!--            DISPLAY APPROVED QUOTES -->
            <?php
                if($SelectedView=="ApprovedQuotes"){
                    if($_SESSION["userrole"]=="Quote Requestor" || $_SESSION["userrole"]=="Sales Manager"){
                        echo "<center><br>";
                        echo "<img src=\"images/Access-Denied.jpg\" width=\"25%\">";
                        echo "<p style=\"color:red;\">You are not authorized to visit this page</p>";
                        echo "</center>";
                    }else{
                        include "../includes/dashboard-table-approvedquotes.php";
                    }
                }
            ?>
            
            <!--            DISPLAY SEARCH QUOTES -->
            <?php
                if($SelectedView=="SearchQuotes"){
                    include "../includes/dashboard-jquery.php";
                    include "../includes/dashboard-search.php";
                }
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