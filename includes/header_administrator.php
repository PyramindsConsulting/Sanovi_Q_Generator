<style>
    nav{
            z-index: 10000;
        }

</style>
<div class="navbar-lg">
    <div class="navbar-primary">
        <nav class="navbar navbar" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
                <div class="row vertical-align">
                    <div class="col-sm-8"> <img src="../images/Sanovi-Logo-Mobile.png" class="img-responsive imagepad displayed" /> </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="logout" style="text-align:right"><?php echo "1.00 USD = ".dispaly_currencies("AED")." AED = ".dispaly_currencies("SGD")." SGD = ".dispaly_currencies("INR")." INR | As on ".display_currency_update_date();?></div>
<!--                            <div class="logout"><a href="../dashboard.php">Dashboard</a>  |  <a href="../logout.php">Logout</a> </div>-->
                            <div class="col-sm-12 last">
                                <p class="usrname">Hello
                                    <?php echo $_SESSION["emp_name"].','.$_SESSION["userrole"]; ?> <span id="desktopbreak"><br></span> Your last login is
                                        <?php echo $_SESSION["lastlogin"]." IST"; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>