<?php

include '../../phpconfig/allfunction.php';

$cashieridz = $_SESSION['login_user'];

if (isset($_POST['approvalstatus'])) {

    $approvalstatus = $_POST['approvalstatus'];
    $joborderidxx = $_POST['joborderidxx'];
    $cancel_text = $_POST['cancel_text'];


    $sql1 = mysqli_query($db, "UPDATE vlookup_mcore.vrepaircanvass SET approvalstatus = '$approvalstatus', cancellationrequester = '$cashieridz', cancellationrequested = NOW() WHERE joborderidz = '$joborderidxx'");

    $sql2 = mysqli_query($db, "UPDATE vlookup_mcore.vtruckrepair SET status = '$approvalstatus', cancelledreason = '$cancel_text' WHERE joborderidxx = '$joborderidxx'");

    if ($sql1 && $sql2) {
        echo "Requested Cancellation Approved.";
    } else {
        echo "Error: " . mysqli_error($db);
    }

} else {
    echo "Invalid request.";
}


?>