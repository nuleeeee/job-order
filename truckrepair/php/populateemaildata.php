<?php
include "../../phpconfig/allfunction.php";

if (isset($_POST['employeename'])) {

	$employeename = $_POST['employeename'];
	$brlogin = $_SESSION['branch'];

	$sql = "SELECT  joborderidxx, nameidz, CONCAT(lastname, ', ', firstname) as vname, brname, position, IFNULL(vdriver, '-') as vdriver,
					IFNULL(vbrand, '-') as vbrand, IFNULL(vmodel, '-') as vmodel, IFNULL(vyear, '-') as vyear,
					IFNULL(vplateno, '-') as vplateno, IFNULL(vodo, '-') as vodo, overview, supplier, material,
					qty, price, datacount, typeofcost, approvalstatus, status, aid_recipient,
					CASE
                        WHEN repairtype = 1 THEN 'TRUCK REPAIR'
                        WHEN repairtype = 2 THEN 'BUILDING REPAIR'
                        WHEN repairtype = 3 THEN 'WATER'
                        WHEN repairtype = 4 THEN 'ELECTRIC'
                        WHEN repairtype = 5 THEN 'COMMUNICATION'
                        WHEN repairtype = 6 THEN 'STATIONARY'
                        WHEN repairtype = 7 THEN 'MARKETING COLLATERALS'
                        WHEN repairtype = 8 THEN 'EQUIPMENT AND ASSETS'
                        WHEN repairtype = 9 THEN 'MIS BRANCH REPAIR'
                        WHEN repairtype = 10 THEN 'HR REQUEST'
                        WHEN repairtype = 11 THEN 'TRANSPORTATION'
                        WHEN repairtype = 12 THEN 'FUEL'
                        WHEN repairtype = 13 THEN 'FINANCIAL AID'
                        WHEN repairtype = 14 THEN 'OTHER DELIVERY EXPENSES'
                        WHEN repairtype = 15 THEN 'PERMIT RENEWALS'
                        WHEN repairtype = 16 THEN 'GARBAGE HAULER'
                        WHEN repairtype = 17 THEN 'CUSTOMER DELIGHT'
                        WHEN repairtype = 18 THEN 'SOLICITATIONS'
                    END as repairtype
			FROM vlookup_mcore.vtruckrepair tr
			LEFT OUTER JOIN
			(
				SELECT  joborderidz, IF(approvalstatus=1, supplier, 'PENDING') as supplier, material, qty, price, datacount,
						typeofcost, approvalstatus
				FROM vlookup_mcore.vrepaircanvass
			) as tbl on tbl.joborderidz = tr.joborderidxx
			LEFT OUTER JOIN vlookup_mcore.vnamenew vn on vn.nameidxx = tr.nameidz
			LEFT OUTER JOIN vlookup_mcore.vbranch vb on vb.branchidxx = vn.bridz
			LEFT OUTER JOIN
			(
				SELECT COALESCE(vlookup_mcore.vemployeeposition.position, IF(vproduct_mcore.category.catz IS NOT NULL, vproduct_mcore.category.catz, oldpos.position)) as position, nameidxx, lvlidz
				FROM vlookup_mcore.vnamenew
				LEFT OUTER JOIN
				(
					SELECT GROUP_CONCAT(catz SEPARATOR ', ') as position, nameidz FROM
					(
						SELECT dtr_mcore.brpos.*, catz FROM dtr_mcore.brpos
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
			) as showpos ON showpos.nameidxx = tr.nameidz
			LEFT OUTER JOIN
            (
                SELECT financialidxx, joborderidz as job_aidz, nameidz as nidz, aid_recipient FROM vlookup_mcore.vfinancialaid aid
                INNER JOIN
                (
                    SELECT nameidxx, CONCAT(lastname, ', ', firstname) as aid_recipient FROM vlookup_mcore.vnamenew
                ) AS vrecepient ON vrecepient.nameidxx = aid.nameidz
            ) AS vaid ON vaid.job_aidz = tr.joborderidxx
			WHERE nameidz = '$employeename'
			AND tr.joborderidxx IN (
			    SELECT MAX(joborderidxx) FROM vlookup_mcore.vtruckrepair WHERE nameidz = '$employeename' GROUP BY nameidz
			)";

	$result = mysqli_query($db, $sql);

	while ($row = mysqli_fetch_assoc($result)) {

	    if ($row["status"] == 0 && $row["approvalstatus"] != 1) {
	        $amount = "<span class='text-danger'>PENDING</span>";
	        $temp_amount = "₱ 0.00";
	    } else if ($row["status"] == 2) {
	        $amount = "<span class='text-secondary'>CANCELLED</span>";
	        $temp_amount = "₱ 0.00";
	    } else if ($row["status"] == 3) {
	        $amount = "<span class='text-secondary'>FOR CANCELLATION</span>";
	        $temp_amount = "₱ 0.00";
	    } else {
	        $amount = "<span class='text-primary'>₱ ".number_format($row["amount"], 2, '.', ',')."</span>";
	        $temp_amount = "₱ ".number_format($row["amount"], 2, '.', ',');
	    }

		$joborderidxx = $row['joborderidxx'];
		$nameidz = $row['nameidz'];
		$brname = $row['brname'];
		$vname = $row['vname'];
		$position = $row['position'];
		$overview = $row['overview'];
		$vdriver = $row['vdriver'];
		$vbrand = $row['vbrand'];
		$vmodel = $row['vmodel'];
		$vyear = $row['vyear'];
		$vplateno = $row['vplateno'];
		$vodo = $row['vodo'];
		$joborderidxx = $row['joborderidxx'];
		$supplier = $row['supplier'];
		$datacount = $row['datacount'];
		$aid_recipient = $row['aid_recipient'];
		$repairtype = $row['repairtype'];

	}

}

$data = array(
    'joid' => $joborderidxx,
    'nameid' => $nameidz,
    'brname' => $brname,
    'vname' => $vname,
    'position' => $position,
    'overview' => $overview,
    'driver' => $vdriver,
    'brand' => $vbrand,
    'model' => $vmodel,
    'year' => $vyear,
    'platenum' => $vplateno,
    'odo' => $vodo,
    'jobid' => $joborderidxx,
    'datacount' => $datacount,
    'suppname' => $supplier,
    'suppamount' => $temp_amount,
    'aid_recipient' => $aid_recipient,
    'repairtype' => $repairtype
);

echo json_encode($data);

?>