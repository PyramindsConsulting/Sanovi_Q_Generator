<?php 
    session_start(); 
    ob_start();
    
    //SET ACTIVE PAGE
    $_SESSION["active_page"]="profile";

    //BREADCRUMB DATA
    $root="Profile";
    $root_link="myprofile.php";
    $active="My Profile";
?>
    <!doctype html>
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
        include "../includes/config.php";
        include "../includes/php_functions.php";
        
        change_session_id();
        check_session_expiry();
        
        if($_SESSION["authentication"] == "passed"){
            include "../includes/header.php";
            include "../includes/mainmenu-mobile.php";
            include "../includes/mainmenu.php";
        
            $emp_id=$_SESSION["emp_id"];
            $emp_name=$_SESSION["emp_name"];
            $email=$_SESSION["email_id"];
            $role=$_SESSION["userrole"];
            $department=$_SESSION["userdepartment"];
            
    ?>
            <div class="font">
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
                                    <h2>My Profile</h2>
                                    <form method="post" action="">
                                        <br>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label">Emp id :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" name="empid" class="form-control" value="<?php echo $emp_id; ?>" readonly> </div>
                                                <div class="col-sm-5"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label">Name :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" name="emp_name" class="form-control" value="<?php echo $emp_name; ?>" readonly>
                                                </div>
                                                <div class="col-sm-5"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label">Email id :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" readonly>
                                                </div>
                                                <div class="col-sm-5"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label">Role :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class='dropdown' name="drop">
                                                        <input type="text" name="role" class="form-control" value="<?php echo $role; ?>" readonly> </div>
                                                </div>
                                                <div class="col-sm-5"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label class="control-label">Department :</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" name="dept" class="form-control" value="<?php echo $department; ?>" readonly>
                                                </div>
                                                <div class="col-sm-5"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
        include "../includes/footer.php";
        ob_flush();
        } 
    ?>
    </body>

    </html>