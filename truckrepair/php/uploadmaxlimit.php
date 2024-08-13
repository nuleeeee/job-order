<?php
include "../../phpconfig/allfunction.php";

$jobid = $_POST["jobid"];

$display = "SELECT joborderidz, COUNT(canvassidxx) as cid FROM vlookup_mcore.vrepaircanvass WHERE joborderidz = '$jobid' GROUP BY joborderidz ";

$result = mysqli_query($db, $display);
$row = mysqli_fetch_assoc($result);

$cid = $row['cid'];

echo $cid;

?>