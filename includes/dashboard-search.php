<!--          SEARCH SELECTOR DROPDOWN  -->
            <?php 
                //DISPLAYING SEARCH CRITERIA IF $_GET VALUE HAS VALUE
                $opp_select=$cust_select=$part_select=$default_select="";
                $opp_key=$cust_key=$part_key=$default_key="";
                switch($SearchOn){
                    case "Opportunity":
                        $opp_select="selected";
                        $opp_key=$Key;
                        break;
                    case "Customer":
                        $cust_select="selected";
                        $cust_key=$Key;
                        break;
                    case "Partner":
                        $part_select="selected";
                        $part_key=$Key;
                        break;
                    default:
                        $default_select="selected";
                        $default_key=$Key;
                        break;
                }

            ?>
            <br>
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2">
                        <label class="control-label">Search Criteria :</label>
                    </div>
                    <div class="col-sm-3">
                        <div class='dropdown' name="drop">
                            <select id='search_selector' class='form-control' name='search_selector' onchange="SelectSearch()" onload="SelectSearch()">
                                <option disabled="disabled" <?php echo $default_select; ?>>--Search Criteria--</option>
                                <option value="Opportunity" <?php echo $opp_select; ?>>Opportunity</option>
                                <option value="Customer" <?php echo $cust_select; ?>>Customer</option>
                                <option value="Partner" <?php echo $part_select; ?>>Partner</option>
                            </select>
                        </div>
                    </div>
                        <script>
//                            SelectSearch();
                        </script>
                    <div class="col-sm-3" onload="SelectSearch()">
                            <input type="text" class="form-control" id="opportunity_name"  name="Opportunity_name" placeholder="Enter Opportunity to Search" onkeydown="executeSearch(event)" value="<?php echo $opp_key; ?>"> 
						  <input type="text" class="form-control" id="customer_name" name="Customer_name" placeholder="Enter Customer Name to Search" onkeydown="executeSearch(event)" value="<?php echo $cust_key; ?>">
						  <input type="text" class="form-control" id="partner_name" name="Partner_name" placeholder="Enter Partner to Search" onkeydown="executeSearch(event)" value="<?php echo $part_key; ?>">
                    </div>
                    <div class="col-sm-4">
                            <button type="button" class="btn btn-primary" id="gobtn" onclick="loadSearchQuotes()">Go</button>
                    </div>
                </div>
                <br>
            </div>
            
<!--            FINDING ALL REFERENCE IDS -->
            <?php
//                echo $SearchOn."<br>";
//                echo $Key."<br>";
                $ref_ids_created_by_users=find_all_ref_ids_from_lgt_search($_SESSION["username"],$SearchOn,$Key); //ARRAY of REF IDs & EMP Names
//    print_r($ref_ids_created_by_users);
                $no_of_ref_ids_created_by_user=count($ref_ids_created_by_users)-1;
            ?>
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