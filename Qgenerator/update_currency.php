<?php 
    include "../includes/php_functions.php";
    include "../includes/config.php";
    $inr=currency_convert(1, "INR");
    $aed=currency_convert(1, "AED");
    $sgd=currency_convert(1, "SGD");
    
    date_default_timezone_set("Asia/Kolkata");
    $updated_on = date('Y-m-d H:i:s');

    //UPDATING INR
    $query_update_inr = "UPDATE ExchangeRates SET exchange_rate = '$inr', lastupdated_ts = '$updated_on' WHERE target_currency='INR'";
    $result_query_inr = mysqli_query($connect, $query_update_inr);

    //UPDATING AED
    $query_update_aed = "UPDATE ExchangeRates SET exchange_rate = '$aed', lastupdated_ts = '$updated_on' WHERE target_currency='AED'";
    $result_query_aed = mysqli_query($connect, $query_update_aed);

    //UPDATING SGD
    $query_update_sgd = "UPDATE ExchangeRates SET exchange_rate = '$sgd', lastupdated_ts = '$updated_on' WHERE target_currency='SGD'";
    $result_query_sgd = mysqli_query($connect, $query_update_sgd);
    
    if(!$result_query_inr || !$result_query_aed || !$result_query_sgd){
        die("Unable to update new password");
    }else{
        echo "updated";
    }
    
?>