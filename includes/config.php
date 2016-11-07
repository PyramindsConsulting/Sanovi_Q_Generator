<?php
    $host_name  = "192.186.234.211";
    $database   = "sanovi_licensequote";
    $user_name  = "sanovi_licensequ";
    $password   = "XRebTEU@7zk.";


    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    
    if(mysqli_connect_errno())
    {
        echo '<p>Connection to MySQL server failed: '.mysqli_connect_error().'</p>';
    }else{
        //echo '<p>Connection to MySQL server is Successful.</p>';
    }
?>