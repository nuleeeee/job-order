<?php
include "../../phpconfig/allfunction.php";

$employee = $_POST['employee'];

$display = mysqli_query($db, "SELECT nameidxx, CONCAT(lastname, ', ', firstname) as vname, vlookup_mcore.vemployee.employeetype, 
								  vlookup_mcore.vemployeeposition.position, IFNULL(vemployeeconcess.supplier, '-') as supplier, 
								  vlookup_mcore.vemployeepositonlevel.positionlevel, bridz, vlookup_mcore.vbranch.brname
					          FROM vlookup_mcore.vnamenew
					          LEFT OUTER JOIN vlookup_mcore.vemployeeposition ON vlookup_mcore.vemployeeposition.positionidxx = vlookup_mcore.vnamenew.positionidz
					          LEFT OUTER JOIN vlookup_mcore.vemployeepositonlevel ON vlookup_mcore.vemployeepositonlevel.levelidxx = vlookup_mcore.vemployeeposition.lvlidz
					          INNER JOIN vlookup_mcore.vbranch ON vlookup_mcore.vbranch.branchidxx = vlookup_mcore.vnamenew.bridz
					          LEFT OUTER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = vlookup_mcore.vnamenew.positionidz
					          LEFT OUTER JOIN vlookup_mcore.vemployee ON vlookup_mcore.vemployee.employeetypeidxx = vlookup_mcore.vnamenew.employeetypeidz
					          LEFT OUTER JOIN vlookup_mcore.vemployeeconcess ON vlookup_mcore.vemployeeconcess.concessposidxx = vlookup_mcore.vnamenew.concessposidz
							  WHERE vlookup_mcore.vnamenew.hide = 0 AND (employeetypeidz = 3 OR (employeetypeidz <> 3 AND (NOT ISNULL(bankacct) OR bankacct = 'NULL'))) AND employeetype != 'HIRING ASSISTANCE' AND nameidxx = '$employee' ");

$data = array();

while ($row = mysqli_fetch_assoc($display)) {

	$position = $row['position'];
	$supplier = $row['supplier'];

	$data[] = array('position' => $position, 'supplier' => $supplier);
}

echo json_encode($data);


?>