<?php

include '../../phpconfig/allfunction.php';

if (isset($_POST['transfer_into'])) {

    $transfer_into = $_POST['transfer_into'];
    $joid = $_POST['joid'];
    $nameid = $_POST['nameid'];

    $sql = mysqli_query($db, "UPDATE vlookup_mcore.vtruckrepair SET repairtype = '$transfer_into' WHERE joborderidxx = '$joid' AND nameidz = '$nameid' ");

    if ($sql) {
        echo "Update successful.";
    } else {
        echo "Error: " . mysqli_error($db);
    }

} else {
    echo "Invalid request.";
}


?>