<div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        if(($_SESSION["status"]=="Draft")||($_SESSION["status"]=="Discount")){
//                                draft_edit($_SESSION["ref_id_edit"],$_SESSION["ver_id_edit"],$_POST['Annexure_1']);
                                $version=$_SESSION["ver_id_edit"];
                            }else{
                                $version=getMaxVersionId(substr($_SESSION["ref_id_edit"],12));
//                                draft_edit($_SESSION["ref_id_edit"],$version,$_POST['Annexure_1']);
                            }
                updatefinalvalues_edit($_SESSION['ref_id_edit'],$version,$discountlicense,$discount_license_value,$final_license_value,$product_support_discount,$product_support_discount_value,$product_support_value_after_discount,$professional_service_discount,$professional_service_discount_value,$professional_service_value_after_discount,$product_training_discount,$product_training_discount_value,$product_training_value_after_discount,$final_discount_value,$final_value_after_discount);
//                        echo $version."-Version<br>";        
                        $max_discount_value=max($discountlicense,$product_support_discount,$professional_service_discount,$product_training_discount);
//                       echo $max_discount_value."<br>";
                       $annexure= $_POST['Annexure_1'];
                        $rep_mg_emailid=send_email_alert_edit($_SESSION["emp_id"],$max_discount_value,$_SESSION['ref_id_edit'],$version);
//                        echo $rep_mg_emailid."-Rep email id";
                        $approver_emp_id=get_approver_emp_id_edit($rep_mg_emailid);
                        $get_approver_name=get_approver_name_edit($rep_mg_emailid);
//                        echo $approver_emp_id;
                        if(($_SESSION["status"]=="Draft")||($_SESSION["status"]=="Discount")){
                                $version=$_SESSION["ver_id_edit"];
                                draft_edit($_SESSION["ref_id_edit"],$version,$approver_emp_id,$annexure);
                            }else{
                                $version=getMaxVersionId(substr($_SESSION["ref_id_edit"],12));
                                draft_edit($_SESSION["ref_id_edit"],$version,$approver_emp_id,$annexure);
                            }
                        ?><center>
                        <div id="crumbs" style="width:100%;margin-top:2%">
                        <ul>
                            <li><a href="#" id="quote_request" class="active">Quote Request</a></li>
                            <li><a href="#" id="config_review">Config Review</a></li>
                            <li><a href="#" id="review_and_discount">Review and Discounts</a></li>
                            <li><a href="#" id="quote_finalize">Quote Saved</a></li>
                        </ul>
                    </div>
                        <h3 style="color:green;"><b>QUOTE SAVED<br> S U C C E S S F U L L Y</b></h3>
                        <div>Quote Ref.No : <?php echo $_SESSION['ref_id_edit'];?></div>
                        <div>Quote Ver.No : <?php echo $version;?></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 style="color:green;">Quote sent to <?php echo $get_approver_name ; ?> for Approval<br>
                                Contact : <?php echo $rep_mg_emailid; ?> for more details </h4>
                                <?php
                                    $quote_ref_id=$_SESSION['ref_id_edit'];
                                    $quote_ver_id=$version;
                                    $url="../pdf/mail_alert_for_approval_edit.php?emailid=".$rep_mg_emailid."&refId=".$quote_ref_id."&verId=".$quote_ver_id."&appname=".$get_approver_name;
                                    $_SESSION["mail_alert"]="Yes";
                                	session_regenerate_id(true);	
                                   	header('location:'.$url);
                                	die()
                                ?>
                                <input type="button" class="btn btn-default" value="Send Alert" onclick="sendmail()">
                                <script>
                                    function sendmail(){
                                        window.location.href = "<?php echo $url; ?>";
                                    }
                                </script>
                            </div>
                        </div>
                        </center>
                    </div>
                </div>
            </div>