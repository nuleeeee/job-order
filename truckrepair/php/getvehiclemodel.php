<?php
include "../../phpconfig/allfunction.php";

$brand = $_POST['brand'];

$display = optionlst($db, "SELECT typeofvehicle FROM vlookup_mcore.vtruckaccounted WHERE brand = '$brand' GROUP BY typeofvehicle", "typeofvehicle", "typeofvehicle");

echo $display;
?>