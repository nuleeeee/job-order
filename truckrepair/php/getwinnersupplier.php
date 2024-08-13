<?php
include "../../phpconfig/allfunction.php";

$supplier = $_POST["suppname"];

$display = "SELECT suppcontactnum FROM vlookup_mcore.vrepairsupplier WHERE suppname = '$supplier' ";

$result = mysqli_query($db, $display);

$row = mysqli_fetch_assoc($result);
$contact = $row['suppcontactnum'];

echo $contact;

?>