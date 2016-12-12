<!--            FINDING ALL REFERENCE IDS -->
            <?php
                //$ref_ids_created_by_users=find_all_ref_ids_from_lgt($_SESSION["username"]); //ARRAY of REF IDs & EMP Names
                //$no_of_ref_ids_created_by_user=count($ref_ids_created_by_users)-1;

				$ref_ids_created_by_users_complete=find_all_ref_ids_from_lgt($_SESSION["username"]); //ARRAY of REF IDs & EMP Names
				$no_of_ref_ids_created_by_users_complete=count($ref_ids_created_by_users_complete);
				//FINDING GET VARIABLES
				if(!$_GET["display"]){
					$display_rows=$display_rows_selectbox=5; //ASSIGNING DEFAULT ROWS TO DISPLAY AS 5
				}else{ //GET VARIABLE VALIDATIONS
					$get_display_value=$_GET["display"];
					if(!is_numeric($get_display_value) || 
					   ($get_display_value-floor($get_display_value))!=0 || 
					   $get_display_value<1){
						die("Invalid Inputs");
					}else{
						if ($get_display_value>$no_of_ref_ids_created_by_users_complete){
							$display_rows=$no_of_ref_ids_created_by_users_complete;
							$display_rows_selectbox=$_GET["display"];
						}else{
							$display_rows=$_GET["display"];
							$display_rows_selectbox=$_GET["display"];
						}
						if ($get_display_value==$no_of_ref_ids_created_by_users_complete){
							$display_rows_selectbox=$_GET["display"];
						}
						$no_of_pages=ceil($no_of_ref_ids_created_by_users_complete/$display_rows);
					}
				}

				if(!$_GET["page"]){
					$display_page=1;//ASSIGNING DEFAULT PAGE NO AS 1
					$no_of_pages=ceil($no_of_ref_ids_created_by_users_complete/$display_rows);
				}else{//GET VARIABLE VALIDATIONS
					$get_page_value=$_GET["page"];
					if(!is_numeric($get_page_value) || 
					   $get_page_value>$no_of_pages || 
					   ($get_page_value-floor($get_page_value))!=0 || 
					   $get_page_value<1){
						die("Invalid Inputs");
					}else{
						$display_page=$_GET["page"];
					}
				}
				$j=0;
				$k=($display_page-1)*$display_rows;
				//LOADING THE QUOTE REFERENCE AND VERSION IDS
				for($i=0;$i<$display_rows;$i++){
					if(!$ref_ids_created_by_users_complete[$k]){
						break;
					}
					$ref_ids_created_by_users[$j]=$ref_ids_created_by_users_complete[$k];
					$j++;
					$k++;
				}
				//print_r($ref_ids_created_by_users);
                $no_of_ref_ids_created_by_user=count($ref_ids_created_by_users)-1;
				
				//PHP BUTTON SUBMISSION RESPONSE CHECKS
				if(isset($_POST["my_quotes_display"])){
					//echo "entered all_quotes_display";
					$noOfQuotesToDisplay=$_POST['no_of_my_quotes_to_display'];
					header("location: dashboard.php?View=MyQuotes&display=".$noOfQuotesToDisplay."&page=1");
				}

				if(isset($_POST["my_quotes_display_next"])){
					$noOfQuotesToDisplay=$_POST['no_of_my_quotes_to_display'];
					if($display_page<$no_of_pages){
						$display_page++;
					}else{
					}
					header("location: dashboard.php?View=MyQuotes&display=".$noOfQuotesToDisplay."&page=".$display_page);
				}

				if(isset($_POST["my_quotes_display_prev"])){
					$noOfQuotesToDisplay=$_POST['no_of_my_quotes_to_display'];
					if($display_page>1){
						$display_page--;
					}else{
					}
					header("location: dashboard.php?View=MyQuotes&display=".$noOfQuotesToDisplay."&page=".$display_page);
				}

				if(isset($_POST["my_quotes_display_first"])){
					$noOfQuotesToDisplay=$_POST['no_of_my_quotes_to_display'];
					$display_page=1;
					header("location: dashboard.php?View=MyQuotes&display=".$noOfQuotesToDisplay."&page=".$display_page);
				}

				if(isset($_POST["my_quotes_display_last"])){
					$noOfQuotesToDisplay=$_POST['no_of_my_quotes_to_display'];
					$display_page=$no_of_pages;
					header("location: dashboard.php?View=MyQuotes&display=".$noOfQuotesToDisplay."&page=".$display_page);
				}
            ?>

           <!--            NAVIGATION BUTTONS-->
            <br>
            <div class="row">
				<form method="post">
					<div class="col-sm-2">
						<label for="no_of_my_quotes">Total No of Quotes :</label>
					</div>
					<div class="col-sm-1">
						<input type="number" class="form-control" id="no_of_my_quotes" readonly value="<?php echo count($ref_ids_created_by_users_complete); ?>">
					</div>

					<div class="col-sm-1">
						<label for="no_of_my_quotes_to_display">Display :</label>
					</div>
					<div class="col-sm-2">
						<select class="form-control" id="no_of_my_quotes_to_display" name="no_of_my_quotes_to_display">
							<option value="5" <?php if($display_rows_selectbox==5){echo "selected";} ?>>5</option>
							<option value="10" <?php if($display_rows_selectbox==10){echo "selected";} ?>>10</option>
							<option value="50" <?php if($display_rows_selectbox==50){echo "selected";} ?>>50</option>
							<option value="<?php echo $no_of_ref_ids_created_by_users_complete; ?>" <?php if($display_rows_selectbox==$no_of_ref_ids_created_by_users_complete){echo "selected";} ?>>All (<?php echo $no_of_ref_ids_created_by_users_complete; ?>)</option>
						</select>
					</div>
					<div class="col-sm-1">
						<button type="submit" class="btn btn-primary" name="my_quotes_display">Go</button>
					</div>
					<div class="col-sm-4">
						<button type="submit" name="my_quotes_display_first" style="background-color: transparent; border: none; padding-top: 5px;"><span class="glyphicon glyphicon-step-backward"></span></button>
						<button type="submit" name="my_quotes_display_prev" style="background-color: transparent; border: none;padding-top: 5px;"><span class="glyphicon glyphicon-triangle-left" name=""></span></button>
						<span style="padding-top: 5px; text-align: center;">Page-<?php echo $display_page;?>/<?php echo $no_of_pages; ?></span>
						<button type="submit" name="my_quotes_display_next" style="background-color: transparent; border: none; padding-top: 5px;"><span class="glyphicon glyphicon-triangle-right"></span></button>
						<button type="submit" name="my_quotes_display_last" style="background-color: transparent; border: none; padding-top: 5px;"><span class="glyphicon glyphicon-step-forward"></span></button>
					</div>
				</form>
			</div>
           <br>
           
            <div class="row">
                <table class="table table-hover" style="font-size:12px;">
                <thead>
                    <tr style="background-color:#33689C; color:WHITE;">
                        <th>Opportunity</th>
                        <th>Module</th>
                        <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                            <th>List Price</th>
                        <?php } ?>
                        <th>Customer</th>
                        <th>Partner</th>
                        <th>Country</th>
                        <th>Date</th>
                        <th>Version</th>
                        <th>Status</th>
                        <th><center>Actions</center></th>
                        <th><center>More</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i=0;$i<=$no_of_ref_ids_created_by_user;$i++){
                            $versions=find_all_version_ids($ref_ids_created_by_users[$i]);
                            $no_of_versions=count($versions);
                            $latest_version=count($versions)-1;
                            
                            $quote_status=find_quote_status_from_lht($ref_ids_created_by_users[$i], $versions[$latest_version]);
                            $crt_product_module=find_data_from_crt_for_dashboard($ref_ids_created_by_users[$i], $versions[$latest_version]);
                            $lht_list_price=find_list_price_from_lht_for_dashboard($ref_ids_created_by_users[$i], $versions[$latest_version]);
                            $lgt_details=find_data_from_lgt_for_dashboard($ref_ids_created_by_users[$i], $versions[$latest_version]);
                    ?>
                    <tr>
                        <td><?php echo find_company_name($ref_ids_created_by_users[$i]); ?> </td>
                        <td><?php echo $crt_product_module["product_module"]; ?></td>
                        <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                            <td><?php echo currency_format($lht_list_price,$crt_product_module["cust_currency"]); ?></td>
                        <?php } ?>
                        <td><?php echo $crt_product_module["cust_name"]; ?></td>
                        <td><?php echo $crt_product_module["partner"]; ?></td>
                        <td><?php echo $crt_product_module["country"]; ?></td>
                        <td><?php echo $lgt_details["license_generation_date"]; ?></td>
                        <td><?php echo $versions[$latest_version]; ?></td>
                        <td><?php echo $lgt_details["status"]; ?></td>
                        <td>
                            <center>
                                <!--View Quote ICON -->
                                <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                    <a href="pdf/html_view_quote.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$latest_version];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="View Quote"><span class="glyphicon glyphicon-eye-open"> </span></a>
                                <?php } ?>
                                
                                <!--View PDF ICON -->
                                <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                    <a href="pdf/view_quote.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$latest_version];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="View Quote"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                <?php } ?>
                                
                                <!--Edit Quote ICON -->
                                <?php
                                    if($quote_status=="Finalized"){?>
                                        <a onclick="return confirm('Finalized Quote cannot be edited. New version will be created. Confirm to proceed');" href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_users[$i]."&verid=".$versions[$latest_version];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Quote"><span class="glyphicon glyphicon-edit"> </span></a>
                                <?php }else{ ?>
                                        <a href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_users[$i]."&verid=".$versions[$latest_version];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Quote"><span class="glyphicon glyphicon-edit"> </span></a>
                                <?php } ?>

                                <!--Download Quote ICON -->
                                <?php if($_SESSION["userrole"]!="Quote Requestor"){ ?>
                                    <a href="pdf/download_quote.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$latest_version];?>" data-toggle="tooltip" data-placement="top" title="Download Quote"><span class="glyphicon glyphicon-save-file"> </span></a>
                                
                                <!--EMail Quote ICON -->
                                    <?php
                                        if($quote_status=="Draft"){?>
                                            <span class="glyphicon glyphicon-envelope"> </span>
                                        <?php }else{?>
                                            <a href="pdf/generate_quote_attachment.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$latest_version]."&emailid=".$_SESSION["emailid"];?>" data-toggle="tooltip" data-placement="top" title="Email Quote"><span class="glyphicon glyphicon-envelope"> </span></a>
                                    <?php } ?>
                                
                                <!--Delete Quote ICON -->
                                    <?php
                                        if($quote_status=="Finalized"){?>
                                            <span class="glyphicon glyphicon-trash"> </span>
                                        <?php }else{?>
                                            <a href="quote_delete.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$latest_version];?>" data-toggle="tooltip" data-placement="top" title="Delete Quote"><span class="glyphicon glyphicon-trash"> </span></a>
                                        <?php }
                                    ?>
                                <?php } ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <!--More ICON -->
                                <?php 
                                    if($latest_version==0){ ?>

                                <?php } else {?>    
                                <a href="dashboard-more.php?refId=<?php echo $ref_ids_created_by_users[$i]."&verId=".$versions[$latest_version];?>" data-toggle="tooltip" data-placement="top" title="Quote History" data-toggle="tooltip" data-placement="top" title="Quote History"><span class="glyphicon glyphicon-option-horizontal"></span></a>
                                <?php }
                                ?>
                            </center>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>