<?php
    function find_all_ref_ids_from_lgt_search($username,$SearchOn,$Key){
        if ($SearchOn=="Opportunity"){
          $SearchField="cust_org_name";  
        }else if($SearchOn=="Customer"){
          $SearchField="cust_name";  
        }else{
          $SearchField="partner";  
        }
        include "../includes/config.php";
        $query = "SELECT DISTINCT LicenseGeneration.license_reference_id FROM LicenseGeneration INNER JOIN CustomerRequirements ON LicenseGeneration.license_crt_id = CustomerRequirements.license_crt_id WHERE LicenseGeneration.login_name='$username' and CustomerRequirements.$SearchField LIKE '%$Key%'";
//        echo $query;
        $query = $connect->query("SELECT DISTINCT LicenseGeneration.license_reference_id FROM LicenseGeneration INNER JOIN CustomerRequirements ON LicenseGeneration.license_crt_id = CustomerRequirements.license_crt_id WHERE LicenseGeneration.login_name='$username' and CustomerRequirements.$SearchField LIKE '%$Key%'");
        $ref_ids = array();
        while($result = $query->fetch_assoc()) {
            $ref_ids[] =  $result['license_reference_id'];  
        }
        
        $reversed = array_reverse($ref_ids);

        return $reversed;
    }
    //FUNCTION TO FIND ALL REFERENCE IDS OF COMPLETE QUOTE COLLECTION
    function find_all_ref_ids_from_lgt_full_collection(){
        include "../includes/config.php";

//        $query = $connect->query("SELECT DISTINCT license_reference_id FROM LicenseGeneration");
        $query = $connect->query("SELECT DISTINCT LicenseGeneration.license_reference_id, users.emp_name FROM users INNER JOIN LicenseGeneration ON users.login_name = LicenseGeneration.login_name");
        $ref_ids = Array();
//        $emp_names = Array();
        $i=0;
        while($result = $query->fetch_assoc()) {
            $ref_ids[$i][0] =  $result['license_reference_id'];
            $ref_ids[$i][1] = $result['emp_name'];
            $i++;
        }
//        print_r($ref_ids);
        $reversed = array_reverse($ref_ids);

        return $reversed;
    }

    //FUNCTION TO FIND ALL REFERENCE ID CREATED BY PARTICULAR USER NAME
    function find_all_ref_ids_from_lgt($user){
        include "../includes/config.php";

        $query = $connect->query("SELECT DISTINCT license_reference_id FROM LicenseGeneration WHERE login_name='$user'");
        $ref_ids = Array();
        while($result = $query->fetch_assoc()) {
            $ref_ids[] =  $result['license_reference_id'];  
        }

        $reversed = array_reverse($ref_ids);

        return $reversed;
    }

    //FUNCTION TO FIND ALL REFERENCE ID CREATED BY QUOTE REQUESTOR WHOSE STATUS IS DRAFT (INNER JOIN USERS AND LGT)
    function find_all_ref_ids_from_lgt_and_users(){
        include "../includes/config.php";

        $query = $connect->query("SELECT DISTINCT LicenseGeneration.license_reference_id FROM users INNER JOIN LicenseGeneration ON users.login_name = LicenseGeneration.login_name WHERE users.login_role='Quote Requestor' AND LicenseGeneration.status='Draft'");
        $ref_ids = Array();
        while($result = $query->fetch_assoc()) {
            $ref_ids[] =  $result['license_reference_id'];  
        }

        $reversed = array_reverse($ref_ids);
        return $reversed;
    }

    //FUNCTION TO FIND COMPANY OF PARTICULAR REFERENCE ID
    function find_company_name($ref_id){
        include "../includes/config.php";
        $query="SELECT license_crt_id FROM LicenseGeneration WHERE license_reference_id = '$ref_id' LIMIT 1";
        $result=mysqli_query($connect,$query);
        if(!$result){
            die("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        $crt_id=$row["license_crt_id"];
        //FINDING COMPANY NAME USING CRT_ID
        $query="SELECT cust_org_name FROM CustomerRequirements WHERE license_crt_id='$crt_id'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            die("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        return $row["cust_org_name"];
    }

    //FUNCTION TO FIND ALL VERSION IDs ASSOCIATED WITH A PARTICULAR REFERENCE ID
    function find_all_version_ids($ref_id){
        include "../includes/config.php";

        $query = $connect->query("SELECT DISTINCT license_revision_id FROM LicenseGeneration WHERE license_reference_id='$ref_id';");
        $license_revision_id = Array();
        while($result = $query->fetch_assoc()) {
            $license_revision_id[] =  $result['license_revision_id'];  
        }
        return $license_revision_id;
    }

    //FUNCTION TO FIND PRODUCT MODULE, CUSTOMER CURRENCY
    function find_data_from_crt_for_dashboard($ref_id, $ver_id){
        include "../includes/config.php";

        $crt_id=$ref_id."_".$ver_id; //CREATING CRT ID

        //FINDING COMPANY NAME USING CRT_ID
        $query="SELECT cust_currency, product_module, cust_name, partner, country FROM CustomerRequirements WHERE license_crt_id='$crt_id'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            die("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        $details["product_module"]=$row["product_module"];
        $details["cust_currency"]=$row["cust_currency"];
        $details["cust_name"]=$row["cust_name"];
        $details["partner"]=$row["partner"];
        $details["country"]=$row["country"];
        
        return $details;
    }

    //FUNCTION TO FIND LHT DETAILS FOR DASHBOARD
    function find_list_price_from_lht_for_dashboard($ref_id, $ver_id){
        include "../includes/config.php";

        $lht_id=$ref_id."_".$ver_id; //CREATING CRT ID

        //FINDING COMPANY NAME USING CRT_ID
        $query="SELECT totalValue FROM LicenseHistory WHERE license_lht_id='$lht_id'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            die("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        return $row["totalValue"];
    }

    //FUNCTION TO FIND LGT DETAILS FOR DASHBOARD
    function find_data_from_lgt_for_dashboard($ref_id, $ver_id){
        include "../includes/config.php";

        //FINDING COMPANY NAME USING CRT_ID
        $query="SELECT status, license_generation_date, approved_by_emp_id, approved_ts FROM LicenseGeneration WHERE license_reference_id='$ref_id' AND license_revision_id='$ver_id'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            die("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        $details["license_generation_date"]=$row["license_generation_date"];
        $details["status"]=$row["status"];
        $details["approved_by_emp_id"]=$row["approved_by_emp_id"];
        $details["approved_ts"]=$row["approved_ts"];
        
        return $details;
    }

    //FUNCTION TO FIND EMP NAME FROM EMP ID
    function find_emp_name_from_users($emp_id){
        include "../includes/config.php";
        $query="SELECT emp_name FROM users WHERE emp_id='$emp_id'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            die("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        return $row["emp_name"];
    }
	
	//FUNCTION TO FIND EMP NAME FROM EMAIL ID
    function find_emp_name_from_users_with_email_id($email_id){
        include "../includes/config.php";
        $query="SELECT emp_name FROM users WHERE email_id='$email_id'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            die("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        return $row["emp_name"];
    }

    //FUNCTION TO FIND THE STATUS OF QUOTE
    function find_quote_status_from_lht($ref_id, $ver_id){
        include "../includes/config.php";
        $query="SELECT status FROM LicenseGeneration WHERE license_reference_id='$ref_id' AND license_revision_id='$ver_id'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            die("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        return $row["status"];
    }
  
    function finalize_quote_generated_by_QR($ref_id, $ver_id){
        include "../includes/config.php";
        date_default_timezone_set("Asia/Kolkata"); //SETTING INDIAN TIME ON SERVER
        $approved_ts = date('Y-m-d H:i:s'); //SETTING DATE AND TIME FORMAT
        $approved_by_emp_id=$_SESSION["emp_id"];
        
        $query = "UPDATE LicenseGeneration SET status = 'Finalized', approved_by_emp_id='$approved_by_emp_id', approved_ts='$approved_ts' WHERE license_reference_id='$ref_id' AND license_revision_id='$ver_id'";
        $result = mysqli_query($connect, $query);
        if(!$result){
            return "Unknown Error. Please contact Administrator";
        }
        return "Successful";
    }
    
    //FUNCTION TO FIND ALL REFERENCE IDS FROM LGT WITH 5 LIMITED
    function find_all_ref_ids_from_lgt_recent($user){
        include "../includes/config.php";

        $query = $connect->query("SELECT DISTINCT license_reference_id FROM LicenseGeneration WHERE login_name =  '$user' ORDER BY `license_generation_date` DESC LIMIT 5");
        $ref_ids = Array();
        while($result = $query->fetch_assoc()) {
            $ref_ids[] =  $result['license_reference_id'];  
        }

        $reversed = array_reverse($ref_ids);

        return $ref_ids;
    }

    //3)FUNCTION TO FIND ROLE OF A LOGIN NAME
    function find_role_from_login_name($login_name){
        include "../includes/config.php";
        
        $query="SELECT login_role FROM users WHERE login_name='$login_name'";
        $result = mysqli_query($connect, $query);
        $row=mysqli_fetch_array($result);
        $login_role=$row["login_role"];
        
        return $login_role;
        
    }

    //2)FINDING ALL LOGIN NAMES FOR APPROVAL/REPORTING MANAGER
    function find_all_login_names_reporting_to_approver($approver){
        include "../includes/config.php";
        $query = $connect->query("SELECT DISTINCT login_name,emp_id FROM users WHERE reporting_manager='$approver'");
        $login_names = array();
        $emp_id = array();
        while($result = $query->fetch_assoc()) {
            $login_names[] =  $result['login_name'];
            $emp_id[]=$result['emp_id'];
        }
        $no_of_login_names= count($login_names);
        for($i=0;$i<$no_of_login_names;$i++){
            if(find_role_from_login_name($login_names[$i])=="Quote Requestor"){
                
            }else{
                $login_names=array_merge($login_names, find_all_login_names_reporting_to_approver($emp_id[$i]));
            }
            
        }
        return $login_names;
    }

    //4)FINDING ALL REF IDS CREATED BY ONE LOGIN NAME
    function find_all_ref_ids_created_by_login_name($login_name){
        include "../includes/config.php";
        if($login_name=="QuoteRequestor"){
            $query = $connect->query("SELECT DISTINCT LicenseGeneration.license_reference_id, LicenseHistory.discountPercentageOnLicense, LicenseHistory.discountPercentageOnSupport, LicenseHistory.discountPercentageOnPS, LicenseHistory.discountPercentageOnTraining FROM LicenseGeneration INNER JOIN LicenseHistory ON LicenseGeneration.license_lht_id=LicenseHistory.license_lht_id WHERE LicenseGeneration.login_name='$login_name' AND LicenseGeneration.status='Draft'"); 
        }else{
            $query = $connect->query("SELECT DISTINCT LicenseGeneration.license_reference_id, LicenseHistory.discountPercentageOnLicense, LicenseHistory.discountPercentageOnSupport, LicenseHistory.discountPercentageOnPS, LicenseHistory.discountPercentageOnTraining FROM LicenseGeneration INNER JOIN LicenseHistory ON LicenseGeneration.license_lht_id=LicenseHistory.license_lht_id WHERE LicenseGeneration.login_name='$login_name' AND LicenseGeneration.status='Discount'");
        }
        $license_reference_discount = array();
        $max_discount = array();
        $i=0;
        while($result = $query->fetch_assoc()) {
            $license_reference_discount[$i][0] =  $result['license_reference_id'];
            $license_reference_discount[$i][1] = max($result['discountPercentageOnLicense'], $result['discountPercentageOnSupport'], $result['discountPercentageOnPS'], $result['discountPercentageOnTraining']);
            $i++;
        }
        return $license_reference_discount;
    }

    //1)FUNCTION TO FIND RERERENCE IDS FOR APPROVAL
    function find_all_ref_ids_for_approal($approver){
        include "../includes/config.php";
        $all_ref_ids=(find_all_login_names_reporting_to_approver($approver));
//        $all_ref_ids=(find_all_login_names_reporting_to_approver("SAN004"));
        $no_of_all_ref_ids=count($all_ref_ids);
        $filtered_all_ref_ids=array();
        $approval_ref_ids=array();
        for ($i=0; $i<$no_of_all_ref_ids; $i++){
            $filtered_all_ref_ids=array_merge($filtered_all_ref_ids,find_all_ref_ids_created_by_login_name($all_ref_ids[$i]));
        }
        $approver_role=$_SESSION["userrole"];
        $query="SELECT MaxDiscount, MinDiscount FROM UserRoles WHERE UserRole='$approver_role'";
//        $query="SELECT MaxDiscount, MinDiscount FROM UserRoles WHERE UserRole='Sales Director'";
        $result = mysqli_query($connect, $query);
        $row=mysqli_fetch_array($result);
        $MaxDiscount=$row["MaxDiscount"];
        $MinDiscount=$row["MinDiscount"];
        
        $j=0;
        $no_of_filtered_all_ref_ids=count($filtered_all_ref_ids);
        for($i=0;$i<$no_of_filtered_all_ref_ids; $i++){
            if($filtered_all_ref_ids[$i][1]<=$MaxDiscount && $filtered_all_ref_ids[$i][1]>=$MinDiscount){
                $approval_ref_ids[$j]=$filtered_all_ref_ids[$i][0];
                $j++;
            }
        }
        return array_reverse($approval_ref_ids);
//        return $filtered_all_ref_ids;
    }

    function find_qgenerator_emailid($ref_id, $ver_id){
        include "../includes/config.php";
        $query = "SELECT users.email_id FROM users INNER JOIN LicenseGeneration ON LicenseGeneration.login_name=users.login_name WHERE LicenseGeneration.license_reference_id='$ref_id' AND LicenseGeneration.license_revision_id='$ver_id'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            die("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        return $row["email_id"];
    }
	
	//FUNCTION TO FIND ALL REFERENCE IDS APPROVED BY MANAGERS
	function find_all_ref_ids_from_lgt_approved_by_managers($emp_id){
		include "../includes/config.php";
        $query = $connect->query("SELECT DISTINCT license_reference_id FROM LicenseGeneration WHERE approved_by_emp_id='$emp_id' AND NOT approved_ts='0000-00-00 00:00:00'");
        $refIds = array();
        while($result = $query->fetch_assoc()) {
            $refIds[] =  $result['license_reference_id'];
        }
		return $refIds;
	}
?>