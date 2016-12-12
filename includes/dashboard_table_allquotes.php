<!--            FINDING ALL REFERENCE IDS -->
            <?php
                $ref_ids_created_by_users_complete=find_all_ref_ids_from_lgt_full_collection(); //ARRAY of REF IDs & EMP Names
				$no_of_ref_ids_created_by_users_complete=count($ref_ids_created_by_users_complete);

				//FINDING GET VARIABLES
				if(!$_GET["display"]){
					$display_rows=5; //ASSIGNING DEFAULT ROWS TO DISPLAY AS 5
				}else{ //GET VARIABLE VALIDATIONS
					$get_display_value=$_GET["display"];
					if(!is_numeric($get_display_value) || 
					   ($get_display_value-floor($get_display_value))!=0 || 
					   $get_display_value<1){
						die("Invalid Inputs");
					}else{
						if ($get_display_value>$no_of_ref_ids_created_by_users_complete){
							$display_rows=$no_of_ref_ids_created_by_users_complete;
						}else{
							$display_rows=$_GET["display"];
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
					if(!$ref_ids_created_by_users_complete[$k][0]){
						break;
					}
					$ref_ids_created_by_users[$j][0]=$ref_ids_created_by_users_complete[$k][0];
					$ref_ids_created_by_users[$j][1]=$ref_ids_created_by_users_complete[$k][1];
					$j++;
					$k++;
				}
                $no_of_ref_ids_created_by_user=count($ref_ids_created_by_users)-1;
				
				//PHP BUTTON SUBMISSION RESPONSE CHECKS
				if(isset($_POST["all_quotes_display"])){
					echo "entered all_quotes_display";
					$noOfQuotesToDisplay=$_POST['no_of_quotes_to_display'];
					header("location: dashboard.php?View=AllQuotes&display=".$noOfQuotesToDisplay."&page=1");
				}

				if(isset($_POST["all_quotes_display_next"])){
					$noOfQuotesToDisplay=$_POST['no_of_quotes_to_display'];
					if($display_page<$no_of_pages){
						$display_page++;
					}else{
					}
					header("location: dashboard.php?View=AllQuotes&display=".$noOfQuotesToDisplay."&page=".$display_page);
				}

				if(isset($_POST["all_quotes_display_prev"])){
					$noOfQuotesToDisplay=$_POST['no_of_quotes_to_display'];
					if($display_page>1){
						$display_page--;
					}else{
					}
					header("location: dashboard.php?View=AllQuotes&display=".$noOfQuotesToDisplay."&page=".$display_page);
				}

				if(isset($_POST["all_quotes_display_first"])){
					$noOfQuotesToDisplay=$_POST['no_of_quotes_to_display'];
					$display_page=1;
					header("location: dashboard.php?View=AllQuotes&display=".$noOfQuotesToDisplay."&page=".$display_page);
				}

				if(isset($_POST["all_quotes_display_last"])){
					$noOfQuotesToDisplay=$_POST['no_of_quotes_to_display'];
					$display_page=$no_of_pages;
					header("location: dashboard.php?View=AllQuotes&display=".$noOfQuotesToDisplay."&page=".$display_page);
				}
            ?>
            
			<!--            NAVIGATION BUTTONS-->
            <br>
            <div class="row">
				<form method="post">
					<div class="col-sm-2">
						<label for="no_of_quotes">Total No of Quotes :</label>
					</div>
					<div class="col-sm-1">
						<input type="number" class="form-control" id="no_of_quotes" readonly value="<?php echo count($ref_ids_created_by_users_complete); ?>">
					</div>

					<div class="col-sm-1">
						<label for="no_of_quotes_to_display">Display :</label>
					</div>
					<div class="col-sm-2">
						<select class="form-control" id="no_of_quotes_to_display" name="no_of_quotes_to_display">
							<option value="5" <?php if($display_rows==5){echo "selected";} ?>>5</option>
							<option value="10" <?php if($display_rows==10){echo "selected";} ?>>10</option>
							<option value="50" <?php if($display_rows==50){echo "selected";} ?>>50</option>
							<option value="<?php echo $no_of_ref_ids_created_by_users_complete; ?>" <?php if($display_rows==$no_of_ref_ids_created_by_users_complete){echo "selected";} ?>>All (<?php echo $no_of_ref_ids_created_by_users_complete; ?>)</option>
						</select>
					</div>
					<div class="col-sm-1">
						<button type="submit" class="btn btn-primary" name="all_quotes_display">Go</button>
					</div>
					<div class="col-sm-4">
						<button type="submit" name="all_quotes_display_first" style="background-color: transparent; border: none; padding-top: 5px;"><span class="glyphicon glyphicon-step-backward"></span></button>
						<button type="submit" name="all_quotes_display_prev" style="background-color: transparent; border: none;padding-top: 5px;"><span class="glyphicon glyphicon-triangle-left" name=""></span></button>
						<span style="padding-top: 5px; text-align: center;">Page-<?php echo $display_page;?>/<?php echo $no_of_pages; ?></span>
						<button type="submit" name="all_quotes_display_next" style="background-color: transparent; border: none; padding-top: 5px;"><span class="glyphicon glyphicon-triangle-right"></span></button>
						<button type="submit" name="all_quotes_display_last" style="background-color: transparent; border: none; padding-top: 5px;"><span class="glyphicon glyphicon-step-forward"></span></button>
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
                        <th>List Price</th>
                        <th>Customer</th>
                        <th>Partner</th>
                        <th>Country</th>
                        <th>Date</th>
                        <th>Version</th>
                        <th>Status</th>
                        <th>App'd By</th>
                        <th>App'd On</th>
                        <th><center>Actions</center></th>
                        <th><center>More</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i=0;$i<=$no_of_ref_ids_created_by_user;$i++){
                            $versions=find_all_version_ids($ref_ids_created_by_users[$i][0]);
                            $no_of_versions=count($versions);
                            $latest_version=count($versions)-1;
                            
                            $quote_status=find_quote_status_from_lht($ref_ids_created_by_users[$i][0], $versions[$latest_version]);
                            $crt_product_module=find_data_from_crt_for_dashboard($ref_ids_created_by_users[$i][0], $versions[$latest_version]);
                            $lht_list_price=find_list_price_from_lht_for_dashboard($ref_ids_created_by_users[$i][0], $versions[$latest_version]);
                            $lgt_details=find_data_from_lgt_for_dashboard($ref_ids_created_by_users[$i][0], $versions[$latest_version]);
                    ?>
                    <tr>
                        <td><?php echo find_company_name($ref_ids_created_by_users[$i][0]); ?></td>
                        <td><?php echo $crt_product_module["product_module"]; ?></td>
                        <td><?php echo currency_format($lht_list_price,$crt_product_module["cust_currency"]); ?></td>
                        <td><?php echo $crt_product_module["cust_name"]; ?></td>
                        <td><?php echo $crt_product_module["partner"]; ?></td>
                        <td><?php echo $crt_product_module["country"]; ?></td>
                        <td><?php echo $lgt_details["license_generation_date"];?></td>
                        <td><?php echo $versions[$latest_version]; ?></td>
                        <td><?php echo $lgt_details["status"];?></td>
                        <td><?php echo find_emp_name_from_users($lgt_details["approved_by_emp_id"]);?></td>
                        <td>
                            <?php 
                                if($lgt_details["approved_ts"]!="0000-00-00 00:00:00"){
                                    echo $lgt_details["approved_ts"];
                                }
                            ?>
                        </td>
                        <td>
                            <center>
                                <!--View Quote ICON -->
                                <a href="pdf/html_view_quote.php?refId=<?php echo $ref_ids_created_by_users[$i][0]."&verId=".$versions[$latest_version];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="View Quote"><span class="glyphicon glyphicon-eye-open"> </span></a>
                                
                                <!--View PDF ICON -->
                                <a href="pdf/view_quote.php?refId=<?php echo $ref_ids_created_by_users[$i][0]."&verId=".$versions[$latest_version];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="View Quote"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                
                                <!--Edit Quote ICON -->
                                <?php
                                    if($quote_status=="Finalized"){?>
                                        <a onclick="return confirm('Finalized Quote cannot be edited. New version will be created. Confirm to proceed');" href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_users[$i][0]."&verid=".$versions[$latest_version];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Quote"><span class="glyphicon glyphicon-edit"> </span></a>
                                <?php }else{ ?>
                                        <a href="Q-Generator-Edit.php?refid=<?php echo $ref_ids_created_by_users[$i][0]."&verid=".$versions[$latest_version];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Quote"><span class="glyphicon glyphicon-edit"> </span></a>
                                <?php } ?>
                                
                                <!--Download Quote ICON -->
                                <a href="pdf/download_quote.php?refId=<?php echo $ref_ids_created_by_users[$i][0]."&verId=".$versions[$latest_version];?>" data-toggle="tooltip" data-placement="top" title="Download Quote"><span class="glyphicon glyphicon-save-file"> </span></a>
                                
                                <!--EMail Quote ICON -->
                                <?php
                                    if($quote_status=="Draft"){?>
                                        <span class="glyphicon glyphicon-envelope" style="color:GREY;"> </span>
                                    <?php }else{?>
                                        <a href="pdf/generate_quote_attachment.php?refId=<?php echo $ref_ids_created_by_users[$i][0]."&verId=".$versions[$latest_version]."&emailid=".$_SESSION["emailid"];?>" data-toggle="tooltip" data-placement="top" title="Email Quote"><span class="glyphicon glyphicon-envelope"> </span></a>
                                    <?php }
                                ?>
                                
                                <!-- Excel Export -->
                                <a href="excel/quote/download.php?refId=<?php echo $ref_ids_created_by_users[$i][0]."&verId=".$versions[$latest_version]."&emailid=".$_SESSION["emailid"];?>" data-toggle="tooltip" data-placement="top" title="Export to Excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                                
								<!-- Quote Transfer ICON-->
                               	<a href="admin/qutoe_transfer.php?refId=<?php echo $ref_ids_created_by_users[$i][0]."&verId=".$versions[$latest_version]; ?>" data-toggle="tooltip" data-placement="top" title="Transfer Quote"><span class="glyphicon glyphicon-transfer"> </span></a>
                                
                                <!--Delete Quote ICON -->
                                <?php
                                    if($quote_status=="Finalized"){?>
                                        <span class="glyphicon glyphicon-trash" style="color:GREY;"> </span>
                                    <?php }else{?>
                                        <a href="quote_delete.php?refId=<?php echo $ref_ids_created_by_users[$i][0]."&verId=".$versions[$latest_version];?>" data-toggle="tooltip" data-placement="top" title="Delete Quote"><span class="glyphicon glyphicon-trash"> </span></a>
                                    <?php }
                                ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <!--More ICON -->
                                <?php 
                                    if($latest_version==0){ ?>

                                <?php } else {?>    
                                <a href="dashboard-more.php?refId=<?php echo $ref_ids_created_by_users[$i][0]."&verId=".$versions[$latest_version];?>" data-toggle="tooltip" data-placement="top" title="Quote History"><span class="glyphicon glyphicon-option-horizontal"></span></a>
                                <?php }
                                ?>
                            </center>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
              </table>
            </div>