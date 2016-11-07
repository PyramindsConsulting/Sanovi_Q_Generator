<?php include "../includes/config.php"; ?>
<!--partner suggestion-->
<script>$(function () {
    var Partners = [
        
        <?php 
        $query = $connect->query("SELECT DISTINCT partner FROM CustomerRequirements");
        $partners = Array();
        while($result = $query->fetch_assoc()) {
            $partners[] =  $result['partner'];  
        }
        $count=count($partners);
        for ($i=0;$i<$count;$i++){
            if($i==($count-1)){
                echo '"'.$partners[$i].'"';
            }else{
                echo '"'.$partners[$i].'",';
            }
        }
        
        ?>

    ];
    $("#partner").autocomplete({
        source: Partners
    });
});

</script>

<!--opportunity name suggestion-->
<script>$(function () {
    var cust_org_name = [
        
        <?php 
        $query = $connect->query("SELECT DISTINCT cust_org_name FROM CustomerRequirements");
        $cust_org_name = Array();
        while($result = $query->fetch_assoc()) {
            $cust_org_name[] =  $result['cust_org_name'];  
        }
        $count=count($cust_org_name);
        for ($i=0;$i<$count;$i++){
            if($i==($count-1)){
                echo '"'.$cust_org_name[$i].'"';
            }else{
                echo '"'.$cust_org_name[$i].'",';
            }
        }
        
        ?>

    ];
    $("#name").autocomplete({
        source: cust_org_name
    });
});

</script>

<!--customer name suggestion-->
<script>$(function () { 
    var customer_name = [
        
        <?php 
        $query = $connect->query("SELECT DISTINCT cust_name FROM CustomerRequirements");
        $customer_name = Array();
        while($result = $query->fetch_assoc()) {
            $cust_name[] =  $result['cust_name'];  
        }
        $count=count($cust_org_name);
        for ($i=0;$i<$count;$i++){
            if($i==($count-1)){
                echo '"'.$cust_name[$i].'"';
            }else{
                echo '"'.$cust_name[$i].'",';
            }
        }
        
        ?>

    ];
    $("#customer_name").autocomplete({
        source: customer_name
    });
});

</script>