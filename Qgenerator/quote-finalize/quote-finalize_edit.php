   <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                            if($_SESSION["status"]=="Draft"){
                                finalize_edit($_SESSION["ref_id_edit"],$_SESSION["ver_id_edit"],$_POST['Annexure_1']);
                                $version=$_SESSION["ver_id_edit"];
                            }else{
                                $version=getMaxVersionId(substr($_SESSION["ref_id_edit"],12));
                                finalize_edit($_SESSION["ref_id_edit"],$version,$_POST['Annexure_1']);
                            }
                updatefinalvalues_edit($_SESSION['ref_id_edit'],$version,$discountlicense,$discount_license_value,$final_license_value,$product_support_discount,$product_support_discount_value,$product_support_value_after_discount,$professional_service_discount,$professional_service_discount_value,$professional_service_value_after_discount,$product_training_discount,$product_training_discount_value,$product_training_value_after_discount,$final_discount_value,$final_value_after_discount);
                        $approver_emp_id_to_update_time_stamp=get_approver_emp_id_to_update_time_stamp($_SESSION["ref_id_edit"],$_SESSION["ver_id_edit"]);
                        if($_SESSION["status"]=="Discount" && ($_SESSION["emp_id"] == $approver_emp_id_to_update_time_stamp)){
                            update_time_stamp_after_approving_quote($_SESSION["ref_id_edit"],$_SESSION["ver_id_edit"]);
                        }
                        
                        ?><center>
                        <div id="crumbs" style="width:100%;margin-top:2%">
                        <ul>
                            <li><a href="#" id="quote_request" class="active">Quote Request</a></li>
                            <li><a href="#" id="config_review">Config Review</a></li>
                            <li><a href="#" id="review_and_discount">Review and Discounts</a></li>
                            <li><a href="#" id="quote_finalize">Quote Finalize</a></li>
                        </ul>
                    </div>
                        <h3 style="color:green;"><b>QUOTE FINALIZED<br> S U C C E S S F U L L Y</b></h3>
                        <div>Quote Ref.No : <?php echo $_SESSION['ref_id_edit'];?></div>
                        <div>Quote Ver.No : <?php echo $version;?></div>
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <form method="post" action="finalize_edit_email.php">
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email Id to Email Quote" value="<?php if (!empty($_POST["email"])) {echo $_POST["email"];} ?>">
                                        <span class="input-group-btn">
                                            <input  class="btn btn-success" type="submit" name="submit" value="Send">
                                        </span>
                                    </div>
                                    <span style="color:red;"><?php echo $emailError; ?></span>
                                </form>
                                    <span style="font-size:11px;">Note:You can go back to List View &amp; And resend email again if needed</span>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
<!--
                                <center>
                                    <p><a href="pdf/view_quote.php?refId=<?php //echo $_SESSION["ref_id_edit"]."&verId=".$version; ?>">Download Quote</a></p>
                                </center>
-->
                                <center>
                                    <p><a href="pdf/view_quote.php?refId=<?php echo $_SESSION["ref_id_edit"]."&verId=".$version; ?>"><button type="button" class="btn btn-primary">Preview Quote</button></a>
                                    <a href="pdf/download_quote.php?refId=<?php echo $_SESSION["ref_id_edit"]."&verId=".$version; ?>"><button type="button" class="btn btn-success">Download Quote</button></a></p>
                                </center> 
                            </div>
                        </div>
                        </center>
                    </div>
                </div>
            </div>
            <?php
                if($email_flag=="Yes"){
                    $refid=$_SESSION['ref_id_edit'];
                    header('location:pdf/generate_quote_attachment.php?refId='.$refid.'&verId='.$version.'&emailid='.$email);
                }
            ?>