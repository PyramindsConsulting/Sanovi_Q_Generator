<div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                            finalize($_SESSION['ref_id'],$_POST['Annexure_1']);
                updateDiscountValues($_SESSION['ref_id'],$discountlicense,$discount_license_value,$final_license_value,$discount_3s,$product_support_discount,$product_support_discount_value,$product_support_value_after_discount,$professional_service_discount,$professional_service_discount_value,$professional_service_value_after_discount,$product_training_discount,$product_training_discount_value,$product_training_value_after_discount,$final_discount_value,$final_value_after_discount);
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
                        <div>Quote Ref.No : <?php echo $_SESSION['ref_id'];?></div>
                        <div>Quote Ver.No : <?php echo "1";?></div>
                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <form method="post" action="finalize_email.php">
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email Id to Email Quote" value="<?php if (!empty($_POST["email"])) {echo $_POST["email"];} ?>">
                                        <span class="input-group-btn">
                                            <input  class="btn btn-success" type="submit" name="submit" value="Send">
<!--                                            <button  class="btn btn-success" type="button">send</button>-->
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
                                <center>
                                    <p><a href="http://quotedev.sanovi.com/pdf/new_quote.php"><button type="button" class="btn btn-primary">Preview Quote</button></a>
                                    <a href="http://quotedev.sanovi.com/pdf/download_quote.php?refId=<?php echo $_SESSION['ref_id'];?>&verId=1"><button type="button" class="btn btn-success">Download Quote</button></a></p>
                                </center>
                            </div>
                        </div>
                        </center>
                    </div>
                </div>
            </div>