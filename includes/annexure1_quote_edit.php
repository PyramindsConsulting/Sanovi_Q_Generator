<div id="box">
                <div class='styled' id='bg_clr' style="font-size:15px;">
                    <div class='col-xs-3' style="text-align:center;font-weight:bold;">Part No/Licensing</div>
                    <div class='col-xs-7' style="text-align:center"><b>License Item Description</b></div>
                    <div class='col-xs-1' style="text-align:right;font-weight:bold;">Qty</div>
                    <div class='col-xs-1' style="text-align:center;font-weight:bold;padding-left:0px;padding-right:0px;">Total Price<br>
                        (<?php echo $Currency;?>)</div>
                </div>
                <br>
                <?php
                $license=$_SESSION['license'];
                if($license=='Perpetual'){
                    $license_qty=License_billing_quantity_edit($Qty_2s_3s);
                }else{
                    $license_qty=License_billing_quantity_subscription_edit($Qty_2s_3s);
                }
                $_SESSION['license_qty_ary']=$license_qty;
                $license_qty=remove_nulls_in_array_four($license_qty);
                $count=count($license_qty);
                for($i=0;$i<$count;$i++){
                    $part_number=$license_qty[$i][0];
                    $part_description=$license_qty[$i][1];
                    $part_qty=$license_qty[$i][2];
                    $part_price=$license_qty[$i][3];
                        echo "<div class='row'>";
                        echo    "<div class='form-group plaintxtbox'>";
                        echo        "<div class='col-sm-3'>";
                        echo            "<input type='text' class='form-control' name='part_no_lic$i' readonly value= '$part_number'".">";
                        echo        "</div>";
                        echo        "<div class='col-sm-7'>";
                        echo          "<input type='text' readonly class='form-control' name='part_desc_lic$i'  wrap='true' value= '$part_description'".">";
//                        echo        "<textarea type='text' readonly cols='80%' >".$part_description."</textarea>";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control'  name='part_qty_lic$i' style='text-align:right' readonly value= '$part_qty'".">";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control'  name='part_price_lic$i' style='text-align:right' readonly value= '$part_price'".">";
//                        echo        "<textarea type='text' readonly size='100%'>".$part_price."</textarea>";
                        echo        "</div>";
                        echo     "</div>";
                        echo "</div><br>";
                }

            $license=$_SESSION['license'];
            $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='License' and country='$Country' and license_type='$license'";
             $result=mysqli_query($connect,$query); 
                if ($result->num_rows > 0) {
                while($row=mysqli_fetch_array($result)){
                        $part_number=$row['part_number'];
                        $part_no="part_no_lic".$count;
                        $part_des="part_desc_lic".$count;
                        $part_qty="part_qty_lic".$count;
                        $part_cost="part_price_lic".$count;
                        $part_desc=$row['part_desc'];
                        $part_price=$row['base_price']* get_exchange_rate();
                        echo "<div class='row'>";
                        echo    "<div class='form-group plaintxtbox'>";
                        echo        "<div class='col-sm-3'>";
                        echo            "<input type='text' class='form-control' name='$part_no' readonly value= '$part_number'".">";
                        echo        "</div>";
                        echo        "<div class='col-sm-7'>";
                        echo          "<input type='text' readonly class='form-control' name='$part_des'  wrap='true' value= '$part_desc'".">";
//                        echo        "<textarea type='text' readonly cols='80%' >".$part_description."</textarea>";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control' name='$part_qty' style='text-align:right' readonly value= '1'>";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control' name='$part_cost' style='text-align:right' readonly value= '$part_price'".">";
//                        echo        "<textarea type='text' readonly size='100%'>".$part_price."</textarea>";
                        echo        "</div>";
                        echo     "</div>";
                        echo "</div><br>";
                    }
                }
            ?>
            </div>
         <div id="box">
                <div class='styled' id='bg_clr'>
                    
                    <div class='col-xs-7 col-xs-offset-3' style="text-align:center"><b>Professional Item Description</b></div>
                    <div class='col-xs-1' style="text-align:right;font-weight:bold;">Qty</div>
                    <div class='col-xs-1' style="text-align:center;font-weight:bold;padding-left:0px;padding-right:0px;">Total Price<br>(<?php echo $Currency;?>)</div>
                </div>
                <br>
                <?php
//                print_r($QuestionsAndValues_Prof);
                $professional= Professional_billing_quantity_edit($QuestionsAndValues_Prof,$Qty_2s_3s);
               // $professional=remove_nulls_in_array_four($professional);
//                print_r($professional);
                 $_SESSION['prof_qty_ary']=$professional;
                $count=count($professional);
                for($i=0;$i<$count;$i++){
                    $part_number=$professional[$i][0];
                    $part_description=$professional[$i][1];
                    $part_qty=$professional[$i][2];
                    $part_price=$professional[$i][3];
                        echo "<div class='row'>";
                        echo    "<div class='form-group plaintxtbox'>";
                        echo        "<div class='col-sm-3'>";
                        echo            "<input type='text' class='form-control' name='part_no_prof$i' readonly value= '$part_number'".">";
                        echo        "</div>";
                        echo        "<div class='col-sm-7'>";
                        echo          "<input type='text' readonly class='form-control' name='part_desc_prof$i'  wrap='true' value= '$part_description'".">";
//                        echo        "<textarea type='text' readonly cols='80%' >".$part_description."</textarea>";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control' name='part_qty_prof$i' style='text-align:right' readonly value= '$part_qty'".">";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control' name='part_price_prof$i' style='text-align:right' readonly value= '$part_price'".">";
//                        echo        "<textarea type='text' readonly size='100%'>".$part_price."</textarea>";
                        echo        "</div>";
                        echo     "</div>";
                        echo "</div><br>";
                }

                $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='Professional_services' and country='$Country'";
                $result=mysqli_query($connect,$query); 
                if ($result->num_rows > 0) {
                while($row=mysqli_fetch_array($result)){
                    $part_number=$row['part_number'];
                    $part_no="part_no_prof".$count;
                    $part_des="part_desc_prof".$count;
                    $part_qty="part_qty_prof".$count;
                    $part_cost="part_price_prof".$count;
                    $part_desc=$row['part_desc'];
                    $part_price=$row['base_price']*get_exchange_rate();
                        echo "<div class='row'>";
                        echo    "<div class='form-group plaintxtbox'>";
                        echo        "<div class='col-sm-3'>";
                        echo            "<input type='text' class='form-control' name='$part_no' readonly value= '$part_number'".">";
                        echo        "</div>";
                        echo        "<div class='col-sm-7'>";
                        echo          "<input type='text' readonly class='form-control' name='$part_des'  wrap='true' value= '$part_desc'".">";
    //                        echo        "<textarea type='text' readonly cols='80%' >".$part_description."</textarea>";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control' name='$part_qty' style='text-align:right' readonly value= '1'>";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control' name='$part_cost' style='text-align:right' readonly value= '$part_price'".">";
    //                        echo        "<textarea type='text' readonly size='100%'>".$part_price."</textarea>";
                        echo        "</div>";
                        echo     "</div>";
                        echo "</div><br>";
                    }
                }
                $license=$_SESSION['license'];
                 $query2="select * from BasePrices where product_module='PREMISE PRODUCT TRAINING' and country='$Country'";
                $result2=mysqli_query($connect,$query2); 
                if ($result2->num_rows > 0) {
                while($row2=mysqli_fetch_array($result2)){
                    $part_number=$row2['part_number'];
                    $part_no="part_no_prof".$count;
                    $part_des="part_desc_prof".$count;
                    $part_qty="part_qty_prof".$count;
                    $part_cost="part_price_prof".$count;
                    $part_desc=$row2['part_desc'];
                    
                    
                        if($ModeOfSale=='First Time Sale'){
                            if($prof_premise_product_training=="Yes"){
                                $node_servers=ceil($_SESSION['count_of_servers_databases']/40);
                                $part_price=$node_servers*$row2['base_price']*get_exchange_rate();
                            }
                        }
                        echo "<div class='row'>";
                        echo    "<div class='form-group plaintxtbox'>";
                        echo        "<div class='col-sm-3'>";
                        echo            "<input type='text' class='form-control' name='$part_no' readonly value= '$part_number'".">";
                        echo        "</div>";
                        echo        "<div class='col-sm-7'>";
                        echo          "<input type='text' readonly class='form-control' name='$part_des'  wrap='true' value= '$part_desc'".">";
    //                        echo        "<textarea type='text' readonly cols='80%' >".$part_description."</textarea>";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control' name='$part_qty' style='text-align:right' readonly value= '$node_servers'>";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control' name='$part_cost' style='text-align:right' readonly value= '$part_price'".">";
    //                        echo        "<textarea type='text' readonly size='100%'>".$part_price."</textarea>";
                        echo        "</div>";
                        echo     "</div>";
                        echo "</div><br>";
                    }
                }
            ?>
            </div>
            <div id="box">
                <div class='styled' id='bg_clr'>
                    <div class='col-xs-3' style="text-align:center;font-weight:bold;">Part No/Licensing</div>
                    <div class='col-xs-7' style="text-align:center"><b>Product support Description</b></div>
                    <div class='col-xs-1' style="text-align:right;font-weight:bold;">Qty</div>
                    <div class='col-xs-1' style="text-align:center;font-weight:bold;padding-left:0px;padding-right:0px;">Total Price<br>
                        (<?php echo $Currency;?>)</div>
                </div>
                <br>
                <?php
                
                $product=Product_billing_quantity_edit($QuestionsAndValues_2s);
//                $product=remove_nulls_in_array_four($product);
                $count=count($product);
//                echo $count;
                for($i=0;$i<$count;$i++){
                    $part_number=$product[$i][0];
                    $part_description=$product[$i][1];
                    $part_qty=$product[$i][2];
                    $part_price=$product[$i][3];
                        echo "<div class='row'>";
                        echo    "<div class='form-group plaintxtbox'>";
                        echo        "<div class='col-sm-3'>";
                        echo            "<input type='text' class='form-control' name='part_no_prod$i' readonly value= '$part_number'".">";
                        echo        "</div>";
                        echo        "<div class='col-sm-7'>";
                        echo          "<input type='text' readonly class='form-control' name='part_desc_prod$i'  wrap='true' value= '$part_description'".">";
//                        echo        "<textarea type='text' readonly cols='80%' >".$part_description."</textarea>";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control' name='part_qty_prod$i' style='text-align:right' readonly value= '$part_qty'".">";
                        echo        "</div>";
                        echo        "<div class='col-sm-1'>";
                        echo            "<input type='text' class='form-control' name='part_price_prod$i' style='text-align:right' readonly value= '$part_price'".">";
//                        echo        "<textarea type='text' readonly size='100%'>".$part_price."</textarea>";
                        echo        "</div>";
                        echo     "</div>";
                        echo "</div><br>";
                    }
                    $query="select * from BasePrices where mode_of_sale='$ModeOfSale' and product_support_questions='Product_support' and country='$Country'";
                    $result=mysqli_query($connect,$query); 
                        if ($result->num_rows > 0) {
                            while($row=mysqli_fetch_array($result)){
                            $part_number=$row['part_number'];
                            $part_no="part_no_prod".$count;
                            $part_des="part_desc_prod".$count;
                            $part_qty="part_qty_prod".$count;
                            $part_cost="part_price_prod".$count;
                            $part_desc=$row['part_desc'];
                            $part_price=$row['base_price']*get_exchange_rate();
                                echo "<div class='row'>";
                                echo    "<div class='form-group plaintxtbox'>";
                                echo        "<div class='col-sm-3'>";
                                echo            "<input type='text' class='form-control' name='$part_no' readonly value= '$part_number'".">";
                                echo        "</div>";
                                echo        "<div class='col-sm-7'>";
                                echo          "<input type='text' readonly class='form-control' name='$part_des'  wrap='true' value= '$part_desc'".">";
            //                        echo        "<textarea type='text' readonly cols='80%' >".$part_description."</textarea>";
                                echo        "</div>";
                                echo        "<div class='col-sm-1'>";
                                echo            "<input type='text' class='form-control' name='$part_qty' style='text-align:right' readonly value= '1'>";
                                echo        "</div>";
                                echo        "<div class='col-sm-1'>";
                                echo            "<input type='text' class='form-control' name='$part_cost' style='text-align:right' readonly value= '$part_price'".">";
            //                        echo        "<textarea type='text' readonly size='100%'>".$part_price."</textarea>";
                                echo        "</div>";
                                echo     "</div>";
                                echo "</div><br>";
                                }
                        }
                    ?>
            

            </div>