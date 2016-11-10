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
    
    #mainmenu_mobile_div{
        background-color: #011D42;
        height: 50px;
        display : none;
    }
    
    #button_mainmenu{
        height: 33px!important;
        font-size: 12px;
        color: white;
    }
</style>

<?php
    $list=$q_generator=$profile=$admin=$ch_password=$add_user=$delete_user=$modify_user=$reset_password=$modify_tables=$user_list="";
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
        case "ch_password":
            $ch_password="active1";
            break;
        case "add_user":
            $add_user="active1";
            break;
        case "delete_user":
            $delete_user="active1";
            break;
        case "modify_user":
            $modify_user="active1";
            break;
        case "reset_password":
            $reset_password="active1";
            break;
        case "modify_tables":
            $modify_tables="active1";
            break;
        case "user_list":
            $user_list="active1";
            break;
    }
?>

<div id="mainmenu_mobile_div">
    <div class="container">
    <nav id="mainmenu" class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button id="button_mainmenu" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">MENU
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="<?php echo $list; ?>"><a href="../dashboard.php">Quote List</a></li>
                    <li class="<?php echo $q_generator; ?>"><a href="../Q-Generator.php">Quote Generator</a></li>
                    <li style="background-color:#f7f7f7; padding:4px; color:#011D42;"><b>PROFILE</b></li>
                    <li class="<?php echo $profile; ?>"><a href="../myprofile.php">My Profile</a></li>
                    <li class="<?php echo $ch_password; ?>"><a href="../changeprofilepassword.php">Change Password</a></li>
                    <?php 
                        if($_SESSION["userrole"]=="Administrator"){
                            echo "<li style=\"background-color:#f7f7f7; padding:4px; color:#011D42;\"><b>ADMINISTRATOR</b></li>";
                            echo "<li class=".$user_list."><a href=\"../admin/userlist.php\">User List</a></li>";
                            echo "<li class=".$add_user."><a href=\"../admin/adduser.php\">Add User</a></li>";
                            echo "<li class=".$delete_user."><a href=\"../admin/deleteuser.php\">Delete User</a></li>";
                            echo "<li class=".$modify_user."><a href=\"../admin/modifyuser.php\">Modify User</a></li>";
                            echo "<li class=".$reset_password."><a href=\"../admin/resetpassword.php\">Reset User Password</a></li>";
                            echo "<li class=".$modify_tables."><a href=\"../tables/modify_tables.php\">Modify Table Values</a></li>";
                        }
                    ?>
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