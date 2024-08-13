<?php
include "../../phpconfig/allfunction.php";

$nameid = $_POST['nameid'];

$display = "SELECT nameidxx, CONCAT(lastname, ', ', firstname) as vname, position FROM vlookup_mcore.vnamenew vn
			LEFT OUTER JOIN
			(
				SELECT COALESCE(vlookup_mcore.vemployeeposition.position, IF(vproduct_mcore.category.catz IS NOT NULL, vproduct_mcore.category.catz, oldpos.position)) as position, nameidxx as nameidz, lvlidz
				FROM vlookup_mcore.vnamenew
			    LEFT OUTER JOIN
			    (
					SELECT GROUP_CONCAT(catz SEPARATOR ', ') as position,nameidz FROM
			        (
						SELECT dtr_mcore.brpos.*,catz FROM dtr_mcore.brpos
			            INNER JOIN
			            (
							SELECT MAX(posidxx) as posidxx FROM dtr_mcore.brpos GROUP BY nameidz,catidz
						)as tbl ON tbl.posidxx = dtr_mcore.brpos.posidxx
			            INNER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = dtr_mcore.brpos.catidz
			            WHERE status = 0 AND trstatus = 0
					)as tbsub1
			        GROUP BY nameidz
				)as oldpos ON oldpos.nameidz = vlookup_mcore.vnamenew.nameidxx
			    LEFT OUTER JOIN vlookup_mcore.vemployeeposition ON vlookup_mcore.vemployeeposition.positionidxx = vlookup_mcore.vnamenew.positionidz
			    LEFT OUTER JOIN vproduct_mcore.category ON vproduct_mcore.category.catidxx = vlookup_mcore.vnamenew.positionidz
			) as showpos ON showpos.nameidz = vn.nameidxx
			WHERE nameidxx = '$nameid'
			ORDER BY vname ASC";

$result = mysqli_query($db, $display);

while ($row = mysqli_fetch_assoc($result)) {
	$position = $row['position'];
}

echo $position;

?>