<div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                updateDiscountValues($_SESSION['ref_id'],$discountlicense,$discount_license_value,$final_license_value,$discount_3s,$product_support_discount,$product_support_discount_value,$product_support_value_after_discount,$professional_service_discount,$professional_service_discount_value,$professional_service_value_after_discount,$product_training_discount,$product_training_discount_value,$product_training_value_after_discount,$final_discount_value,$final_value_after_discount);
                        $max_discount_value=max($discountlicense,$product_support_discount,$professional_service_discount,$product_training_discount);
                        $rep_mg_emailid=send_email_alert($_SESSION["emp_id"],$max_discount_value,$_SESSION['ref_id'],1);
                        $approver_emp_id=get_approver_emp_id($rep_mg_emailid);
                        $get_approver_name=get_approver_name($rep_mg_emailid);
                        draft($_SESSION['ref_id'],$approver_emp_id,$_POST['Annexure_1']);
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
                        <div>Quote Ref.No : <?php echo $_SESSION['ref_id'];?></div>
                        <div>Quote Ver.No : <?php echo "1";?></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 style="color:green;">Quote sent to <?php echo $get_approver_name ; ?> for Approval<br>
                                Contact : <?php echo $rep_mg_emailid; ?> for more details </h4>
                                <?php
                                    $quote_ref_id=$_SESSION['ref_id'];
                                    $quote_ver_id=1;
									$rep_mg_name=
                                    $url="../pdf/mail_alert_for_approval.php?emailid=".$rep_mg_emailid."&refId=".$quote_ref_id."&verId=".$quote_ver_id."&appname=".$get_approver_name;
                                    $_SESSION["mail_alert"]="Yes";
									session_regenerate_id(true);
                                    header('location:'.$url);
									die();
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