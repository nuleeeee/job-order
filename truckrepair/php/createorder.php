<?php
include "../../phpconfig/allfunction.php";

$formidz = 43;

if (isset($_POST['employeename']))
{
	$typeselection = mysqli_real_escape_string($db, $_POST['type_selection']);
	$branchid = mysqli_real_escape_string($db, $_POST['branchid']);
	$employeename = mysqli_real_escape_string($db, $_POST['employeename']);
	$driver = mysqli_real_escape_string($db, $_POST['driver']);
	$brand = mysqli_real_escape_string($db, $_POST['brand']);
    $model = mysqli_real_escape_string($db, $_POST['model']);
    $year = mysqli_real_escape_string($db, $_POST['year']);
    $platenum = mysqli_real_escape_string($db, $_POST['platenum']);
    $odo = mysqli_real_escape_string($db, $_POST['odo']);
	$overview = mysqli_real_escape_string($db, $_POST['overview']);
	$aidee_name = mysqli_real_escape_string($db, $_POST['aidee_name']);


	$newID = getnewId($db, "vlookup_mcore", "vtruckrepair", "joborderidxx", $formidz, $branchid);

	if ($typeselection == 1) {
		$result1 = mysqli_query($db, "INSERT INTO vlookup_mcore.vtruckrepair (joborderidxx, nameidz, vbrand, vmodel, vyear, vplateno, vodo, overview, repairtype, status, tsz) VALUES ('$newID', '$employeename', '$brand', '$model', '$year', '$platenum', '$odo', '$overview', '$typeselection', 0, NOW())");
	} else if ($typeselection == 11) {
		$result1 = mysqli_query($db, "INSERT INTO vlookup_mcore.vtruckrepair (joborderidxx, nameidz, vdriver, vplateno, overview, repairtype, status, tsz) VALUES ('$newID', '$employeename', '$driver', '$platenum', '$overview', '$typeselection', 0, NOW())");
	} else if ($typeselection == 12) {
		$result1 = mysqli_query($db, "INSERT INTO vlookup_mcore.vtruckrepair (joborderidxx, nameidz, vplateno, overview, repairtype, status, tsz) VALUES ('$newID', '$employeename', '$platenum', '$overview', '$typeselection', 0, NOW())");
	} else if ($typeselection != 1) {
		$result1 = mysqli_query($db, "INSERT INTO vlookup_mcore.vtruckrepair (joborderidxx, nameidz, overview, repairtype, status, tsz) VALUES ('$newID', '$employeename', '$overview', '$typeselection', 0, NOW())");
	}

	
	if ($typeselection == 13) {
		// This is to insert into vfinancial aid
		$financialidxx = getnewId($db, "vlookup_mcore", "vfinancialaid", "financialidxx", $formidz, $branchid);

		$financialaid = mysqli_query($db, "INSERT INTO vlookup_mcore.vfinancialaid (financialidxx, joborderidz, nameidz, cashieridz, tsz) VALUES ('$financialidxx', '$newID', '$aidee_name', '$employeename', NOW())");
	}



	$laborcost_data_sets = array(
	    isset($_POST['laborcost_data1']) ? $_POST['laborcost_data1'] : array(),
	    isset($_POST['laborcost_data2']) ? $_POST['laborcost_data2'] : array(),
	    isset($_POST['laborcost_data3']) ? $_POST['laborcost_data3'] : array()
	);

	$materialcost_data_sets = array(
	    isset($_POST['materialcost_data1']) ? $_POST['materialcost_data1'] : array(),
	    isset($_POST['materialcost_data2']) ? $_POST['materialcost_data2'] : array(),
	    isset($_POST['materialcost_data3']) ? $_POST['materialcost_data3'] : array()
	);

	$labor_rows = count($laborcost_data_sets[0]);
	$material_rows = count($materialcost_data_sets[0]);

	$max_labor_iterations = count($laborcost_data_sets);
	$max_material_iterations = count($materialcost_data_sets);

	// Loop through the maximum number of iterations for labor data
	for ($labor_index = 0; $labor_index < $max_labor_iterations; $labor_index++) {
	    $labor_data = isset($laborcost_data_sets[$labor_index]) ? $laborcost_data_sets[$labor_index] : null;
	    
	    // Set datacount based on whether it's data1 or data2
	    $datacount = $labor_index + 1;
	    $costtype = "labor";

	    foreach ($labor_data as $row) {
	        $supplier = !empty($row['supplier']) ? mysqli_real_escape_string($db, $row['supplier']) : null;
	        $material = !empty($row['material']) ? mysqli_real_escape_string($db, $row['material']) : null;
	        $qty = !empty($row['qty']) ? mysqli_real_escape_string($db, $row['qty']) : null;
	        $price = !empty($row['price']) ? mysqli_real_escape_string($db, $row['price']) : null;
	        $attachments = !empty($row['attachments']) ? mysqli_real_escape_string($db, $row['attachments']) : null;

	        $newCanvassID = getnewId($db, "vlookup_mcore", "vrepaircanvass", "canvassidxx", $formidz, $branchid);

	        // Use the current $newCanvassID and $newID for insertion
	        $result2 = mysqli_query($db, "INSERT INTO vlookup_mcore.vrepaircanvass (canvassidxx, joborderidz, supplier, material, qty, price, datacount, typeofcost, attachments, approvalstatus, cashieridz, tsz) VALUES ('$newCanvassID', '$newID', '$supplier', '$material', '$qty', '$price', $datacount, '$costtype', '$attachments', 0, '$employeename', NOW())");

	        if (!$result2) {
	            echo "Error in labor iteration $labor_index, row: " . mysqli_error($db);
	        }
	    }
	}

	// Loop through the maximum number of iterations for material data
	for ($material_index = 0; $material_index < $max_material_iterations; $material_index++) {
	    $material_data = isset($materialcost_data_sets[$material_index]) ? $materialcost_data_sets[$material_index] : null;
	    
	    // Set datacount based on whether it's data1 or data2
	    $datacount = $material_index + 1;
	    $costtype = "material";

	    foreach ($material_data as $row) {
	        $supplier = !empty($row['supplier']) ? mysqli_real_escape_string($db, $row['supplier']) : null;
	        $material = !empty($row['material']) ? mysqli_real_escape_string($db, $row['material']) : null;
	        $qty = !empty($row['qty']) ? mysqli_real_escape_string($db, $row['qty']) : null;
	        $price = !empty($row['price']) ? mysqli_real_escape_string($db, $row['price']) : null;
	        $attachments = !empty($row['attachments']) ? mysqli_real_escape_string($db, $row['attachments']) : null;

	        $newCanvassID = getnewId($db, "vlookup_mcore", "vrepaircanvass", "canvassidxx", $formidz, $branchid);

	        // Use the current $newCanvassID and $newID for insertion
	        $result2 = mysqli_query($db, "INSERT INTO vlookup_mcore.vrepaircanvass (canvassidxx, joborderidz, supplier, material, qty, price, datacount, typeofcost, attachments, approvalstatus, cashieridz, tsz) VALUES ('$newCanvassID', '$newID', '$supplier', '$material', '$qty', '$price', $datacount, '$costtype', '$attachments', 0, '$employeename', NOW())");

	        if (!$result2) {
	            echo "Error in material iteration $material_index, row: " . mysqli_error($db);
	        }
	    }
	}


	if ($result1 && $result2) {
		echo "Records Inserted Successfully.";
	} else {
		echo "Error: " . mysqli_error($db);
	}
	
}

?>