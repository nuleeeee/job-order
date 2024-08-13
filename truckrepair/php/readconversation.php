<?php
date_default_timezone_set("Asia/Manila");
include "../../phpconfig/allfunction.php";

$jobid = $_POST['jobid'];
$msngr = $_POST['msngr'];

if ($msngr == 1) {
	$msg = "UPDATE vlookup_mcore.joborder_convo SET convo_status = 0
			WHERE joborderidzz = '$jobid' AND cashieridz IS NOT NULL AND convo_status = 2
			ORDER BY convoidxx DESC LIMIT 1";
} else {
	$msg = "UPDATE vlookup_mcore.joborder_convo SET convo_status = 0
		WHERE joborderidzz = '$jobid' AND nameidz IS NOT NULL AND convo_status = 1
		ORDER BY convoidxx DESC LIMIT 1";
}

mysqli_query($db, $msg);

?>