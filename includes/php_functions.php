<?php
    //FUNCTION FOR AUTHENTICATING USER UPON LOGIN
    function authenticate_user($entered_userid, $entered_pass){
        require_once('../includes/config.php');
        //RETRIVING USER DATA FROM DB
        $query="SELECT * FROM users WHERE login_name='$entered_userid'";
        $result = mysqli_query($connect, $query);
        $entered_pass = md5($entered_pass);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        $actual_userid=$row["login_name"];
        $actual_password=$row["login_passwd"];
        $login_status=$row["login_status"];
        $login_failed_attempts=$row["login_failed_attempts"];
        $password_expires=$row["password_expires"];
        $password_changed_on=$row["password_changed_on"];
        $password_exp_days=$row["password_exp_days"];
        $user_role=$row["login_role"];
        $_SESSION["loginstatus"]=$row["login_status"];
        
        if($actual_userid===$entered_userid && $login_status==0){
            //echo $login_failed_attempts;
            if($actual_password===$entered_pass){
                //USER ID AND PASSWORD ARE MATCHED
                //session_start();
                
                //CHECKING PASSWORD EXPIRY
                if($password_expires=="Yes"){
                    $today=date_create(date('Y-m-d'));
                    $last_password_changed=date_create("$password_changed_on");
                    $diff=date_diff($last_password_changed,$today);
                    $diff_days = $diff->format("%a");
                    if(($diff_days)>=$password_exp_days){
                        $_SESSION["pass_expired_emp_id"]=$row["emp_id"];
                        $_SESSION["expired_password"]=$row["login_passwd"];
                        header('Location: passwordexpired.php');
                        return false;
                    }
                }
                
                date_default_timezone_set("Asia/Kolkata"); //SETTING INDIAN TIME ON SERVER
                $newlogin_ts = date('Y-m-d H:i:s'); //SETTING DATE AND TIME FORMAT
                $_SESSION["emp_id"]=$row["emp_id"];
                $_SESSION["emp_name"]=$row["emp_name"];
                $_SESSION["email_id"]=$row["email_id"];
                $_SESSION["username"]=$row["login_name"];
                $_SESSION["userrole"]=$row["login_role"];
                $_SESSION["userdepartment"]=$row["login_department"];
                $_SESSION["lastlogin"]=$row["login_lastlogin_ts"];
                $_SESSION["emailid"]=$row["email_id"];
                $_SESSION["sp_discount_percentage"]=$row["sp_discount_percentage"];
                $query_userrole="SELECT MaxDiscount from UserRoles where UserRole='$user_role'";
                $result_userrole=mysqli_query($connect, $query_userrole);
                if(!$result_userrole){
                    die("Database Update Failed");
                }
                $row_userrole=mysqli_fetch_array($result_userrole);
                $Max_Discount=$row_userrole['MaxDiscount'];
                if($Max_Discount<$_SESSION["sp_discount_percentage"]){
                    $_SESSION["Max_Discount"]=$_SESSION["sp_discount_percentage"];
                }else{
                     $_SESSION["Max_Discount"]=$Max_Discount;
                }
                
                
                //$ip_address=ip2long(get_IP_address());//CAPTURING IP ADDRESS OF LOGIN
                $ip_address=get_IP_address();//CAPTURING IP ADDRESS OF LOGIN
                //echo get_IP_address();
                
                //INITIALIZING ADMIN SESSIONS
                $_SESSION["modify_emp_id"]="";
                $_SESSION["delete_emp_id"]="";
                
                //UPDATING LOGIN AND LOGOUT TIMES IN DB
                $query_update_lastlogin_ts = "UPDATE users SET login_lastlogin_ts = '$newlogin_ts', login_lastlogout_ts = '0000-00-00 00:00:00', login_failed_attempts ='0', login_ip_address = '$ip_address' WHERE login_name='$actual_userid'";
                $result_query_lastlogin_ts = mysqli_query($connect, $query_update_lastlogin_ts);
                if(!$result_query_lastlogin_ts){
                    die("Database Update Failed");
                }

                return true;
            }else{
                $login_failed_attempts=$login_failed_attempts+1;
                
                //UPDATING LOGIN FAILED ATTEMPTS IN DB
                $query_update_login_failed_attempts = "UPDATE users SET login_failed_attempts = '$login_failed_attempts' WHERE login_name='$actual_userid'";
                $result_query_login_failed_attempts = mysqli_query($connect, $query_update_login_failed_attempts);
                if(!$result_query_login_failed_attempts){
                    die("Database Update Failed");
                }
                if($login_failed_attempts==5){ // UPDATING BLOCKED STATUS AFTER 5 LOGIN ATTEMPTS IN DB
                    $query_update_login_status = "UPDATE users SET login_status = '1' WHERE login_name='$actual_userid'";
                    $result_query_login_status = mysqli_query($connect, $query_update_login_status);
                }
                return false;
            }
        }else{
            
            return false;
        }
    }


    //FUNCTION TO LOGOUT THE USER & UPDATE LAST LOGOUT DATE AND TIME IN DB
    function logout_user(){
        require_once('../includes/config.php');
        session_start();   
        date_default_timezone_set("Asia/Kolkata"); //SETTING INDIAN TIME ON SERVER
        $newlogout_ts = date('Y-m-d H:i:s'); //SETTING DATE AND TIME FORMAT
        $actual_userid=$_SESSION["username"];
         
        //UPDATING LOGOUT TIME
        $query_update_lastlogout_ts = "UPDATE users SET login_lastlogout_ts = '$newlogout_ts' WHERE login_name='$actual_userid'";
        $result_query_lastlogout_ts = mysqli_query($connect, $query_update_lastlogout_ts);
        if(!$result_query_lastlogout_ts){
            die("Database Update Failed");
        }
    
        session_destroy();
     }


    //FUNCTION TO GENERATE A RANDOM STRING
    function GenerateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $RandomString = '';
        for ($i = 0; $i < $length; $i++) {
            $RandomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $RandomString;
    }


    //FUNCTION TO RESET PASSWORD
    function ResetPassword($username){
        require_once('../includes/config.php');
        $error_code="";
        
        //QUERY TO FETCH USER DATA FROM DB
        $query_find_username="SELECT * FROM users WHERE login_name='$username'";
        $result_find_username = mysqli_query($connect, $query_find_username);
        
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result_find_username){
            die("Database Query Failed");
        }
        
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result_find_username);
        $actual_userid=$row["login_name"];
        $login_status=$row["login_status"];
        $actual_emailid=$row["email_id"];
        
        //CHECKING IF USER NAME ENTERED IS VALID OR NOT
        if($actual_userid===$username){
            //CHECKING IF LOGIN STATUS IS ACTIVA OR BLOCKED
            if($login_status=="0"){
                //RESETTING THE PASSWORD
                
                //GENERATING PASSWORD RESET KEY
                $password_reset_key=GenerateRandomString(20);
                
                //UPDATING DATABASE RECORD WITH RESET KEY
                $query_update_reset_key = "UPDATE users SET reset_password_key = '$password_reset_key' WHERE login_name='$actual_userid'";
                $result_query_reset_key = mysqli_query($connect, $query_update_reset_key);
                if(!$result_query_reset_key){
                    die("Database Update Failed");
                }
                
                //SENDING EMAIL WITH PASSWORD RESET LINK TO THE USER 
                $ch = curl_init("http://176.32.230.53/worksbypyraminds.co/Sanovi/reset_password.php?emailid=$actual_emailid&key=$password_reset_key");
                curl_setopt($ch, CURLOPT_POST, true);
                //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                return "Password reset link is sent to your registered email id";
            }else{
                //USER ID IS BLOCKED. CONTACT ADMINISTRATOR
                $error_code="Username is blocked. Please contace Administrator";
                return $error_code;
            }
        }else{
            //INVALID USER NAME
            $error_code="Invalid Username";
            return $error_code;
        }
        
    }


    //FUNCTION TO RESET USER PASSWORD BY ADMIN
    function reset_user_password($emp_id, $new_password){
        include '../../includes/config.php';
        $EncryptedPassword = md5($new_password);
        $today=date('Y-m-d');
        $query_update_new_password = "UPDATE users SET login_passwd = '$EncryptedPassword', password_changed_on = '$today' WHERE emp_id='$emp_id'";
            $result_query_new_password = mysqli_query($connect, $query_update_new_password);
            if(!$result_query_new_password){
                return "Password Reset UnSuccessful";
            }else{
                return "Password Reset Successfully";
            }
    }


    //CHANGE PASSWORD BY USER(NOT BY ADMIN) - ON CLICKING LOST PASSWORD
    function ChangePassword_byUser($key, $newpassword){
        include ('../includes/config.php');

        $key=$_GET["key"];        
        $EncryptedPassword=md5($newpassword);
        
        $today=date('Y-m-d');
        
        //RETRIVING USER DATA FROM DB
        $query="SELECT * FROM users WHERE reset_password_key='$key'";
        $result = mysqli_query($connect, $query);

        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }

        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        $actual_userid=$row["login_name"];
        //echo "userid".$actual_userid;
        
            //UPDATING NEW PASSWORD
            $query_update_new_password = "UPDATE users SET login_passwd = '$EncryptedPassword', password_changed_on = '$today' WHERE reset_password_key='$key'";
            $result_query_new_password = mysqli_query($connect, $query_update_new_password);
            if(!$result_query_new_password){
                die("Unable to update new password");
            }

            //REMOVING PASSWORD RESET KEY
            $query_update_key = "UPDATE users SET reset_password_key = '', login_failed_attempts='0' WHERE login_name='$actual_userid'";
            $result_query_key = mysqli_query($connect, $query_update_key);
            if(!$result_query_key){
                die("Unable to remove the reset key");
            }

            $result_note="Password Reset Done";
            return $result_note;
        }
    

    //FUNCTION TO CHECK EXPIRY OF PASSWORD RESET KEY 
    function check_password_resetkey($key){
        include('../includes/config.php');

        $key=$_GET["key"];        
        
        //RETRIVING USER DATA FROM DB
        $query="SELECT * FROM users WHERE reset_password_key='$key'";
        $result = mysqli_query($connect, $query);

        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }

        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        $actual_userid=$row["login_name"];
        if($actual_userid==""){
            return "Invalid";
        }else{
            return "Valid";
        }
    }


    //FUNCTION TO ADD A NEW USER IN TO LOGIN LIST
    function add_new_user($emp_id, $emp_name, $email, $login_name, $passwd, $role, $department, $expiry_days, $update_india, $update_me, $update_apac, $update_usa_europe, $update_r_of_w, $repManager, $sp_disc){
        include('../../includes/config.php');
        $EncryptedPassword=md5($passwd);
        $emp_id_already_exist="";
        $email_id_already_exist="";
        $login_name_already_exist="";
        
        if($expiry_days>0){
            $password_expires="Yes";
        }else{
            $password_expires="No";
        }
        
        //CHECKING EMP ID ALREADY EXIST OR NOT
        $query_check_empid = "SELECT * FROM users WHERE emp_id='$emp_id'";
        $result_check_empid = mysqli_query($connect, $query_check_empid);
        if(!$result_check_empid){
            die("Database Query Failed"); //CHECK IF QUERY EXECUTES OR NOT
        }
        
        $row=mysqli_fetch_array($result_check_empid);
        $actual_emp_id=$row["emp_id"];
        
        if($actual_emp_id===$emp_id){
            $emp_id_already_exist="Yes";
        }else{
            $emp_id_already_exist="";
        }
        
        //CHECKING EMAIL ID ALREADY EXIST OR NOT
        $query_check_emailid = "SELECT * FROM users WHERE email_id='$email'";
        $result_check_emailid = mysqli_query($connect, $query_check_emailid);
        
        if(!$result_check_emailid){
            die("Database Query Failed"); //CHECK IF QUERY EXECUTES OR NOT
        }
        
        $row=mysqli_fetch_array($result_check_emailid);
        $actual_email_id=$row["email_id"];
        
        if($actual_email_id===$email){
            $email_id_already_exist="Yes";
        }else{
            $email_id_already_exist="";
        }
        
        //CHECKING LOGIN NAME ALREADY EXIST OR NOT
        $query_check_login_name = "SELECT * FROM users WHERE login_name='$login_name'";
        $result_check_login_name = mysqli_query($connect, $query_check_login_name);
        
        if(!$result_check_login_name){
            die("Database Query Failed"); //CHECK IF QUERY EXECUTES OR NOT
        }
        
        $row=mysqli_fetch_array($result_check_login_name);
        $actual_login_name=$row["login_name"];
        
        if($actual_login_name===$login_name){
            $login_name_already_exist="Yes";
        }else{
            $login_name_already_exist="";
        }
        
        //CHECKING ERRORS AND CREATING ACCOUNT
        if($emp_id_already_exist=="Yes" || $email_id_already_exist=="Yes" || $login_name_already_exist=="Yes"){
            $error_code="";
            if($emp_id_already_exist=="Yes"){
                $error_code.="User id : ".$emp_id."<br>";
            }
            if($email_id_already_exist=="Yes"){
                $error_code.="Email id : ".$email."<br>";
            }
            if($login_name_already_exist=="Yes"){
                $error_code.="Login Name : ".$login_name."<br>";
            }
            
            return "Account already exist with <br>".$error_code;
            
        }else{
            $today=date('Y-m-d'); //CAPTURING DATE FOR UPDATING PASSWORD UPDATED ON 
            $query_add_new_user="INSERT INTO users 
                      (emp_id, emp_name, email_id, login_name, login_passwd, 
                       login_role, login_department, login_lastlogin_ts, 
                       login_lastlogout_ts, password_expires, password_changed_on, 
                       reset_password_key, login_status, login_failed_attempts, password_exp_days, reporting_india, reporting_me, reporting_apac, reporting_usa_europe, reporting_row, reporting_manager, sp_discount_percentage) 
                      VALUES ('$emp_id', '$emp_name', '$email', '$login_name', 
                              '$EncryptedPassword', '$role', 
                              '$department', '0', '0', '$password_expires', '$today', '', '0', '0', '$expiry_days', '$update_india', '$update_me', '$update_apac', '$update_usa_europe', '$update_r_of_w', '$repManager', '$sp_disc')";
            $result_add_login = mysqli_query($connect, $query_add_new_user);
            if(!$result_add_login){
                die("Failed to create login");
            }
            return "User Added Successfully";
        }
    }


    //FUNCTION TO DELETE USER IN LOGIN LIST
    function delete_user($emp_id){
        
        include('../../includes/config.php');
        
        if($_SESSION["emp_id"]==$emp_id){
            return "Cannot Delete Your Own ID";
        }
        $query_delete_user = "DELETE FROM users WHERE emp_id='$emp_id'";
        $result_delete_user = mysqli_query($connect, $query_delete_user);
        
        if(!$result_delete_user){
            die("Delete Failed"); //CHECK IF QUERY EXECUTES OR NOT
            return "Unable to Delete";
        }else{
            return "User Successfully Deleted";
        }
        
    }


    //FUNCTION TO CHECK EXISTANCE OF USER IN LOGIN LIST
    function check_user($emp_id){
        include('../../includes/config.php');
        
        $query_check_empid = "SELECT * FROM users WHERE emp_id='$emp_id'";
        $result_check_empid = mysqli_query($connect, $query_check_empid);
        
        if(!$result_check_empid){
            die("Database Query Failed"); //CHECK IF QUERY EXECUTES OR NOT
        }
        
        $row=mysqli_fetch_array($result_check_empid);
        $actual_emp_id=$row["emp_id"];
        
        if($actual_emp_id===$emp_id){
            return "Account exist";
        }else{
            return "Account doesnot exist";;
        }
    }


    //FUNCTION TO FETCH USER DATA FROM LOGIN LIST
    function fetch_user_data($emp_id){
        include('../../includes/config.php');
        
        $query_fetch_details = "SELECT * FROM users WHERE emp_id='$emp_id'";
        $result_fetch_details = mysqli_query($connect, $query_fetch_details);
        
        if(!$result_fetch_details){
            die("Database Query Failed"); //CHECK IF QUERY EXECUTES OR NOT
        }
        
        $row=mysqli_fetch_array($result_fetch_details);
        $details['emp_id']=$emp_id;
        $details['email_id']=$row["email_id"];
        $details['emp_name']=$row["emp_name"];
        $details['login_name']=$row["login_name"];
        $details['role']=$row["login_role"];
        $details['department']=$row["login_department"];
        $details['status']=$row["login_status"];
        $details['pass_Exp_days']=$row["password_exp_days"];
        
        $details['reporting_india']=$row["reporting_india"];
        $details['reporting_me']=$row["reporting_me"];
        $details['reporting_apac']=$row["reporting_apac"];
        $details['reporting_usa_europe']=$row["reporting_usa_europe"];
        $details['reporting_row']=$row["reporting_row"];
        
        $details['sp_discount_percentage']=$row["sp_discount_percentage"];
        $details['reporting_manager']=$row["reporting_manager"];
        
        return $details;
    }


    //FUNCTION TO ECHO BREADCRUMB
    function breadcrumb($root, $root_link, $active){
            echo "<ol class='breadcrumb'>";
            echo "<li><a href='".$root_link."'>".$root."</a></li>";
            echo "<li class=\"active\">".$active."</li>";
            echo "</ol>";
    }


    //FUNCTION FOR CURRENCY CONVERSION
    function currency_convert($usd_value, $target_currency){
        // set API Endpoint and access key (and any options of your choice)
        $endpoint = 'live';
        $access_key = '14e44e9668900c762564bff7952a8a74';

        // Initialize CURL:
        $ch = curl_init('http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);
        
        $USD_to_TargetCurrency="USD".$target_currency;
        // Access the exchange rate values, e.g. GBP:
        $ExRate = $exchangeRates['quotes'][$USD_to_TargetCurrency];
        return $ExRate*$usd_value;
    }


    //FUNCTION FOR CHANGING PROFILE PASSWORD
    function ChangeProfilePassword($emp_id, $newpassword){
        include ('../includes/config.php');
        $EncryptedPassword=md5($newpassword);
        
        //UPDATING NEW PASSWORD
        $query_change_password = "UPDATE users SET login_passwd = '$EncryptedPassword' WHERE emp_id='$emp_id'";
        $result_change_password = mysqli_query($connect, $query_change_password);
        if(!$result_change_password){
            die("Unable to change password");
        }

        $result_note="Password Reset Done";
        return $result_note;
    }


    //FUNCTION TO ADD A NEW USER IN TO LOGIN LIST
    function modify_user($emp_id, $emp_name, $email, $role, $department, $status, $expiry_days, $update_india, $update_me, $update_apac, $update_usa_europe, $update_r_of_w, $repManager, $sp_disc){
        include('../../includes/config.php');
        
        //CHECKING EMAIL ID ALREADY EXIST OR NOT
        $query_check_emailid = "SELECT * FROM users WHERE email_id='$email'";
        $result_check_emailid = mysqli_query($connect, $query_check_emailid);
        
        if(!$result_check_emailid){
            die("Database Query Failed"); //CHECK IF QUERY EXECUTES OR NOT
        }
        
        $row=mysqli_fetch_array($result_check_emailid);
        $actual_email_id=$row["email_id"];
        $actual_emp_id=$row["emp_id"];
        
        if($actual_email_id==$email && $actual_emp_id==$emp_id){
            //MODIFYING USER DETAILS
            $query_modify_user="UPDATE users SET emp_name = '$emp_name', email_id = '$email', login_role='$role', login_department='$department', login_status='$status', password_exp_days='$expiry_days', reporting_india='$update_india', reporting_me='$update_me', reporting_apac='$update_apac', reporting_usa_europe='$update_usa_europe', reporting_row='$update_r_of_w', reporting_manager='$repManager', sp_discount_percentage='$sp_disc' WHERE emp_id='$emp_id'";
            $result_modify_user = mysqli_query($connect, $query_modify_user);
            if(!$result_modify_user){
                die("Failed to Modify User");
            }
            return "User Modified Successfully";
        }else{
            return "Update Failed!<br>Email ID entered is already associated with another account";
        }
        
    }


    //FUNCTION TO DISPLAY USERS LIST ON ADMIN HOME PAGE
    function display_user_list(){
        include "../../includes/config.php";
        
        $query_user_list="SELECT emp_id, emp_name, login_name, login_role, login_lastlogin_ts, login_ip_address FROM users ORDER BY login_lastlogin_ts DESC";
        $result_user_list = mysqli_query($connect, $query_user_list);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result_user_list){
            die("Database Query Failed");
        }
        //$row=mysqli_fetch_array($result_user_list);
        
        echo "<table class=\"table table-hover\" style=\" font-size:12px;\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Emp Id</th>";
        echo "<th>Emp Name</th>";
        echo "<th>User Name</th>";
        echo "<th>User Role</th>";
        echo "<th>Last Login</th>";
        echo "<th>Login IP</th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        if (mysqli_num_rows($result_user_list) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result_user_list)) {        
                echo "<tr>";
                echo "<td>".$row["emp_id"]."</td>";
                echo "<td>".$row["emp_name"]."</td>";
                echo "<td>".$row["login_name"]."</td>";
                echo "<td>".$row["login_role"]."</td>";
                echo "<td>".$row["login_lastlogin_ts"]."</td>";
                echo "<td>".$row["login_ip_address"]."</td>";
                echo "<td>
                    <a href=\"confirmmodifyuser.php?emp_id=".$row["emp_id"]."\" data-placement=\"top\" data-toggle=\"tooltip\" title=\"Modify User\"\"><span class=\"glyphicon glyphicon-edit\"> </span></a>
                    <a href=\"confirmresetpassword.php?emp_id=".$row["emp_id"]."\" data-placement=\"top\" data-toggle=\"tooltip\" title=\"Reset Password\"\"><span class=\"glyphicon glyphicon-lock\"> </span></a>
                    <a href=\"confirmdelete.php?emp_id=".$row["emp_id"]."\" data-placement=\"top\" data-toggle=\"tooltip\" title=\"Delete User\"\"><span class=\"glyphicon glyphicon-trash\"> </span></a>
                    </td>";
                echo "</tr>";
                }
            }else{
            echo "0 results";
        }
        echo "</tbody>";
        echo "</table>";
    }


    //FUNCTION AUTHENTICATE ADMIN AND CEO
    function authenticate_admin(){
        if($_SESSION["userrole"]=="Administrator" || $_SESSION["userrole"]=="Chief Executive Officer" || $_SESSION["userrole"]=="Chief Financial Officer"){
            return "Passed";
        }else{
            return "Failed";
        }
    }
    

    //FUNCTION TO CHANGE SESSION ID
    function change_session_id(){
        session_regenerate_id();
    }


    //FUNCTION TO CHECK SESSION EXPIRY
    function check_session_expiry(){
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
        // last request was more than 60 minutes ago;
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage

        }
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
    }


    //FUNCTION TO FIND IP ADDRESS
    function get_IP_address(){
        foreach (array('HTTP_CLIENT_IP',
                       'HTTP_X_FORWARDED_FOR',
                       'HTTP_X_FORWARDED',
                       'HTTP_X_CLUSTER_CLIENT_IP',
                       'HTTP_FORWARDED_FOR',
                       'HTTP_FORWARDED',
                       'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $IPaddress){
                    $IPaddress = trim($IPaddress); // Just to be safe

                    if (filter_var($IPaddress,
                                   FILTER_VALIDATE_IP,
                                   FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
                        !== false) {

                        return $IPaddress;
                    }
                }
            }
        }
    }

    
    //FUNCTION TO CHANGE EXPIRED PASSWORD
    function ChangeExpiredPassword($emp_id, $newpassword){
        include ('../includes/config.php');
        
        $EncryptedPassword=md5($newpassword);
        $today=date('Y-m-d');
        
        //UPDATING NEW PASSWORD
        $query_change_password = "UPDATE users SET login_passwd = '$EncryptedPassword', password_changed_on = '$today' WHERE emp_id='$emp_id'";
        $result_change_password = mysqli_query($connect, $query_change_password);
        if(!$result_change_password){
            die("Unable to change password");
        }

        $result_note="Password Reset Done";
        return $result_note;
    }


    //FUNCTION TO CHECK OLD PASSWORD
    function check_old_password($emp_id, $oldpassword){
        include ('../includes/config.php');
        $EncryptedPassword=md5($oldpassword);
        
        $query="SELECT * FROM users WHERE emp_id='$emp_id'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        $actual_password=$row["login_passwd"];
        
        if($EncryptedPassword===$actual_password){
            return true;
        }else{
            return false;
        }
    }


    //FUNCTION TO DISPLAY CURRENCIES ON HEADER
    function dispaly_currencies($currency){
        include ('config.php');
        
        $query="SELECT * FROM ExchangeRates WHERE target_currency='$currency'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        
        return round($row["exchange_rate"],2);
    }

    //FUNCTION TO DISPLAY CURRENCY LAST UPDATED DATE
    function display_currency_update_date(){
        include ('config.php');
        
        $query="SELECT * FROM ExchangeRates";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        
        return $row["lastupdated_ts"];
    }

    //FUNCTION TO FIND ALL REFERENCE IDS OF COMPLETE QUOTE COLLECTION
    function find_all_emp_names_from_users_for_admin(){
        include "../../includes/config.php";

        $query = $connect->query("SELECT DISTINCT emp_name, emp_id FROM users ORDER BY emp_name");
        $emp_id_and_names = Array();
        $i=0;
        while($result = $query->fetch_assoc()) {
            $emp_id_and_names[$i][0] = $result['emp_id'];
            $emp_id_and_names[$i][1] = $result['emp_name'];
            $i++;
        }
        return $emp_id_and_names;
    }
    
    //FUNCTION TO FIND QUOTE APPROVAL ASSIGNED TO (RETURNS EMP ID OF ASSIGNED APPROVER)
    function approval_assigned_to_qgenerator_edit($refId, $verId){
        include "../includes/config.php";
        $query="SELECT approved_by_emp_id FROM LicenseGeneration WHERE license_reference_id='$refId' AND license_revision_id='$verId'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        return $row["approved_by_emp_id"];
    }
    
    //FUNCTION TO FIND REPORTING REGION - RETURNS YES/NO 
    function find_rep_area($empid){
        include "../includes/config.php";
        $query="SELECT reporting_india, reporting_me, reporting_apac, reporting_usa_europe, reporting_row FROM users WHERE emp_id='$empid'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        $areas=array();
        $areas['reporting_india']=$row['reporting_india'];
        $areas['reporting_me']=$row['reporting_me'];
        $areas['reporting_apac']=$row['reporting_apac'];
        $areas['reporting_usa_europe']=$row['reporting_usa_europe'];
        $areas['reporting_row']=$row['reporting_row'];
    
        return $areas;
    } 

	//FUNCTION TO FILL ALL EMP NAMES & EMP IDS FOR QUOTE TRANSFER
	function fill_user_data_in_new_owner(){
		include "../../includes/config.php";
		$query = $connect->query("SELECT * FROM users ORDER BY emp_id");
		$user_string="";
        while($result = $query->fetch_assoc()) {
			$user_string.="<option value='".$result['emp_id']."'>".$result['emp_id']." - ".$result['emp_name']." - ".$result['login_role']." </option>";
        }

        return $user_string;
	}

	//FUNCTION TO FIND QUOTE OWNER DETAILS FOR QUOTE TRANSFER
	function find_quote_owner_details($refId, $verId){
		include "../../includes/config.php";
		
		$query="SELECT users.emp_id, users.emp_name, users.login_name, users.login_department FROM users INNER JOIN LicenseGeneration ON users.login_name=LicenseGeneration.login_name WHERE LicenseGeneration.license_reference_id='$refId' AND LicenseGeneration.license_revision_id='$verId'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
		$row=mysqli_fetch_array($result);
		$current_quote_owner_details=array();
		$current_quote_owner_details["emp_id"]=$row["emp_id"];
		$current_quote_owner_details["emp_name"]=$row["emp_name"];
		$current_quote_owner_details["login_name"]=$row["login_name"];
		$current_quote_owner_details["login_department"]=$row["login_department"];
		
		return $current_quote_owner_details;
	}

	//FUNCTION TO FIND QUOTE DETAILS FOR QUOTE TRANSFER
	function find_quote_details_for_transfer($refId, $verId){
		include "../../includes/config.php";
		
		$crt_id=$refId."_".$verId;
		$query = "SELECT CustomerRequirements.cust_org_name, CustomerRequirements.cust_name, CustomerRequirements.partner, CustomerRequirements.option_tag FROM CustomerRequirements INNER JOIN LicenseGeneration ON CustomerRequirements.license_crt_id=LicenseGeneration.license_crt_id WHERE CustomerRequirements.license_crt_id='$crt_id'";
		
		$result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
		$row=mysqli_fetch_array($result);
		
		$transfer_quote_details=array();
		
		$transfer_quote_details["cust_org_name"]=$row["cust_org_name"];
		$transfer_quote_details["cust_name"]=$row["cust_name"];
		$transfer_quote_details["partner"]=$row["partner"];
		$transfer_quote_details["option_tag"]=$row["option_tag"];
		
		return($transfer_quote_details);
	}

	//FUNCTION TO UPDATE NEW QUOTE OWNER IN LGT
	function update_new_quote_owner($refId, $verId, $new_quote_owner){
		include "../../includes/config.php";
		
		$query = "SELECT login_name FROM users WHERE emp_id='$new_quote_owner'";
		$result = mysqli_query($connect, $query);
		if(!$result){
            die("Database Query Failed at USERS");
        }
		$row=mysqli_fetch_array($result);
		$new_quote_owner_login_name=$row["login_name"];
		$query = "UPDATE LicenseGeneration SET login_name = '$new_quote_owner_login_name', approved_by_emp_id = NULL, approved_ts ='0000-00-00 00:00:00' WHERE license_reference_id='$refId'";
		$result = mysqli_query($connect, $query);
		if(!$result){
            die("Database Query Failed at Quote Update");
        }else{
			return "Quote Transferred Successfully";
		}
	}

//	//FUNCTION TO FIND MAX DISCOUNT OF QUOTE FROM LHT FOR QUOTE TRANSFER
//	function find_max_discount_of_quote($refId, $verId){
//		include "../../includes/config.php";
//		
//		$lht_id=$refId."_".$verId;
//		$query="SELECT discountPercentageOnLicense, discountPercentageOnSupport, discountPercentageOnPS, discountPercentageOnTraining FROM LicenseHistory WHERE license_lht_id='$lht_id'";
//		$result = mysqli_query($connect, $query);
//        //CHECK IF QUERY EXECUTES OR NOT
//        if(!$result){
//            die("Database Query Failed");
//        }
//		$row=mysqli_fetch_array($result);
//		
//		return max($row["discountPercentageOnLicense"], $row["discountPercentageOnSupport"], $row["discountPercentageOnPS"], $row["discountPercentageOnTraining"]);
//	}
//
//	//FUNCTION TO FIND REPORTING MANAGER OF NEW QUOTE OWNER BASED ON MAX DISCOUNT OF QUOTE FOR QUOTE TRANSFER
//	function find_rep_manager_of_new_quote_owner($max_discount_in_quote, $new_quote_owner){
//		include "../../includes/config.php";
//		
//		//FINDING REPORTING MANAGER OF NEW QUOTE OWNER
//		$query="SELECT reporting_manager FROM users WHERE emp_id='$new_quote_owner'";
//		$result = mysqli_query($connect, $query);
//        //CHECK IF QUERY EXECUTES OR NOT
//        if(!$result){
//            die("Database Query Failed");
//        }
//		$row=mysqli_fetch_array($result);
//		$rep_manager=$row["reporting_manager"];
//		
////		echo "Rep Manager - ".$rep_manager."<br>";
//		//FINDING ROLE OF REPORTING MANAGER
//		$query="SELECT login_role FROM users WHERE emp_id='$rep_manager'";
//		$result = mysqli_query($connect, $query);
//        //CHECK IF QUERY EXECUTES OR NOT
//        if(!$result){
//            die("Database Query Failed");
//        }
//		$row=mysqli_fetch_array($result);
//		$rep_manager_role=$row["login_role"];
//		
////		echo "Rep Manager Role - ".$rep_manager_role."<br>";
//		
//		//FINDING MAX AND MIN APPROVAL DISCOUNT RANGE OF REPORTING MANAGER
//		$query="SELECT MaxDiscount, MinDiscount FROM UserRoles WHERE UserRole='$rep_manager_role'";
//		$result = mysqli_query($connect, $query);
//        //CHECK IF QUERY EXECUTES OR NOT
//        if(!$result){
//            die("Database Query Failed");
//        }
//		$row=mysqli_fetch_array($result);
//		$MaxDiscount=$row["MaxDiscount"];
//		$MinDiscount=$row["MinDiscount"];
//		
//		if($max_discount_in_quote<=$MaxDiscount && $max_discount_in_quote>=$MinDiscount){
//			echo "Reporting Manager - ".$rep_manager."<br>";
//		}else{
//			return find_rep_manager_of_new_quote_owner($max_discount_in_quote, $rep_manager);
//		}
//		
//		
//	}
?>