<?php
include "../../phpconfig/allfunction.php";

$brand = $_POST['brand'];
$model = $_POST['model'];

$display = optionlst($db, "SELECT plateno FROM vlookup_mcore.vtruckaccounted WHERE brand = '$brand' AND typeofvehicle = '$model'", "plateno", "plateno");

echo $display;
?>