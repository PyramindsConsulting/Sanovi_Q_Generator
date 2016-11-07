<?php 
//print_r($_POST);
$Currency=$_POST["Currency"];
$CustomerName=$_POST["Customer_name"];
$OrgName=$_POST["organization_name"];
$Partner=$_POST["partner_name"];
$license=$_POST["License"];
$product=$_POST["Productname"];
$Country=$_POST["Country"];
$ModeOfSale=$_POST["Mode_of_sale"];
$ProdModule=$_POST["Product_module"];
$Bunker=$_POST["bunker_3S"];
$QuestionsAndValues_2s=array();
$QuestionsAndValues_3s=array();
$QuestionsAndValues_Prof=array();
//$ProfServicesReqd=$_POST["Prof_Services_all"];
$Type_of_service=$_POST["Prof_Services_type"];
$ProdSupport=$_POST["Product_Support"];
//$Discount=$_POST["Discount"];

$vm_images_2s=$_POST['vm_images_2S'];
$db_2s=$_POST['db_2S'];
$b_windows_datas_2s=$_POST['b_windows_datas_2S'];
$b_windows_db_2s=$_POST['b_windows_db_2S'];
$b_unix_datas_2s=$_POST['b_unix_datas_2S'];
$b_unix_db_2s=$_POST['b_unix_db_2S'];
$prod_servers_2s=$_POST['prod_servers_2S'];
$virtual_prod_2s=$_POST['virtual_prod_2S'];
$share_server_2s=$_POST['share_server_2S'];
$virtual_sharepoint_server_2s=$_POST['virtual_sharepoint_server_2S'];
$prod_ms_2s=$_POST['prod_ms_2S'];
$prod_v_ms_2s=$_POST['prod_v_ms_2S'];
$servers_2s=$_POST['servers_2S'];
$bunker_3s=$_POST['bunker_3S'];
$vm_images_3s=$_POST['vm_images_3S'];
$database_3s=$_POST['database_3S'];
$b_windows_datas_3s=$_POST['b_windows_datas_3S'];
$b_windows_db_3s=$_POST['b_windows_db_3S'];
$b_unix_datas_3s=$_POST['b_unix_datas_3S'];
$b_unix_db_3s=$_POST['b_unix_db_3S'];
$prod_servers_3s=$_POST['prod_servers_3S'];
$virtual_prod_3s=$_POST['virtual_prod_3S'];
$share_server_3s=$_POST['share_server_3S'];
$virtual_server_3s=$_POST['virtual_server_3S'];
$prod_ms_3s=$_POST['prod_ms_3S'];
$prod_v_ms_3s=$_POST['prod_v_ms_3S'];
$servers_3s=$_POST['servers_3S'];
$prof_services_all=$_POST['Prof_Services_all'];
$prof_services_type=$_POST['Prof_Services_type'];
$prof_services_vm_image=$_POST['Prof_Services_vm_image'];
$prof_services_database=$_POST['Prof_Services_database'];
$prof_services_b_windows_datas=$_POST['Prof_Services_b_windows_datas'];
$prof_services_b_windows_db=$_POST['Prof_Services_b_windows_db'];
$prof_services_b_unix_datas=$_POST['Prof_Services_b_unix_datas'];
$prof_services_b_unix_db=$_POST['Prof_Services_b_unix_db'];
$prof_services_prod_servers=$_POST['Prof_Services_prod_servers'];
$prof_services_virtual_prod=$_POST['Prof_Services_virtual_prod'];
$prof_services_share_server=$_POST['Prof_Services_share_server'];
$prof_services_share_db=$_POST['Prof_Services_share_db'];
$prof_services_v_share_server=$_POST['Prof_Services_v_share_server'];
$prof_services_v_share_db=$_POST['Prof_Services_v_share_db'];
$prof_services_prod_ms=$_POST['Prof_Services_prod_ms'];
$prof_services_prod_v_ms=$_POST['Prof_Services_prod_v_ms'];
$Discount_license=$_POST["Discount_license"];
$Discount_prof_serv=$_POST["Discount_prof_serv"];
$Discount_product_support=$_POST["Discount_product_support"];
$Discount_product_training=$_POST["Discount_product_training"];

$i=0;
$Qty_2s_3s=array();

foreach ( $_POST as $key => $value) {
    if((strchr($key,"_2s")=="_2s") || (strchr($key,"_2S")=="_2S")){
        if(strchr($key,"_2s")=="_2s"){
            $i++;   
            $QuestionsAndValues_2s[$i][0]=$value;
            
        }else if(strchr($key,"_2S")=="_2S"){
            if($value==""){
                $value=0;
                $QuestionsAndValues_2s[$i][1]=$value;
            }else{
                $QuestionsAndValues_2s[$i][1]=$value;
            }
            
        }
    }
}

$i=0;
foreach ( $_POST as $key => $value) {
    if((strchr($key,"_3s")=="_3s") || (strchr($key,"_3S")=="_3S")){
        if(strchr($key,"_3s")=="_3s"){
            $i++;   
            $QuestionsAndValues_cust_3s[$i][0]=$value;
            
        }else if(strchr($key,"_3S")=="_3S"){
            if($value==""){
                $value=0;
                $QuestionsAndValues_cust_3s[$i][1]=$value;
            }else{
                $QuestionsAndValues_cust_3s[$i][1]=$value;
            }
            
        }
    }
}

$i=0;
foreach ( $_POST as $key => $value) {
    if($Bunker=="No"){
    if((strchr($key,"_3s")=="_3s") || (strchr($key,"_3S")=="_3S")){
        if(strchr($key,"_3s")=="_3s"){
            $i++;   
            $QuestionsAndValues_3s[$i][0]=$value;
            
        }else if(strchr($key,"_3S")=="_3S"){
            if($value==""){
                $value=0;
                $QuestionsAndValues_3s[$i][1]=$value;
            }else{
                $QuestionsAndValues_3s[$i][1]=2 * $value;
            }
            
        }
    }
  }else{
        if((strchr($key,"_3s")=="_3s") || (strchr($key,"_3S")=="_3S")){
        if(strchr($key,"_3s")=="_3s"){
            $i++;   
            $QuestionsAndValues_3s[$i][0]=$value;
            
        }else if(strchr($key,"_3S")=="_3S"){
            if($value==""){
                $value=0;
                $QuestionsAndValues_3s[$i][1]=$value;
            }else{
                if((strchr($key,"prod_servers_3S")=="prod_servers_3S")||(strchr($key,"virtual_prod_3S")=="virtual_prod_3S")){
                    $QuestionsAndValues_3s[$i][1]=2 * $value;
                    
                }else{
                    $QuestionsAndValues_3s[$i][1]=$value;
                    
                }
            }
            
        }
    } 
    }
}


$i=0;
foreach ( $_POST as $key => $value) {
    if((substr($key,0,5)=="Prof_") || (substr($key,0,5)=="prof_")){
        if(substr($key,0,5)=="prof_"){
            $i++;   
            $QuestionsAndValues_Prof[$i][0]=$value;
            
        }else if(substr($key,0,5)=="Prof_"){
            if($value==""){
                $value=0;
                $QuestionsAndValues_Prof[$i][1]=$value;
            }else{
                $QuestionsAndValues_Prof[$i][1]=$value;
            }
            
        }
    }
}


$_SESSION['Country']=$Country;
$_SESSION['license_2s_qty']=$QuestionsAndValues_2s;
//$_SESSION['license_3s_qty']=$QuestionsAndValues_3s;
$_SESSION['license_3s_qty']=$QuestionsAndValues_cust_3s;
$_SESSION['prof_qty']=$QuestionsAndValues_Prof;
$_SESSION['prof_service_required']=$prof_services_all;
$_SESSION['OrgName']=$OrgName;
$_SESSION['license']=$license;
$_SESSION['product']=$product;
$_SESSION['modeofsale']=$ModeOfSale;
$_SESSION['productModule']=$ProdModule;
$_SESSION['productSupport']=$ProdSupport;
$_SESSION['currency']=$Currency;

$a=0;
//Adding 2s and 3s quantity
$count1=count($QuestionsAndValues_3s);
$count2=count($QuestionsAndValues_2s);
for($j=0;$j<=$count1;$j++){
for ($i=1;$i<=$count2;$i++){
    
    if(@$QuestionsAndValues_2s[$i][0]==@$QuestionsAndValues_3s[$j][0]){
//        echo $QuestionsAndValues_2s[$i][1];
//        echo $QuestionsAndValues_2s[$i][1];
        //echo $QuestionsAndValues_2s[$i][1]+$QuestionsAndValues_3s[$j][1];
        @$Qty_2s_3s[$a][0]=@$QuestionsAndValues_2s[$i][0];//storing name
        @$Qty_2s_3s[$a][1]=@$QuestionsAndValues_2s[$i][1]+@$QuestionsAndValues_3s[$j][1];//adding quantity
    }
} 
  $a++;  
}

//Taking count for training cost
$a=0;
$count1=count($QuestionsAndValues_cust_3s);
$count2=count($QuestionsAndValues_2s);
$count_of_servers_databases=0;
for($j=0;$j<=$count1;$j++){
for ($i=1;$i<=$count2;$i++){
   
   if(@$QuestionsAndValues_2s[$i][0]==@$QuestionsAndValues_cust_3s[$j][0]){
       @$Qty_2s_3s_cust[$a][0]=@$QuestionsAndValues_2s[$i][0];//storing name
       if((@$Qty_2s_3s_cust[$a][0]=="Number of Production Servers that are using Advanced Replication for data protection")||(@$Qty_2s_3s_cust[$a][0]=="Number of Virtual Production Servers that are using Advanced Replication for data protection")){
           $count_of_servers_databases-=$Qty_2s_3s_cust[$a][1];
           @$Qty_2s_3s_cust[$a][1]=@$QuestionsAndValues_2s[$i][1]+@$QuestionsAndValues_cust_3s[$j][1];//adding quantity
       }else{
           @$Qty_2s_3s_cust[$a][1]=@$QuestionsAndValues_2s[$i][1]+@$QuestionsAndValues_cust_3s[$j][1];//adding quantity
           $count_of_servers_databases+=$Qty_2s_3s_cust[$a][1];
       }
   }
} 
 $a++;  
}
$_SESSION['count_of_servers_databases']=$count_of_servers_databases;
?>