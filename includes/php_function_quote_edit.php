<?php
    //FUNCTION TO DELETE QUOTE
    function delete_quote($refNo, $verNo){
        include ("../includes/config.php");
        $query_lgt="DELETE FROM LicenseGeneration WHERE license_reference_id='$refNo' AND license_revision_id='$verNo'";
        $result_lgt=mysqli_query($connect, $query_lgt);
        
        $license_crt_id=$refNo."_".$verNo;
        $query_crt="DELETE FROM CustomerRequirements WHERE license_crt_id='$license_crt_id'";
        $result_crt=mysqli_query($connect, $query_crt);
        
        $license_lht_id=$refNo."_".$verNo;
        $query_lht="DELETE FROM LicenseHistory WHERE license_lht_id='$license_lht_id'";
        $result_lht=mysqli_query($connect, $query_lht);
        
        if(!$result_lgt || !$result_crt || !$result_lht){
            return "Error Deleting Quote! Please contact Admin";
        }else{
            return "Quote Deleted Successfully";
        }
    }

    //FUNCTION TO FIND EXISTANCE OF QUOTE
    function is_valid_quote($refNo, $verNo){
        include ("../includes/config.php");
        $query="SELECT * FROM LicenseGeneration WHERE license_reference_id='$refNo' AND license_revision_id='$verNo'";
        $result=mysqli_query($connect, $query);
        if(!$result){
            echo "Database Query Failed";
        }
        $number_of_rows=mysqli_num_rows($result);
        if($number_of_rows==0){
            return "Quote Not Found to find valid quote";
        }else if($number_of_rows==1){
            return "Quote Found";
        }else{
            return "Unknown Database Error! Contact Administrator";
        }
    }

    //FUNCTION TO FIND QUOTE CREATED USER - USED IN QUOTE_DELETE.PHP
    function find_quote_created_user_to_delete($refNo, $verNo){
        include ("../includes/config.php");
        $query="SELECT login_name FROM LicenseGeneration WHERE license_reference_id='$refNo' AND license_revision_id='$verNo'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            echo "Database Query Failed";
        }
        $row=mysqli_fetch_array($result);
        return $row["login_name"];
    }

    //FUNCTION TO FIND QUOTE CREATED USER
    function find_quote_created_user_quote_edit($refNo, $verNo){
        include ("../includes/config.php");
        $query="SELECT login_name FROM LicenseGeneration WHERE license_reference_id='$refNo' AND license_revision_id='$verNo'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            echo "Database Query Failed";
        }
        $row=mysqli_fetch_array($result);
        return $row["login_name"];
    }

    //FUNCTION TO FIND QUOTE CREATED USER
    function find_quote_created_user($refNo, $verNo){
        include ("../../includes/config.php");
        $query="SELECT login_name FROM LicenseGeneration WHERE license_reference_id='$refNo' AND license_revision_id='$verNo'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            echo "Database Query Failed";
        }
        $row=mysqli_fetch_array($result);
        return $row["login_name"];
    }

    //FUNCTION TO FIND QUOTE CREATED USER
    function find_quote_created_user_for_approval($refNo, $verNo){
        include ("../includes/config.php");
        $query="SELECT login_name FROM LicenseGeneration WHERE license_reference_id='$refNo' AND license_revision_id='$verNo'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            echo "Database Query Failed";
        }
        $row=mysqli_fetch_array($result);
        return $row["login_name"];
    }

    //FUNCTION TO FIND QUOTE CREATED DATE
    function find_quote_created_date($refNo, $verNo){
        include ("../includes/config.php");
        $query="SELECT license_generation_date FROM LicenseGeneration WHERE license_reference_id='$refNo' AND license_revision_id='$verNo'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            echo "Database Query Failed at Date";
        }
        $row=mysqli_fetch_array($result);
        return $row["license_generation_date"];
    }

    //FUNCTION TO FIND QUOTE STATUS FOR DELETING
    function find_quote_status_to_delete($refNo, $verNo){
        include ("../includes/config.php");
        $query="SELECT status FROM LicenseGeneration WHERE license_reference_id='$refNo' AND license_revision_id='$verNo'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            echo "Database Query Failed";
        }
        $row=mysqli_fetch_array($result);
        return $row["status"];
    }

    //FUNCTION TO FIND QUOTE STATUS
    function find_quote_status($refNo, $verNo){
        include ("../../includes/config.php");
        $query="SELECT status FROM LicenseGeneration WHERE license_reference_id='$refNo' AND license_revision_id='$verNo'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            echo "Database Query Failed";
        }
        $row=mysqli_fetch_array($result);
        return $row["status"];
    }

    //FUNCTION TO PULL FROM LGT-NEW QUOTE
    function NewQuote_lgt_values($refNo,$verNo){
        include ("../../includes/config.php");
        $query="select * from LicenseGeneration where license_reference_id='$refNo' and license_revision_id='$verNo'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            echo "Database Query Failed";
        }
        $row=mysqli_fetch_array($result);
        $details=array();
        $details['date']=$row['license_generation_date'];
        return $details;
    }

    
    //FUNCTION TO PULL FROM LHT-NEW QUOTE
    function NewQuote_lht_values($refNo, $verNo){
        include ("../../includes/config.php");
        $refNo_verNo=$refNo."_".$verNo;
        $query="select * from LicenseHistory where license_lht_id='$refNo_verNo'";
        $result=mysqli_query($connect,$query);
        if(!$result){
            echo "Database Query Failed";
        }
        $row=mysqli_fetch_array($result);
        $details=array();
        $details["licenseCost"]=$row["licenseCost"];
        $details["productSupportCost"]=$row["productSupportCost"];
        $details["PSCost"]=$row["PSCost"];
        $details["trainingCost"]=$row["trainingCost"];
        
        $details["discountPercentageOnLicense"]=$row["discountPercentageOnLicense"];
        $details["discountPercentageOnSupport"]=$row["discountPercentageOnSupport"];
        $details["discountPercentageOnPS"]=$row["discountPercentageOnPS"];
        $details["discountPercentageOnTraining"]=$row["discountPercentageOnTraining"];
        
        $details["finalLicenseCost"]=$row["finalLicenseCost"];
        $details["finalSupportCost"]=$row["finalSupportCost"];
        $details["finalPSCost"]=$row["finalPSCost"];
        $details["finalTrainingCost"]=$row["finalTrainingCost"];
        
        $details["totalValue"]=$row["totalValue"];
//        print_r ($details);
        return $details;
    }

       function remove_null($arrayName){
       $a=0;
        $temp=array();
        $count=count($arrayName);
        for($i=0;$i<=$count+1;$i++){
        if(!(is_null(@$arrayName[$i][0]))){
           if(@$arrayName[$i][1]>0){
            @$temp[$a][0]=@$arrayName[$i][0];
            @$temp[$a][1]=@$arrayName[$i][1];
            $a++;
           }
        }
        }
        return $temp;
    } 

    function currency_format($value,$currency){
        switch ($currency){
            case "USD": 
                     setlocale(LC_MONETARY, 'en_US');
                     return  money_format('%=*(#10.0i', $value);  
                     break;
        
            case "INR":    
                     setlocale(LC_MONETARY, 'en_IN');
                     return money_format("%=*(#10.0i", $value);
                     break;    
                     
            case "AED":    
                     setlocale(LC_MONETARY, 'ar_AE');
                     return money_format('%=*(#10.0i', $value);
                     break;
            case "SGD":
                     setlocale(LC_MONETARY, 'zh_SG');
                     return money_format('%=*(#10.0i', $value);
                     break;
        }
            
        
        
    }
    function masterServerLicense(){
        include ("../../includes/config.php");
        $temp=array();
//        $license=$_SESSION['license'];
        $ModeOfSale=$_SESSION['modeofsale'];
        $Country=$_SESSION['Country'];
        $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='License' and country='$Country' and license_type='$license'";
             $result=mysqli_query($connect,$query); 
                if ($result->num_rows > 0) {
                while($row=mysqli_fetch_array($result)){
                    $i=0;$j=0;
                        $temp[$i][$j]=$row['part_number'];
                        $j++;
                        $temp[$i][$j]=$row['part_desc'];
                        $j++;
                        $temp[$i][$j]='1';
                        $j++;
                        $temp[$i][$j]=$row['base_price'];
                    }
                    return $temp;
                }
    }
    function masterServerProf(){
        include ("../../includes/config.php");
        $temp=array();
        $ModeOfSale=$_SESSION['modeofsale'];
        $Country=$_SESSION['Country'];
//        $license=$_SESSION['license'];
//        $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='Professional_services' and country='$Country'";
         $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='Professional_services' and country='$Country'";
             $result=mysqli_query($connect,$query); 
                if ($result->num_rows > 0) {
                while($row=mysqli_fetch_array($result)){
                    $i=0;$j=0;
                        $temp[$i][$j]=$row['part_number'];
                        $j++;
                        $temp[$i][$j]=$row['part_desc'];
                        $j++;
                        $temp[$i][$j]='1';
                        $j++;
                        $temp[$i][$j]=$row['base_price'];
                    }
                    return $temp;
                }
    }
    function masterServerproduct(){
        include ("../../includes/config.php");
        $temp=array();
        $ModeOfSale=$_SESSION['modeofsale'];
        $Country=$_SESSION['Country'];
//        $license=$_SESSION['license'];
         $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='Product_support' and country='$Country' and license_type='$license'";
             $result=mysqli_query($connect,$query); 
                if ($result->num_rows > 0) {
                while($row=mysqli_fetch_array($result)){
                    $i=0;$j=0;
                        $temp[$i][$j]=$row['part_number'];
                        $j++;
                        $temp[$i][$j]=$row['part_desc'];
                        $j++;
                        $temp[$i][$j]='1';
                        $j++;
                        $temp[$i][$j]=$row['base_price'];
                    }
                    return $temp;
                }
    }

    function fetch_crt_2s_data($crt_id){
    include ("../../includes/config.php");
    $query="SELECT * FROM CustomerRequirements WHERE license_crt_id='$crt_id'";
    $result=mysqli_query($connect ,$query);
    if(!$result){
        echo "Database Query Failed";
    }
    
    $row=mysqli_fetch_array($result);
    
    //Qty
    $details["0"]["1"]=$row["2s_noOfVmImages"];
    $details["1"]["1"]=$row["2s_noOfVmDatabases"];
    $details["2"]["1"]=$row["2s_noOfBareMetalWinLinuxServers"];
    $details["3"]["1"]=$row["2s_noOfBareMetalWinLinuxDatabases"];
    $details["4"]["1"]=$row["2s_noOfBareMetalUnixServers"];
    $details["5"]["1"]=$row["2s_noOfBareMetalUnixDatabases"];
    $details["6"]["1"]=$row["2s_noOfVirtualSharePointServers"];
    $details["7"]["1"]=$row["2s_noOfSharePointServers"];
    $details["8"]["1"]=$row["2s_noOfVirtualMSExchangeDatabases"];
    $details["9"]["1"]=$row["2s_noOfMSExchangeDatabases"];
    $details["10"]["1"]=$row["2s_noOfVirtualServersUsingAdvancedReplication"];
    $details["11"]["1"]=$row["2s_noOfUsingAdvancedReplication"];
    $details["12"]["1"]=$row["2s_noOfServersForPFRReplication"];
    $details["13"]["1"]=$row["2s_noOfSAPHANADatabases"];
    $details["14"]["1"]=$row["2s_noOfSAPHANANodes"];

    //Questions
    $details["0"]["0"]=$row["noOfVmImages_2s"];
    $details["1"]["0"]=$row["noOfVmDatabases_2s"];
    $details["2"]["0"]=$row["noOfBareMetalWinLinuxServers_2s"];
    $details["3"]["0"]=$row["noOfBareMetalWinLinuxDatabases_2s"];
    $details["4"]["0"]=$row["noOfBareMetalUnixServers_2s"];
    $details["5"]["0"]=$row["noOfBareMetalUnixDatabases_2s"];
    $details["6"]["0"]=$row["noOfVirtualSharePointServers_2s"];
    $details["7"]["0"]=$row["noOfSharePointServers_2s"];
    $details["8"]["0"]=$row["noOfVirtualMSExchangeDatabases_2s"];
    $details["9"]["0"]=$row["noOfMSExchangeDatabases_2s"];
    $details["10"]["0"]=$row["noOfVirtualServersUsingAdvancedReplication_2s"];
    $details["11"]["0"]=$row["noOfUsingAdvancedReplication_2s"];
    $details["12"]["0"]=$row["noOfServersForPFRReplication_2s"];
    $details["13"]["0"]=$row["noOfSAPHANADatabases_2s"];
    $details["14"]["0"]=$row["noOfSAPHANANodes_2s"];
    
    return $details;
}

function fetch_crt_3s_data($crt_id){
    include ("../../includes/config.php");
    $query="SELECT * FROM CustomerRequirements WHERE license_crt_id='$crt_id'";
    $result=mysqli_query($connect ,$query);
    if(!$result){
        echo "Database Query Failed";
    }
    
    $row=mysqli_fetch_array($result);
    
    //Qty
    $details["0"]["1"]=$row["3s_isBunkerSite"];
    $details["1"]["1"]=$row["3s_noOfServersInBunkerSite"];
    $details["2"]["1"]=$row["3s_noOfVmImages"];
    $details["3"]["1"]=$row["3s_noOfVmDatabases"];
    $details["4"]["1"]=$row["3s_noOfBareMetalWinLinuxServers"];
    $details["5"]["1"]=$row["3s_noOfBareMetalWinLinuxDatabases"];
    $details["6"]["1"]=$row["3s_noOfBareMetalUnixServers"];
    $details["7"]["1"]=$row["3s_noOfBareMetalUnixDatabases"];
    $details["8"]["1"]=$row["3s_noOfVirtualSharePointServers"];
    $details["9"]["1"]=$row["3s_noOfSharePointServers"];
    $details["10"]["1"]=$row["3s_noOfVirtualMSExchangeDatabases"];
    $details["11"]["1"]=$row["3s_noOfMSExchangeDatabases"];
    $details["12"]["1"]=$row["3s_noOfVirtualServersUsingAdvancedReplication"];
    $details["13"]["1"]=$row["3s_noOfUsingAdvancedReplication"];
    $details["14"]["1"]=$row["3s_noOfServersForPFRReplication"];
    $details["15"]["1"]=$row["3s_noOfSAPHANADatabases"];
    $details["16"]["1"]=$row["3s_noOfSAPHANANodes"];

    //Questions
    $details["0"]["0"]=$row["isBunkerSite_3s"];
    $details["1"]["0"]=$row["noOfServersInBunkerSite_3s"];
    $details["2"]["0"]=$row["noOfVmImages_3s"];
    $details["3"]["0"]=$row["noOfVmDatabases_3s"];
    $details["4"]["0"]=$row["noOfBareMetalWinLinuxServers_3s"];
    $details["5"]["0"]=$row["noOfBareMetalWinLinuxDatabases_3s"];
    $details["6"]["0"]=$row["noOfBareMetalUnixServers_3s"];
    $details["7"]["0"]=$row["noOfBareMetalUnixDatabases_3s"];
    $details["8"]["0"]=$row["noOfVirtualSharePointServers_3s"];
    $details["9"]["0"]=$row["noOfSharePointServers_3s"];
    $details["10"]["0"]=$row["noOfVirtualMSExchangeDatabases_3s"];
    $details["11"]["0"]=$row["noOfMSExchangeDatabases_3s"];
    $details["12"]["0"]=$row["noOfVirtualServersUsingAdvancedReplication_3s"];
    $details["13"]["0"]=$row["noOfUsingAdvancedReplication_3s"];
    $details["14"]["0"]=$row["noOfServersForPFRReplication_3s"];
    $details["15"]["0"]=$row["noOfSAPHANADatabases_3s"];
    $details["16"]["0"]=$row["noOfSAPHANANodes_3s"];
    
//    print_r($details);
    return $details;
}

function fetch_crt_prof_data($crt_id){
    include ("../../includes/config.php");
    $query="SELECT * FROM CustomerRequirements WHERE license_crt_id='$crt_id'";
    $result=mysqli_query($connect ,$query);
    if(!$result){
        echo "Database Query Failed";
    }
    
    $row=mysqli_fetch_array($result);
    
    //Qty
    $details["0"]["1"]=$row["areProfessionalServicesRequired"];
    $details["1"]["1"]=$row["Prof_serviceType"];
    $details["2"]["1"]=$row["Prof_noOfVmImages"];
    $details["3"]["1"]=$row["Prof_noOfVmDatabases"];
    $details["4"]["1"]=$row["Prof_noOfBareMetalWinLinuxServers"];
    $details["5"]["1"]=$row["Prof_noOfBareMetalWinLinuxDatabases"];
    $details["6"]["1"]=$row["Prof_noOfBareMetalUnixServers"];
    $details["7"]["1"]=$row["Prof_noOfBareMetalUnixDatabases"];
    $details["8"]["1"]=$row["Prof_noOfUsingAdvancedReplication"];
    $details["9"]["1"]=$row["Prof_noOfVirtualServersUsingAdvancedReplication"];
    $details["10"]["1"]=$row["Prof_noOfSharePointServers"];
    $details["11"]["1"]=$row["Prof_noOfSharePointDatabases"];
    $details["12"]["1"]=$row["Prof_noOfVirtualSharePointServers"];
    $details["13"]["1"]=$row["Prof_noOfVirtualSharePointDatabases"];
    $details["14"]["1"]=$row["Prof_noOfMSExchangeDatabases"];
    $details["15"]["1"]=$row["Prof_noOfVirtualMSExchangeDatabases"];
    $details["16"]["1"]=$row["Prof_PremiseProductTraining"];
    $details["17"]["1"]=$row["Prof_noOfSAPHANADatabases"];
    $details["18"]["1"]=$row["Prof_noOfSAPHANANodes"];

    //Questions
    $details["0"]["0"]=$row["areProfessionalServicesRequired_Q"];
    $details["1"]["0"]=$row["serviceType_Prof"];
    $details["2"]["0"]=$row["noOfVmImages_Prof"];
    $details["3"]["0"]=$row["noOfVmDatabases_Prof"];
    $details["4"]["0"]=$row["noOfBareMetalWinLinuxServers_Prof"];
    $details["5"]["0"]=$row["noOfBareMetalWinLinuxDatabases_Prof"];
    $details["6"]["0"]=$row["noOfBareMetalUnixServers_Prof"];
    $details["7"]["0"]=$row["noOfBareMetalUnixDatabases_Prof"];
    $details["8"]["0"]=$row["noOfUsingAdvancedReplication_Prof"];
    $details["9"]["0"]=$row["noOfVirtualServersUsingAdvancedReplication_Prof"];
    $details["10"]["0"]=$row["noOfSharePointServers_Prof"];
    $details["11"]["0"]=$row["noOfSharePointDatabases_Prof"];
    $details["12"]["0"]=$row["noOfVirtualSharePointServers_Prof"];
    $details["13"]["0"]=$row["noOfVirtualSharePointDatabases_Prof"];
    $details["14"]["0"]=$row["noOfMSExchangeDatabases_Prof"];
    $details["15"]["0"]=$row["noOfVirtualMSExchangeDatabases_Prof"];
    $details["16"]["0"]=$row["OnPremiseProductTrainingReqd_Prof"];
    $details["17"]["0"]=$row["noOfSAPHANADatabases_Prof"];
    $details["18"]["0"]=$row["noOfSAPHANANodes_Prof"];
    return $details;
}

function fetch_crt_prod_support_years($crt_id){
    include ("../../includes/config.php");
    $query="SELECT yearsOfSupport FROM CustomerRequirements WHERE license_crt_id='$crt_id'";
    $result=mysqli_query($connect ,$query);
    if(!$result){
        echo "Database Query Failed";
    }
    
    $row=mysqli_fetch_array($result);
    
    //Qty
    $details=$row["yearsOfSupport"];
    
    return $details;
}

function fetch_lgt_data($refId, $verId){
    include ("../../includes/config.php");
    $query = "SELECT * FROM LicenseGeneration WHERE license_reference_id='$refId' AND license_revision_id='$verId'";
    $result=mysqli_query($connect, $query);
    if(!$result){
        echo "Database query failed";
    }
    
    $row=mysqli_fetch_array($result);
    
    $details["login_name"]=$row["login_name"];
    $details["license_generation_date"]=$row["license_generation_date"];
    $details["license_crt_id"]=$row["license_crt_id"];
    $details["license_lht_id"]=$row["license_lht_id"];
    $details["status"]=$row["status"];
    
    return $details;
    
}

function fetch_crt_customer_data($crt_id){
    include ("../../includes/config.php");
    $query="SELECT * FROM CustomerRequirements WHERE license_crt_id='$crt_id'";
    $result=mysqli_query($connect ,$query);
    if(!$result){
        echo "Database Query Failed";
    }
    
    $row=mysqli_fetch_array($result);
    
    $details["license_crt_id"]=$row["license_crt_id"];
    $details["product"]=$row["product"];
    $details["license_type"]=$row["license_type"];
    $details["country"]=$row["country"];
    $details["cust_currency"]=$row["cust_currency"];
    $details["cust_org_name"]=$row["cust_org_name"];
    $details["cust_name"]=$row["cust_name"];
    $details["mode_of_sale"]=$row["mode_of_sale"];
    $details["product_module"]=$row["product_module"];
//    print_r($details);
    return $details;
}

function fetch_lht_data($lht_id){
    include ("../../includes/config.php");
    $query="SELECT * FROM LicenseHistory WHERE license_lht_id='$lht_id'";
    $result=mysqli_query($connect ,$query);
    if(!$result){
        echo "Database Query Failed";
    }
    
    $row=mysqli_fetch_array($result);
    
    $details["licenseCost"]=$row["licenseCost"];
    $details["discountPercentageOnLicense"]=$row["discountPercentageOnLicense"];
    $details["licenseDiscountValue"]=$row["licenseDiscountValue"];
    $details["licenseCostAfterDiscount"]=$row["licenseCostAfterDiscount"];
    $details["productSupportCost"]=$row["productSupportCost"];
    $details["discountPercentageOnSupport"]=$row["discountPercentageOnSupport"];
    $details["prodDiscountValue"]=$row["prodDiscountValue"];
    $details["finalSupportCost"]=$row["finalSupportCost"];
    $details["PSCost"]=$row["PSCost"];
    $details["discountPercentageOnPS"]=$row["discountPercentageOnPS"];
    $details["discountValueOnPS"]=$row["discountValueOnPS"];
    $details["finalPSCost"]=$row["finalPSCost"];
    $details["trainingCost"]=$row["trainingCost"];
    $details["discountPercentageOnTraining"]=$row["discountPercentageOnTraining"];
    $details["trainingDiscountValue"]=$row["trainingDiscountValue"];
    $details["finalTrainingCost"]=$row["finalTrainingCost"];
    $details["discountPercentageOnBunkerSite"]=$row["discountPercentageOnBunkerSite"];
    $details["finalLicenseCost"]=$row["finalLicenseCost"];
    $details["totalValue"]=$row["totalValue"];
//    print_r($details);
    return $details;
}

function get_question($name){
    include ("../../includes/config.php");
    $query="SELECT question FROM QGeneratorQuestions WHERE name='$name'";
    $result=mysqli_query($connect ,$query);
    if(!$result){
        echo "Database Query Failed";
    }
    
    $row=mysqli_fetch_array($result);
    
    $question=$row["question"];
    
    return $question;
}

//Adding 2s and 3s data
//function adding2s_3s($qty_2s,$qty_3s,$bunker){
//$a=0;
//$count1=count($qty_3s);
////    print_r($qty_3s);
////    echo $count1;
//$count2=count($qty_2s);
////     echo $count2;
//for($j=0;$j<=$count1;$j++){
//    $question_3s=get_question($qty_3s[$j][0]);
//    for ($i=0;$i<=$count2;$i++){
//        $question_2s=get_question($qty_3s[$i][0]);
//        if($question_2s===$question_3s){
//            $Qty_2s_3s[$a][0]=get_question($qty_2s[$i][0]);//storing name
//            if($bunker=='no'){
//                $Qty_2s_3s[$a][1]=$qty_2s[$i][1]+($qty_3s[$j][1]*2);//adding quantity
//            }else{
//                if($qty_2s[$i][0]=='prod_servers_3S' || $qty_2s[$i][0]=='virtual_prod_3S'){
//                    $Qty_2s_3s[$a][1]=$qty_2s[$i][1]+($qty_3s[$j][1]*2);//adding quantity
//                }
//                else{
////                   
//                    $Qty_2s_3s[$a][1]=$qty_2s[$i][1]+$qty_3s[$j][1];//adding quantity
//              }
//            }    
//        }$a++;
//    } 
//}
////    print_r($Qty_2s_3s);
//    return $Qty_2s_3s;
//}
    
function adding2s_3s($qty_2s,$qty_3s,$bunker){
$a=0;
$count1=count($qty_3s);
    for($i=0;$i<$count1;$i++){
        $qty_que_3s[$i][0]=get_question($qty_3s[$i][0]);
        $qty_que_3s[$i][1]=$qty_3s[$i][1];
    }
    $count2=count($qty_2s);
    for($i=0;$i<$count2;$i++){
        $qty_que_2s[$i][0]=get_question($qty_2s[$i][0]);
        $qty_que_2s[$i][1]=$qty_2s[$i][1];
    }
    for($j=0;$j<=$count1;$j++){
        for($i=0;$i<=$count2;$i++){
            if($qty_que_2s[$i][0]==$qty_que_3s[$j][0]){
                $Qty_2s_3s[$a][0]=$qty_que_2s[$i][0];//storing name
                if($bunker=='No'){
                    $Qty_2s_3s[$a][1]=($qty_que_2s[$i][1]+($qty_que_3s[$j][1]*2));//adding quantity
                }else
                    if(($qty_3s[$j][0]=='prod_servers_3S')||($qty_3s[$j][0]=='prod_servers_3S')){ 
                        // double the quantity of advanced replications
                        $Qty_2s_3s[$a][1]=$qty_que_2s[$i][1]+($qty_que_3s[$j][1]*2);//adding quantity
                    }
                    else{
                        $Qty_2s_3s[$a][1]=$qty_que_2s[$i][1]+($qty_que_3s[$j][1]);//adding quantity
                    }
            }    
            }$a++;
    }
    $Qty_2s_3s=remove_nulls($Qty_2s_3s);
//    print_r($Qty_2s_3s);
    return $Qty_2s_3s;
}

function count_node_servers($qty_2s,$qty_3s,$bunker){
    $a=0;
$count1=count($qty_3s);
    for($i=0;$i<$count1;$i++){
        $qty_que_3s[$i][0]=get_question($qty_3s[$i][0]);
        $qty_que_3s[$i][1]=$qty_3s[$i][1];
    }
    $count2=count($qty_2s);
    for($i=0;$i<$count2;$i++){
        $qty_que_2s[$i][0]=get_question($qty_2s[$i][0]);
        $qty_que_2s[$i][1]=$qty_2s[$i][1];
    }
    $count_of_servers_databases=0;
    for($j=0;$j<=$count1;$j++){
        for($i=0;$i<=$count2;$i++){
            if($qty_que_2s[$i][0]==$qty_que_3s[$j][0]){
                $Qty_2s_3s[$a][0]=$qty_que_2s[$i][0];//storing name
                if(($Qty_2s_3s[$a][0]=="Number of Production Servers that are using Advanced Replication for data protection")||($Qty_2s_3s[$a][0]=="Number of Virtual Production Servers that are using Advanced Replication for data protection")){
                   $Qty_2s_3s[$a][1]=$Qty_2s_3s[$a][1];//adding quantity
               }else{
                   $Qty_2s_3s[$a][1]=$qty_que_2s[$i][1]+$qty_que_3s[$j][1];//adding quantity
                   $count_of_servers_databases+=$Qty_2s_3s[$a][1];
               }
            }    
            }$a++;
    }
return $count_of_servers_databases;
}
    function remove_nulls($arrayName){
       $a=0;
        $temp=array();
        $count=count($arrayName);
        for($i=0;$i<=$count+1;$i++){
        if(!(is_null($arrayName[$i][0]))){
           if($arrayName[$i][1]>0){
            $temp[$a][0]=$arrayName[$i][0];
            $temp[$a][1]=$arrayName[$i][1];
            $a++;
           }
        }
        }
        return $temp;
    } 
function get_exchange_rate($currency){
        
        include ("../../includes/config.php");
        $query="select exchange_rate from ExchangeRates where target_currency='$currency'";
        $result=mysqli_query($connect,$query);
        if(!$result){
             echo "database query failed";
        }
        $row=mysqli_fetch_array($result);
        $exchange_rate=$row['exchange_rate'];
        return $exchange_rate;
    }

function License_billing_quantity($data_2s_3s,$ProdModule,$Country,$ModeOfSale,$currency,$license){
//    echo $license;
        $temp=array();
        include ("../../includes/config.php");
        if($ModeOfSale!='Support Only Sale'){
        $license_qty=$data_2s_3s;
//            print_r($license_qty);
//        $license=$_SESSION['license'];   
        $count=count($license_qty);
        for($j=0;$j<$count+1;$j++){
                $question=@$license_qty[$j][0];
                $qty=@$license_qty[$j][1];
                $query="select * from BasePrices where product_module= '$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
//            echo $query;
                $result=mysqli_query($connect,$query);
//                print_r($result);
                if(!$result){
                    echo "database query failed";
                    die();
                }
                $row=mysqli_fetch_array($result);
                $i=0;
                $temp[$j][$i]=$row['part_number'];
                $i++;
                $temp[$j][$i]=$row['part_desc'];
                $i++;
                $temp[$j][$i]=$qty;
                $i++;
                $amount=$row['base_price']* get_exchange_rate($currency);
                $temp[$j][$i]=round($qty * $amount);
            }
            return $temp;
        }
    }
    
    // FUNCTION FOR LICENSE QUANTITY SUBSCRIPTION 

    function License_billing_quantity_subscription($data_2s_3s,$ProdModule,$Country,$ModeOfSale,$currency,$license){
        include ("../../includes/config.php");
        $temp=array();
        if($ModeOfSale!='Support Only Sale'){
        $license_qty=remove_null($data_2s_3s);
//        print_r($license_qty);
//        $license=$_SESSION['license'];
        $count=count($license_qty);
        $k=0;
        for($j=0;$j<$count+1;$j++){
                $question=@$license_qty[$j][0];
                if($question=="Number of VM Images to be protected under Sanovi Cloud Continuity Module"){
                        $value=$license_qty[$j][1];
                        if($value!=0){
                            $query="select * from BasePrices where product_module='Starter Pack' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed at starter pack";
                            }
                            $i=0;
                            $temp[$k][$i]=$row['part_number'];
                            $i++;
                            $temp[$k][$i]=$row['part_desc'];
                            $i++;
                            $temp[$k][$i]=1;
                            $i++;
                            $temp[$k][$i]=round($row['base_price'] * get_exchange_rate());
                            $k++;
//                            echo $k;
//                            print_r($temp);
//                            $License_cost=$row['base_price'];
                            $value=$value-20;
                            if (($value > 0) && ($value < 100)){
                                $vm_packcount_20=ceil($value/20);
                                $query2="select * from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='20Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $i=0;
                                $temp[$k][$i]=$row['part_number'];
                                $i++;
                                $temp[$k][$i]=$row['part_desc'];
                                $i++;
                                $temp[$k][$i]=$vm_packcount_20;
                                $i++;
                                $temp[$k][$i]=round($vm_packcount_20 * $row['base_price'] * get_exchange_rate());
                                $k++;
//                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_20);
                                }
                                else if($value >= 100){
                                $vm_packcount_100= ($value - $value % 100) / 100;
                                $query2="select * from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='100Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $i=0;
                                $temp[$k][$i]=$row['part_number'];
                                $i++;
                                $temp[$k][$i]=$row['part_desc'];
                                $i++;
                                $temp[$k][$i]=$vm_packcount_100;
                                $i++;
                                $temp[$k][$i]=round($vm_packcount_100 * $row['base_price'] * get_exchange_rate());
                                $k++;
//                                    echo $k;
                                   
//                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_100);
                                $value = ($value %  100);
                                if($value!=0){
                                $vm_packcount_20=ceil($value/20);
                                $query2="select * from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='20Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $i=0;
                                $temp[$k][$i]=$row['part_number'];
                                $i++;
                                $temp[$k][$i]=$row['part_desc'];
                                $i++;
                                $temp[$k][$i]=$vm_packcount_20;
                                $i++;
                                $temp[$k][$i]=round($vm_packcount_20 * $row['base_price'] * get_exchange_rate());
                                $k++;
//                                     print_r($temp);
                                }
                                    
                            }
                        }
//                        print_r($temp);
                    }else if($question=="Number of VM Databases to be protected under Sanovi Cloud Continuity Module"){
                        $value=$license_qty[$j][1];
                        if($value!=0){
                            if($value > 0 && $value < 25){
                                $vm_packcount_5=ceil($value/5);
                                $query2="select * from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='5Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $i=0;
                                $temp[$k][$i]=$row['part_number'];
                                $i++;
                                $temp[$k][$i]=$row['part_desc'];
                                $i++;
                                $temp[$k][$i]=$vm_packcount_5;
                                $i++;
                                $temp[$k][$i]=round($vm_packcount_5 * $row['base_price'] * get_exchange_rate());
                                $k++;
//                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_5);
                                }
                                else if($value >= 25){
                                $vm_packcount_25= ($value - $value % 25) / 25;
                                $query2="select * from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='25Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $i=0;
                                $temp[$k][$i]=$row['part_number'];
                                $i++;
                                $temp[$k][$i]=$row['part_desc'];
                                $i++;
                                $temp[$k][$i]=$vm_packcount_25;
                                $i++;
                                $temp[$k][$i]=round($vm_packcount_25 * $row['base_price'] * get_exchange_rate());
                                $k++;
//                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_25);
                                $value = ($value %  25);
                                if($value!=0){
                                $vm_packcount_5=ceil($value/5);
                                $query2="select * from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='5Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $i=0;
                                $temp[$k][$i]=$row['part_number'];
                                $i++;
                                $temp[$k][$i]=$row['part_desc'];
                                $i++;
                                $temp[$k][$i]=$vm_packcount_5;
                                $i++;
                                $temp[$k][$i]=round($vm_packcount_5 * $row['base_price'] * get_exchange_rate());
                                $k++;
//                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_5);
                                }
                                   
                            }
                        }
                    }
                    else if($question=="Number of Baremetal Windows/Linux Datas (Servers) to be protected under Sanovi Cloud Continuity Module"){
                        $value=$license_qty[$j][1];
                        if($value!=0){
                            $query="select * from BasePrices where product_module='Starter Pack' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $i=0;
                            $temp[$k][$i]=$row['part_number'];
                            $i++;
                            $temp[$k][$i]=$row['part_desc'];
                            $i++;
                            $temp[$k][$i]=1;
                            $i++;
                            $temp[$k][$i]=round($row['base_price'] * get_exchange_rate());
                            $k++;
//                            $startervalue= $row['base_price'];
//                            $License_cost = $License_cost + $startervalue;
                            $value = $value-5;
                            if ($value > 0){
                                $query2="select * from BasePrices where product_module='$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $i=0;
                                $temp[$k][$i]=$row['part_number'];
                                $i++;
                                $temp[$k][$i]=$row['part_desc'];
                                $i++;
                                $temp[$k][$i]=$value;
                                $i++;
                                $temp[$k][$i]=round($value * $row['base_price'] * get_exchange_rate());
                                $k++;
//                                $License_cost=$License_cost + ($row['base_price']*$temp);
                                }
                        }
                    }
                    else if($question=="Number of Baremetal Unix Datas (Servers) to be protected under Sanovi Cloud Continuity Module"){
                        $value=$license_qty[$j][1];
                        if($value!=0){
                            $query="select * from BasePrices where product_module='Starter Pack' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $i=0;
                            $temp[$k][$i]=$row['part_number'];
                            $i++;
                            $temp[$k][$i]=$row['part_desc'];
                            $i++;
                            $temp[$k][$i]=1;
                            $i++;
                            $temp[$k][$i]=round($row['base_price'] * get_exchange_rate());
                            $k++;
//                            $startervalue= $row['base_price'];
//                            $License_cost = $License_cost + $startervalue;
                            $value=$value-5;
                            if ($value > 0){
                                $query2="select * from BasePrices where product_module='$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $i=0;
                                $temp[$k][$i]=$row['part_number'];
                                $i++;
                                $temp[$k][$i]=$row['part_desc'];
                                $i++;
                                $temp[$k][$i]=$value;
                                $i++;
                                $temp[$k][$i]=round($value * $row['base_price'] * get_exchange_rate());
                                $k++;
//                                $License_cost=$License_cost + ($row['base_price']*$value);
                                }
                        }
                    }
                    else{
                        $value=$license_qty[$j][1];
                        if($value!=0){
                            $query2="select * from BasePrices where product_module='$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query2); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $i=0;
                            $temp[$k][$i]=$row['part_number'];
                            $i++;
                            $temp[$k][$i]=$row['part_desc'];
                            $i++;
                            $temp[$k][$i]=$value;
                            $i++;
                            $temp[$k][$i]=round($value * $row['base_price'] * get_exchange_rate());
                            $k++;
                        }
                    }
            }
//            print_r($temp);
            return $temp;
            }
    }
function Product_billing_quantity($tempArray,$ProdModule,$Country,$ModeOfSale,$currency,$Productsupport){
            $temp=array();
//            include ("../../includes/post_value_arrays.php");
            include ("../../includes/config.php");
//            $license=$_SESSION['license'];
            $product_qty=remove_nulls($tempArray);
            $count=count($product_qty);
            for($i=0;$i<$count;$i++){
                $productqty[$i][0]=get_question($product_qty[$i][0]);
                $productqty[$i][1]=$product_qty[$i][1];
            }
            for($j=0;$j<$count;$j++){
                $question=$productqty[$j][0];
                $qty=$productqty[$j][1];
                $query="select * from BasePrices where product_module= '$ProdModule' and product_support_questions='$question' and country='$Country'";
                $result=mysqli_query($connect,$query);
                if(!$result){
                    echo "database query failed";
                }
                $row=mysqli_fetch_array($result);
                $i=0;
                $temp[$j][$i]=$row['part_number'];
                $i++;
                $temp[$j][$i]=$row['part_desc'];
                $i++;
                $temp[$j][$i]=$qty;
                $i++;
                $temp[$j][$i]= round($row['base_price']*$Productsupport *get_exchange_rate($currency));
            }
        return $temp;
        }
        function remove_nan_questions($arrayName){
            $a=0;
            $temp=array();
            $count=count($arrayName);
            for($i=0;$i<=$count+1;$i++){
                if(is_numeric($arrayName[$i][1])){
                    $temp[$a][0]=$arrayName[$i][0];
                    $temp[$a][1]=$arrayName[$i][1];
                    $a++;
                }
            }
            return $temp;
        }

        function Professional_billing_quantity($tempArray,$temparray2,$ProdModule,$Country,$ModeOfSale,$currency,$Productsupport,$prof_services_all,$license){
//            echo $license;
            $temp=array();
//            include ("../../includes/post_value_arrays.php");
            include ("../../includes/config.php");
//            $license=$_SESSION['license'];
            if($ModeOfSale!='Support Only Sale'){
            if($prof_services_all=="No"){
                    $QuestionsAndValues_Prof=remove_nulls($tempArray);
                    $count=count($QuestionsAndValues_Prof);
                    for($i=0;$i<=$count;$i++){
                        $QuestionsAndValues_Prof[$i][0]=get_question($QuestionsAndValues_Prof[$i][0]);
                        $QuestionsAndValues_Prof[$i][1]=$QuestionsAndValues_Prof[$i][1];
                    }
                    for($j=0;$j<$count;$j++){
                        $question1=@$QuestionsAndValues_Prof[$j][0];
                        $qty=@$QuestionsAndValues_Prof[$j][1];
                        $simpleApps=round($qty*0.7);
                        $complexApps=$qty-$simpleApps; //Calculating complex apps at 30% of total
                        $query="select * from BasePrices where product_module= '$ProdModule' and question='$question1' and country='$Country'";
                        $result=mysqli_query($connect,$query);
                        if(!$result){
                            echo "database query failed";
                            die();
                        }
                        $row=mysqli_fetch_array($result);
                        $part_desc=$row['part_desc'];
                        $base_price=$row['base_price'];
                        $simpleAppValue=0;
                        $complexAppValue=0;
                        for($i=$simpleApps;$i>0;$i--){
                            if($i>3){    
                                $query2="select * from LearningFactor where app='4'";
                                $result2=mysqli_query($connect,$query2);
                                if(!$result2){
                                    echo "database query failed";
                                    die();
                                }
                                $row2=mysqli_fetch_array($result2);
                                $simpleAppValue+= ($base_price * ($row2['simple_app'])/100);
                            }else{
                                $query2="select * from LearningFactor where app='$i'";
                                $result2=mysqli_query($connect,$query2);
                                if(!$result2){
                                    echo "database query failed";
                                    die();
                                }
                                $row2=mysqli_fetch_array($result2);
                                $simpleAppValue+= ($base_price * ($row2['simple_app'])/100);
                            }
                        }
                        for($i=$complexApps;$i>0;$i--){
                            if($i>3){    
                                $query2="select * from LearningFactor where app='4'";
                                $result2=mysqli_query($connect,$query2);
                                if(!$result2){
                                    echo "database query failed";
                                    die();
                                }
                                $row2=mysqli_fetch_array($result2);
                                $complexAppValue+= ($base_price * ($row2['complex_app'])/100);
                            }else{
                                $query2="select * from LearningFactor where app='$i'";
                                $result2=mysqli_query($connect,$query2);
                                if(!$result2){
                                    echo "database query failed";
                                    die();
                                }
                                $row2=mysqli_fetch_array($result2);
                                $complexAppValue+= ($base_price * ($row2['complex_app'])/100);
                            }
                        }
                         $professional_value=$simpleAppValue+$complexAppValue;
                         if($Type_of_service=="Remote"){
                            $professional_service_value=($professional_value * 0.6);
                        }else{
                            $professional_service_value=$professional_value;
                         }
                        $i=0;
                        $temp[$j][$i]=$row['part_number'];
                        $i++;
                        $temp[$j][$i]=$row['part_desc'];
                        $i++;
                        $temp[$j][$i]=$qty;
                        $i++;
                        $temp[$j][$i]=round($professional_service_value * get_exchange_rate($currency));
                    }
                   return $temp;
                }else{
                    $Qty_2s_3s=$temparray2;
                    $QuestionsAndValues_Prof=remove_nan_questions($tempArray);
                    $count=count($Qty_2s_3s);
                    $count1=count($QuestionsAndValues_Prof);
                    for($i=0;$i<=$count1;$i++){
                        $QuestionsAndValues_Prof[$i][0]=get_question($QuestionsAndValues_Prof[$i][0]);
                        $QuestionsAndValues_Prof[$i][1]=$QuestionsAndValues_Prof[$i][1];
                    }
                    for($j=0;$j<$count;$j++){
                        $question1=$QuestionsAndValues_Prof[$j][0];
                        $question2=$Qty_2s_3s[$j][0];
                        $qty=$Qty_2s_3s[$j][1];
                        $simpleApps=round($qty*0.7);
                        $complexApps=$qty-$simpleApps; //Calculating complex apps at 30% of total
                        $query="select * from BasePrices where product_module= '$ProdModule' and question='$question1' and country='$Country'";
//                        echo $query;
                        $result=mysqli_query($connect,$query);
                        if(!$result){
                            echo "database query failed";
                            die();
                        }
                        $row=mysqli_fetch_array($result);
                        $base_price=$row['base_price'];
                        $simpleAppValue=0;
                        $complexAppValue=0;
                        for($i=$simpleApps;$i>0;$i--){
                            if($i>3){    
                                $query2="select * from LearningFactor where app='4'";
                                $result2=mysqli_query($connect,$query2);
                                if(!$result2){
                                    echo "database query failed";
                                    die();
                                }
                                $row1=mysqli_fetch_array($result2);
                                $simpleAppValue+= ($base_price * ($row1['simple_app'])/100);
                            }else{
                                $query2="select * from LearningFactor where app='$i'";
                                $result2=mysqli_query($connect,$query2);
                                if(!$result2){
                                    echo "database query failed";
                                    die();
                                }
                                $row1=mysqli_fetch_array($result2);
                                $simpleAppValue+= ($base_price * ($row1['simple_app'])/100);
                            }
                        }
                        for($i=$complexApps;$i>0;$i--){
                            if($i>3){    
                                $query2="select * from LearningFactor where app='4'";
                                $result2=mysqli_query($connect,$query2);
                                if(!$result2){
                                    echo "database query failed";
                                    die();
                                }
                                $row1=mysqli_fetch_array($result2);
                                $complexAppValue+= ($base_price * ($row1['complex_app'])/100);
                            }else{
                                $query2="select * from LearningFactor where app='$i'";
                                $result2=mysqli_query($connect,$query2);
                                if(!$result2){
                                    echo "database query failed";
                                    die();
                                }
                                $row1=mysqli_fetch_array($result2);
                                $complexAppValue+= ($base_price * ($row1['complex_app'])/100);
                            }
                        }
                        $professional_value=$simpleAppValue+$complexAppValue;
                         if($Type_of_service=="Remote"){
                            $professional_service_value=($professional_value * 0.6);
                        }else{
                            $professional_service_value=$professional_value;
                         }
                        $i=0;
                        $temp[$j][$i]=$row['part_number'];
                        $i++;
                        $temp[$j][$i]=$row['part_desc'];
                        $i++;
                        $temp[$j][$i]=$qty;
                        $i++;
                        $temp[$j][$i]=round($professional_service_value * get_exchange_rate($currency));
                    }
                    return $temp;
                }
        }
    }
    function masterServerLicense_view($ModeOfSale,$Country,$license){
        include ("../../includes/config.php");
        $temp=array();
//        $license=$_SESSION['license'];
        $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='License' and country='$Country' and license_type='$license'";
             $result=mysqli_query($connect,$query); 
                if ($result->num_rows > 0) {
                while($row=mysqli_fetch_array($result)){
                    $i=0;$j=0;
                        $temp[$i][$j]=$row['part_number'];
                        $j++;
                        $temp[$i][$j]=$row['part_desc'];
                        $j++;
                        $temp[$i][$j]='1';
                        $j++;
                        $temp[$i][$j]=$row['base_price'];
                    }
                    return $temp;
                }
    }
     
    function masterServerProf_view($ModeOfSale,$Country){
        include ("../../includes/config.php");
        $temp=array();
//        $license=$_SESSION['license'];
         $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='Professional_services' and country='$Country'";
              $result=mysqli_query($connect,$query); 
                if ($result->num_rows > 0) {
                while($row=mysqli_fetch_array($result)){
                $i=0;$j=0;
                    $temp[$i][$j]=$row['part_number'];
                    $j++;
                    $temp[$i][$j]=$row['part_desc'];
                    $j++;
                    $temp[$i][$j]='1';
                    $j++;
                    $temp[$i][$j]=$row['base_price'];
                }
                return $temp;
            }
    }

    function premiseProductTraining($ModeOfSale,$prof_premise_product_training,$Country,$nodeservers){
        include ("../../includes/config.php");
        $temp=array();
//        $license=$_SESSION['license'];
         if($ModeOfSale=='First Time Sale'){
                if($prof_premise_product_training=="Yes"){
                    $node_servers=ceil($nodeservers/40);
                    $query="select * from BasePrices where product_module='PREMISE PRODUCT TRAINING' and country='$Country'";
                    $result=mysqli_query($connect,$query); 
                    $row=mysqli_fetch_array($result);
                    if(!$result){
                        echo "database query failed";
                    }
                    $premise_training=$row['base_price']*$node_servers;
                    $i=0;$j=0;
                    $temp[$i][$j]=$row['part_number'];
                    $j++;
                    $temp[$i][$j]=$row['part_desc'];
                    $j++;
                    $temp[$i][$j]=$node_servers;
                    $j++;
                    $temp[$i][$j]=$premise_training;
                }
            }
            return $temp;
    }
    function masterServerproduct_view($ModeOfSale,$Country){
        include ("../../includes/config.php");
        $temp=array();
//        $license=$_SESSION['license'];
         $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='Product_support' and country='$Country'";
             $result=mysqli_query($connect,$query); 
                if ($result->num_rows > 0) {
                while($row=mysqli_fetch_array($result)){
                    $i=0;$j=0;
                        $temp[$i][$j]=$row['part_number'];
                        $j++;
                        $temp[$i][$j]=$row['part_desc'];
                        $j++;
                        $temp[$i][$j]='1';
                        $j++;
                        $temp[$i][$j]=$row['base_price'];
                    }
                    return $temp;
                }
    }
    function displayAnnexure_1($refid,$verid){
        include ("../../includes/config.php");
        $query="select annexure_1 from LicenseGeneration where license_reference_id='$refid' and license_revision_id='$verid'";
        $result=mysqli_query($connect,$query);
        $row=mysqli_fetch_array($result);
        return $row['annexure_1'];
    }

    //FUNCTION TO FIND QUOTE APPROVAL ASSIGNED TO (RETURNS EMP ID OF ASSIGNED APPROVER)
    function approval_assigned_to($refId, $verId){
        include "../../includes/config.php";
        $query="SELECT approved_by_emp_id, status FROM LicenseGeneration WHERE license_reference_id='$refId' AND license_revision_id='$verId'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        if($row["status"]=="Draft"){
            return $row["status"];
        }else{
            return $row["approved_by_emp_id"];
        }
    }
    
    function get_quote_generated_name($userid){
        include "../../includes/config.php";
        $query="SELECT emp_name FROM users WHERE login_name='$userid'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        return $row["emp_name"];
    }

    //FINDING REPORTING MANAGER OF QUOTE CREATED USER NAME
    function find_rep_manager_of_quote_creator($quote_created_user){
        include "../../includes/config.php";
        $query="SELECT reporting_manager FROM users WHERE login_name='$quote_created_user'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        return $row["reporting_manager"];
    }
?>