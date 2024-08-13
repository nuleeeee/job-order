<?php

include '../../phpconfig/allfunction.php';

$cashieridz = $_SESSION['login_user'];

if (isset($_POST['approvalstatus'])) {

    $approvalstatus = $_POST['approvalstatus'];
    $joborderidxx = $_POST['joborderidxx'];
    $datacount = $_POST['datacount'];
    $cancel_text = $_POST['cancel_text'];
    $modeoffunds = $_POST['modeoffunds'];

    // Update vrepaircanvass table
    if ($approvalstatus == 1) {
        $sql1 = mysqli_query($db, "UPDATE vlookup_mcore.vrepaircanvass SET approvalstatus = 2, approver = '$cashieridz', approvaldate = NOW() WHERE joborderidz = '$joborderidxx' AND datacount != '$datacount'");

        $sql2 = mysqli_query($db, "UPDATE vlookup_mcore.vrepaircanvass SET approvalstatus = 1, approver = '$cashieridz', approvaldate = NOW() WHERE joborderidz = '$joborderidxx' AND datacount = '$datacount'");
        
        $sql3 = mysqli_query($db, "UPDATE vlookup_mcore.vtruckrepair SET status = '$approvalstatus', modeoffunds = '$modeoffunds' WHERE joborderidxx = '$joborderidxx'");
    } else {
        $sql1 = mysqli_query($db, "UPDATE vlookup_mcore.vrepaircanvass SET approvalstatus = '$approvalstatus', approver = '$cashieridz', approvaldate = NOW() WHERE joborderidz = '$joborderidxx'");

        $sql2 = mysqli_query($db, "UPDATE vlookup_mcore.vtruckrepair SET status = '$approvalstatus', cancelledreason = '$cancel_text', modeoffunds = '$modeoffunds' WHERE joborderidxx = '$joborderidxx'");
    }

    if ($sql1 && $sql2 && $sql3 || $sql1 && $sql2) {
        echo "Update successful.";
    } else {
        echo "Error: " . mysqli_error($db);
    }

} else {
    echo "Invalid request.";
}


?>