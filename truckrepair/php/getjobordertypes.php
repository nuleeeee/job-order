<?php
include "../../phpconfig/allfunction.php";

$display = optionlst($db, "SELECT idxx, typename FROM vlookup_mcore.joborder_type WHERE idxx NOT IN (19,20)", "typename", "idxx");

echo $display;
?>