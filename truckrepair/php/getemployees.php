<?php
include "../../phpconfig/allfunction.php";

$bridz = $_SESSION['branch'];
$cashieridz = $_SESSION['login_user'];

mysqli_set_charset($db, "utf8");

$display = mysqli_query($db, "SELECT nameidxx, CONCAT(lastname, ', ', firstname) as vname FROM vlookup_mcore.vnamenew WHERE bridz = '$bridz' AND nameidxx = '$cashieridz' ");

$data = array();

while ($row = mysqli_fetch_assoc($display)) {

	$nameid = utf8_encode($row['nameidxx']);
    $vname = utf8_encode($row['vname']);

	$data[] = array('nameid' => $nameid, 'vname' => $vname);
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);

?>