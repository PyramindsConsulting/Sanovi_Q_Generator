<?php
    //FUNCTION FOR GATHERING VALUES OF LEARNING FACTOR TABLE
    function gather_learning_factor_values($app_id){
        include ("../../includes/config.php");
        $query="SELECT * FROM LearningFactor WHERE app='$app_id'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        $details=array();
        $details["simple_app"]=$row["simple_app"];
        $details["complex_app"]=$row["complex_app"];
        return $details;
    }

    //FUNCTION FOR UPDATING LEARNING FACTOR TABLE
    function update_learning_factor_values($app_id,$simple_app, $complex_app){
        include ("../../includes/config.php");
        $query="UPDATE LearningFactor SET simple_app = '$simple_app', complex_app='$complex_app' WHERE app='$app_id'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Update Failed");
        }
        return "Update Successfull";
    }

    //FUNCTION TO FIND LAST UPDATED TS OF EXCHANGE RATES TABLE
    function last_updated_exchange_rates(){
        include ("../../includes/config.php");
        $query="SELECT lastupdated_ts FROM ExchangeRates WHERE target_currency='USD'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        $time_stamp = $row["lastupdated_ts"];
        return $time_stamp;
    }

    //FUNCTION TO FIND NUMBER OF ROWS IN EXCHANGE RATES TABLE
    function no_of_rows_exchange_rates(){
        include ("../../includes/config.php");
        $query="SELECT * FROM ExchangeRates";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        $num_rows = mysqli_num_rows($result);
        return $num_rows;
    }

    //FUNCTION FOR GATHERING VALUES OF EXCHANGE RATES TABLE
    function gather_exchange_rates_values($app_id){
        include ("../../includes/config.php");
        $query="SELECT * FROM ExchangeRates WHERE modify_tbl_key='$app_id'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        $details=array();
        $details["base_currency"]=$row["base_currency"];
        $details["target_currency"]=$row["target_currency"];
        $details["exchange_rate"]=$row["exchange_rate"];
        //print_r ($details);
        return $details;
    }

    //FUNCTION FOR UPDATING EXCHANGE RATES TABLE
    function update_exchange_rates_values($app_id, $exchange_rate){
        include ("../../includes/config.php");
        
        $now = date("Y-m-d H:i:s");
        
        $query="UPDATE ExchangeRates SET exchange_rate = '$exchange_rate', lastupdated_ts='$now' WHERE modify_tbl_key='$app_id'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Update Failed");
        }
        
        $query="UPDATE ExchangeRates SET lastupdated_ts='$now'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Update Failed");
        }
        return "Update Successfull";
    }

    //FUNCTION TO FIND NUMBER OF ROWS IN GENERAL DISCOUNTS TABLE
    function no_of_rows_general_discounts(){
        include ("../../includes/config.php");
        $query="SELECT * FROM GeneralDiscounts";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        $num_rows = mysqli_num_rows($result);
        return $num_rows;
    }

    //FUNCTION TO FIND NUMBER OF ROWS IN USER ROLES TABLE
    function no_of_rows_user_roles(){
        include ("../../includes/config.php");
        $query="SELECT * FROM UserRoles";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        $num_rows = mysqli_num_rows($result);
        return $num_rows;
    }

    //FUNCTION FOR GATHERING VALUES OF GENERAL DISCOUNTS TABLE
    function gather_general_discounts_values($app_id){
        include ("../../includes/config.php");
        $query="SELECT * FROM GeneralDiscounts WHERE modify_tbl_key='$app_id'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        $details=array();
        $details["DiscountName"]=$row["DiscountName"];
        $details["DiscountPercentage"]=$row["DiscountPercentage"];
//        print_r ($details);
        return $details;
    }

    //FUNCTION FOR GATHERING VALUES OF GENERAL DISCOUNTS TABLE
    function gather_role_discounts_values($app_id){
        include ("../../includes/config.php");
        $query="SELECT * FROM UserRoles WHERE modify_tbl_key='$app_id'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        $details=array();
        $details["UserRole"]=$row["UserRole"];
        $details["MaxDiscount"]=$row["MaxDiscount"];
//        print_r ($details);
        return $details;
    }

    //FUNCTION FOR UPDATING EXCHANGE RATES TABLE
    function update_general_discounts_values($app_id, $discount_percentage){
        include ("../../includes/config.php");
        
        $query="UPDATE GeneralDiscounts SET DiscountPercentage = '$discount_percentage' WHERE modify_tbl_key='$app_id'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Update Failed");
        }
        
        return "Update Successfull";
    }

    //FUNCTION FOR UPDATING USER ROLES TABLE
    function update_userroles_values($app_id, $discount_percentage){
        include ("../../includes/config.php");
        
        $query="UPDATE UserRoles SET MaxDiscount = '$discount_percentage' WHERE modify_tbl_key='$app_id'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Update Failed");
        }
        
        return "Update Successfull";
    }

    //FUNCTION TO FIND NUMBER OF ROWS IN GENERAL DISCOUNTS TABLE
    function no_of_rows_base_prices($country){
        include ("../../includes/config.php");
        
        //$query="SELECT * FROM BasePrices WHERE product_Module IN ('Drill Manager', 'Monitor/Recovery Bundle', 'DR Lifecycle Bundle', 'PFR Base Server', 'CCM Base', 'Block Base Server', 'DRM Recovery Monitor and Manager') AND country='$country' ORDER BY product_module ASC";
        
        //$query="SELECT * FROM BasePrices WHERE product_module IN ('Drill Manager', 'Monitor/Recovery Bundle', 'DR Lifecycle Bundle', 'PFR Base Server', 'CCM Base', 'Block Base Server', 'DRM Recovery Monitor and Manager') AND country='India'";
        
        $query="SELECT * FROM BasePrices WHERE country='$country'";
        
        //$query="SELECT * FROM BasePrices WHERE modify_tbl_key='$search_key'";
        
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        $num_rows = mysqli_num_rows($result);
        return $num_rows;
    }

    //FUNCTION FOR GATHERING VALUES OF GENERAL DISCOUNTS TABLE
    function gather_base_prices_values($base_id, $country){
        include ("../../includes/config.php");
        $search_key=$country.$base_id;
        //echo $search_key;
        $query="SELECT * FROM BasePrices WHERE modify_tbl_key='$search_key'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Query Failed");
        }
        //ACQUIRING THE DATA FROM DB
        $row=mysqli_fetch_array($result);
        $details=array();
        $details["part_number"]=$row["part_number"];
        $details["part_desc"]=$row["part_desc"];
        $details["product_module"]=$row["product_module"];
        $details["base_price"]=$row["base_price"];
//        print_r ($details);
        return $details;
    }

    //FUNCTION FOR UPDATING EXCHANGE RATES TABLE
    function update_base_price_values($base_id, $country, $price){
        include ("../../includes/config.php");
        
        $search_key=$country.$base_id;
        
        $query="UPDATE BasePrices SET base_price = '$price' WHERE modify_tbl_key='$search_key'";
        $result = mysqli_query($connect, $query);
        //CHECK IF QUERY EXECUTES OR NOT
        if(!$result){
            die("Database Update Failed");
        }
        
        return "Update Successfull";
    }
?>