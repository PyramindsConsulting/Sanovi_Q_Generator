<?php
    function get_field_values($refid, $verid){
        include ("../includes/config.php");
        $crt_id=$refid."_".$verid;
        $query="SELECT * FROM CustomerRequirements WHERE license_crt_id='$crt_id'";
        $result=mysqli_query($connect, $query);
        if(!$result){
            die ("Database Query Failed");
        }
        $row=mysqli_fetch_array($result);
        
        $details["Productname"]=$row["product"];
        $details["License"]=$row["license_type"];
        $details["Country"]=$row["country"];
        $details["Currency"]=$row["cust_currency"];
        $details["organization_name"]=$row["cust_org_name"];
        $details["Customer_name"]=$row["cust_name"];
        $details["Partner_name"]=$row["partner"];
        $details["option_tag"]=$row["option_tag"];
        $details["Mode_of_sale"]=$row["mode_of_sale"];
        $details["Product_module"]=$row["product_module"];
        $details["vm_images_2S"]=$row["2s_noOfVmImages"];
        $details["db_2S"]=$row["2s_noOfVmDatabases"];
        $details["b_windows_datas_2S"]=$row["2s_noOfBareMetalWinLinuxServers"];
        $details["b_windows_db_2S"]=$row["2s_noOfBareMetalWinLinuxDatabases"];
        $details["b_unix_datas_2S"]=$row["2s_noOfBareMetalUnixServers"];
        $details["b_unix_db_2S"]=$row["2s_noOfBareMetalUnixDatabases"];
        $details["prod_servers_2S"]=$row["2s_noOfUsingAdvancedReplication"];
        $details["virtual_prod_2S"]=$row["2s_noOfVirtualServersUsingAdvancedReplication"];
        $details["share_server_2S"]=$row["2s_noOfSharePointServers"];
        $details["virtual_sharepoint_server_2S"]=$row["2s_noOfVirtualSharePointServers"];
        $details["prod_ms_2S"]=$row["2s_noOfMSExchangeDatabases"];
        $details["prod_v_ms_2S"]=$row["2s_noOfVirtualMSExchangeDatabases"];
        $details["servers_2S"]=$row["2s_noOfServersForPFRReplication"];
        $details["sap_hana_data_2S"]=$row["2s_noOfSAPHANADatabases"];
        $details["sap_hana_nodes_2S"]=$row["2s_noOfSAPHANANodes"];
        $details["bunker_3S"]=$row["3s_isBunkerSite"];
        $details["vm_images_3S"]=$row["3s_noOfVmImages"];
        $details["database_3S"]=$row["3s_noOfVmDatabases"];
        $details["b_windows_datas_3S"]=$row["3s_noOfBareMetalWinLinuxServers"];
        $details["b_windows_db_3S"]=$row["3s_noOfBareMetalWinLinuxDatabases"];
        $details["b_unix_datas_3S"]=$row["3s_noOfBareMetalUnixServers"];
        $details["b_unix_db_3S"]=$row["3s_noOfBareMetalUnixDatabases"];
        $details["prod_servers_3S"]=$row["3s_noOfUsingAdvancedReplication"];
        $details["virtual_prod_3S"]=$row["3s_noOfVirtualServersUsingAdvancedReplication"];
        $details["share_server_3S"]=$row["3s_noOfSharePointServers"];
        $details["virtual_server_3S"]=$row["3s_noOfVirtualSharePointServers"];
        $details["prod_ms_3S"]=$row["3s_noOfMSExchangeDatabases"];
        $details["prod_v_ms_3S"]=$row["3s_noOfVirtualMSExchangeDatabases"];
        $details["servers_3S"]=$row["3s_noOfServersForPFRReplication"];
        $details["sap_hana_data_3S"]=$row["3s_noOfSAPHANADatabases"];
        $details["sap_hana_nodes_3S"]=$row["3s_noOfSAPHANANodes"];
        $details["Prof_Services_all"]=$row["areProfessionalServicesRequired"];
        $details["Prof_Services_type"]=$row["Prof_serviceType"];
        $details["Prof_Services_vm_image"]=$row["Prof_noOfVmImages"];
        $details["Prof_Services_database"]=$row["Prof_noOfVmDatabases"];
        $details["Prof_Services_b_windows_datas"]=$row["Prof_noOfBareMetalWinLinuxServers"];
        $details["Prof_Services_b_windows_db"]=$row["Prof_noOfBareMetalWinLinuxDatabases"];
        $details["Prof_Services_b_unix_datas"]=$row["Prof_noOfBareMetalUnixServers"];
        $details["Prof_Services_b_unix_db"]=$row["Prof_noOfBareMetalUnixDatabases"];
        $details["Prof_Services_prod_servers"]=$row["Prof_noOfUsingAdvancedReplication"];
        $details["Prof_Services_virtual_prod"]=$row["Prof_noOfVirtualServersUsingAdvancedReplication"];
        $details["Prof_Services_share_server"]=$row["Prof_noOfSharePointServers"];
        $details["Prof_Services_share_db"]=$row["Prof_noOfSharePointDatabases"];
        $details["Prof_Services_v_share_server"]=$row["Prof_noOfVirtualSharePointServers"];
        $details["Prof_Services_v_share_db"]=$row["Prof_noOfVirtualSharePointDatabases"];
        $details["Prof_Services_prod_ms"]=$row["Prof_noOfMSExchangeDatabases"];
        $details["Prof_Services_prod_v_ms"]=$row["Prof_noOfVirtualMSExchangeDatabases"];
        $details["Prof_services_sap_hana_data"]=$row["Prof_noOfSAPHANADatabases"];
        $details["Prof_services_sap_hana_node"]=$row["Prof_noOfSAPHANANodes"];
        $details["Prof_PremiseProductTraining"]=$row["Prof_PremiseProductTraining"];
        $details["Product_Support"]=$row["yearsOfSupport"];
        
        $lht_id=$refid."_".$verid;
        $query="SELECT * FROM LicenseHistory WHERE license_lht_id='$lht_id'";
        $result=mysqli_query($connect, $query);
        if(!$result){
            die ("Database Query Failed");
        }
        
        $row=mysqli_fetch_array($result);
        
        $details["Discount_license"]=$row["discountPercentageOnLicense"];
        $details["Discount_prof_serv"]=$row["discountPercentageOnPS"];
        $details["Discount_product_support"]=$row["discountPercentageOnSupport"];
        $details["Discount_product_training"]=$row["discountPercentageOnTraining"];
        
        return $details;
    }
    function get_discount_percentage_value($refid,$verid){
        include ("../includes/config.php");
        $lht_id=$refid."_".$verid;
        $query="SELECT * FROM LicenseHistory WHERE license_lht_id='$lht_id'";
        $result=mysqli_query($connect, $query);
        if(!$result){
            die ("Database Query Failed");
        }
        
        $row=mysqli_fetch_array($result);
        $details["Discount_license"]=$row["discountPercentageOnLicense"];
        $details["Discount_prof_serv"]=$row["discountPercentageOnPS"];
        $details["Discount_product_support"]=$row["discountPercentageOnSupport"];
        $details["Discount_product_training"]=$row["discountPercentageOnTraining"];
        return $details;
    }
    function get_existing_discount_values($refid, $verid){
        include ("../includes/config.php");
        $lht_id=$refid."_".$verid;
        $query="SELECT * FROM LicenseHistory WHERE license_lht_id='$lht_id'";
        $result=mysqli_query($connect, $query);
        if(!$result){
            die ("Database Query Failed");
        }
        
        $row=mysqli_fetch_array($result);
        
        $details["Discount_license"]=$row["discountPercentageOnLicense"];
        $details["Discount_prof_serv"]=$row["discountPercentageOnPS"];
        $details["Discount_product_support"]=$row["discountPercentageOnSupport"];
        $details["Discount_product_training"]=$row["discountPercentageOnTraining"];
        return $details;
    }
?>