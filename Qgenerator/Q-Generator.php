<?php 
    session_start(); 
    ob_start();
    $result_code="";
    $error_code="error";

    //SET ACTIVE PAGE
    $_SESSION["active_page"]="q_generator";

    //BREADCRUMB DATA
    $root="Q-Generator";
    $root_link="q_generator.php";
    $active="";
    $loggedin_userrole=$_SESSION["userrole"];
//    $loggedin_user_empid=$_SESSION["emp_id"];
//    echo $loggedin_user_empid;
?>

    <!--ASIGNING USERROLE PHP VARIABLE TO JAVASCRIPT VARIABLE-->
    <script>
        function userRole() {
            loggedin_userrole = '<?php echo $loggedin_userrole ;?>';
            return loggedin_userrole;
        }
    </script>
    <!doctype html>
    <html>

    <head> 
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/crumbs.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style-bg-other-pages.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <!--JS FILES-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/menu-q-gen.js"></script>
        <script src="js/app.js"></script>
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
                include "../includes/jquery.php";
                $loggedin_user_empid=$_SESSION["emp_id"];
//                echo $loggedin_user_empid;
        ?>
    <div id="crumbs" style="width:100%;margin-top:2%">
        <ul>
            <li><a href="#" id="quote_request" class="active">Quote Request</a></li>
            <li><a href="#" id="config_review">Config Review</a></li>
            <li><a href="#" id="review_and_discount">Review and Discounts</a></li>
            <li><a href="#" id="quote_finalize">Quote Finalize</a></li>
        </ul>
    </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <center>
                            <h2 id="top">Q-Generator</h2></center>
                        <div class="col-sm-12">
                            <form action="quote.php" method="POST">
                                <div id="first">
                                    <div class='form-group'>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <label>Product</label>
                                            </div>
                                            <div class='col-sm-6'>
                                                <div class='dropdown'>
                                                    <select id='productname' class='form-control' name='Productname'>
                                                        <option value='Cloud Continuity'>Cloud Continuity</option>
                                                        <option value='Cloud Migration' disabled style="background-color:#cccccc">Cloud Migration</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <label>License Type</label>
                                            </div>
                                            <div class='col-sm-6'>
                                                <div class='dropdown'>
                                                    <select id='license' class='form-control' name='License'>
                                                        <option value='Perpetual'>Perpetual</option>
                                                        <option value='Subscription'>Subscription</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <label>Select the Country</label>
                                            </div>
                                            <div class='col-sm-6'>
                                                <?php 
                                                    $areas=find_rep_area($loggedin_user_empid);
                                                ?>
                                            
                                                <div class='dropdown'>
                                                    <select id='country' class='form-control' name='Country'>
                                                        <?php  if($areas['reporting_india']=="Yes"){ echo "<option value='India'>India</option>"; }?>
                                                        <?php  if($areas['reporting_me']=="Yes"){ echo "<option value='ME'>ME</option>";} ?>
                                                        <?php  if($areas['reporting_apac']=="Yes"){ echo "<option value='APAC'>APAC</option>";} ?>
                                                        <?php  if($areas['reporting_usa_europe']=="Yes"){ echo "<option value='USA/Europe'>USA/Europe</option>";} ?>
                                                        <?php  if($areas['reporting_row']=="Yes"){ echo "<option value='Rest of World'>Rest of World</option>";} ?>
                                                    </select> <span id='drop' style='color:red; font-size:15px; display:none'>Please select an option</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <label>Select the Currency</label>
                                            </div>
                                            <div class='col-sm-6'>
                                                <div class='dropdown'>
                                                    <select id='currency' class='form-control' name='Currency'>
                                                        <option value='USD'>USD</option>
                                                        <option value='AED'>AED</option>
                                                        <option value='SGD'>SSGD</option>
                                                        <option value='INR'>INR</option>
                                                    </select> <span id='drop' style='color:red; font-size:15px; display:none'>Please select an option</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class='form-group'>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <label style='font-size:16px'>Opportunity Name</label>
                                            </div>
                                            <div class='col-sm-6'>
                                                <input type='text' id='name' name='organization_name' class='form-control' value="" style='width:100%'> <span id='namelen' style='color:red;font-size:15px; display:none;'>please enter organization name</span>
                                            <span id='namecheck' style='color:red;font-size:15px;display:none'>please enter proper name</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <label style='font-size:16px'>Customer Name</label>
                                            </div>
                                            <div class='col-sm-6'>
                                                <input type='text' id='customer_name' name='Customer_name' class='form-control' value="" style='width:100%'> <span id='customername' style='color:red;font-size:15px;display:none'>please enter customer  name</span>
                                                <span id='customernamecheck' style='color:red;font-size:15px;display:none'>please enter proper customer name</span>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class='form-group'>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <label style='font-size:16px'>Partner</label>
                                            </div>
                                            <div class='col-sm-6'>
                                                <input type='text' id='partner' name='partner_name' class='form-control' value="" style='width:100%'> <span id='partnerlen' style='color:red;font-size:15px;display:none'>please enter Partner name</span>
                                            <span id='partnernamecheck' style='color:red;font-size:15px;display:none'>please enter proper name</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <label style='font-size:16px'>Notes(Option Tag)</label>
                                            </div>
                                            <div class='col-sm-6' id="optionDiv">
                                                <textarea rows="4" cols="50" id='option_tag' name='Option_tag' class='form-control'  style='width:100%' onblur="checkLengthOfNotes()"></textarea>
                                                <span id='optionlen' style='color:red;font-size:15px;display:none'>Max 256 characters allowed </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label style="font-size:16px">Mode of Sale</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="dropdown">
                                                    <select name="Mode_of_sale" id="mode_of_sale" class="form-control" onchange="changemodeofquestions()">
                                                        <option value="First Time Sale">First Time Sale</option>
                                                        <option value="Upgrade Sale">Upgrade Sale</option>
<!--                                                        <option value="Support Only Sale">Support Only Sale</option>-->
                                                    </select><span id="drop1" style="color:red; font-size:15px; display:none">Please select an option</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label style="font-size:16px">Product Module</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="dropdown">
                                                    <select name="Product_module" id="product_module" class="form-control">
                                                        <option value="DR Lifecycle Bundle">DR Lifecycle Bundle</option>
<!--
                                                        <option value="Drill Manager">Drill Manager</option>
                                                        <option value="Monitor/Recovery Bundle">Monitor/Recovery Bundle</option>
-->
                                                    </select><span id="drop2" style="color:red; font-size:15px; display:none">Please select an option</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-2 col-sm-offset-10">
                                            <button class="btn btn-success nextpagebtn" name="validate" type="button" onclick="next_page1()">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="second">
                                    <div class="container" id="supportDetails">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4"><b>Customer: </b><span id="customerName"></span> </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4"><b>Product: </b><span id="productName"></span></div>
                                            <div class="col-md-4 col-sm-4 col-xs-4"><b>Module: </b><span id="productModule"></span></div>
                                        </div>
                                    </div>
                                    <?php
                                        $sql = "select * from QGeneratorQuestions where category='2-Site_normal_set1' limit 0,20";
                                        
                                        $result = $connect->query($sql);
                                       
                                        if ($result->num_rows > 0) {
                                            //$_SESSION['question'] = $restaurant_row['restaurant_id'];
                                            echo "<div class='form-group addPersonPanel'>
                                                    <div class='panel panel-default'>
                                                        <div class='panel-heading'>
                                                            <label class='radio-inline'>
                                                                <input type='checkbox' class='licence' id='2-site' checked>&nbsp;&nbsp;<div class='tool' data-toggle='tooltip' data-placement='bottom' title='Provide Counts of all Production Components'>2-Site Configuration License</div>
                                                            </label>
                                                        </div>
                                                        <div class='panel-body collapse' id='table'>";
                                                          while($row = $result->fetch_assoc()) {

                                                          echo "<div class='row'>
                                                                    
                                                                    <div class='col-sm-12'> 
                                                                        <div class='form-group' id='".$row['name']."'> 
                                                                            <div class='col-sm-8'>" . $row["question"] . "</div>
                                                                            <div class='col-sm-4' id='".$row['name']."'>
                                                                                <input type='hidden' value='".$row["question"]."' name='".$row['id']."'>
                                                                                <input class='form-control' type='text' id='".$row['id']."' name='".$row['name']."' placeholder='0' style='width:100%'>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><br>";
                                                        }
                                                        
                                                        //Incase of enable all questions remove the below comments  
                                            
                                            
//                                                        $query3 = "select * from QGeneratorQuestions where category='2-Site_normal_set2' limit 0,20";
//                                                        $set2=$connect->query($query3);
//                                                        echo "<div id='2_site_panel' class='panel panel-default' style='padding-top:20px;'>";
//                                                        while($row = $set2->fetch_assoc()) {
//                                                                 
//                                                          echo "<div class='row'>
//                                                                    <div class='col-sm-12'> 
//                                                                        <div class='form-group' id='".$row['name']."'> 
//                                                                            <div class='col-sm-8'>" . $row["question"] . "</div>
//                                                                            <div class='col-sm-4' id='".$row['name']."'>
//                                                                                <input type='hidden' value='".$row["question"]."' name='".$row['id']."'>
//                                                                                <input class='form-control' type='text' id='".$row['id']."' name='".$row['name']."' placeholder='0' style='width:100%'>
//                                                                            </div>
//                                                                        </div>
//                                                                    </div>
//                                                                </div><br>";
//                                                        }
//                                                        echo "</div>";
//                                                        echo '<div class="row">
//                                                        <button type="button" class="btn" id="less1" style="float:right ;margin-right:15px" >Less</button>';
//                                                        echo '<button type="button" class="btn" id="button1" style="float:right ;margin-right:15px" >More</button></div><br>';      
//                                                        $query2 = "select * from QGeneratorQuestions where category='2-Site_advanced' limit 0,10";
//                                                        $advanced_replication= $connect->query($query2);
//                                                        if ($advanced_replication->num_rows > 0) {
//                                                        echo"<div class='row'>
//                                                                <div class='col-sm-12'>
//                                                                <div class='form-group addPersonPanel'>
//                                                            <div class='panel panel-default'>
//                                                            <div class='panel-heading'>
//                                                                <label class='radio-inline'>
//                                                                    <input type='checkbox' class='licence' id='advanced_replication' onclick='displayAdvanced()' >&nbsp;&nbsp; Any Servers On Advanced Replication
//                                                                </label>
//                                                            </div>
//                                                            <div class='panel-body collapse' id='inline_table'>";
//                                                             while($row = $advanced_replication->fetch_assoc()) {
//                                                                 
//                                                          echo "<div class='row'>
//                                                                    
//                                                                    <div class='col-sm-12'> 
//                                                                        <div class='form-group' id='".$row['name']."'> 
//                                                                            <div class='col-sm-8'>" . $row["question"] . "</div>
//                                                                            <div class='col-sm-4' id='".$row['name']."'>
//                                                                            <div class='input-group'>
//                                                                                <input type='hidden' value='".$row["question"]."' name='".$row['id']."'>
//                                                                                <input class='form-control' type='text' id='".$row['id']."' name='".$row['name']."' placeholder='0' style='width:100%' onblur='correctValuesEnteredIn2s_vm()'>
//                                                                                <span class='input-group-btn'>
//                                                                                    <button class='btn btn-secondary' type='button' id='".$row['addon']."'>0</button>
//                                                                                </span>
//                                                                                </div> 
//                                                                            </div>
//                                                                        </div>
//                                                                    </div>
//                                                                    
//                                                                </div><br>";
//                                                        }
//                                                            echo "<span id='advancedCheck' style='color:red;font-size:15px;display:none'>Add VM Imges,BM Win/Lin Datas and Bm Unix Datas to select Advanced replication </span>";
//                                                             echo "</div></div></div></div>
//                                                             </div>";
//                                                        }else{
//                                                            echo "0 results";
//                                                        }
                                                //Incase of enable all questions remove the above comments and remove this line
                                            
                                            
                                                echo "     </div>      
                                                            </div>
                                                        </div>";


                                            } else {
                                                echo "0 results";
                                            } 

                                        $sql = "select * from QGeneratorQuestions where category='3-site_normal_set1' limit 1,20";
                                        $result = $connect->query($sql);
                                        if ($result->num_rows > 0) {     
                                            echo "<div class='form-group addPersonPanel'>
                                                  <div class='panel panel-default'>
                                                  <div class='panel-heading'>
                                                        <label class='radio-inline'>
                                                            <input type='checkbox' class='licence' id='3-site' name='3-Site'>&nbsp;&nbsp; <div class='tool' data-toggle='tooltip' data-placement='bottom' title='Provide Counts of all Production Components'> 3-Site / Bunker Site Configuration</div>
                                                        </label>
                                                  </div>
                                                  <div class='panel-body collapse' id='table1'>
                                                    <div class='row'>
                                                        <div class='col-sm-12'>
                                                            <div class='form-group'  id='3S_bunker'>
                                                                <div class='col-sm-8'> Is this a Bunker site only? </div>
                                                                <div class='col-sm-4'>
                                                                    <div class='dropdown' style='width:100%'>
                                                                        <select name='bunker_3S' id='bunker_3s' class='form-control' >
                                                                            <option value='Yes'>YES</option>
                                                                            <option value='No' selected>NO</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>";


                                            while($row = $result->fetch_assoc()) {
                                            echo "  <div class='row'>
                                                        <div class='col-sm-12'>
                                                            <div class='from-group' id='".$row['name']."'>
                                                                <div class='col-sm-8'>" . $row["question"] . "
                                                                </div>
                                                                <div class='col-sm-4' id='".$row['name']."'>
                                                                    <input type='hidden'  value='".$row["question"]."' name='".$row['id']."'>
                                                                    <input class='form-control' type='text' id='" .$row['id']."' name='" .$row['name']."' placeholder='0' id='value' style='width:100%'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>"; 
                                            }
                                            //Incase of enable all questions remove the below comments  
                                            
                                            
                                                        
//                                                        $query3 = "select * from QGeneratorQuestions where category='3-Site_normal_set2' limit 0,20";
//                                                        $set2=$connect->query($query3);
//                                                        echo "<div id='3_site_panel' class='panel panel-default' style='padding-top:20px;'>"; 
//                                                        while($row = $set2->fetch_assoc()) {
//                                                                 
//                                                          echo "<div class='row'>
//                                                                    <div class='col-sm-12'> 
//                                                                        <div class='form-group' id='".$row['name']."'> 
//                                                                            <div class='col-sm-8'>" . $row["question"] . "</div>
//                                                                            <div class='col-sm-4' id='".$row['name']."'>
//                                                                                <input type='hidden' value='".$row["question"]."' name='".$row['id']."'>
//                                                                                <input class='form-control' type='text' id='".$row['id']."' name='".$row['name']."' placeholder='0' style='width:100%'>
//                                                                            </div>
//                                                                        </div>
//                                                                    </div>
//                                                                </div><br>";
//                                                        }
//                                                        echo "</div>";
//                                            echo '<div class="row"><button class="btn" type="button" id="button2" style="float:right ;margin-right:15px">More</button>';
//                                            echo '<button  type="button" class="btn" id="less2" style="float:right ;margin-right:15px" >Less</button></div><br>';
//                                                        $query2 = "select * from QGeneratorQuestions where category='3-Site_advanced' limit 0,10";
//                                                        $advanced_replication= $connect->query($query2);
//                                                        if ($advanced_replication->num_rows > 0) {
//                                                        echo"<div class='row'>
//                                                                <div class='col-sm-12'>
//                                                                    <div class='form-group addPersonPanel' id='personalpanel'>
//                                                                        <div class='panel panel-default'>
//                                                                            <div class='panel-heading'>
//                                                                                <label class='radio-inline'>
//                                                                                    <input type='checkbox' class='licence' id='advanced_replication_3s' onclick='displayAdvance_3s()'>&nbsp;&nbsp; Any Servers On Advanced Replication
//                                                                                </label>
//                                                                            </div>
//                                                                            <div class='panel-body collapse' id='inline_table1'>";
//                                                                            while($row = $advanced_replication->fetch_assoc()) {
//                                                                 
//                                                                            echo "<div class='row'>
//                                                                                    <div class='col-sm-12'> 
//                                                                                        <div class='form-group' id='".$row['name']."'> 
//                                                                                            <div class='col-sm-8'>" . $row["question"] . "</div>
//                                                                                            <div class='col-sm-4' id='".$row['name']."'>
//                                                                                                <div class='input-group' id='".$row['name']."'>
//                                                                                <input type='hidden' value='".$row["question"]."' name='".$row['id']."'>
//                                                                                <input class='form-control' type='text' id='".$row['id']."' name='".$row['name']."' placeholder='0' style='width:100%' onblur='correctValuesEnteredIn3s_vm()'>
//                                                                                <span class='input-group-btn'>
//                                                                                    <button class='btn btn-secondary' type='button' id='".$row['addon']."'>0</button>
//                                                                                </span>
//                                                                                </div> 
//                                                                                            </div>
//                                                                                        </div>
//                                                                                    </div>
//                                                                                </div><br>";
//                                                                            }
//                                                            echo "<span id='advancedCheck_3s' style='color:red;font-size:15px;display:none'>Add VM Imges,BM Win/Lin Datas and Bm Unix Datas to select Advanced replication </span>";
//                                                                        echo "</div>
//                                                                        </div>
//                                                                    </div>
//                                                                </div>
//                                                            </div>";
//                                                        }else{
//                                                            echo "0 results";
//                                                        }
                                //Incase of enable all questions remove the above comments and remove this line
                                            
                                            
                                echo "</div></div></div>";
                                } else {
                                     echo "0 results";
                                }
                            ?>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success nextpagebtn pull-left" type="button" onclick="prev_page1()">Prev</button>
                                                <button class="btn btn-success nextpagebtn pull-right" type="button" onclick="next_page2()">Next</button>
                                            </div>
                                        </div>
                                </div>
                                <div id="third">
                                    <div class="container" id="supportDetails">
                                        <div class="row">
                                            <div class="col-sm-4"><b>Customer: </b><span id="customerName2"></span> </div>
                                            <div class="col-sm-4"><b>Product: </b><span id="productName2"></span></div>
                                            <div class="col-sm-4"><b>Module: </b><span id="productModule2"></span></div>
                                        </div>
                                        <hr> </div>
                                    <br>
                                    <br>
                                    <div id="professionalsection">
                                    <div class='form-group'>
                                        <div class='row'>
                                            <div class='col-sm-6 col-xs-12'> Product Support Required</div>
                                            <div class='col-sm-6 col-xs-12'>
                                                <div class="input-group">
                                                    <input type='text' id='product_support' name='Product_Support' class='form-control' value="1" style='width:100%' placeholder='1' onblur="valid_product()"> <span class="input-group-addon">years</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php        
                                           
                
                    $sql = "select * from QGeneratorQuestions where category='Prof-Services_normal_set1' limit 2,20";
                    $result = $connect->query($sql);
                    if ($result->num_rows > 0) { 
                       echo "
                        <div class='form-group addPersonPanel'>
                            <div class='form-group'>
                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <label class='radio-inline'>
                                            <input type='checkbox' class='licence' id='prof' >&nbsp;&nbsp; Professional Services Requirement including 3 Site/Bunker Site Configuration </label>
                                    </div>
                                    <div class='panel-body collapse' id='table2'>
                                        <div class='row'>
                                            <div class='col-sm-5'>
                                                <div class='form-group' id='Prof-Services_all'>
                                                    <label> Scope of Service </label>
                                                        <div class='dropdown' style='width:100%'>
                                                            
                                                                <label class='radio-inline'><input  id='full' type='radio' name='Prof_Services_all' value='Yes' checked='checked'>Full</label>
                                                                <label class='radio-inline'><input  id='partial' type='radio' name='Prof_Services_all' value='No'>Partial</label>
                                                                
                                                        </div>
                                                </div>
                                                
                                            </div>
                                            <div class='col-sm-1' style='text-align:right'>
                                                <div class='vertical_line'></div>
                                            </div>
                                            <div class='col-sm-5'>
                                                <div class='form-group' id='Prof_Services_Type'>
                                                    <label> Type of Service</label>
                                                    
                                                        <div class='dropdown' style='width:100%'>
                                                            
                                                            <label class='radio-inline'><input  id='On-site' type='radio' name='Prof_Services_type' checked value='On-site'>On-site</label>
                                                            
                                                        </div>
                                                </div>
                                        </div>
                                    </div>";
                          echo "<div id='panel3'>";
                        while($row = $result->fetch_assoc()) {
                             echo "<div class='row'>
                                    <div class='col-sm-12'> 
                                        <div class='from-group' id='".$row['name']."'>
                                            <div class='col-sm-8'>" . $row["question"] . "
                                            </div>
                                            <div class='col-sm-4'> 
                                            <div class='input-group' id='".$row['name']."'>
                                                <input type='hidden' value='".$row["question"]."' name='".$row['id']."'>
                                                <input class='form-control' class='form-control' type='text' id='" .$row['id']."' name='" .$row['name']."' placeholder='0' id='value' style='width:100%'><span class='input-group-btn'>
                                                                    <button class='btn btn-secondary' type='button' id='".$row['addon']."'>0</button>
                                                                </span></div>" . "
                                            </div>
                                        </div>
                                    </div>
                                    </div><br>";                       
                                }
                                echo "</div>";
                                
                              //Incase of enable all questions remove the below comments                              
//                            $query3 = "select * from QGeneratorQuestions where category='Prof-Services_normal_set2' limit 0,20";
//                            $set2=$connect->query($query3);
//                            echo "<div id='prof_panel' class='panel panel-default' style='padding-top:20px;'>";
//                            while($row = $set2->fetch_assoc()) {
//
//                              echo "<div class='row'>
//                                        <div class='col-sm-12'> 
//                                            <div class='form-group' id='".$row['name']."'> 
//                                                <div class='col-sm-8'>" . $row["question"] . "</div>
//                                                <div class='col-sm-4'>
//                                                 <div class='input-group' id='".$row['name']."'>
//                                                        <input type='hidden' value='".$row["question"]."' name='".$row['id']."'>
//                                                        <input class='form-control' class='form-control' type='text' id='" .$row['id']."' name='" .$row['name']."' placeholder='0' id='value' style='width:100%'>
//                                                        <span class='input-group-btn'>
//                                                                    <button class='btn btn-secondary' type='button' id='".$row['addon']."'>0</button>
//                                                        </span>
//                                                </div>" . "
//                                                </div>
//                                            </div>
//                                        </div>
//                                        
//                                    </div><br>";
//                            }
//                            echo "<div class='row'>
//                                    <div class='col-sm-12'>
//                                        <div class='form-group'>
//                                            <div class='col-sm-8'>
//                                                Is Customer On-Premise Product Training Required?
//                                            </div>
//                                            <div class='col-sm-4'>
//                                                <div class='dropdown'>
//                                                    <select id='premise_product_training' class='form-control' name='Premise_product_training'>
//                                                        <option value='Yes'>Yes</option>
//                                                        <option value='No'>No</option>
//                                                    </select>
//                                                </div>
//                                            </div>
//                                        </div>
//                                    </div>
//                                </div></div><br>
//                                ";
//                            echo '<div class="row"><button class="btn" type="button" id="button3" style="float:right ;margin-right:15px" >More</button>';
//                            echo '<button type="button" class="btn" id="less3" style="float:right ;margin-right:15px" >Less</button></div><br>';
//                            $query2 = "select * from QGeneratorQuestions where category='Prof-Services_advanced' limit 0,10";
//                            $advanced_replication= $connect->query($query2);
//                            if ($advanced_replication->num_rows > 0) {
//                            echo"<div class='row'>
//                                    <div class='col-sm-12'>
//                                        <div class='form-group addPersonPanel' id='personalpanel1'>
//                                            <div class='panel panel-default'>
//                                                <div class='panel-heading'>
//                                                    <label class='radio-inline'>
//                                                        <input type='checkbox' class='licence' id='advanced_replication_prof' onclick='dispalyAdvance_prof()' >&nbsp;&nbsp;Any Professional Services for Advanced Replication
//                                                    </label>
//                                                </div>
//                                                <div class='panel-body collapse' id='inline_table2'>";
//                                                while($row = $advanced_replication->fetch_assoc()) {
//
//                                                echo "<div class='row'>
//                                                        <div class='col-sm-12'> 
//                                                            <div class='form-group' id='".$row['name']."'> 
//                                                                <div class='col-sm-8'>" . $row["question"] . "</div>
//                                                                <div class='col-sm-4'>
//                                                                   <div class='input-group' id='" .$row['name']."'>
//                                                                        <input type='hidden' value='".$row["question"]."' name='".$row['id']."'>
//                                                                        <input class='form-control' class='form-control' type='text' id='" .$row['id']."' name='" .$row['name']."' onblur='correctValuesEnteredInprof()' placeholder='0' id='value' style='width:100%'>
//                                                                        <span class='input-group-btn'>
//                                                                                    <button class='btn btn-secondary' type='button' id='".$row['addon']."'>0</button>
//                                                                        </span>
//                                                                </div>" . "
//                                                                </div>
//                                                            </div>
//                                                        </div>
//                                                    </div><br>";
//                                                }
//                                echo "<span id='advancedCheck_Prof' style='color:red;font-size:15px;display:none'>Add VM Imges,BM Win/Lin Datas and Bm Unix Datas to select Advanced replication </span>";
//                                            echo "</div>
//                                            </div>
//                                        </div>
//                                    </div>
//                                </div>";
//                            }else{
//                                echo "0 results";
//                            }
                            //Incase of enable all questions remove the above comments and remove this line  
                            echo "</div></div></div></div>";
                     

                    } else {
                         echo "0 results";
                    }
    
                    
                        ?>
<!--                                        <label class='radio-inline'><input  id='Remote' type='radio' name='Prof_Services_type' value='Remote'>Remote</label>-->
                                        <div class="contianer">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success pull-left" id="prevbtn" type="button" onclick="prev_page2()">Prev</button>
                                                    <button type="button" style="float:right;" id="userRequirements" class="btn btn-success pull-right" onclick="roleBasedDiscount()">Next</button>
                                                </div>
                                                <!-- Button trigger modal -->
                                                <div class="col-sm-6 quotepagediv">
                                                    
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                </div>
<!--                                panel review config           -->
                                    <div class="panel panel-default" id="requirements">
                                        <div class="panel-heading" style="background-color:lightgrey;">
                                            <h4 class="modal-title" id="myModalLabel">Review Configuration</h4> </div>
                                        <div class="panel-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-xs-8">1. Product Type</div>
                                                    <div class="col-xs-4"><span id="product"></span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">2. License</div>
                                                    <div class="col-xs-4"><span id="LicenseName"></span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">3. Country</div>
                                                    <div class="col-xs-4"><span id="countryName"></span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">4. Currency</div>
                                                    <div class="col-xs-4"><span id="currencyName"></span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">5. Opportunity Name</div>
                                                    <div class="col-xs-4"><span id="organizationName"></span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">6. Customer Name</div>
                                                    <div class="col-xs-4"><span id="customer"></span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">7. Partner Name</div>
                                                    <div class="col-xs-4"><span id="Partner_Name"></span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">8. Mode of Sale</div>
                                                    <div class="col-xs-4"><span id="modeOfSale"></span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">9. Product Module</div>
                                                    <div class="col-xs-4"><span id="module"></span></div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-xs-12" style="background-color:lightgrey">2-Site Configuration</div>
                                                </div>
                                                <div class="row" id="vm_image_2">
                                                    <div class="col-xs-8">No of VM Images </div>
                                                    <div class="col-xs-4"><span id="Vm_image_2"></span></div>
                                                </div>
                                                <div class="row" id="vm_db_2">
                                                    <div class="col-xs-8">No of VM DB's</div>
                                                    <div class="col-xs-4"><span id="Vm_db_2"></span></div>
                                                </div>
                                                <div class="row" id="bm_w_2">
                                                    <div class="col-xs-8">No of Bm Win/Lin Datas</div>
                                                    <div class="col-xs-4"><span id="Bm_w_2"></span></div>
                                                </div>
                                                <div class="row" id="bm_wd_2">
                                                    <div class="col-xs-8">No of Bm Win/Lin DB's</div>
                                                    <div class="col-xs-4"><span id="Bm_wd_2"></span></div>
                                                </div>
                                                <div class="row" id="bm_u_2">
                                                    <div class="col-xs-8">No of Bm Unix Datas</div>
                                                    <div class="col-xs-4"><span id="Bm_u_2"></span></div>
                                                </div>
                                                <div class="row" id="bm_ud_2">
                                                    <div class="col-xs-8">No of Bm Unix DB's</div>
                                                    <div class="col-xs-4"><span id="Bm_ud_2"></span></div>
                                                </div>

<!--                                                Incase of enable all questions remove the below comments   -->
                                                <!--
                                                <div class="row" id="bm_sar_2">
                                                    <div class="col-xs-8">No of Bm Servers that are using Advanced Replication</div>
                                                    <div class="col-xs-4"><span id="Bm_sar_2"></span></div>
                                                </div>
                                                <div class="row" id="vm_sar_2">
                                                    <div class="col-xs-8">No of Vm Servers that are using Advanced Replication</div>
                                                    <div class="col-xs-4"><span id="Vm_sar_2"></span></div>
                                                </div>
                                                <div class="row" id="s_s_2">
                                                    <div class="col-xs-8">No of Sharepoint Servers</div>
                                                    <div class="col-xs-4"><span id="S_s_2"></span></div>
                                                </div>
                                                <div class="row" id="v_s_s_2">
                                                    <div class="col-xs-8">No of Virtual Sharepoint Servers</div>
                                                    <div class="col-xs-4"><span id="V_s_s_2"></span></div>
                                                </div>
                                                <div class="row" id="prod_ms_2">
                                                    <div class="col-xs-8">No of MS Exchange Data</div>
                                                    <div class="col-xs-4"><span id="Prod_ms_2"></span></div>
                                                </div>
                                                <div class="row" id="prod_v_ms_2">
                                                    <div class="col-xs-8">No of Virtual MS Exchange Data</div>
                                                    <div class="col-xs-4"><span id="Prod_v_ms_2"></span></div>
                                                </div>
                                                <div class="row" id="server_2">
                                                    <div class="col-xs-8">No of Servers that will use Sanovi PFR replication</div>
                                                    <div class="col-xs-4"><span id="Server_2"></span></div>
                                                </div>
                                                <div class="row" id="sap_hana_databases_2site">
                                                    <div class="col-xs-8">No of SAP HANA Database Units</div>
                                                    <div class="col-xs-4"><span id="Sap_hana_databases_2site"></span></div>
                                                </div>
                                                <div class="row" id="sap_hana_nodes_2site">
                                                    <div class="col-xs-8">No of SAP HANA Nodes</div>
                                                    <div class="col-xs-4"><span id="Sap_hana_nodes_2site"></span></div>
                                                </div>
-->
<!--                                                //Incase of enable all questions remove the above comments and remove this line  -->
                                                
                                                <div class="row">
                                                    <div class="col-xs-12" style="background-color:lightgrey">3-Site Configuration</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">Is this a Bunker Site only?</div>
                                                    <div class="col-xs-4"><span id="bunker_3"></span></div>
                                                </div>
                                                <div class="row" id="vm_image_3">
                                                    <div class="col-xs-8">No of VM Images </div>
                                                    <div class="col-xs-4"><span id="Vm_image_3"></span></div>
                                                </div>
                                                <div class="row" id="vm_db_3">
                                                    <div class="col-xs-8">No of VM DB's</div>
                                                    <div class="col-xs-4"><span id="Vm_db_3"></span></div>
                                                </div>
                                                <div class="row" id="bm_w_3">
                                                    <div class="col-xs-8">No of Bm Win/Lin Datas</div>
                                                    <div class="col-xs-4"><span id="Bm_w_3"></span></div>
                                                </div>
                                                <div class="row" id="bm_wd_3">
                                                    <div class="col-xs-8">No of Bm Win/Lin DB's</div>
                                                    <div class="col-xs-4"><span id="Bm_wd_3"></span></div>
                                                </div>
                                                <div class="row" id="bm_u_3">
                                                    <div class="col-xs-8">No of Bm Unix Datas</div>
                                                    <div class="col-xs-4"><span id="Bm_u_3"></span></div>
                                                </div>
                                                <div class="row" id="bm_ud_3">
                                                    <div class="col-xs-8">No of Bm Unix DB's</div>
                                                    <div class="col-xs-4"><span id="Bm_ud_3"></span></div>
                                                </div>
                                                
<!--                                                //Incase of enable all questions remove the below comments   -->
<!--
                                                <div class="row" id="bm_sar_3">
                                                    <div class="col-xs-8">No of Bm Servers that are using Advanced Replication</div>
                                                    <div class="col-xs-4"><span id="Bm_sar_3"></span></div>
                                                </div>
                                                <div class="row" id="vm_sar_3">
                                                    <div class="col-xs-8">No of Vm Servers that are using Advanced Replication</div>
                                                    <div class="col-xs-4"><span id="Vm_sar_3"></span></div>
                                                </div>
                                                <div class="row" id="s_s_3">
                                                    <div class="col-xs-8">No of Sharepoint Servers</div>
                                                    <div class="col-xs-4"><span id="S_s_3"></span></div>
                                                </div>
                                                <div class="row" id="v_s_s_3">
                                                    <div class="col-xs-8">No of Virtual Sharepoint Servers</div>
                                                    <div class="col-xs-4"><span id="V_s_s_3"></span></div>
                                                </div>
                                                <div class="row" id="prod_ms_3">
                                                    <div class="col-xs-8">No of MS Exchange Data</div>
                                                    <div class="col-xs-4"><span id="Prod_ms_3"></span></div>
                                                </div>
                                                <div class="row" id="prod_v_ms_3">
                                                    <div class="col-xs-8">No of Virtual MS Exchange Data</div>
                                                    <div class="col-xs-4"><span id="Prod_v_ms_3"></span></div>
                                                </div>
                                                <div class="row" id="server_3">
                                                    <div class="col-xs-8">No of Servers that will use Sanovi PFR replication</div>
                                                    <div class="col-xs-4"><span id="Server_3"></span></div>
                                                </div>
                                                <div class="row" id="sap_hana_databases_3site">
                                                    <div class="col-xs-8">No of SAP HANA Database Units</div>
                                                    <div class="col-xs-4"><span id="Sap_hana_databases_3site"></span></div>
                                                </div>
                                                <div class="row" id="sap_hana_nodes_3site">
                                                    <div class="col-xs-8">No of SAP HANA Nodes</div>
                                                    <div class="col-xs-4"><span id="Sap_hana_nodes_3site"></span></div>
                                                </div>
-->
<!--                                                //Incase of enable all questions remove the above comments and remove this line  -->
                                                
                                                <br>
                                                <div class="row">
                                                    <div class="col-xs-12" style="background-color:lightgrey">Professional Services Requirement</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">Are Professional Services Required on All Purchases</div>
                                                    <div class="col-xs-4"><span id="prof_services"></span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">Type of Professional Services Req</div>
                                                    <div class="col-xs-4"><span id="type_of_service"></span></div>
                                                </div>
                                                <div class="row" id="prof_vm_image">
                                                    <div class="col-xs-8">Prof Services Req on VM Images</div>
                                                    <div class="col-xs-4"><span id="Prof_vm_image"></span></div>
                                                </div>
                                                <div class="row" id="prof_database">
                                                    <div class="col-xs-8">Prof Services Req on VM DB's</div>
                                                    <div class="col-xs-4"><span id="Prof_database"></span></div>
                                                </div>
                                                <div class="row" id="prof_b_windows_datas">
                                                    <div class="col-xs-8">Prof Services Req on Bm Win/Lin Datas</div>
                                                    <div class="col-xs-4"><span id="Prof_b_windows_datas"></span></div>
                                                </div>
                                                <div class="row" id="prof_b_windows_db">
                                                    <div class="col-xs-8">Prof Services Req on Bm Win/Lin DB's</div>
                                                    <div class="col-xs-4"><span id="Prof_b_windows_db"></span></div>
                                                </div>
                                                <div class="row" id="prof_b_unix_datas">
                                                    <div class="col-xs-8">Prof Services Req on Bm Unix Datas</div>
                                                    <div class="col-xs-4"><span id="Prof_b_unix_datas"></span></div>
                                                </div>
                                                <div class="row" id="prof_b_unix_db">
                                                    <div class="col-xs-8">Prof Services Req on Bm Unix DB's</div>
                                                    <div class="col-xs-4"><span id="Prof_b_unix_db"></span></div>
                                                </div>
                                                
<!--                                                //Incase of enable all questions remove the below comments   -->
<!--
                                                <div class="row" id="prof_prod_servers">
                                                    <div class="col-xs-8">Prof Services Req on Bm Servers using Advanced Replication</div>
                                                    <div class="col-xs-4"><span id="Prof_prod_servers"></span></div>
                                                </div>
                                                <div class="row" id="prof_virtual_prod">
                                                    <div class="col-xs-8">Prof Services Req on Vm Servers using Advanced Replication</div>
                                                    <div class="col-xs-4"><span id="Prof_virtual_prod"></span></div>
                                                </div>
                                                <div class="row" id="prof_share_server">
                                                    <div class="col-xs-8">Prof Services Req on Sharepoint Servers </div>
                                                    <div class="col-xs-4"><span id="Prof_share_server"></span></div>
                                                </div>
                                                <div class="row" id="prof_share_db">
                                                    <div class="col-xs-8">Prof Services Req on Sharepoint DB's </div>
                                                    <div class="col-xs-4"><span id="Prof_share_db"></span></div>
                                                </div>
                                                <div class="row" id="prof_v_share_server">
                                                    <div class="col-xs-8">Prof Services Req on Virtual Sharepoint Servers</div>
                                                    <div class="col-xs-4"><span id="Prof_v_share_server"></span></div>
                                                </div>
                                                <div class="row" id="prof_v_share_db">
                                                    <div class="col-xs-8">Prof Services Req on Virtual Sharepoint DB's</div>
                                                    <div class="col-xs-4"><span id="Prof_v_share_db"></span></div>
                                                </div>
                                                <div class="row" id="prof_prod_ms">
                                                    <div class="col-xs-8">Prof Services Req on MS Exchange Data </div>
                                                    <div class="col-xs-4"><span id="Prof_prod_ms"></span></div>
                                                </div>
                                                <div class="row" id="prof_prod_v_ms">
                                                    <div class="col-xs-8">Prof Services Req on Virtual MS Exchange Data</div>
                                                    <div class="col-xs-4"><span id="Prof_prod_v_ms"></span></div>
                                                </div>
                                                <div class="row" id="prof_sap_hana_databases">
                                                    <div class="col-xs-8">Prof Services Req on SAP HANA Database Units</div>
                                                    <div class="col-xs-4"><span id="Prof_sap_hana_databases"></span></div>
                                                </div>
                                                <div class="row" id="prof_sap_hana_nodes">
                                                    <div class="col-xs-8">Prof Services Req on SAP HANA Database Nodes on Production</div>
                                                    <div class="col-xs-4"><span id="Prof_sap_hana_nodes"></span></div>
                                                </div>
                                                <div class="row" id="prof_premise_product_training">
                                                    <div class="col-xs-8">Is Customer On-Premise Product Training Required?</div>
                                                    <div class="col-xs-4"><span id="Prof_premise"></span></div>
                                                </div>
-->
<!--                                               //Incase of enable all questions remove the above comments and remove this line   -->
                                                
                                            </div>
                                            <br>
                                                <div class="row">
                                                    <div class="col-xs-12" style="background-color:lightgrey;">Product Support Requirements </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-xs-8">Years of Sanovi Product Support required for the Purchase</div>
                                                    <div class="col-xs-4"><span id="productSupport"></span></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="background-color:lightgrey;">
                                                <button type="button" class="btn btn-lg btn-success savebtn pull-left" id="backbutton" onclick="goBackToPreviousPage()">Back</button>
                                                <button class="btn btn-lg btn-success savebtn pull-right" id="savebutton" type="submit">Next</button><br><br><br>
                                                <span>* You are in final screen of Review Configuration<br>You cannot come back once you click on Next</span>
                                            </div>
                                        </div>
                                <?php 
     $connect->close();
?> 
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
            <?php  include "../includes/footer.php"; }else{
        header('location:index.php');
        ob_flush();
      }
        ?>
    </body>

    </html>