            <div class="row">
                <table class="table table-hover" style="font-size:12px;">
                <thead>
                    <tr style="background-color:#33689C; color:WHITE;">
                        <th>Opportunity</th>
                        <th>Module</th>
                        <th>List Price</th>
                        <th>Customer</th>
                        <th>Partner</th>
                        <th>Date</th>
                        <th>Version</th>
                        <th>Status</th>
                        <th><center>Actions</center></th>
                    </tr>
                </thead>
                    
                <tbody>
                    <?php
                        for($j=$verId;$j>=1;$j--){
                            $quote_status=find_quote_status_from_lht($refId, $j);
                            $crt_product_module=find_data_from_crt_for_dashboard($refId, $j);
                            $lht_list_price=find_list_price_from_lht_for_dashboard($refId, $j);
                            $lgt_details=find_data_from_lgt_for_dashboard($refId, $j);
                            if ($quote_status==""){
                                
                            }else{
                    ?>
                    
                            <tr>
                                <td><?php echo find_company_name($refId); ?></td>
                                <td><?php echo $crt_product_module["product_module"]; ?></td>
                                <td><?php echo currency_format($lht_list_price,$crt_product_module["cust_currency"]); ?></td>
                                <td><?php echo $crt_product_module["cust_name"]; ?></td>
                                <td><?php echo $crt_product_module["partner"]; ?></td>
                                <td><?php echo $lgt_details["license_generation_date"];?></td>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $lgt_details["status"];?></td>
                                <td>
                                    <center>
                                        <!--View Quote ICON -->
                                        <a href="pdf/html_view_quote.php?refId=<?php echo $refId."&verId=".$j;?>" target="_blank" data-toggle="tooltip" data-placement="top" title="View Quote"><span class="glyphicon glyphicon-eye-open"> </span></a>
                                        
                                        <!--View PDF ICON -->
                                        <a href="pdf/view_quote.php?refId=<?php echo $refId."&verId=".$j;?>" target="_blank" data-toggle="tooltip" data-placement="top" title="View Quote"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>

                                        <!--Edit Quote ICON -->
                                        <?php
                                            if($quote_status=="Finalized"){?>
                                                <a onclick="return confirm('Finalized Quote cannot be edited. New version will be created. Confirm to proceed');" href="Q-Generator-Edit.php?refid=<?php echo $refId."&verid=".$j;?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Quote"><span class="glyphicon glyphicon-edit"> </span></a>
                                        <?php }else{ ?>
                                                <a href="Q-Generator-Edit.php?refid=<?php echo $refId."&verid=".$j;?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Quote"><span class="glyphicon glyphicon-edit"> </span></a>
                                        <?php } ?>

                                        <!--Download Quote ICON -->
                                        <a href="pdf/download_quote.php?refId=<?php echo $refId."&verId=".$j;?>" data-toggle="tooltip" data-placement="top" title="Download Quote"><span class="glyphicon glyphicon-save-file"> </span></a>

                                        <!--EMail Quote ICON -->
                                        <?php
                                            if($quote_status=="Draft"){?>
                                                <span class="glyphicon glyphicon-envelope" style="color:GREY;"> </span>
                                            <?php }else{?>
                                                <a href="pdf/generate_quote_attachment.php?refId=<?php echo $refId."&verId=".$j."&emailid=".$_SESSION["emailid"];?>" data-toggle="tooltip" data-placement="top" title="Email Quote"><span class="glyphicon glyphicon-envelope"> </span></a>
                                            <?php }
                                        ?>

                                        <!--Delete Quote ICON -->
                                        <?php
                                            if($quote_status=="Finalized"){?>
                                                <span class="glyphicon glyphicon-trash" style="color:GREY;"> </span>
                                            <?php }else{?>
                                                <a href="quote_delete.php?refId=<?php echo $refId."&verId=".$j;?>" data-toggle="tooltip" data-placement="top" title="Delete Quote"><span class="glyphicon glyphicon-trash"> </span></a>
                                            <?php }
                                        ?>
                                    </center>
                                </td>
                            </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
                    
              </table>
            </div>