<?php 
    session_start(); 
    ob_start();
    $result_code="";
    $error_code="error";
    
    //SET ACTIVE PAGE
    $_SESSION["active_page"]="add_user";

    //BREADCRUMB DATA
    $root="Admin";
    $root_link="adduser.php";
    $active="Add User";
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
    </head>

    <body onresize="change_menus()">
        <!--        <p style="color:red;">You are not authorized to visit this page</p>-->
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
            
        
            $nameError="";
            $passwordError="";
            $roleError="";
            $deptError ="";
            $emailError ="";
            $empidError ="";
            $emp_nameError ="";
            $pass_Exp_Error = "";
            $error="";
            $emp_id=$emp_name=$email=$login_name=$password=$role=$department="";
            $pass_Exp=90;
            $repArea_Error="";
            $rep_Manager_Error="";
            $rep_Manager="";
            $india=$me=$apac=$usa_europe=$r_of_w="";
            $update_india=$update_me=$update_apac=$update_usa_europe=$update_r_of_w="No";
            $sp_disc_Error="";
            $sp_disc="";
            
            
            if(isset($_POST['submit'])){
                if (empty($_POST["loginname"])) {
                    $nameError = "Name is mandatory";
                    $error.="LoginName";
                }else{
                    $login_name=$_POST["loginname"];
                }
                if (empty($_POST["entered_password"])) {
                    $passwordError = "Password is mandatory";
                    $error.="Password";
                } else{
                    if(strlen($_POST["entered_password"])<8){
                            $passwordError = "Password Policy : Min 8 Characters";
                            $error.="Password";
                    }
                   $password=$_POST["entered_password"];
                }
                if (empty($_POST["dept"])) {
                    $deptError = "Department is mandatory";
                    $error.="Dept";
                }else{
                    $department=$_POST["dept"];
                }
                if (empty($_POST["email"])) {
                    $emailError = "Email is mandatory";
                    $error.="email";
                }else {    
                    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        $emailError = "Invalid email format";
                        $error.="InvalidEmail";
                    }else{
                        $email=$_POST["email"];
                    }
                }
                if (empty($_POST["empid"])) {
                    $empidError = "Employee id is mandatory";
                    $error.="EmpID";
                }else{
                    $emp_id=$_POST["empid"];
                }
                if (empty($_POST["emp_name"])) {
                    $emp_nameError = "Employee Name is mandatory";
                    $error.="EmpName";
                }else{
                    $emp_name=$_POST["emp_name"];
                }
                
                if (!is_numeric($_POST["expiry_days"])) {
                    $pass_Exp_Error = "Please enter valid number of days";
                    $error.="PassExpError";
                }else{
                    if($_POST["expiry_days"]<0){
                        $pass_Exp_Error = "Please enter valid number of days";
                        $error.="PassExpError";
                    }else{
                        $pass_Exp=round($_POST["expiry_days"]);
                    }
                }
                
                if (empty($_POST["sp_disc"])) {
                    if($_POST["sp_disc"]=="0"){
                        
                    }else{
                        $sp_disc_Error = "Please enter valid discount percentage";
                        $error.="SpDiscError";
                    }
                }else{
                    if (!is_numeric($_POST["sp_disc"])) {
                        $sp_disc_Error = "Please enter valid discount percentage";
                        $error.="SpDiscError";
                    }else{
                        if($_POST["sp_disc"]<0){
                            $sp_disc_Error = "Please enter valid discount percentage";
                            $error.="SpDiscError";
                        }else{
                            $sp_disc=round($_POST["sp_disc"]);
                        }
                    }
                    $sp_disc=$_POST["sp_disc"];
                }
                
                if (!isset($_POST["repArea_india"]) && !isset($_POST["repArea_me"]) && !isset($_POST["repArea_usa_europe"]) && !isset($_POST["repArea_apac"]) && !isset($_POST["repArea_r_of_w"])){
                    $error.="repAreaError";
                    $repArea_Error="Select atleast One Reporting Area";
                }else{
                    $repArea_Error="";
                    if($_POST["repArea_india"]=="India"){
                        $india="checked";
                        $update_india="Yes";
                    }
                    if($_POST["repArea_me"]=="ME"){
                        $me="checked";
                        $update_me="Yes";
                    }
                    if($_POST["repArea_apac"]=="APAC"){
                        $apac="checked";
                        $update_apac="Yes";
                    }
                    if($_POST["repArea_usa_europe"]=="USA_Europe"){
                        $usa_europe="checked";
                        $update_usa_europe="Yes";
                    }
                    if($_POST["repArea_r_of_w"]=="R_OF_W"){
                        $r_of_w="checked";
                        $update_r_of_w="Yes";
                    }
                }
                
                if($error==""){
                    $result_code=add_new_user($emp_id, $emp_name, $email, $login_name, $password, $_POST["role"], $department, $_POST["expiry_days"], $update_india, $update_me, $update_apac, $update_usa_europe, $update_r_of_w, $_POST["repManager"], $sp_disc);
                    if($result_code!="User Added Successfully"){
                        $error_code="error";
                    }else{
                        $error_code="";
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
                                        <h2>Add User</h2>
                                        <form method="post" action="">
                                            <br>
                                            <center>
                                                <?php echo "<p  style='color:red;'>".$result_code."</p>"; ?>
                                            </center>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Employee id * :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="empid" class="form-control" value="<?php echo $emp_id; ?>"> <span style='color:red;font-size:15px' class="error"><?php echo $empidError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Employee Name * :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="emp_name" class="form-control" value="<?php echo $emp_name; ?>"> <span style='color:red;font-size:15px' class="error"><?php echo $emp_nameError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Email id * :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>"> <span style='color:red;font-size:15px' class="error"><?php echo $emailError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Login Name *:</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="loginname" class="form-control" value="<?php echo $login_name; ?>"> <span style='color:red;font-size:15px' class="error" value="<?php echo $login_name; ?>"><?php echo $nameError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Password *:</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="password" name="entered_password" class="form-control" value="<?php echo $password; ?>"> <span style='color:red;font-size:15px' class="error"><?php echo $passwordError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Role *:</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class='dropdown' name="drop">
                                                            <select id='dropdown' class='form-control' name='role'>
                                                                <option value='Quote Requestor'>Quote Requestor</option>
                                                                <option value='Sales Manager'>Sales Manager</option>
                                                                <option value='Sales Director'>Sales Director</option>
                                                                <option value='Sales VP'>Sales VP</option>
                                                                <option value='Administrator'>Administrator</option>
                                                                <option value='Chief Executive Officer'>CEO</option>
                                                                <option value='Chief Financial Officer'>CFO</option>
                                                            </select>
                                                        </div> <span style='color:red;font-size:15px' class="error"><?php echo $roleError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Department * :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="dept" class="form-control" value="<?php echo $department; ?>"> <span style='color:red;font-size:15px' class="error"><?php echo  $deptError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Password Expires in :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <input type="text" name="expiry_days" class="form-control" aria-describedby="days-addon" value="<?php if(isset($_POST['expiry_days'])){echo $_POST['expiry_days'];}else {echo $pass_Exp;}?>" placeholder="Enter 0 for No Expiry"> <span class="input-group-addon" id="days-addon">Days</span>
                                                        </div>
                                                        <span style='color:red;font-size:15px' class="error"><?php echo  $pass_Exp_Error;?></span>
                                                    </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Reporting Area :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="repArea_india" value="India" <?php echo $india; ?> >India</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="repArea_me" value="ME" <?php echo $me; ?> >ME</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="repArea_usa_europe" value="USA_Europe" <?php echo $usa_europe; ?> >USA/Europe</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="repArea_apac" value="APAC" <?php echo $apac; ?> >APAC</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="repArea_r_of_w" value="R_OF_W" <?php echo $r_of_w; ?> >Rest of the World</label>
                                                        </div>
                                                        <span style='color:red;font-size:15px' class="error"><?php echo  $repArea_Error;?></span>
                                                    </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Reporting Manager * :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <?php
                                                        $emp_id_and_names=find_all_emp_names_from_users_for_admin();
                                                        $no_of_emp_names = count($emp_id_and_names)-1;
                                                        ?>
                                                        <div class='dropdown' name="drop">
                                                            <select id='dropdown' class='form-control' name='repManager'>
                                                                <?php 
                                                                   for($i=0; $i<=$no_of_emp_names; $i++){?>
                                                                        <option value='<?php echo $emp_id_and_names[$i][0]; ?>'><?php echo $emp_id_and_names[$i][0]." - ".$emp_id_and_names[$i][1]; ?></option>"
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Special Discount % * :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="sp_disc" class="form-control" value="<?php if($sp_disc==""){echo "0";}else{echo $sp_disc;} ?>"> <span style='color:red;font-size:15px' class="error"><?php echo  $sp_disc_Error;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button type="submit" name="submit" class="btn btn-default">Create User</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                            }else{
                                                echo "<center><p  style='color:green;'>".$result_code."</p></center>";
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