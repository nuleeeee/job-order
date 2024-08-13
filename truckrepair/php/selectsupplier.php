<?php
include "../../phpconfig/allfunction.php";

$display = optionlst($db, "SELECT suppname FROM vlookup_mcore.vrepairsupplier", "suppname", "idxx");

echo $display;

?>