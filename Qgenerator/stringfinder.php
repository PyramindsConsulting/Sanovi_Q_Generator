
<?php
function find_current_calendar_year(){
    $year1=date('Y');
    $year2=date('y');
    $month=date('n');    
    $day=date('j');
    if ($month > 3) { //
       $nextyear = $year2 + 1;
        $finYr = $year1."-".$nextyear;
    } else {
        $finYr = ($year1 - 1)."-".$year2;
    }
    return $finYr;
}

$a = 'SAN/2016-17/1';
$FinYear=find_current_calendar_year();
if (preg_match('/'.$FinYear.'/',$a)){
    echo 'true'.$FinYear;
}else{
    echo "No Match Found";
}
DELETE FROM RefVerID WHERE ref_id NOT IN 
  (SELECT id FROM RefVerID WHERE ref_id = 0);
?>

12:58:31	DELETE FROM RefVerID_1 WHERE ref_id NOT IN (SELECT ref_id FROM RefVerID_1 WHERE ver_id = 0)	Error Code: 1093. You can't specify target table 'RefVerID_1' for update in FROM clause	0.250 sec
