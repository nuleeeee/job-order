<?php
include "../../phpconfig/allfunction.php";

$branchid = $_POST['branchid'];

$display = optionlst($db, "SELECT brand FROM vlookup_mcore.vtruckaccounted WHERE bridz = '$branchid' GROUP BY brand", "brand", "brand");

echo $display;
?>