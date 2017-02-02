    <?php
    function calculate_2site_licence(){
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        $j=1;
        $license_2s=0;
        $license=$_SESSION['license'];
        if($ModeOfSale!='Support Only Sale'){
            $count=count($QuestionsAndValues_2s);
            for($j=0;$j<=$count;$j++){
                if(isset($QuestionsAndValues_2s[$j][0])){
                    $question=$QuestionsAndValues_2s[$j][0];
                    if($question=='Number of SAP HANA Database Nodes on Production'){
                      $value=0;  
                    }else{
                      $value=$QuestionsAndValues_2s[$j][1];
                    }
                    $query="select base_price,question from BasePrices where product_module= '$ProdModule' and question='$question'and country='$Country' and license_type='$license'";
                    $result=mysqli_query($connect,$query);
                    if(!$result){
                        echo "database query failed";
                    }
                    $row=mysqli_fetch_array($result);

                    //echo $row['base_price']*$QuestionsAndValues_2s[$j][1]." ".$row['question']."<br>";
                    $license_2s+= $row['base_price']*$value;
                }
            }
        }
        return $license_2s;
    }

    function calculate_2site_licence_subscription(){
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        $license=$_SESSION['license'];
        if($ModeOfSale!='Support Only Sale'){
            $count=count($QuestionsAndValues_2s);
            for($j=0;$j<=$count;$j++){
                if(isset($QuestionsAndValues_2s[$j][0])){
                    $question=$QuestionsAndValues_2s[$j][0];
                    if($question=="Number of VM Images to be protected under Sanovi Cloud Continuity Module"){
                        $value=$QuestionsAndValues_2s[$j][1];
                        if($value!=0){
                            $query="select base_price from BasePrices where product_module='Starter Pack' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $License_cost=$row['base_price'];
                            $value=$value-20;
                            if (($value > 0) && ($value < 100)){
                                $vm_packcount_20=ceil($value/20);
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='20Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_20);
                                }
                                else if($value >= 100){
                                $vm_packcount_100= ($value - $value % 100) / 100;
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='100Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_100);
                                $temp = ($value %  100);
                                if($temp!=0){
                                $vm_packcount_20=ceil($temp/20);
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='20Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_20);
                                }
                                    
                            }
                        }
                    
                    }else if($question=="Number of VM Databases to be protected under Sanovi Cloud Continuity Module"){
                        $value=$QuestionsAndValues_2s[$j][1];
                        if($value!=0){
                            if($value > 0 && $value < 25){
                                $vm_packcount_5=ceil($value/5);
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='5Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_5);
                                }
                                else if($value >= 25){
                                $vm_packcount_25= ($value - $value % 25) / 25;
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='25Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_25);
                                $temp = ($value %  25);
                                if($temp!=0){
                                $vm_packcount_5=ceil($temp/5);
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='5Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_5);
                                }
                                   
                            }
                        }
                    }
                    else if($question=="Number of Baremetal Windows/Linux Datas (Servers) to be protected under Sanovi Cloud Continuity Module"){
                        $value=$QuestionsAndValues_2s[$j][1];
                        if($value!=0){
                            $query="select base_price from BasePrices where product_module='Starter Pack' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $startervalue= $row['base_price'];
                            $License_cost = $License_cost + $startervalue;
                            $temp = $value-5;
                            if ($temp > 0){
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$temp);
                                }
                        }
                    }
                    else if($question=="Number of Baremetal Unix Datas (Servers) to be protected under Sanovi Cloud Continuity Module"){
                        $value=$QuestionsAndValues_2s[$j][1];
                        if($value!=0){
                            $query="select base_price from BasePrices where product_module='Starter Pack' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $startervalue= $row['base_price'];
                            $License_cost = $License_cost + $startervalue;
                            $value=$value-5;
                            if ($value > 0){
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$value);
                                }
                        }
                    }
                    else{
                        $value=$QuestionsAndValues_2s[$j][1];
                        if($value!=0){
                            $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query2); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $License_cost=$License_cost + ($row['base_price']*$value);
                        }
                    }
                     
                }
            }
            return $License_cost;
        }
    }

    function calculate_3site_licence_subscription(){
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        $license=$_SESSION['license'];
        if($ModeOfSale!='Support Only Sale'){
            $count=count($QuestionsAndValues_3s);
            for($j=0;$j<=$count;$j++){
                if(isset($QuestionsAndValues_3s[$j][0])){
                    $question=$QuestionsAndValues_3s[$j][0];
                    if($question=="Number of VM Images to be protected under Sanovi Cloud Continuity Module"){
                        $value=$QuestionsAndValues_3s[$j][1];
                        if($value!=0){
                            $query="select base_price from BasePrices where product_module='Starter Pack' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $License_cost=$row['base_price'];
                            $value=$value-20;
                            if (($value > 0) && ($value < 100)){
                                $vm_packcount_20=ceil($value/20);
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='20Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_20);
                                }
                                else if($value >= 100){
                                $vm_packcount_100= ($value - $value % 100) / 100;
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='100Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_100);
                                $temp = ($value %  100);
                                if($temp!=0){
                                $vm_packcount_20=ceil($temp/20);
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='20Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_20);
                                }
                                    
                            }
                        }
                    
                    }else if($question=="Number of VM Databases to be protected under Sanovi Cloud Continuity Module"){
                        $value=$QuestionsAndValues_3s[$j][1];
                        if($value!=0){
                            if($value > 0 && $value < 25){
                                $vm_packcount_5=ceil($value/5);
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='5Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_5);
                                }
                                else if($value >= 25){
                                $vm_packcount_25= ($value - $value % 25) / 25;
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='25Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_25);
                                $temp = ($value %  25);
                                if($temp!=0){
                                $vm_packcount_5=ceil($temp/5);
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and product_support_questions='5Pack' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$vm_packcount_5);
                                }
                                   
                            }
                        }
                    }
                    else if($question=="Number of Baremetal Windows/Linux Datas (Servers) to be protected under Sanovi Cloud Continuity Module"){
                        $value=$QuestionsAndValues_3s[$j][1];
                        if($value!=0){
                            $query="select base_price from BasePrices where product_module='Starter Pack' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $startervalue= $row['base_price'];
                            $License_cost = $License_cost + $startervalue;
                            $temp = $value-5;
                            if ($temp > 0){
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$temp);
                                }
                        }
                    }
                    else if($question=="Number of Baremetal Unix Datas (Servers) to be protected under Sanovi Cloud Continuity Module"){
                        $value=$QuestionsAndValues_3s[$j][1];
                        if($value!=0){
                            $query="select base_price from BasePrices where product_module='Starter Pack' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $startervalue= $row['base_price'];
                            $License_cost = $License_cost + $startervalue;
                            $value=$value-5;
                            if ($value > 0){
                                $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
                                $result=mysqli_query($connect,$query2); 
                                $row=mysqli_fetch_array($result);
                                if(!$result){
                                    echo "database query failed";
                                }
                                $License_cost=$License_cost + ($row['base_price']*$value);
                                }
                        }
                    }
                    else{
                        $value=$QuestionsAndValues_3s[$j][1];
                        if($value!=0){
                            $query2="select base_price from BasePrices where product_module='$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
                            $result=mysqli_query($connect,$query2); 
                            $row=mysqli_fetch_array($result);
                            if(!$result){
                                echo "database query failed";
                            }
                            $License_cost=$License_cost + ($row['base_price']*$value);
                        }
                    }
                     
                }
            }
            return $License_cost;
        }
    }



    function master_server_license(){
            include ("../includes/post_value_arrays.php");
            include ("../includes/config.php");
            $license=$_SESSION['license'];
            if($ModeOfSale!='Support Only Sale'){
            $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='License' and country='$Country' and license_type='$license'";
            $result=mysqli_query($connect,$query); 
            $row=mysqli_fetch_array($result);
            if(!$result){
                echo "database query failed";
            }
            $master_server=$row['base_price'];
        }
        return $master_server;
        //echo $master_server;
    }

    function master_server_support(){
            include ("../includes/post_value_arrays.php");
            include ("../includes/config.php");
            $license=$_SESSION['license'];
            $noofYears=$_SESSION['productSupport'];
            if($ModeOfSale!='Support Only Sale'){
            $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='Product_support' and country='$Country'";
            $result=mysqli_query($connect,$query); 
            $row=mysqli_fetch_array($result);
            if(!$result){
                echo "database query failed";
            }
            $master_server=$noofYears*$row['base_price'];
        }
        return $master_server;
        //echo $master_server;
    }

    function master_server_prof(){
            include ("../includes/post_value_arrays.php");
            include ("../includes/config.php");
            $license=$_SESSION['license'];
            if($ModeOfSale!='Support Only Sale'){
            $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='Professional_services' and country='$Country'";
            $result=mysqli_query($connect,$query); 
            $row=mysqli_fetch_array($result);
            if(!$result){
                echo "database query failed";
            }
            $master_server=$row['base_price'];
        }
        return $master_server; 
        //echo $master_server;
    }
    function calculate_premise_product_training(){
            include ("../includes/post_value_arrays.php");
            include ("../includes/config.php");
//            $license=$_SESSION['license'];
        $_SESSION['premise_product_training']=$prof_premise_product_training; 
            if($ModeOfSale=='First Time Sale'){
                if($prof_premise_product_training=="Yes"){
//                    echo $_SESSION['count_of_servers_databases'];
                    $node_servers=ceil($_SESSION['count_of_servers_databases']/40);
//                    echo $node_servers;
                    $query="select * from BasePrices where product_module='PREMISE PRODUCT TRAINING' and country='$Country'";
                    $result=mysqli_query($connect,$query); 
                    $row=mysqli_fetch_array($result);
                    if(!$result){
                        echo "database query failed";
                    }
                    $premise_training=$row['base_price']*$node_servers;
                }
            }
//        echo $premise_training;
        return $premise_training;
    }

    function calculate_3site_licence(){
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        $j=1;
        $licence_3s=0;
        $license=$_SESSION['license'];
        if($ModeOfSale!='Support Only Sale'){
            $count=count($QuestionsAndValues_3s);
            for($j=0;$j<=$count;$j++){
                if(isset($QuestionsAndValues_3s[$j][0])){
                    $question=$QuestionsAndValues_3s[$j][0];
                    if($question=='Number of SAP HANA Database Nodes on Production'){
                      $value=0;  
                    }else{
                      $value=$QuestionsAndValues_3s[$j][1];
                    }
                    $query="select base_price,question from BasePrices where product_module= '$ProdModule' and question='$question'and country='$Country' and license_type='$license'";
                    $result=mysqli_query($connect,$query);
                    if(!$result){
                        echo "database query failed";
                    }
                    $row=mysqli_fetch_array($result);
//                    echo $row['base_price']*$QuestionsAndValues_3s[$j][1]." ".$row['question']."<br>";
                    $licence_3s+= $row['base_price']*$value;
                }
            }
        }
        return $licence_3s;
    }

    function calculate_prof_services(){
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        $professional_cost=0;
            if($ModeOfSale!='Support Only Sale'){
            if($prof_services_all=="No"){
                $QuestionsAndValues_Prof=remove_nulls_in_array($QuestionsAndValues_Prof);
                $QuestionsAndValues_Prof=Get_questions_to_prof($QuestionsAndValues_Prof,$Qty_2s_3s);
//                print_r();
                $count=count($QuestionsAndValues_Prof);
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
                            $row=mysqli_fetch_array($result2);
                            $simpleAppValue+= ($base_price * ($row['simple_app'])/100);
                        }else{
                            $query2="select * from LearningFactor where app='$i'";
                            $result2=mysqli_query($connect,$query2);
                            if(!$result2){
                                echo "database query failed";
                                die();
                            }
                            $row=mysqli_fetch_array($result2);
                            $simpleAppValue+= ($base_price * ($row['simple_app'])/100);
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
                            $row=mysqli_fetch_array($result2);
                            $complexAppValue+= ($base_price * ($row['complex_app'])/100);
                        }else{
                            $query2="select * from LearningFactor where app='$i'";
                            $result2=mysqli_query($connect,$query2);
                            if(!$result2){
                                echo "database query failed";
                                die();
                            }
                            $row=mysqli_fetch_array($result2);
                            $complexAppValue+= ($base_price * ($row['complex_app'])/100);
                        }
                    }
                     $professional_value=$simpleAppValue+$complexAppValue;
                     if($Type_of_service=="Remote"){
                        $professional_service_value=($professional_value * 0.6);
                    }else{
                        $professional_service_value=$professional_value;
                     }
                    $professional_cost+=$professional_service_value;
                }
                   
            }else{
                $Qty_2s_3s=remove_null($temparray2);
                $QuestionsAndValues_Prof=remove_nulls_in_array($tempArray);
                $QuestionsAndValues_Prof=Get_questions_to_license($QuestionsAndValues_Prof,$Qty_2s_3s);
                $count=count($QuestionsAndValues_Prof);
                for($j=0;$j<=$count;$j++){
                    $question1=@$QuestionsAndValues_Prof[$j][0];
                    $question2=@$Qty_2s_3s[$j][0];
                    $qty=@$QuestionsAndValues_Prof[$j][1];
                    $simpleApps=round($qty*0.7);
//                        echo $simpleApps;//Calculating simple apps at 70% of total
                    $complexApps=$qty-$simpleApps; //Calculating complex apps at 30% of total
//                        echo $complexApps;//Calculating simple apps at 70% of total
                    $query="select * from BasePrices where product_module='$ProdModule' and question='$question1' and product_support_questions='$question2' and country='$Country'";
                    $result=mysqli_query($connect,$query);
                    if(!$result){
                        echo "database query failed";
                        die();
                    }
                    $row=mysqli_fetch_array($result);
                    $base_price=$row['base_price'];
                //    echo $base_price;
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
                  //  echo $simpleAppValue;
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
                    $professional_cost+=$professional_service_value;   
                }
            }
            
        }
        return $professional_cost;
    }
    function calculate_product_support(){
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
            $j=1;
            $prod_support_cost=0;
            $QuestionsAndValues_2s=remove_null($QuestionsAndValues_2s);
            $count=count($QuestionsAndValues_2s);
            for($j=0;$j<$count;$j++){
                if(isset($QuestionsAndValues_2s[$j][0])){
                    $question=$QuestionsAndValues_2s[$j][0];
                    $qty=$QuestionsAndValues_2s[$j][1];
                    $query="select base_price,question from BasePrices where product_module= '$ProdModule' and product_support_questions='$question' and country='$Country'";
                    
                    $result=mysqli_query($connect,$query);
                    if(!$result){
                        echo "database query failed";
                    }
                    $row=mysqli_fetch_array($result);
                    $prod_support_cost+= ($qty*$row['base_price']*$ProdSupport);
                }
            }
            return $prod_support_cost;
        }
        
    function calculate_product_training(){
       include ("../includes/post_value_arrays.php");
       include ("../includes/config.php");
       $query="select base_price from BasePrices where question='Product Training' and country='$Country'";
       $result=mysqli_query($connect,$query);
           if(!$result){
               echo "database query failed";
           }
       $row=mysqli_fetch_array($result);
       $product_training_cost=0;
       $product_training_cost=$count_of_servers_databases/40*$row['base_price'];
       $product_training_cost=$product_training_cost*get_exchange_rate();
       return $product_training_cost;
   }

    function get_exchange_rate(){
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        $query="select exchange_rate from ExchangeRates where target_currency='$Currency'";
        $result=mysqli_query($connect,$query);
        if(!$result){
             echo "database query failed";
        }
        $row=mysqli_fetch_array($result);
        $exchange_rate=$row['exchange_rate'];
        return $exchange_rate;
    }
    

    function remove_nulls_in_array($arrayName){
        $a=0;
        $temp=array();
        $count=count($arrayName);
        for($i=0;$i<=$count+1;$i++){
//            echo @$arrayName[$i][1];
        if(!(is_null(@$arrayName[$i][0]))){
//            $temp[$a][0]=$arrayName[$i][0];
//            $temp[$a][1]=$arrayName[$i][1];
           
            @$temp[$a][0]=@$arrayName[$i][0];
            @$temp[$a][1]=@$arrayName[$i][1];
            $a++;
           
             //echo @$temp[$a][0];
        }
        }
//        echo $arrayName;
        return $temp;
    }
    function remove_null($arrayName){
       $a=0;
        $temp=array();
        $count=count($arrayName);
        for($i=0;$i<=$count+1;$i++){
//            echo @$arrayName[$i][1];
        if(!(is_null(@$arrayName[$i][0]))){
//            $temp[$a][0]=$arrayName[$i][0];
//            $temp[$a][1]=$arrayName[$i][1];
           if(@$arrayName[$i][1]>0){
            @$temp[$a][0]=@$arrayName[$i][0];
            @$temp[$a][1]=@$arrayName[$i][1];
            $a++;
           }
             //echo @$temp[$a][0];
        }
        }
//        echo $arrayName;
        return $temp;
//        print_r($temp);
    } 
    function remove_nulls_in_question($arrayName){
      $a=0;
        $temp=array();
        $count=count($arrayName);
        for($i=0;$i<=$count+1;$i++){
        if(!(is_null(@$arrayName[$i][0]))){
            @$temp[$a][0]=@$arrayName[$i][0];
            @$temp[$a][1]=@$arrayName[$i][1];
            $a++;
        }
         else{
           
           }
    }   
//        print_r($temp);
        return $temp;
    }
    function remove_nulls_in_array_four($arrayName){
        $a=0;
        $temp=array();
        $count=count($arrayName);
        for($i=0;$i<=$count+1;$i++){
//            echo @$arrayName[$i][1];
        if(!(is_null(@$arrayName[$i][0]))){
//            $temp[$a][0]=$arrayName[$i][0];
//            $temp[$a][1]=$arrayName[$i][1];
           for($j=0;$j<4;$j++){
            @$temp[$a][$j]=@$arrayName[$i][$j];
           }    
            $a++;
             //echo @$temp[$a][0];
        }
        }
//        echo $arrayName;
        return $temp;
    }

    function License_billing_quantity($tempArray){
        $temp=array();
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        if($ModeOfSale!='Support Only Sale'){
        $license_qty=remove_null($tempArray);
        $license=$_SESSION['license'];
        $count=count($license_qty);
        for($j=0;$j<=$count+1;$j++){
                $question=@$license_qty[$j][0];
                $qty=@$license_qty[$j][1];
                $query="select * from BasePrices where product_module= '$ProdModule' and question='$question' and country='$Country' and license_type='$license'";
                $result=mysqli_query($connect,$query);
                if(!$result){
                    echo "database query failed";
                    die();
                }
            //.$row['part_number'].<input class='form-control' type='text' value='".$row['part_number']."' readonly>
                $row=mysqli_fetch_array($result);
                $i=0;
                $temp[$j][$i]=$row['part_number'];
                $i++;
                $temp[$j][$i]=$row['part_desc'];
                $i++;
                $temp[$j][$i]=$qty;
                $i++;
                $temp[$j][$i]=round($qty * $row['base_price'] * get_exchange_rate());
//                echo "<div class='row'><div class='col-xs-3'>";echo $row['part_number'];echo "</div>
//                        <div class='col-xs-7'>";echo $row['part_desc']; echo "</div>
//                        <div class='col-xs-1' style='text-align:center'>"; echo $qty; echo "</div>
//                        <div class='col-xs-1'>"; echo $qty * $row['base_price'];echo "</div></div><br>";
            }
            
            return $temp;
            }
        }
        
// FUNCTION FOR LICENSE QUANTITY SUBSCRIPTION 

    function License_billing_quantity_subscription($tempArray){
        $temp=array();
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        if($ModeOfSale!='Support Only Sale'){
        $license_qty=remove_null($tempArray);
//        print_r($license_qty);
        $license=$_SESSION['license'];
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

    function Product_billing_quantity($tempArray){
            $temp=array();
            include ("../includes/post_value_arrays.php");
            include ("../includes/config.php");
            $license=$_SESSION['license'];
            $product_qty=remove_null($tempArray);
//            print_r($product_qty);
            $count=count($product_qty);
            for($j=0;$j<$count;$j++){
                $question=$product_qty[$j][0];
                $qty=@$product_qty[$j][1];
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
//                $temp[$j][$i]=$qty * $row['base_price'];
                $temp[$j][$i]= round(($qty*$row['base_price']*$ProdSupport) *get_exchange_rate());
            }
        $_SESSION['prod_qty_ary']=$temp;
//        print_r($temp);
        return $temp;
        }

    function Professional_billing_quantity($tempArray,$temparray2){
            $temp=array();
            include ("../includes/post_value_arrays.php");
            include ("../includes/config.php");
            
            if($ModeOfSale!='Support Only Sale'){
            if($prof_services_all=="No"){
                    $QuestionsAndValues_Prof=remove_null($tempArray);
                    $QuestionsAndValues_Prof=Get_questions_to_prof($QuestionsAndValues_Prof,$Qty_2s_3s);
                    $count=count($QuestionsAndValues_Prof);
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
                        $temp[$j][$i]=round($professional_service_value * get_exchange_rate());
                    }
                   return $temp;
                }else{
                    $Qty_2s_3s=remove_null($temparray2);
                    $QuestionsAndValues_Prof=remove_nulls_in_array($tempArray);
                    $QuestionsAndValues_Prof=Get_questions_to_license($QuestionsAndValues_Prof,$Qty_2s_3s);
                    $QuestionsAndValues_Prof=remove_null($QuestionsAndValues_Prof);
                    $count=count($QuestionsAndValues_Prof);
//                    echo $count;
                    for($j=0;$j<=$count;$j++){
                        $question1=@$QuestionsAndValues_Prof[$j][0];
                        $question2=@$Qty_2s_3s[$j][0];
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
                        $temp[$j][$i]=round($professional_service_value * get_exchange_rate());
//                        echo "<div class='row'><div class='col-xs-3'>";echo $row['part_number'];echo "</div>
//                        <div class='col-xs-7'>";echo $row['part_desc']; echo "</div>
//                        <div class='col-xs-1' style='text-align:center'>"; echo $qty; echo "</div>
//                        <div class='col-xs-1'>"; echo round($professional_service_value);echo "</div></div><br>";
                    }
                    $temp=remove_nulls_in_array_four($temp);
                    return $temp;
                }
//            $_SESSION['prof_qty_ary']=$temp;
        }

    }

    function Get_questions_to_prof($profArray,$licenseArray){
       $count=count($profArray);
        $temp=array();
        for($i=0;$i<$count;$i++){
            if($profArray[$i][0]=="Professional Services Required on SAP HANA Database Units (per 64GB unit size) "){
                $temp[$i][0]="Professional Services Required on SAP HANA Database Units (per 64GB unit size)";
                $temp[$i][1]=0;
            }else if($profArray[$i][0]=="Professional Services Required on SAP HANA Database Nodes on Production"){
                $temp[$i][0]="Professional Services Required on SAP HANA Database Units (per 64GB unit size)";
                $LicenseCount=count($licenseArray);
                for($j=0;$j<=$LicenseCount;$j++){
                    if($licenseArray[$j][0]=="Number of SAP HANA Database Nodes on Production"){
                       $temp[$i][1]=$licenseArray[$j][1]; 
                        $j=$LicenseCount+1;    
                    }else{
                       $temp[$i][1]=0;
                    }
//                    echo $temp[$i][1];
                }
            }else{
               $temp[$i][0]=$profArray[$i][0];
               $temp[$i][1]=$profArray[$i][1];
            }
        }
      $temp=remove_null($temp);
        return $temp;
    }
    function Get_questions_to_license($profArray,$licenseArray){
        $count=count($licenseArray);
        $temp=array();
        for($i=0;$i<$count;$i++){
            if($licenseArray[$i][0]=="Number of VM Images to be protected under Sanovi Cloud Continuity Module"){
                $temp[$i][0]="Professional Services Required on VM Images to be protected under Sanovi Cloud Continuity Module";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of VM Databases to be protected under Sanovi Cloud Continuity Module"){
                $temp[$i][0]="Professional Services Required on VM Databases to be protected under Sanovi Cloud Continuity Module";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of Baremetal Windows/Linux Datas (Servers) to be protected under Sanovi Cloud Continuity Module"){
                $temp[$i][0]="Professional Services Required on Baremetal Windows/Linux Datas (Servers) to be protected under Sanovi Cloud Continuity Module";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of Baremetal Windows/Linux Databases to be protected under Sanovi Cloud Continuity Module"){
                $temp[$i][0]="Professional Services Required on Baremetal Windows/Linux Databases to be protected under Sanovi Cloud Continuity Module";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of Baremetal Unix Datas (Servers) to be protected under Sanovi Cloud Continuity Module"){
                $temp[$i][0]="Professional Services Required on Baremetal Unix Datas (Servers) to be protected under Sanovi Cloud Continuity Module";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of Baremetal Unix Databases to be protected under Sanovi Cloud Continuity Module"){
                $temp[$i][0]="Professional Services Required on Baremetal Unix Databases to be protected under Sanovi Cloud Continuity Module";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of Sharepoint Servers to be protected under Sanovi Cloud Continuity Module"){
                $temp[$i][0]="Professional Services Required on Sharepoint Servers to be protected under Sanovi Cloud Continuity Module";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of Virtual Sharepoint Servers to be protected under Sanovi Cloud Continuity Module"){
                $temp[$i][0]="Professional Services Required on Virtual Sharepoint Servers to be protected under Sanovi Cloud Continuity Module";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of Production MS Exchange Data Availability Group (DAGs)"){
                $temp[$i][0]="Professional Services Required on Production MS Exchange Data Availability Group (DAGs)";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of Production Virtual MS Exchange Data Availability Group ( DAGs)"){
                $temp[$i][0]="Professional Services Required on Production Virtual MS Exchange Data Availability Group ( DAGs)";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of Production Servers that are using Advanced Replication for data protection"){
                $temp[$i][0]="Professional Services Required on Production Servers that are using Advanced Replication for data protection";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of Virtual Production Servers that are using Advanced Replication for data protection"){
                $temp[$i][0]="Professional Services Required on Virtual Production Servers that are using Advanced Replication for data protection";
                $temp[$i][1]=$licenseArray[$i][1];
            }else if($licenseArray[$i][0]=="Number of SAP HANA Database Nodes on Production"){
                $temp[$i][0]="Professional Services Required on SAP HANA Database Units (per 64GB unit size)";
                $temp[$i][1]=$licenseArray[$i][1];
            }else{
                
            } 
        }
        return $temp;
    }  

    function  generateReferenceId(){
        $num="";
        $text="SAN/";
        $year1=date('Y');
        $year2=date('y');
        $month=date('n');    
        $day=date('j');
        if ($month > 3) { //
           $nextyear = $year2 + 1;
            $finYr = $year1."-".$nextyear;
        } else {
            $finYr = ($year1 - 1)."-".$year2;
        }
        $num=FindLastSavedReferenceId();
//        print_r($num);
        $ref=$text.$finYr."/".($num["ref_id"]+1);
//        echo $ref;
        $_SESSION['ref_id']=$ref;
        return $ref;
    }
//.($num["ref_id"]+1)
    function FindLastSavedReferenceId(){
        include ("../includes/config.php");
        $query="SELECT * from RefVerID ORDER BY ref_id DESC LIMIT 1";
        $result=mysqli_query($connect, $query);
        if (!$result){
            echo "Update failed";
            die();
        }
        $row=mysqli_fetch_array($result);
        $details=array();
        $details["ref_id"]=$row["ref_id"];
        $details["ver_id"]=$row["ver_id"];
//        echo  $details["ref_id"];
        return $details;
        
    }
    function updateReferenceVersionTable(){
        include ("../includes/config.php");
        
        $refid=FindLastSavedReferenceId();
        $refno=$refid["ref_id"]+1;
        $query="INSERT INTO RefVerID(ref_id,ver_id) values ('$refno','1')";
        $result=mysqli_query($connect, $query);
        if ($result) {
//            echo "New record created successfully";
        } else {
            echo "Update failed";
            die();
        }
    }
    
    function saveLicenseHistory($licenseCost,$licenseDiscountValue,$final_license_cost,$productSupoortCost,
                               $prodDiscountValue,$finalSupportCost,$PSCost, $discountValueOnPs,$finalPSCost,$product_training_cost,$product_training_discount_value,$final_product_training_cost,$totalValue){
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        $license_lht_id=(generateReferenceId()."_1");
        $licenseCostAfterDiscount=$licenseCostAfterDiscount+round(get_exchange_rate()*(calculate_3site_licence()*0.5));
        $query="INSERT INTO LicenseHistory (license_lht_id,licenseCost,discountPercentageOnLicense,licenseDiscountValue,licenseCostAfterDiscount,productSupportCost,discountPercentageOnSupport,prodDiscountValue,finalSupportCost,PSCost,discountPercentageOnPS,discountValueOnPs,finalPSCost,trainingCost,discountPercentageOnTraining,trainingDiscountValue,finalTrainingCost,discountPercentageOnBunkerSite,finalLicenseCost,totalValue)
        VALUES ('$license_lht_id','$licenseCost','$Discount_license','$licenseDiscountValue','$licenseCostAfterDiscount','$productSupoortCost','$Discount_product_support','$prodDiscountValue',
        '$finalSupportCost','$PSCost','$Discount_prof_serv','$discountValueOnPs','$finalPSCost','$product_training_cost','$Discount_product_training','$product_training_discount_value','$final_product_training_cost','50','$final_license_cost','$totalValue')";
        $result=mysqli_query($connect, $query);
        if ($result) {
//            echo "New record created successfully";
        } else {
            echo "Update failed";
            die();
        }
        mysqli_close($connect);
    }
    
    function saveCustomerDetails(){
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        
        $license_crt_id=(generateReferenceId()."_1");
       $query="INSERT INTO CustomerRequirements (license_crt_id,
product,
license_type,
country,
cust_currency,
cust_org_name,
cust_name,
partner,
option_tag,
mode_of_sale,
product_module,
2s_noOfVmImages,
2s_noOfVmDatabases,
2s_noOfBareMetalWinLinuxServers,
2s_noOfBareMetalWinLinuxDatabases,
2s_noOfBareMetalUnixServers,
2s_noOfBareMetalUnixDatabases,
2s_noOfUsingAdvancedReplication,
2s_noOfVirtualServersUsingAdvancedReplication,
2s_noOfSharePointServers,
2s_noOfVirtualSharePointServers,
2s_noOfMSExchangeDatabases,
2s_noOfVirtualMSExchangeDatabases,
2s_noOfserversforPFRReplication,
2s_noOfSAPHANADatabases,
2s_noOfSAPHANANodes,
3s_isBunkerSite,
3s_noOfVmImages,
3s_noOfVmDatabases,
3s_noOfBareMetalWinLinuxServers,
3s_noOfBareMetalWinLinuxDatabases,
3s_noOfBareMetalUnixServers,
3s_noOfBareMetalUnixDatabases,
3s_noOfVirtualServersUsingAdvancedReplication,
3s_noOfUsingAdvancedReplication,
3s_noOfSharePointServers,
3s_noOfVirtualSharePointServers,
3s_noOfMSExchangeDatabases,
3s_noOfVirtualMSExchangeDatabases,
3s_noOfserversforPFRReplication,
3s_noOfSAPHANADatabases,
3s_noOfSAPHANANodes,
areProfessionalServicesRequired,
Prof_serviceType,
Prof_noOfVmImages,
Prof_noOfVmDatabases,
Prof_noOfBareMetalWinLinuxServers,
Prof_noOfBareMetalWinLinuxDatabases,
Prof_noOfBareMetalUnixServers,
Prof_noOfBareMetalUnixDatabases,
Prof_noOfUsingAdvancedReplication,
Prof_noOfVirtualServersUsingAdvancedReplication,
Prof_noOfSharePointServers,
Prof_noOfSharePointDatabases,
Prof_noOfVirtualSharePointServers,
Prof_noOfVirtualSharePointDatabases,
Prof_noOfMSExchangeDatabases,
Prof_noOfVirtualMSExchangeDatabases,
Prof_noOfSAPHANADatabases,
Prof_noOfSAPHANANodes,
Prof_PremiseProductTraining,
yearsOfSupport,
noOfVmImages_2s,
noOfVmDatabases_2s,
noOfBareMetalWinLinuxServers_2s,
noOfBareMetalWinLinuxDatabases_2s,
noOfBareMetalUnixServers_2s,
noOfBareMetalUnixDatabases_2s,
noOfVirtualSharePointServers_2s,
noOfSharePointServers_2s,
noOfVirtualMSExchangeDatabases_2s,
noOfMSExchangeDatabases_2s,
noOfVirtualServersUsingAdvancedReplication_2s,
noOfUsingAdvancedReplication_2s,
noOfServersForPFRReplication_2s,
noOfSAPHANADatabases_2s,
noOfSAPHANANodes_2s,
isBunkerSite_3s,
noOfServersInBunkerSite_3s,
noOfVmImages_3s,
noOfVmDatabases_3s,
noOfBareMetalWinLinuxServers_3s,
noOfBareMetalWinLinuxDatabases_3s,
noOfBareMetalUnixServers_3s,
noOfBareMetalUnixDatabases_3s,
noOfVirtualServersUsingAdvancedReplication_3s,
noOfUsingAdvancedReplication_3s,
noOfVirtualSharePointServers_3s,
noOfSharePointServers_3s,
noOfVirtualMSExchangeDatabases_3s,
noOfMSExchangeDatabases_3s,
noOfServersForPFRReplication_3s,
noOfSAPHANADatabases_3s,
noOfSAPHANANodes_3s,
areProfessionalServicesRequired_Q,
serviceType_Prof,
noOfVmImages_Prof,
noOfVmDatabases_Prof,
noOfBareMetalWinLinuxServers_Prof,
noOfBareMetalWinLinuxDatabases_Prof,
noOfBareMetalUnixServers_Prof,
noOfBareMetalUnixDatabases_Prof,
noOfUsingAdvancedReplication_Prof,
noOfVirtualServersUsingAdvancedReplication_Prof,
noOfSharePointServers_Prof,
noOfSharePointDatabases_Prof,
noOfVirtualSharePointServers_Prof,
noOfVirtualSharePointDatabases_Prof,
noOfMSExchangeDatabases_Prof,
noOfVirtualMSExchangeDatabases_Prof,
noOfSAPHANADatabases_Prof,
noOfSAPHANANodes_Prof,
OnPremiseProductTrainingReqd_Prof)
        VALUES ('$license_crt_id',
'$product',
'$license',
'$Country',
'$Currency',
'$OrgName',
'$CustomerName',
'$Partner',
'$OptionTag',
'$ModeOfSale',
'$ProdModule',
'$vm_images_2s',
'$db_2s',
'$b_windows_datas_2s',
'$b_windows_db_2s',
'$b_unix_datas_2s',
'$b_unix_db_2s',
'$prod_servers_2s',
'$virtual_prod_2s',
'$share_server_2s',
'$virtual_sharepoint_server_2s',
'$prod_ms_2s',
'$prod_v_ms_2s',
'$servers_2s',
'$sap_hana_data_2s',
'$sap_hana_nodes_2s',
'$bunker_3s',
'$vm_images_3s',
'$database_3s',
'$b_windows_datas_3s',
'$b_windows_db_3s',
'$b_unix_datas_3s',
'$b_unix_db_3s',
'$virtual_prod_3s',
'$prod_servers_3s',
'$share_server_3s',
'$virtual_server_3s',
'$prod_ms_3s',
'$prod_v_ms_3s',
'$servers_3s',
'$sap_hana_data_3s',
'$sap_hana_nodes_3s',
'$prof_services_all',
'$Type_of_service',
'$prof_services_vm_image',
'$prof_services_database',
'$prof_services_b_windows_datas',
'$prof_services_b_windows_db',
'$prof_services_b_unix_datas',
'$prof_services_b_unix_db',
'$prof_services_prod_servers',
'$prof_services_virtual_prod',
'$prof_services_share_server',
'$prof_services_share_db',
'$prof_services_v_share_server',
'$prof_services_v_share_db',
'$prof_services_prod_ms',
'$prof_services_prod_v_ms',
'$prof_services_sap_hana_data',
'$prof_services_sap_hana_node',
'$prof_premise_product_training',
'$ProdSupport',
'vm_images_2S',
'db_2S',
'b_windows_datas_2S',
'b_windows_db_2S',
'b_unix_datas_2S',
'b_unix_db_2S',
'virtual_sharepoint_server_2S',
'share_server_2S',
'prod_v_ms_2S',
'prod_ms_2S',
'virtual_prod_2S',
'prod_servers_2S',
'servers_2S',
'sap_hana_data_2S',
'sap_hana_nodes_2S',
'bunker_3S',
'bunker_servers_3s',
'vm_images_3S',
'database_3S',
'b_windows_datas_3S',
'b_windows_db_3S',
'b_unix_datas_3S',
'b_unix_db_3S',
'virtual_prod_3S',
'prod_servers_3S',
'virtual_server_3S',
'share_server_3S',
'prod_v_ms_3S',
'prod_ms_3S',
'servers_3S',
'sap_hana_data_3S',
'sap_hana_nodes_3S',
'Prof_Services_all',
'Prof_Services_type',
'Prof_Services_vm_image',
'Prof_Services_database',
'Prof_Services_b_windows_datas',
'Prof_Services_b_windows_db',
'Prof_Services_b_unix_datas',
'Prof_Services_b_unix_db',
'Prof_Services_prod_servers',
'Prof_Services_virtual_prod',
'Prof_Services_share_server',
'Prof_Services_share_db',
'Prof_Services_v_share_server',
'Prof_Services_v_share_db',
'Prof_Services_prod_ms',
'Prof_Services_prod_v_ms',
'Prof_services_sap_hana_data',
'Prof_services_sap_hana_node',
'Premise_product_training')";
         $result=mysqli_query($connect, $query);
        if ($result) {
//            echo "New record created successfully";
        } else {
            echo "Update failed";
            die();
        }
    }

    function saveLicenseGeneration(){
        include ("../includes/post_value_arrays.php");
        include ("../includes/config.php");
        $license_reference_id=generateReferenceId();
        $license_revision_id="1";
        $login_name=$_SESSION["username"];
        //$license_generation_date='now()';
        $license_crt_id=$license_reference_id."_".$license_revision_id;
        $license_lht_id=$license_reference_id."_".$license_revision_id;
        date_default_timezone_set("Asia/Kolkata");
        $quote_saved_time = date('Y-m-d H:i:s');   
        $query="INSERT INTO LicenseGeneration (license_reference_id,license_revision_id,login_name,license_generation_date,license_crt_id,license_lht_id,status)
        VALUES ('$license_reference_id', '$license_revision_id', '$login_name', '$quote_saved_time', '$license_crt_id', '$license_lht_id','Draft')";
        $result=mysqli_query($connect, $query);
        if ($result) {
//            echo "New record created successfully";
        } else {
            echo "Update failed";
            die();
        }
    }


    function finalize($refid,$annexure_1){
    include ("../includes/config.php");
    $query="UPDATE LicenseGeneration set status='Finalized',annexure_1='$annexure_1' where license_reference_id='$refid'";
    $result=mysqli_query($connect, $query);
    if ($result) {
    } else {
        echo "Update failed_finalized";
        die();
    }
}
function draft($refid,$approver_emp_id,$annexure_1){
    include ("../includes/config.php");
    $query="UPDATE LicenseGeneration set status='Discount',approved_by_emp_id='$approver_emp_id',annexure_1='$annexure_1' where license_reference_id='$refid'";
    $result=mysqli_query($connect, $query);
    if ($result) {
    } else {
        echo "Update failed_finalized";
        die();
    }
}
function draft_quoteRequestor($refid,$approver_emp_id,$annexure_1){
    include ("../includes/config.php");
    $query="UPDATE LicenseGeneration set status='Draft',approved_by_emp_id='$approver_emp_id',annexure_1='$annexure_1' where license_reference_id='$refid'";
    $result=mysqli_query($connect, $query);
    if ($result) {
    } else {
        echo "Update failed_finalized";
        die();
    }
}

function get_approver_emp_id($rep_mg_emailid){
    include ("../includes/config.php");
    $query="SELECT emp_id from users where email_id='$rep_mg_emailid'";
    $result=mysqli_query($connect, $query);
    if (!$result) {
        echo "Update failed_finalized";
        die();
    }
    $row=mysqli_fetch_array($result);
    return $row['emp_id'];
}
function get_approver_name($rep_mg_emailid){
    include ("../includes/config.php");
    $query="SELECT emp_name from users where email_id='$rep_mg_emailid'";
    $result=mysqli_query($connect, $query);
    if (!$result) {
        echo "Update failed_finalized";
        die();
    }
    $row=mysqli_fetch_array($result);
    return $row['emp_name'];
}
    function updateDiscountValues($refid,$discountlicense,$discount_license_value,$final_license_value,$discount_3s,$product_support_discount,$product_support_discount_value,$product_support_value_after_discount,$professional_service_discount,$professional_service_discount_value,$professional_service_value_after_discount,$product_training_discount,$product_training_discount_value,$product_training_value_after_discount,$final_discount_value,$final_value_after_discount){
       include ("../includes/config.php");
//        $total_license_value=$final_license_value-$discount_3s;
        $lht_id=$refid."_1";
        $query="UPDATE LicenseHistory set discountPercentageOnLicense='$discountlicense',
        licenseDiscountValue='$discount_license_value', 
        licenseCostAfterDiscount='$final_license_value', 
        discountPercentageOnSupport='$product_support_discount',
        prodDiscountValue='$product_support_discount_value',
        finalSupportCost='$product_support_value_after_discount',
        discountPercentageOnPS='$professional_service_discount',
        discountValueOnPS='$professional_service_discount_value',
        finalPSCost='$professional_service_value_after_discount',
        discountPercentageOnTraining='$product_training_discount',
        trainingDiscountValue='$product_training_discount_value',
        finalTrainingCost='$product_training_value_after_discount',
        finalLicenseCost='$final_license_value',
        totalValue='$final_value_after_discount' where license_lht_id='$lht_id'";
        $result=mysqli_query($connect, $query);
        if ($result) {
        } else {
            echo "Update failed at discount";
            die();
        }
    }

function send_email_alert($emp_id,$discount,$refId,$verId){
       include ("../includes/config.php");
        $approver_email_id=find_reporting_manager($emp_id,$discount);
        return $approver_email_id;  
}
function find_reporting_manager($emp_id,$discount){
       include ("../includes/config.php");
        $query="SELECT reporting_manager from users where emp_id='$emp_id'";
        $result=mysqli_query($connect, $query);
        if (!$result) {
            echo "Database Query failed";
            die();
        }
        $row=mysqli_fetch_array($result);
        $rep_emp_id=$row['reporting_manager']; 
        $get_rep_mg_email_id=get_rep_mg_details($rep_emp_id,$discount);
        return $get_rep_mg_email_id;
}
function get_rep_mg_details($rep_emp_id,$discount){
       include ("../includes/config.php");
        $query="SELECT login_role,email_id from users where emp_id='$rep_emp_id'";
        $result=mysqli_query($connect, $query);
        if (!$result) {
            echo "Database Query failed";
            die();
        }
        $row=mysqli_fetch_array($result);
        $rep_mg_max_discount=get_rep_mg_discount($row['login_role']);
//        echo "enteredDiscount".$discount."<br>";
//        echo "repmangerdiscount".$rep_mg_max_discount."<br>";
        if($discount <= $rep_mg_max_discount){
            return $row['email_id'];
        }else{
           return find_reporting_manager($rep_emp_id,$discount);
        }
} 
function get_rep_mg_discount($role){
       include ("../includes/config.php");
        $query="SELECT MaxDiscount from UserRoles where UserRole='$role'";
        $result=mysqli_query($connect, $query);
        if (!$result) {
            echo "Database Query failed";
            die();
        }
        $row=mysqli_fetch_array($result);
        return $row['MaxDiscount'];
}
?>  