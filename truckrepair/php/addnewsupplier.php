<?php
include "../../phpconfig/allfunction.php";

$formidz = 43;
$branchid = 0;

$cashieridz = $_SESSION['login_user'];

if (isset($_POST['add_name']))
{
	$add_name = mysqli_real_escape_string($db, $_POST['add_name']);
	$add_contact = mysqli_real_escape_string($db, $_POST['add_contact']);
	$add_address = mysqli_real_escape_string($db, $_POST['add_address']);


	$newID = getnewId($db, "vlookup_mcore", "vrepairsupplier", "idxx", $formidz, $branchid);

	$sql = mysqli_query($db, "INSERT INTO vlookup_mcore.vrepairsupplier (idxx, suppname, suppcontactnum, suppaddress, cashieridz, tsz) VALUES ('$newID', '$add_name', '$add_contact', '$add_address', '$cashieridz', NOW())");

}

?>
