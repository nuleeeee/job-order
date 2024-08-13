<?php

include '../../phpconfig/allfunction.php';

$cashieridz = $_SESSION['login_user'];

if (isset($_POST['approvalstatus'])) {

    $approvalstatus = $_POST['approvalstatus'];
    $joborderidxx = $_POST['joborderidxx'];
    $nameid = $_POST['nameid'];

    $sql1 = mysqli_query($db, "UPDATE vlookup_mcore.vrepaircanvass SET approvalstatus = '$approvalstatus', approver = '$cashieridz', approvaldate = NOW() WHERE joborderidz = '$joborderidxx'");

    $sql2 = mysqli_query($db, "UPDATE vlookup_mcore.vtruckrepair SET status = '$approvalstatus' WHERE joborderidxx = '$joborderidxx'");

    if ($sql1 && $sql2) {
        echo "Update successful.";
    } else {
        echo "Error: " . mysqli_error($db);
    }

} else {
    echo "Invalid request.";
}


?>