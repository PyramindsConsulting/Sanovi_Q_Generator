<style>
    #mainmenu a {
        color: white;
    }
    
    #mainmenu {
        background-color: #011D42;
        border: none;
        border-radius: 0;
    }
    
    .navbar .nav .active > a:hover {
        color: #fff;
        background-color: #33689C !important;
    }
    
    .navbar .nav a:hover {
        color: #fff;
        background-color: #33689C !important;
    }
    
    .active1 {
        background-color: #33689C !important;
    }
    
    #mainmenu_div {
        background-color: #011D42;
        height: 50px;
        z-index: 999;
    }
    
    #button_mainmenu {
        height: 33px!important;
        font-size: 12px;
        color: white;
    }
    
    nav {
        z-index: 5000;
    }
</style>
<?php
    $list=$q_generator=$profile=$admin="";
    switch ($_SESSION["active_page"]){
        case "list":
            $list="active1";
            break;
        case "q_generator":
            $q_generator="active1";
            break;
        case "profile":
            $profile="active1";
            break;
        case "admin":
            $admin="active1";
            break;
        case "add_user":
            $admin="active1";
            break;
        case "modify_user":
            $admin="active1";
            break;
        case "delete_user":
            $admin="active1";
            break;
        case "reset_password":
            $admin="active1";
            break;
    }
?>
<div id="mainmenu_div">
    <div class="container">
        <nav id="mainmenu" class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button id="button_mainmenu" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">MENU</button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo $list; ?>"><a href="../dashboard.php">Quote List</a></li>
                        
                            <li class="<?php echo $q_generator; ?>"><a href="../Q-Generator.php">Quote Generator</a></li>
                        
                        <li class="<?php echo $profile; ?>"><a href="../myprofile.php">Profile</a></li>
                        <?php 
                            if($_SESSION["userrole"]=="Administrator"){
                                echo "<li class=".$admin."><a href=\"../admin/userlist.php\">Admin</a></li>";
                            }
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        <li><a href="help" target="_blank"><span class="glyphicon glyphicon-question-sign"></span></a></li>
                        
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </div>
</div>