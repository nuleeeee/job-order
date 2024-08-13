<?php
include "../../phpconfig/allfunction.php";

// $display = optionlst($db, "SELECT suppname FROM vlookup_mcore.vrepairsupplier", "suppname", "idxx");

// echo $display;

$options = [];

$resultx = mysqli_query($db, "SELECT suppname, idxx FROM vlookup_mcore.vrepairsupplier");
if (mysqli_error($db) != "") {
    // Handle the error if needed
} else {
    while ($rowx = $resultx->fetch_assoc()) {
        $options[] = ['label' => $rowx['suppname'], 'value' => $rowx['suppname']];
    }
}

header('Content-Type: application/json');
echo json_encode(['data' => $options]);

?>