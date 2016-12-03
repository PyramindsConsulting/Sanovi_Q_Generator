<?php 
    session_start(); 
    ob_start();
    //echo $_SESSION["delete_emp_id"];
    $deleted="No";

    //SET ACTIVE PAGE
    $_SESSION["active_page"]="list";

    //BREADCRUMB DATA
//    $root="Admin";
//    $root_link="userlist.php";
//    $active="Quote Transfer";
    $error_result="";

    include "../../includes/config.php";
    include "../../includes/php_functions.php";

    change_session_id();
    check_session_expiry();
?>
    <html>

    <head>
        <title> Sanovi Q-Generator </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/style-admin.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="../js/menu.js"></script>
    </head>

    <body onresize="change_menus()">
        <?php
            if($_SESSION["authentication"] == "passed"){ 
                $admin_check=authenticate_admin();
                include "../../includes/header_administrator.php";
                include "../../includes/mainmenu-mobile.php";
                include "../../includes/mainmenu.php";
                if($admin_check!="Passed"){
                    echo "<center><br>";
                    echo "<img src=\"../images/Access-Denied.jpg\" width=\"25%\">";
                    echo "<p style=\"color:red;\">You are not authorized to visit this page</p>";
                    echo "</center>";
                    die();
                }
                
                //GET QUOTE REF ID FOR TRANSFER
                if(!$_GET){
                    echo "<br><center><p style=\"color:RED;\">Invalid Request</p></center>";
                       die();
                }else{
                    if(!$_GET[refId]){
                        echo "<br><center><p style=\"color:RED;\">Invalid Request</p></center>";
                        die();
                    }
                    $refId=$_GET[refId];
                    $verId=$_GET[verId];
					$current_quote_owner_details=find_quote_owner_details($refId, $verId);
					$transfer_quote_details=find_quote_details_for_transfer($refId, $verId);
					
					$new_owner_error="";
					$transfer_status="";
                }
                
                $details=fetch_user_data($emp_id);
                
                if(isset($_POST['submit']))
                {
                    if(isset($_POST["NewOwner"])){
						$transfer_status=update_new_quote_owner($refId, $verId, $_POST["NewOwner"]);
					}else{
						$new_owner_error="Please select new owner";
					}
                }
        	?>
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-md-3 sidemenu_div">
						<?php include "../../includes/sidemenu.php"; ?>
					</div>
					<div class="col-sm-8 col-md-9 breadcrumbs_div">
						<div id="breadcrumbs_id">
							<?php 
							//breadcrumb($root, $root_link, $active);
						?>
						</div>
						<div class="row">
							<div class="col-sm-12 main_content">
								<form method="post">
									<div class="form-group addPersonPanel">
										<div class="form-group">
											<?php echo "<br><center><p style='color:RED;'>".$error_result."</p></center>"; ?>
											<h2>Quote Transfer</h2>
											<br>
											<?php if($transfer_status!="Quote Transferred Successfully") {?>
											<div class="form-group">
												<div class="row">
													<div class="col-sm-12">
														<h3><b>Quote Details</b></h3>
														<div class="col-sm-3">
															<p><b>Quote Ref ID</b></p>
															<p><b>Latest Version</b></p>
															<p><b>Opportunity Name</b></p>
															<p><b>Customer Name</b></p>
															<p><b>Partner</b></p>
															<p><b>Notes</b></p>
														</div>
														<div class="col-sm-3">
															<p><?php echo $refId; ?></p>
															<p><?php echo $verId; ?></p>
															<p><?php echo $transfer_quote_details["cust_org_name"];?></p>
															<p><?php echo $transfer_quote_details["cust_name"]; ?></p>
															<p><?php echo $transfer_quote_details["partner"]; ?></p>
															<p><?php echo $transfer_quote_details["option_tag"]; ?></p>
														</div>
														<div class="col-sm-6">
														</div>
													</div>
												</div>
											   <hr>
												<div class="row">
													<div class="col-sm-6">
														<b><p>CURRENT OWNER</p></b>
														<div class="row">
															<div class="col-xs-6">
																<p><b>Emp Id</b></p>
																<p><b>Emp Name</b></p>
																<p><b>User Name</b></p>
																<p><b>Department</b></p>
															</div>
															<div class="col-xs-6">
																<p><?php echo $current_quote_owner_details["emp_id"] ?></p>
																<p><?php echo $current_quote_owner_details["emp_name"] ?></p>
																<p><?php echo $current_quote_owner_details["login_name"] ?></p>
																<p><?php echo $current_quote_owner_details["login_department"] ?></p>

															</div>
														</div>

													</div>
													<div class="col-sm-6">
														<b><p>NEW OWNER</p></b>
														<form method="post">
															<div class="form-group">
																<label for="NewOwner">Please Select New Owner</label>
																<select class="form-control" id="NewOwner" name="NewOwner">
																	<option disabled selected> -- Please Select -- </option>
																	<?php echo fill_user_data_in_new_owner(); ?>
																</select>
																<span style="color:red;"><?php echo $new_owner_error; ?></span>
															</div>
														</form>
													</div>
												</div>

												<div class="row">
													<div class="col-sm-12">
														<button type="submit" name="submit" class="btn btn-default">Transfer</button>
													</div>
												</div>
											</div>
											<?php } else{ ?>
											 	<span style=" color:GREEN;">Quote Transferred Successfully</span>
											<?php } ?>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			include "../../includes/footer.php"; 
			}else {
				header('location:../../index.php');
			}
			ob_flush() 
		?>
    </body>

    </html>