
<style>
    #sidemenu_div{
        background-color: #f4f4f4;
        padding: 20px;
        height: 90vh;
        margin-left: 15px;
    }
/*
    body{
        margin-bottom: 0;
    }
*/
</style>
<body>
<div id="sidemenu_div">
    <p style="color:#011D42;"><b>PROFILE</b></p>
    <p><a href="../myprofile.php">My Profile</a></p>
    <p><a href="../changeprofilepassword.php">Change Password</a></p><br>
    <?php 
        if($_SESSION["userrole"]=="Administrator"){
            echo "<p style=\"color:#011D42;\"><b>ADMINISTRATOR</b></p>";
            echo "<p><a href=\"../admin/userlist.php\">User List</a></p>";
            echo "<p><a href=\"../admin/adduser.php\">Add User</a></p>";
            echo "<p><a href=\"../admin/deleteuser.php\">Delete User</a></p>";
            echo "<p><a href=\"../admin/modifyuser.php\">Modify User</a></p>";
            echo "<p><a href=\"../admin/resetpassword.php\">Reset Password</a></p>";
            echo "<p><a href=\"../tables/modify_tables.php\">Modify Table Values</a></p>";
        }
    ?>
</div>
    </body>