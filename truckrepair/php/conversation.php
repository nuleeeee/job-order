<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION['login_user'];
$brlogin = $_SESSION['branch'];

$jobid = $_POST['jobid'];
$message = $_POST['message'];
$file_paths = $_POST['file_paths'];
$msngr = $_POST['msngr'];

$newId = getnewId($db, "vlookup_mcore", "joborder_convo", "convoidxx", 43, $brlogin);

if ($msngr == 1) {
    if (empty($file_paths)) {
        $sql = "INSERT INTO vlookup_mcore.joborder_convo (convoidxx, joborderidzz, nameidz, nameidz_message, nameidz_date, cashieridz, cashieridz_message, cashieridz_date, convo_status, tsz) VALUES ('$newId', '$jobid', '$cashieridz', '$message', NOW(), null,  null, null, 1, NOW())";
    } else {
        $sql = "INSERT INTO vlookup_mcore.joborder_convo (convoidxx, joborderidzz, nameidz, nameidz_message, nameidz_date, cashieridz, cashieridz_message, cashieridz_date, convo_attachments, convo_status, tsz) VALUES ('$newId', '$jobid', '$cashieridz', '$message', NOW(), null,  null, null, '$file_paths', 1, NOW())";
    }
} else {
    if (empty($file_paths)) {
        $sql = "INSERT INTO vlookup_mcore.joborder_convo (convoidxx, joborderidzz, nameidz, nameidz_message, nameidz_date, cashieridz, cashieridz_message, cashieridz_date, convo_status, tsz) VALUES ('$newId', '$jobid', null, null, null, '$cashieridz',  '$message', NOW(), 2, NOW())";
    } else {
        $sql = "INSERT INTO vlookup_mcore.joborder_convo (convoidxx, joborderidzz, nameidz, nameidz_message, nameidz_date, cashieridz, cashieridz_message, cashieridz_date, convo_attachments, convo_status, tsz) VALUES ('$newId', '$jobid', null, null, null, '$cashieridz',  '$message', NOW(), '$file_paths', 2, NOW())";
    }
}

$result = mysqli_query($db, $sql);

if (!$result) {
    echo 0;
} else {
    echo 1;
}

?>