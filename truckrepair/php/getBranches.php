<?php
include "../../phpconfig/allfunction.php";

$cashieridz = $_SESSION['login_user'];

$display = mysqli_query($db, "SELECT bridz, brname FROM vlookup_mcore.vnamenew vn
LEFT OUTER JOIN vlookup_mcore.vbranch vb ON vb.branchidxx = vn.bridz
WHERE nameidxx = '$cashieridz' ");

while ($row = mysqli_fetch_assoc($display)) {

	$bridz = $row['bridz'];
	$brname = $row['brname'];

	$data[] = array('bridz' => $bridz, 'brname' => $brname);
}

echo json_encode($data);


?>