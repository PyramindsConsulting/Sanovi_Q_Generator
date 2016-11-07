<?php 
    session_start(); 
    ob_start();
    $result_code="";
    $error_code="error";
    
    //SET ACTIVE PAGE
    $_SESSION["active_page"]="modify_user";
    
    //BREADCRUMB DATA
    $root="Admin";
    $root_link="adduser.php";
    $active="Modify User";
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
        <script src="../js/admin.js"></script>
    </head>

    <body onresize="change_menus()">
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
            
            //GET EMP ID FROM MODIFYUSER.PHP
            if(!$_GET){
                if($_SESSION["modify_emp_id"]==""){
                    header('location:modifyuser.php');
                }else{
                    $emp_id=$_SESSION["modify_emp_id"];
                }
            }else{
                if(!$_GET[emp_id]){
                    echo "<br><center><p style=\"color:RED;\">Invalid Request</p></center>";
                    die();
                }
                $emp_id=$_GET[emp_id];
                $user_data=fetch_user_data($emp_id);
                if($user_data["emp_name"]==""){
                    echo "<br><center><p style=\"color:RED;\">Invalid Request</p></center>";
                    die();
                }
            }
            

            
            $details=fetch_user_data($emp_id);
            //print_r ($details);
            $nameError="";
            $passwordError="";
            $roleError="";
            $deptError ="";
            $emailError ="";
            $empidError ="";
            $emp_nameError ="";
            $pass_Exp_Error = "";
            $repArea_Error="";
            $rep_Manager_Error="";
            $rep_Manager="";
            $india=$me=$apac=$usa_europe=$r_of_w="";
            $update_india=$update_me=$update_apac=$update_usa_europe=$update_r_of_w="No";
            $sp_disc_Error="";
            $sp_disc="";
            $india=$me=$apac=$usa_europe=$r_of_w="";
            $error="";
            
            $emp_name=$details["emp_name"];
            $email=$details["email_id"];
            $login_name=$details["login_name"];
            $role=$details["role"];
            $department=$details["department"];
            $status=$details["status"];
            $pass_Exp_days=$details["pass_Exp_days"];
            
                
            if($details['reporting_india']=="Yes"){
                $india="checked";
            }
            if($details['reporting_me']=="Yes"){
                $me="checked";
            }
            if($details['reporting_apac']=="Yes"){
                $apac="checked";
            }
            if($details['reporting_usa_europe']=="Yes"){
                $usa_europe="checked";
            }
            if($details['reporting_row']=="Yes"){
                $r_of_w="checked";
            }

            $sp_disc=$details['sp_discount_percentage'];
            $existing_repManager=$details['reporting_manager'];
            
            if(isset($_POST['submit'])){
                if (empty($_POST["loginname"])) {
                    $nameError = "Name is mandatory";
                    $error.="LoginName";
                }else{
                    $login_name=$_POST["loginname"];
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
                    $result_code=modify_user($emp_id, $_POST["emp_name"], $_POST["email"], $_POST["role"], $_POST["dept"], $_POST["status"], $_POST["expiry_days"], $update_india, $update_me, $update_apac, $update_usa_europe, $update_r_of_w, $_POST["repManager"], $sp_disc);
                    if($result_code!="User Modified Successfully"){
                        //echo $result_code;
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
                                    <h2>Modify User</h2>
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
                                                        <input id="modify_user_emp_id" type="text" name="empid" class="form-control" value="<?php echo $emp_id; ?>" readonly> <span style='color:red;font-size:15px' class="error"><?php echo $empidError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Employee Name * :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input id="modify_user_emp_name" type="text" name="emp_name" class="form-control" value="<?php echo $emp_name; ?>" readonly> <span style='color:red;font-size:15px' class="error"><?php echo $emp_nameError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Email id * :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input id="modify_user_emailid" type="text" name="email" class="form-control" value="<?php echo $email; ?>" readonly> <span style='color:red;font-size:15px' class="error"><?php echo $emailError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">User Name *:</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input id="modify_user_user_name" type="text" name="loginname" class="form-control" value="<?php echo $login_name; ?>" readonly> <span style='color:red;font-size:15px' class="error" value="<?php echo $login_name; ?>"><?php echo $nameError;?></span> </div>
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
                                                            <select id='modify_user_role' class='form-control' name='role' disabled>
                                                                <option value='Quote Requestor' <?php if($role=="Quote Requestor"){echo "Selected";} ?>>Quote Requestor</option>
                                                                <option value='Sales Manager' <?php if($role=="Sales Manager"){echo "Selected";} ?>>Sales Manager</option>
                                                                <option value='Sales Director' <?php if($role=="Sales Director"){echo "Selected";} ?>>Sales Director</option>
                                                                <option value='Sales VP' <?php if($role=="Sales VP"){echo "Selected";} ?>>Sales VP</option>
                                                                <option value='Administrator' <?php if($role=="Administrator"){echo "Selected";} ?>>Administrator</option>
                                                                <option value='Chief Executive Officer' <?php if($role=="Chief Executive Officer"){echo "Selected";} ?>>CEO</option>
                                                                <option value='Chief Financial Officer' <?php if($role=="Chief Financial Officer"){echo "Selected";} ?>>CFO</option>
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
                                                        <input id="modify_user_dept" type="text" name="dept" class="form-control" value="<?php echo $department; ?>" readonly> <span style='color:red;font-size:15px' class="error"><?php echo  $deptError;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Status :</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select id='modify_user_status' class='form-control' name='status' disabled>
                                                            <option value='0' <?php if($status==0){echo "selected";} ?>>Active</option>
                                                            <option value='1' <?php if($status==1){echo "selected";} ?>>Disabled</option>
                                                        </select>
                                                    </div>
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
                                                            <input id="modify_exp_days" type="text" name="expiry_days" class="form-control" aria-describedby="days-addon" value="<?php if(isset($_POST['expiry_days'])){echo $_POST['expiry_days'];}else {echo  $pass_Exp_days;}?>" placeholder="Enter 0 for No Expiry" disabled> <span class="input-group-addon" id="days-addon">Days</span>
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
                                                            <label><input id="modify_repArea_india" type="checkbox" name="repArea_india" value="India" <?php echo $india; ?> disabled>India</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input id="modify_repArea_me" type="checkbox" name="repArea_me" value="ME" <?php echo $me; ?> disabled >ME</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input id="modify_repArea_usa_europe" type="checkbox" name="repArea_usa_europe" value="USA_Europe" <?php echo $usa_europe; ?> disabled >USA/Europe</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input id="modify_repArea_apac" type="checkbox" name="repArea_apac" value="APAC" <?php echo $apac; ?> disabled >APAC</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input id="modify_repArea_r_of_w" type="checkbox" name="repArea_r_of_w" value="R_OF_W" <?php echo $r_of_w; ?> disabled>Rest of the World</label>
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
                                                            <select id='modify_repManager' class='form-control' name='repManager' disabled>
                                                                <?php 
                                                                   for($i=0; $i<=$no_of_emp_names; $i++){?>
                                                                        <option value='<?php echo $emp_id_and_names[$i][0]; ?>' <?php if($existing_repManager==$emp_id_and_names[$i][0]){ echo "selected"; }?>><?php echo $emp_id_and_names[$i][0]." - ".$emp_id_and_names[$i][1]; ?></option>"
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
                                                        <input id="modify_sp_disc" type="text" name="sp_disc" class="form-control" value="<?php if($sp_disc==""){echo "0";}else{echo $sp_disc;} ?>" disabled> <span style='color:red;font-size:15px' class="error"><?php echo  $sp_disc_Error;?></span> </div>
                                                    <div class="col-sm-5"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input id="modify_user_edit_btn" type="button" name="edit" value="Edit" onclick="ModifyUserEditable()" class="btn btn-default">
                                                        <button id="modify_user_submit_btn" type="submit" name="submit" class="btn btn-default" disabled>Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                            }else{
                                                echo "<center><p  style='color:green;'>".$result_code."</p></center>";
                                                if(!$_GET){
                                                    $_SESSION["modify_emp_id"]="";
                                                }else{
                                                    echo '<center>You\'ll be redirected to User List in 5 secs.</a>.</center>';
                                                    header( "refresh:5;url=userlist.php" ); 
                                                }
                                                
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
                ob_flush(); 
            ?>
    </body>

    </html>